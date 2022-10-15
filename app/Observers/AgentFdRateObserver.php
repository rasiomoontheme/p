<?php

namespace App\Observers;

use App\Exceptions\InvalidRequestException;
use App\Models\AgentFdRate;
use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AgentFdRateObserver
{
    public function saving(AgentFdRate $rate){
        // $game_type_text = config('platform.game_type')[$rate->game_type];
        // $game_type_text = Arr::get(config('platform.game_type'),$rate->game_type,'-');
        $game_type_text = Arr::get(trans('res.option.game_type'),$rate->game_type);
        // if(!$game_type_text) return $rate->delete();

        // type = 3 或 5 时，不能低于最高，不能高于最低
        if($rate->type == AgentFdRate::TYPE_SYSTEN_AGENT || $rate->type == AgentFdRate::TYPE_AGENT_MEMBER || $rate->type == AgentFdRate::TYPE_AGENT_CHILD){
            // 查询该游戏类型的最高和最低返点
            $sys = AgentFdRate::where('game_type',$rate->game_type)->whereIn('type',[AgentFdRate::TYPE_SYSTEM_HIGHEST,AgentFdRate::TYPE_SYSTEM_LOWEST])->pluck('rate','type');

            if($rate->rate < $sys[AgentFdRate::TYPE_SYSTEM_LOWEST])
                // '游戏类型【'.$game_type_text.'】的反水点位不能低于系统设置的最低点位【'.$sys[AgentFdRate::TYPE_SYSTEM_LOWEST].'】'
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.lower_than_system',['game_type' => $game_type_text,'rate' => $sys[AgentFdRate::TYPE_SYSTEM_LOWEST]]));

            if($rate->rate > $sys[AgentFdRate::TYPE_SYSTEM_HIGHEST])
                // .'游戏类型【'.$game_type_text.'】的反水点位不能高于系统设置的最高点位【'.$sys[AgentFdRate::TYPE_SYSTEM_HIGHEST].'】'
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.higher_than_system',['game_type' => $game_type_text,'rate' => $sys[AgentFdRate::TYPE_SYSTEM_HIGHEST]]));
        }

        // TYPE_AGENT_MEMBER 表示自身的点位，自身点位 不能高于自身的点位 不能低于下级代理的下级代理中的最高点位
        if($rate->type == AgentFdRate::TYPE_AGENT_MEMBER){
            if($rate->parent_id == 0) $rate->parent_id = $rate->member->top->member->id ?? 0;

            if($rate->parent_id == 0) return;

            $top_agent_rates = AgentFdRate::getMemberFdByGameType($rate->parent_id,$rate->game_type)->first();
            if(!$top_agent_rates)
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.rate_not_set',['game_type' => $game_type_text]));

            if($top_agent_rates->rate < $rate->rate)
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.child_rate_err',['game_type' => $game_type_text,'rate' => $top_agent_rates->rate]));

            $childMaxRate = AgentFdRate::where('game_type',$rate->game_type)
                ->where('type',AgentFdRate::TYPE_AGENT_MEMBER)
                ->whereIn('member_id',Member::where('status',1)->where('top_id',$rate->member->agent_id)->pluck('id'))->max('rate');
            if($childMaxRate > $rate->rate)
                // '游戏类型【'.$game_type_text.'】的反水点位不能低于该代理的下级的最高点位【'.$childMaxRate.'】'
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.top_rate_err',['game_type' => $game_type_text,'rate' => $childMaxRate]));
        }

        else if($rate->type == AgentFdRate::TYPE_AGENT_CHILD){
            // 不能高于上级代理的点位
            $agrates = AgentFdRate::where('game_type',$rate->game_type)->where('member_id',$rate->member_id)->where('type',AgentFdRate::TYPE_AGENT_MEMBER)->first();
            if(!$agrates)
                // '您游戏类型【'.$game_type_text.'】的反水点位尚未设置，请联系您的上级代理或者管理员'
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.rate_not_set',['game_type' => $game_type_text]));

            if($rate->rate > $agrates->rate)
                // '游戏类型【'.$game_type_text.'】的反水点位不能高于自身的点位【'.$agrates->rate.'】'
                throw new InvalidRequestException(trans('res.api.agent_fd_rates.agent_rate_err',['game_type' => $game_type_text,'rate' => $agrates->rate]));

            // 不能低于下级账号的点位
            /**
            $childMaxRate = AgentFdRate::where('game_type',$rate->game_type)
                ->where('type',AgentFdRate::TYPE_AGENT_MEMBER)
                ->whereIn('member_id',Member::where('status',1)->where('top_id',$rate->member->agent_id)->pluck('id'))->max('rate');
            if($childMaxRate > $rate->rate)
                throw new InvalidRequestException('游戏类型【'.$game_type_text.'】的反水点位不能低于该代理的下级的最高点位【'.$childMaxRate.'】');
             */
        }
    }
}
