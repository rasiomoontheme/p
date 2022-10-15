<?php

namespace App\Events;

use App\Models\AgentInvite;
use App\Models\Member;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AutoInviteFd
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $invite,$member;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AgentInvite $invite,Member $member)
    {
        $this->invite = $invite;
        $this->member = $member;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
