<?php

namespace App\Listeners;

use App\Events\CheckAwards;
use App\Events\CheckTask;
use App\Models\Member;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckMemberTask
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
     * @param  CheckTask  $event
     * @return void
     */
    public function handle(CheckTask $event)
    {
        $member = $event->member;
        $condition_type = $event->condition_type;

        try{app(GameService::class)->convertSumGameRecord($this->auth->user()->id);}catch (\Exception $e){}

        $service = app(TaskService::class);

        writelog('['.$event->member->name.']check task ,condition-type:'.config('platform.task_condition_types')[$condition_type]);

        // 根据条件判断任务是否达成
        switch ($condition_type){
            case Task::TYPE_SINGLE_RECHARGE:
            case Task::TYPE_SUM_RECHARGE:
                // $this->checkRecharge($member);
                $service->checkRecharge($member);
                break;
            case Task::TYPE_SUM_DRAWING:
                $service->checkDrawing($member);
                break;
            case Task::TYPE_SUM_LOSS:
            case Task::TYPE_SUM_PROFIT:
            case Task::TYPE_SUM_TRANSACTION:
                // 累计输的金额达到
                $service->checkLossAndProfit($member);
                break;
        }
        // 检查是否发放奖励
        event(new CheckAwards($member));

        // 检查会员是否晋级
        $service->checkMemberNewLevel($member);
    }
}
