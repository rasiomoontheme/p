<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Drawing;
use App\Models\FsLevel;
use App\Models\GameRecord;
use App\Models\LevelConfig;
use App\Models\Member;
use App\Models\MemberLevelBonus;
use App\Models\MemberMoneyLog;
use App\Models\MemberTask;
use App\Models\Message;
use App\Models\Recharge;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskService{

    // 同一个任务可能需要领取多次
    /**
     * // 如果是 晋级奖励，并且money_times = 0 (表示可以一直领取下去)
    if($item->isSystemTask() && array_key_exists('money_times',$item->award_content) && $item->award_content['money_times'] == 0) return true;
     * @param Member $member
     * @param $types
     * @return mixed
     */
    public function getUndoTasks(Member $member,$types){
        // 判断 借呗是否逾期，如果逾期则暂停发放奖励

        $types = is_array($types) ? $types : [$types];
        // return Task::whereIn('condition_type',$types)->whereHas('membertasks',function($query){},'>=',);
        //->whereNotIn('id',$member->tasks->pluck('task_id'))->get();
        return Task::whereIn('condition_type',$types)
            ->notSystem()
            ->withCount(['membertasks' => function($query) use ($member){
                $query->where('member_id',$member->id);
            }])->get()
            ->filter(function($item){
                // 如果任务中设置了 奖励可领取次数,并且奖励次数大于目前已经完成的次数
                if(array_key_exists('money_times',$item->award_content) && $item->award_content['money_times'] > $item->membertasks_count) return true;

                // 如果任务中没有设置了 奖励可领取次数，并且任务已经完成过
                if(!array_key_exists('money_times',$item->award_content) && $item->membertasks_count >= 1) return false;

                // 如果任务中设置了奖励可领取次数，并且奖励次数小于目前已经完成的次数
                if(array_key_exists('money_times',$item->award_content) && $item->award_content['money_times'] < $item->membertasks_count) return false;

                return true;
            });
    }

    public function checkRecharge(Member $member){
        // 查找未完成的task
        $tasks = $this->getUndoTasks($member,[Task::TYPE_SINGLE_RECHARGE,Task::TYPE_SUM_RECHARGE]);

        if(!$tasks->count()) return ['code' => '-1','message' => trans('res.api.task.no_task')];

        foreach ($tasks as $item){
            if($item->condition_type == Task::TYPE_SUM_RECHARGE){
                // 统计用户充值的总金额
                $total = Recharge::where('member_id',$member->id)
                    ->where('status',Recharge::STATUS_SUCCESS)
                    ->where('created_at','>',$item->created_at)
                    ->sum('money');

                if($total > $item->condition_money){
                    // 任务达标
                    $this->sendAward($item,$member,$total);
                }

            }else if($item->condition_type == Task::TYPE_SINGLE_RECHARGE){
                // 判断是否有金额达标的数据
                $groups = Recharge::select(DB::raw('count(*) as times,date(created_at) as date'))
                    ->where('member_id',$member->id)
                    ->where('money','>=',$item->condition_money)
                    ->where('status',Recharge::STATUS_SUCCESS)
                    ->where('created_at','>',$item->created_at) // 订单时间大于任务创建时间
                    ->groupBy('date')->having('times','>=',$item->condition_number)->get();

                // 判断统计数据的长度是否大于
                if($groups->count() >= $item->condition_day){
                    $this->sendAward($item,$member);
                }
            }
        }
    }

    // 累计亏损 / 盈利 / 流水
    public function checkLossAndProfit(Member $member){
        $tasks = $this->getUndoTasks($member,[Task::TYPE_SUM_PROFIT,Task::TYPE_SUM_LOSS,Task::TYPE_SUM_TRANSACTION]);

        // 检查是否需要发放晋级奖励
        $this->checkMemberLevelup($member);

        if(!$tasks->count()) return ['code' => '-1','message' => trans('res.api.task.no_task')];

        foreach ($tasks as $item){

            // 判断累计输额是否达标
            $total = GameRecord::where('member_id',$member->id)
                ->where('status','<>','X')
                ->where('created_at','>',$item->created_at)
                // ->where('betAmount','>','netAmount')
                ->get()
                ->sum(function($record) use($item){
                    if($item->condition_type == Task::TYPE_SUM_LOSS && $record->betAmount > $record->netAmount){
                        return $record->betAmount - $record->netAmount;
                    }else if($item->condition_type == Task::TYPE_SUM_PROFIT && $record->netAmount > $record->betAmount){
                        return $record->netAmount - $record->betAmount;
                    }else if($item->condition_type == Task::TYPE_SUM_TRANSACTION){
                        return $record->validBetAmount;
                    }
                    return 0;
                });

            if($total >= $item->condition_money){

                if($item->isSystemTask()) continue;
                // 任务达标
                $this->sendAward($item,$member,$total);
            }
        }
    }

    // 检查累计提款
    public function checkDrawing(Member $member){
        $tasks = $this->getUndoTasks($member,Task::TYPE_SUM_DRAWING);

        if(!$tasks->count()) return ['code' => '-1','message' => trans('res.api.task.no_task')];

        foreach ($tasks as $item){
            $total = Drawing::where('member_id',$member->id)
                ->where('status',Drawing::STATUS_SUCCESS)
                ->where('created_at','>',$item->created_at)
                ->sum('money');

            if($total >= $item->condition_money){
                // 任务达标
                $this->sendAward($item,$member,$total);
            }
        }
    }

    // 发放任务奖励
    public function sendAward(Task $task,Member $member,$total = 0){
        $money_type = 'fs_money';
        if(systemconfig('activity_money_type')) $money_type = systemconfig('activity_money_type');

        try{
            DB::transaction(function() use ($task,$member,$total,$money_type){
                // 标记任务完成
                $mt = MemberTask::create([
                    'task_id' => $task->id,
                    'member_id' => $member->id
                ]);

                // 增加余额
                if($task->award_type == Task::AWARD_TYPE_MONEY){
                    $money_before = $member->$money_type;

                    $member->increment($money_type,$task->award_content['money']);

                    // 如果奖励次数不止一次，那么标记领取中
                    if($task->award_content['money_times'] > 1){
                        $mt->update(['status' => MemberTask::STATUS_RECEIVING]);
                    }

                    MemberMoneyLog::create([
                        'member_id' => $member->id,
                        'money' => $task->award_content['money'],
                        'money_before' => $money_before,
                        'money_after' => $member->$money_type,
                        'money_type' => $money_type,
                        'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                        'operate_type' => MemberMoneyLog::OPERATE_TYPE_HONGLI,
                        'model_name' => get_class($mt),
                        'model_id' => $mt->id,
                        'description' => '会员完成任务【'.$task->title.'】发放奖励【'.$task->award_content['money'].'】元'
                    ]);

                }else if($task->award_type == Task::AWARD_TYPE_FD){
                    // 修改返点
                    FsLevel::create([
                        'member_id' => $member->id,
                        'game_type' => $task->award_content['game_type'],
                        'type' => FsLevel::TYPE_MEMBER,
                        'quota' => 0,
                        'rate' => $task->award_content['fd_percent'],
                    ]);
                }

                // 通知会员
                Message::create([
                    'member_id' => $member->id,
                    'user_id' => auth('web')->user()->id ?? 0,
                    'visible_type' => Message::VISIBLE_TYPE_MEMBER,
                    'title' => trans('res.api.task.task_complete_title'),
                    'content' => trans('res.api.task.task_complete_desc',['title' => $task->title]).$task->getTaskDescription()
                ]);
            });
        }catch (\Exception $e){
            DB::rollback();
            // 任务完成失败
            app(AdminLogService::class)->systemLogCreate('会员【'.$member->name.'】完成任务【'.$task->title.'】后奖励发放失败，报错信息：'.$e->getMessage());
            // dd('任务失败：'.$e->getMessage());
        }
    }

    // app(App\Services\TaskService::class)->checkMemberNewLevel(\App\Models\Member::find(1));
    public function checkMemberNewLevel(Member $member){
        // if(!$member->level) return;

        // 获取会员最大领取等级记录
        $max_level = MemberLevelBonus::where('member_id',$member->id)
            ->where('type',MemberMoneyLog::OPERATE_TYPE_LEVEL_BONUS)->max('level');

        // if(!$max_level) return;

        // 获取会员的累计流水
        $total_bet = app(GameRecord::class)->getMemberTotalValidBet($member->id);

        $total_deposit = Recharge::where('member_id',$member->id)->where('status',Recharge::STATUS_SUCCESS)->sum('money');

        // writelog('bet:'.$total_bet.',deposit:'.$total_deposit);
        // 检查是否需要发放晋级礼金，借呗额度
        $this->sendNewLevelUpAward($member,$max_level,$total_bet,$total_deposit);

        // 检查是否需要发放日礼金，周礼金，月礼金，年礼金
        $this->sendNewBonusAward($member);
    }

    // level 上次发放晋级礼金的等级
    public function sendNewLevelUpAward(Member $member,$level,$total_bet = 0, $total_deposit = 0){
        $level = $level + 1;
        $levelConfig = LevelConfig::where('level',$level)->where('lang',$member->lang)->first();

        // 配置数据不存在
        if(!$levelConfig) return;

        if(!$total_bet) $total_bet = app(GameRecord::class)->getMemberTotalValidBet($member->id);
        if(!$total_deposit) $total_deposit = Recharge::where('member_id',$member->id)->where('status',Recharge::STATUS_SUCCESS)->sum('money');

        // 判断会员是否晋级
        if(!$levelConfig->isMemberLevelUp($total_bet,$total_deposit)) return;

        // 如果晋级了，就发放晋级奖励
        if(MemberLevelBonus::where('member_id',$member->id)
            ->where('level',$level)
            ->where('type',MemberMoneyLog::OPERATE_TYPE_LEVEL_BONUS)->exists())
            return $this->sendNewLevelUpAward($member,$level,$total_bet,$total_deposit);

        try{
            DB::transaction(function() use($member, $levelConfig,$level) {
                // 创建领取记录
                MemberLevelBonus::create([
                    'member_id' => $member->id,
                    'level' => $level,
                    'type' => MemberMoneyLog::OPERATE_TYPE_LEVEL_BONUS
                ]);

                $money_before = $member->money;
                $money_type = 'money';
                // 增加会员金额
                $member->increment($money_type,$levelConfig->level_bonus);

                // 增加借呗额度
                if($levelConfig->credit_bonus){
                    $member->increment('total_credit',$levelConfig->credit_bonus);
                }

                $member->update([
                    'level' => $levelConfig->level,
                    'level_name' => $levelConfig->level_name
                ]);

                // 金额日志
                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $levelConfig->level_bonus,
                    'money_before' => $money_before,
                    'money_after' => $member->money,
                    'money_type' => $money_type,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_LEVEL_BONUS,
                    'description' => trans('res.api.level_config.level_up_award_msg',['name' => $member->name,'level' => $level,'money' => $levelConfig->level_bonus,'credit' => $levelConfig->credit_bonus],$member->lang)
                ]);

                // 发放通知
                Message::create([
                    'member_id' => $member->id,
                    'user_id' => auth('web')->user()->id ?? 0,
                    'visible_type' => Message::VISIBLE_TYPE_MEMBER,
                    'title' => trans('res.api.level_config.level_up_award_title'),
                    // 'content' => '恭喜您领取【'.$member->level.'级 ~ '.$level.'级】晋级奖励。'.$msg
                    'content' => trans('res.api.level_config.level_up_award_desc',['level_name' => $levelConfig->level_name,'money' => $levelConfig->level_bonus,'credit' => $levelConfig->credit_bonus],$member->lang),
                ]);
            });
        }catch (\Exception $e){
            DB::rollback();
            // 任务完成失败
            app(AdminLogService::class)->systemLogCreate('会员【'.$member->name.'】领取【'.$level.'级】晋级礼金失败，报错信息：'.$e->getMessage());
        }

        return $this->sendNewLevelUpAward($member,$level,$total_bet,$total_deposit);
    }

    public function sendNewBonusAward(Member $member){
        try{
            DB::transaction(function() use($member) {
                $money_type = 'money';

                $arr = [
                    'day' => 1,
                    'week' => 7,
                    'month' => 30,
                    'year' => 365
                ];

                $config = LevelConfig::where('level', $member->level)->where('lang',$member->lang)->first();

                if(!$config) return;

                foreach ($arr as $field => $day){
                    $money_field_name = $field."_bonus";
                    $award_money = $config->$money_field_name;

                    // 检查奖励金额字段是否大于0
                    if($award_money <= 0) continue;

                    $type_field = MemberMoneyLog::getAwardTypeByDay($day);
                    // 检查几天内是否发放过改奖励
                    $last = MemberLevelBonus::where('member_id',$member->id)
                        ->where('type',$type_field)->latest()->first();

                    // 如果几天之内发放过
                    if($last && $last->created_at->diffInDays(Carbon::now()) <= $day) continue;

                    if($last && $last->created_at->gt(Carbon::now()->subDays($day))) continue;

                    $money_before = $member->money;

                    $member->increment($money_type,$award_money);

                    MemberLevelBonus::create([
                        'member_id' => $member->id,
                        'level' => $member->level,
                        'type' => $type_field
                    ]);

                    MemberMoneyLog::create([
                        'member_id' => $member->id,
                        'money' => $award_money,
                        'money_before' => $money_before,
                        'money_after' => $member->$money_type,
                        'money_type' => $money_type,
                        'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                        'operate_type' => $type_field,
                        'model_name' => get_class($config),
                        'model_id' => $config->id,
                        'description' => trans('res.api.level_config.'.$field.'_bonus_award_msg',['level' => $member->level,'money' => $award_money],$member->lang),
                        'created_at' => $last ? $last->created_at->addDays($day) : Carbon::now()
                    ]);

                    // 通知信息
                    Message::create([
                        'member_id' => $member->id,
                        'user_id' => auth('web')->user()->id ?? 0,
                        'visible_type' => Message::VISIBLE_TYPE_MEMBER,
                        'title' => trans('res.api.level_config.'.$field.'_bonus_award_title',[],$member->lang),
                        'content' => trans('res.api.level_config.'.$field.'_bonus_award_desc',['level' => $member->level,'money' => $award_money],$member->lang)
                    ]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            app(AdminLogService::class)->systemLogCreate('会员【'.$member->name.'】领取【'.$member->level.'级】福利奖金失败，报错信息：'.$e->getMessage());
        }
    }

    // app(App\Services\TaskService::class)->checkMemberLevelup(\App\Models\Member::find(1));
    public function checkMemberLevelup(Member $member){
        // 获取会员的 累计流水
        /**
        $total = GameRecord::where('member_id',$member->id)
        ->where('status','<>','X')
        ->get()
        ->sum(function($record){
        return $record->validBetAmount;
        });
         **/

        $total = app(GameRecord::class)->getMemberTotalValidBet($member->id);

        $task = Task::systemLevel()
            ->where('condition_type',Task::TYPE_SUM_TRANSACTION)
            ->where('condition_money','<=',$total)
            ->orderBy('condition_money','desc')
            ->first();

        if($task && $task->level && $task->level > $member->level) $this->sendLevelupAward($member,$task->level);

        if($member->level) $this->sendSerialLevelAward($member);
    }

    // 发放晋级奖励
    public function sendLevelupAward(Member $member,$level){
        $before_level = $member->level;
        // $msg = "发放会员【".$member->name."】从【".$before_level."级】到【".$level."级】的晋级奖励，奖励内容包括：“";
        $msg = trans('res.api.task.level_up_desc_start',['name' => $member->name,'old_level' => $before_level,'level' => $level]);

        try{
            DB::transaction(function() use ($member, $level,$msg){
                $tasks = Task::where('level',$level)->whereIn('level_award_type',[Task::LEVEL_TYPE_NAME,Task::LEVEL_TYPE_BORROW])->get();

                $content = [];

                // 发放称号奖励  和 借呗奖励
                if($name = $tasks->where('level_award_type',Task::LEVEL_TYPE_NAME)->first()){
                    $content['level'] = $level;
                    MemberTask::create([
                        'task_id' => $name->id,
                        'member_id' => $member->id
                    ]);
                    $msg .= trans('res.option.level_award_type.name_award')."、";
                }

                if($borrow = $tasks->where('level_award_type',Task::LEVEL_TYPE_BORROW)->first()){
                    $content['total_credit'] = \Arr::get($borrow->award_content,'money');
                    MemberTask::create([
                        'task_id' => $borrow->id,
                        'member_id' => $member->id
                    ]);
                    $msg .= trans('res.option.level_award_type.borrow_award')."、";
                }

                // 查询晋级奖励金额
                $money_tasks = Task::where('level','>',$member->level)->where('level','<=',$level)
                    ->where('level_award_type',Task::LEVEL_TYPE_LEVEL)->get();

                $total_money = 0;
                $msg .= trans('res.api.task.level_up_award')."【";
                foreach ($money_tasks as $item){
                    $money = \Arr::get($item->award_content,'money',0);
                    $total_money += $money;
                    $msg .= " ".trans('res.api.common.money_desc',['money' => $money])." +";
                    MemberTask::create([
                        'task_id' => $item->id,
                        'member_id' => $member->id
                    ]);
                }
                $msg = mb_substr($msg,0,mb_strlen($msg) - 1);
                $msg .= "】";
                $msg .= "”";

                $money_type = 'money';
                $money_before = $member->$money_type;
                $money_after = $money_before + $total_money;
                $content[$money_type] = $money_after;

                $member->update($content);

                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $total_money,
                    'money_before' => $money_before,
                    'money_after' => $money_after,
                    'money_type' => $money_type,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_LEVELUP,
                    'description' => $msg
                ]);

                // 通知会员
                Message::create([
                    'member_id' => $member->id,
                    'user_id' => auth('web')->user()->id ?? 0,
                    'visible_type' => Message::VISIBLE_TYPE_MEMBER,
                    'title' => trans('res.api.task.level_up_title'),
                    // 'content' => '恭喜您领取【'.$member->level.'级 ~ '.$level.'级】晋级奖励。'.$msg
                    'content' => trans('res.api.task.level_up_desc',['old_level' => $member->level,'level' => $level]),
                ]);
            });
        }catch (\Exception $e){
            DB::rollback();
            // 任务完成失败
            app(AdminLogService::class)->systemLogCreate('会员【'.$member->name.'】领取【'.$member->level.'级 ~ '.$level.'级】晋级奖励失败，报错信息：'.$e->getMessage());
        }
    }

    // 发放周 / 月俸禄
    // app(App\Services\TaskService::class)->sendSerialLevelAward(\App\Models\Member::find(1));
    public function sendSerialLevelAward(Member $member){
        try{
            DB::transaction(function () use ($member){
                $money_type = 'money';

                // 查询上次周俸禄发放时间
                $lastWeek = MemberMoneyLog::where('member_id',$member->id)
                    ->where('operate_type',MemberMoneyLog::OPERATE_TYPE_WEEKE_AWARD)
                    ->latest()->first();

                if(!$lastWeek || ($lastWeek && $lastWeek->created_at->diffInDays(Carbon::now()) >= 7) && $lastWeek->created_at->lt(Carbon::now()->subWeek())){
                    $task = Task::systemLevelAndType($member->level,Task::LEVEL_TYPE_WEEK)->first();

                    if($task){
                        $money_before = $member->money;
                        $member->increment($money_type,\Arr::get($task->award_content,'money',0));
                        MemberMoneyLog::create([
                            'member_id' => $member->id,
                            'money' => \Arr::get($task->award_content,'money',0),
                            'money_before' => $money_before,
                            'money_after' => $member->$money_type,
                            'money_type' => $money_type,
                            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                            'operate_type' => MemberMoneyLog::OPERATE_TYPE_WEEKE_AWARD,
                            'model_name' => get_class($task),
                            'model_id' => $task->id,
                            'description' => '会员领取【'.$member->level.'级】周俸禄，发放奖励【'.$task->award_content['money'].'】元',
                            // 'created_at' => $lastWeek->created_at->addWeek()
                            'created_at' => $lastWeek ? $lastWeek->created_at->addWeek() : Carbon::now()
                        ]);

                        // 通知信息
                        Message::create([
                            'member_id' => $member->id,
                            'user_id' => auth('web')->user()->id ?? 0,
                            'visible_type' => Message::VISIBLE_TYPE_MEMBER,
                            'title' => trans('res.api.task.week_award_title'),
                            // 'content' => '恭喜您领取【'.$member->level.'级】周俸禄【'.$task->award_content['money'].'元】'
                            'content' => trans('res.api.task.week_award_desc',['level' => $member->level,'money' => $task->award_content['money']])
                        ]);
                    }
                }

                $lastMonth = MemberMoneyLog::where('member_id',$member->id)
                    ->where('operate_type',MemberMoneyLog::OPERATE_TYPE_MONTH_AWARD)->latest()->first();
                if(!$lastMonth || ($lastMonth && $lastMonth->created_at->diffInDays(Carbon::now()) >= 30) && $lastMonth->created_at->lt(Carbon::now()->subMonth())){
                    $task = Task::systemLevelAndType($member->level,Task::LEVEL_TYPE_MONTH)->first();

                    if($task){
                        $money_before = $member->money;
                        $member->increment($money_type,\Arr::get($task->award_content,'money',0));
                        MemberMoneyLog::create([
                            'member_id' => $member->id,
                            'money' => \Arr::get($task->award_content,'money',0),
                            'money_before' => $money_before,
                            'money_after' => $member->$money_type,
                            'money_type' => $money_type,
                            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                            'operate_type' => MemberMoneyLog::OPERATE_TYPE_MONTH_AWARD,
                            'model_name' => get_class($task),
                            'model_id' => $task->id,
                            'description' => '会员领取【'.$member->level.'级】月俸禄，发放奖励【'.$task->award_content['money'].'】元',
                            'created_at' => $lastMonth ? $lastMonth->created_at->addMonth() : Carbon::now()
                        ]);

                        // 通知信息
                        Message::create([
                            'member_id' => $member->id,
                            'user_id' => auth('web')->user()->id ?? 0,
                            'visible_type' => Message::VISIBLE_TYPE_MEMBER,
                            'title' => trans('res.api.task.month_award_title'),
                            // 'content' => '恭喜您领取【'.$member->level.'级】月俸禄【'.$task->award_content['money'].'元】'
                            'content' => trans('res.api.task.month_award_desc',['level' => $member->level,'money' => $task->award_content['money']])
                        ]);
                    }
                }
            });
        }catch (\Exception $e){
            DB::rollback();
            app(AdminLogService::class)->systemLogCreate('会员【'.$member->name.'】领取【'.$member->level.'级】周俸禄 / 月俸禄 失败，报错信息：'.$e->getMessage());
        }
    }
}
