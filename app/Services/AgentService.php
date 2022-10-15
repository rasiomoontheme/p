<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\Agent;
use App\Models\AgentFdMoneyLog;
use App\Models\AgentFdRate;
use App\Models\AgentYjLog;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\MemberMoneyLog;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AgentService{
    // top_id 表示 上级代理的代理ID

    // 是否是传统代理模式
    public function isTraditionalMode(){
        return systemconfig('agent_fd_mode') == 0;
    }

    public function checkTraditional(){
        if(!self::isTraditionalMode()) throw new InvalidRequestException(trans('res.agent_page.notice.traditional_only',[],request('lang') ?? ''));
    }

    public function checkAllAgent(){
        if(self::isTraditionalMode()) throw new InvalidRequestException(trans('res.agent_page.notice.allagent_only',[],request('lang') ?? ''));
    }

    // 根据游戏记录生成返点记录
    public function getAgentFdMoneyLogByRecord(GameRecord $record){
        if(!$record || !$record->canSendFd() || !$record->billNo) return ['code' => -1,'msg' => '游戏记录不存在或未结算，或者已经返点过'];

        $member = $record->member;
        if(!$member) return ['code' => -1,'msg' => trans('res.api.common.member_not_exist')];

        // 根据游戏类型获取当前会员的返点
        $member_fd = AgentFdRate::getMemberFdByGameType($member->id,$record->gameType)->first();

        if($member->isAgent() && (!$member_fd || !$member_fd->rate)) return ['code' => -1,'msg' => trans('res.agent_page.notice.rate_not_exist')];

        // 根据游戏类型获取上级会员的返点
        /*
        $agent_fd = AgentFdRate::getMemberFdByGameType($member->top->member_id,$record->gameType);

        if(!$agent_fd) return;

        // 如果会员的点位大于代理的点位
        if($member_fd->rate > $agent_fd->rate) return;
        */

        // 循环发放返点，获取所有的上级和点位  上级代理member_id）=> 下级代理member_id [1 => 3,3 => 2]
        $top_member_list = $this->getAllTopMember($member->id);

        // 获取上级的所有点位 member_id => rate [1 => "6.00",3 => "5.00"]
        $top_member_rates = AgentFdRate::whereIn('member_id',array_keys($top_member_list))
            ->where('type', AgentFdRate::TYPE_AGENT_MEMBER)
            ->where('game_type',$record->gameType)->pluck('rate','member_id')->toArray();

        try{
            DB::transaction(function() use($top_member_rates,$top_member_list,$member,$member_fd,$record) {

                // 如果是代理，那么将自己的那部分的返点发放给自己(错误)
                // 投注者自身不需要返点，可以领取反水
                /**
                if($member->isAgent()){
                    $member_money_before = $member->money;

                    $member_fd_money = getRateMoney($member_fd->rate,$record->validBetAmount);//sprintf("%.2f",$member_fd->rate * $record->validBetAmount);
                    $member->increment('money',$member_fd_money);

                    AgentFdMoneyLog::create([
                        'member_id' => $member->id,
                        'member_rate' => $member_fd->rate,
                        'agent_member_id' => $member->id,
                        'agent_member_rate' => $member_fd->rate,
                        'game_type' => $record->gameType,
                        'bet_amount' => $record->validBetAmount,
                        'fd_money' => $member_fd_money,
                        'record_billno' => $record->billNo,
                        'money_before' => $member_money_before,
                        'money_after' => $member->money
                    ]);
                }
                **/
                $record->update(['is_fd' => 1]);

                // 生成返点记录
                foreach ($top_member_rates as $agent_meber_id => $rate){
                    // 获取下级的返点，如果下级是会员，则获取会员的返点
                    $child_member_rate = $top_member_list[$agent_meber_id] == $member->id ? $member_fd->rate ?? 0 : $top_member_rates[$top_member_list[$agent_meber_id]];

                    if($rate <= $child_member_rate) continue;

                    $fd_money = getRateMoney($rate - $child_member_rate,$record->validBetAmount);

                    $agent_member = Member::find($agent_meber_id);
                    if(!$agent_member) continue;

                    $money_before = $agent_member->money;
                    $agent_member->increment('money',$fd_money);

                    AgentFdMoneyLog::create([
                        'member_id' => $member->id,
                        'member_rate' => $member_fd->rate ?? 0,
                        'agent_member_id' => $agent_meber_id,
                        'agent_member_rate' => $rate,
                        'child_member_id' => $top_member_list[$agent_meber_id],
                        'child_member_rate' => $child_member_rate,
                        'game_type' => $record->gameType,
                        'bet_amount' => $record->validBetAmount,
                        'fd_money' => $fd_money,
                        'record_billno' => $record->billNo,
                        'money_before' => $money_before,
                        'money_after' => $agent_member->money
                    ]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return ['code' => -1,'msg' => trans('res.api.common.operate_error').$e->getMessage()];
        }

        return ['code' => 0];
    }

    // 根据会员ID获取会员的所有上级 app(App\Services\AgentService::class)->getAllTopMember(2)
    // 包括该会员id
    public function getAllTopMember($id,$list = []){
        $member = Member::find($id);
        if($member->top_id > 0 && $member->top_member)
            $list[$member->top_member->id ?? 0] = $member->id;

        if($member && $member->top_id > 0 && $member->top_member && $member->top_member->top_id > 0){
            return $this->getAllTopMember($member->top_member->id,$list);
        }

        return $list;
    }

    //根据代理的会员ID获取所有的下级，包括自己(会员 和 代理)(member_id 数组) app(App\Services\AgentService::class)->getAllChildId(1)
    public function getAllChildId($member_id){
        /*
        $agent = Member::find($member_id);
        $list = [];
        if(!$agent->isAgent()) return $list;

        $childs = $agent->agentchild->pluck('id')->toArray();
        if(count($childs)){
            foreach ($childs as $id){
                $list[] = $id;
                $list = array_merge($list,$this->getAllChildId($id));
                //return $this->getAllChildId($id);
            }
        }

        return $list;
        */
        $member = Member::find($member_id);
        if(!$member) return [];
        $data = Member::where('status',1)->get(['id','top_id','agent_id'])->toArray();
        $list = $this->circle_member_list($data,$member->agent_id);
        // 从list 中删除 member_id
        return array_filter($list,function($item) use ($member_id){
            return $item !== $member_id;
        });
    }

    // app(App\Services\AgentService::class)->getAgentAndChildMemberIds(10)
    public function getAgentAndChildMemberIds($member_id){
        $data = $this->getAllChildId($member_id);
        array_push($data,$member_id);
        return $data;
    }

    // 这里的 pid 是 agent_id
    public function circle_member_list($data, $pid = 0, $root = 1){
        static $new_data = [];
        if($pid == 0) return $new_data;

        if($root == 1 && count($new_data)) $new_data = [];

        //循环遍历传递过来的数据
        foreach ($data as $key => $value) {
            //判断数据的上级 ID 是否等于当前 ID，最顶级 ID 为 0
            //这里的上级 ID 在数据库中的字段为 parent_id
            if ($value['top_id'] == $pid) {
                $new_data[] = $value['id'];
                $value['root'] = $root;

                // 去掉已经处理过的数据，这一步是关键，可以提高效率
                unset($data[$key]);

                //使用当前数据记录的 ID 进行再次循环排序
                $this->circle_member_list($data, $value['agent_id'], $root + 1);
            }
        }
        return $new_data;
    }

    // 判断 child_member_id 是否是 agent_member_id 的下级
    public function isAgentChild($agent_member_id, $child_member_id){
        return in_array($child_member_id,$this->getAllChildId($agent_member_id));
    }

    // 判断 child_member_id 的直属上级是否是 member
    public function isDirectChild(Member $member,$childMember){
        if(is_numeric($childMember)) $childMember = Member::find($childMember);
        return $member->agent_id && $childMember && $childMember->top_id && $member->agent_id == $childMember->top_id;
    }

    public function getChildMemberIds(Member $member){
        if($this->isTraditionalMode()){
             return Member::where('top_id',$member->agent_id)->pluck('id');
        }else{
            return $this->getAllChildId($member->id);
        }
    }

    // 直推会员
    public function getDirectChildMemberIds(Member $member){
        return Member::where('top_id',$member->agent_id)->pluck('id')->toArray();
    }

    // 代理下级的不是直推的所有会员
    public function getNotDirectChildMemberIds(Member $member){
        $all_child_ids = $this->getAllChildId($member->id);

        return array_values(array_diff($all_child_ids,$this->getDirectChildMemberIds($member)));
    }

    // 获取时间范围的数据统计信息（包括 会员的福利金额，代理的佣金 和 全民代理的返点）
    public function getTotalFreeMoney($start_at){
        $member_free = MemberMoneyLog::where('created_at','>',$start_at)
            ->whereNotIn('member_id',Member::demoIdLists())
            ->activityMoney()->sum('money');

        $agent_yj = AgentYjLog::where('created_at','>',$start_at)->sum('money');

        $agent_fd = AgentFdMoneyLog::where('created_at','>',$start_at)->sum('fd_money');

        return $member_free + $agent_yj + $agent_fd;
    }

    // app(App\Services\AgentService::class)->test();
    public function test(){
        $api_games = \App\Models\ApiGame::where('lang','zh_cn')->get();
        // ->makeHidden('game_type_text')->toArray();

        foreach($api_games as $game){
            $data = $game->toArray();
            unset($data['id']);
            unset($data['game_type_text']);
            unset($data['game_type_cn_text']);
            unset($data['created_at']);
            unset($data['updated_at']);
            $data['lang_json'] = $game->lang_json;
            $data['lang'] = 'zh_hk';
            \App\Models\ApiGame::create($data);
            // dd($data);
        }

        // return $api_games;
    }
}