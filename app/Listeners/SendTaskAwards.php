<?php

namespace App\Listeners;

use App\Events\CheckAwards;
use App\Models\MemberMoneyLog;
use App\Models\MemberTask;
use App\Models\Message;
use App\Models\User;
use App\Services\AdminLogService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class SendTaskAwards
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckAwards  $event
     * @return void
     */
    public function handle(CheckAwards $event)
    {
        $member = $event->member;

        // 查找用户有没有未发放的奖励数据
        $tasks = $member->tasks->where('status',MemberTask::STATUS_RECEIVING);
        if(!$tasks->count()) return;

        $money_type = 'fs_money';
        if(systemconfig('activity_money_type')) $money_type = systemconfig('activity_money_type');

        foreach ($tasks as $item){
            $task = $item->task;

            if(!$task) continue;

            // 判断条件，一般是金额奖励才会连续发放奖励,在金额日志中查询已经发放过几次奖励
            $logs = MemberMoneyLog::where('model_name',get_class($task))->where('model_id',$task->id)->orderBy('created_at','desc')->get();

            if($logs->count() >= $task->award_content['money_times']){
                return $item->update(['status' => MemberTask::STATUS_RECEIVED]);
            }

            $count = $logs->count() + 1;

            // 在checktask时会发放第一次的奖金，所以logs大于等于1
            // 判断当前时间和最后领取时间，是否相差超过 $task->award_content['money_per_day']
            if($logs->count() && $logs->first()->created_at->diffInDays(Carbon::now()) >= $task->award_content['money_per_day']){
                try{
                    DB::transaction(function() use ($member,$task,$logs,$item,$count,$money_type){
                        $money_before = $member->$money_type;

                        $member->increment($money_type,$task->award_content['money']);

                        if($count >= $task->award_content['money_times']){
                            $item->update(['status' => MemberTask::STATUS_RECEIVED]);
                        }

                        MemberMoneyLog::create([
                            'member_id' => $member->id,
                            'money' => $task->award_content['money'],
                            'money_before' => $money_before,
                            'money_after' => $member->$money_type,
                            'money_type' => $money_type,
                            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                            'operate_type' => MemberMoneyLog::OPERATE_TYPE_HONGLI,
                            'model_name' => get_class($task),
                            'model_id' => $task->id,
                            'description' => '会员完成任务【'.$task->title.'】发放第【'.$count.'】次奖励【'.$task->award_content['money'].'】元'
                        ]);

                        Message::create([
                            'member_id' => $member->id,
                            'user_id' => User::first()->id,
                            'title' => '奖励发放通知',
                            'content' => '发放任务【'.$task->title.'】第【'.$count.'】次奖励'
                        ]);
                    });
                }catch (\Exception $e){
                    DB::rollBack();
                    // dd($e->getMessage());
                    app(AdminLogService::class)->systemLogCreate('会员【'.$member->name.'】完成任务【'.$task->title.'】后第【'.$count.'】次奖励发放失败，报错信息：'.$e->getMessage());
                }
            }
        }
    }
}
