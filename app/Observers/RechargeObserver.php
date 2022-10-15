<?php

namespace App\Observers;

use App\Events\CheckTask;
use App\Models\MemberMoneyLog;
use App\Models\Recharge;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class RechargeObserver
{
    // 当充值状态设置为 充值成功时，触发event，判断是否有自动任务完成
    public function saved(Recharge $recharge){

        if($recharge->isDirty() && in_array('status',array_keys($recharge->getDirty())) && $recharge->status == Recharge::STATUS_SUCCESS){
            //writelog('recharge id:'.$recharge->id.'充值确认通过');
            event(new CheckTask($recharge->member,Task::TYPE_SINGLE_RECHARGE));

            // 充值之后，记录充值日志
            // 如果是 第三方充值，，如果没有记录金额变化日志，自动记录金额变化日志
            if($recharge->isThirdPay() && !MemberMoneyLog::whereModel($recharge)
                ->where('operate_type',MemberMoneyLog::OPERATE_TYPE_MEMBER)->exists()){
                MemberMoneyLog::create([
                    'member_id' => $recharge->member_id,
                    'money' => $recharge->money,
                    'money_before' => $recharge->before_money ?? 0,
                    'money_after' => $recharge->after_money ?? 0,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_MEMBER,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'model_name' => get_class($recharge),
                    'model_id' => $recharge->id
                ]);

                $recharge->addRechargeML();
            }
        }else{
            //writelog('$recharge->isDirty:'.$recharge->isDirty());
            //writelog('$recharge->getDirty:'.json_encode($recharge->getDirty()));
            //writelog('$recharge->status:'.$recharge->status);
            //writelog('condition:'.in_array('status',array_keys($recharge->getDirty())));
        }
    }
}
