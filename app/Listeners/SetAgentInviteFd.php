<?php

namespace App\Listeners;

use App\Events\AutoInviteFd;
use App\Models\AgentFdRate;
use App\Models\AgentInviteRecord;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetAgentInviteFd
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
     * @param  object  $event
     * @return void
     */
    public function handle(AutoInviteFd $event)
    {
        $invite = $event->invite;
        $member = $event->member;

        $rates = $invite->invite_rates;

        $agent_member = $invite->member;
        if(!$rates->count() || !$member) return;

        foreach ($rates as $item){
            AgentFdRate::create([
                'parent_id' => $agent_member->agent_id ?? 0,
                'member_id' => $member->id,
                'game_type' => $item->game_type,
                'type' => AgentFdRate::TYPE_AGENT_MEMBER,
                'rate' => $item->rate
            ]);
        }

        AgentInviteRecord::create([
            'member_id' => $member->id,
            'invite_id' => $invite->id
        ]);
    }
}
