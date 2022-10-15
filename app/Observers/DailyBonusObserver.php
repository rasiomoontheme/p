<?php

namespace App\Observers;

use App\Models\DailyBonus;

class DailyBonusObserver
{
    public function saved(DailyBonus $mod){
        // 如果state被设置为确认领奖
        if($mod->state == DailyBonus::STATE_ENSURE 
            && $mod->bonus_money > 0
            && in_array($mod->type,[DailyBonus::TYPE_SERIAL_AWARD,DailyBonus::TYPE_TOTAL_AWARD])){
            if(!$mod->getOriginal('state')){
                $mod->sendBonus();
            }else if($mod->getOriginal('state') != DailyBonus::STATE_ENSURE){
                $mod->sendBonus();
            }
        }
    }
}
