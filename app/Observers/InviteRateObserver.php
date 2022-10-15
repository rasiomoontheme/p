<?php

namespace App\Observers;

use App\Exceptions\InvalidRequestException;
use App\Models\AgentFdRate;
use App\Models\InviteRate;

class InviteRateObserver
{
    public function saving(InviteRate $r){
        if($r->agent_invite && $r->agent_invite->member){
            $member = $r->agent_invite->member;
            // 获取该代理的点位
            $rate = AgentFdRate::where('member_id',$member->id)
                ->where('game_type',$r->game_type)
                ->where('type',AgentFdRate::TYPE_AGENT_MEMBER)
                ->first();

            $game_type_text = Arr::get(trans('res.option.game_type'),$r->game_type);

            if(!$rate)
                // '您游戏类型【'.config('platform.game_type')[$r->game_type].'】的反水点位尚未设置，请联系您的上级代理或者管理员'
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.rate_not_set',['game_type' => $game_type_text]));

            if($rate->rate < $r->rate)
                // '邀请注册链接【'.config('platform.game_type')[$r->game_type].'】类型的返点不能高于您自身的返点'
                throw new InvalidRequestException(trans('res.api.invite_rate.self_rate_err',['game_type' => $game_type_text]));

            // 不能低于系统最低点位
            $sys_low = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)
                ->where('game_type',$r->game_type)->first();

            if($sys_low && $sys_low->rate > $r->rate)
                // '邀请注册链接【'.config('platform.game_type')[$r->game_type].'】类型的返点不能低于系统设置的最低点位【'.$sys_low->rate.'】'
                throw new InvalidRequestException(trans('res.api.invite_rate.lower_than_system',['game_type' => $game_type_text,'rate' => $sys_low->rate]));
        }
    }
}
