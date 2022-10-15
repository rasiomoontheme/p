<?php

namespace App\Listeners;

use App\Events\AutoMemberFd;
use App\Models\AgentFdRate;
use App\Services\AgentService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class SetAgentChildMemberFd
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
     * @param  AutoMemberFd  $event
     * @return void
     */
    public function handle(AutoMemberFd $event)
    {
        $member = $event->member;

        $rates = [];

        if(app(AgentService::class)->isTraditionalMode()) return;

        // 如果是会员，则不设置点位
        if(!$member->isAgent()) return;

        // 如果会员或者代理已经设置了点位，那么则不设置
        if(AgentFdRate::where('member_id',$member->id)->where('type',AgentFdRate::TYPE_AGENT_MEMBER)->count() > 0) return;

        // 判断 member 是否有上级，如果有，则设置上级的默认点位或者上级同样的点位，
        if($member->top_id){
            // 判断上级是否设置了下级会员的默认点位
            $rates = AgentFdRate::where('member_id',$member->top->member_id)->where('type',AgentFdRate::TYPE_AGENT_CHILD)->latest()->pluck('rate','game_type')->toArray();

            // 如果没有设置下级会员的默认点位，则设置和上级代理相同的点位
            if(!count($rates)) $rates = AgentFdRate::where('member_id',$member->top->member_id)->where('type',AgentFdRate::TYPE_AGENT_MEMBER)->latest()->pluck('rate','game_type')->toArray();
        }else{
            // 如果没有上级，则设置系统默认点位
            $rates = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEN_AGENT)->pluck('rate','game_type');
        }
        $now = Carbon::now();
        foreach ($rates as $key => $value){
            /**
            AgentFdRate::create([
                'parent_id' => $member->top_id ?? 0,
                'member_id' => $member->id,
                'game_type' => $key,
                'type' => AgentFdRate::TYPE_AGENT_MEMBER,
                'rate' => $value
            ]);
             */
            DB::table('agent_fd_rates')->insert([
                'parent_id' => $member->top_id ?? 0,
                'member_id' => $member->id,
                'game_type' => $key,
                'type' => AgentFdRate::TYPE_AGENT_MEMBER,
                'rate' => $value,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }


    }
}
