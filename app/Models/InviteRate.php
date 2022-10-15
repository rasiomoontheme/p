<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteRate extends Model
{
    public $guarded = ['id'];

    public $appends = ['game_type_text'];

    public function getGameTypeTextAttribute(){
        return isset_and_not_empty(config('platform.game_type'),$this->attributes['game_type'],$this->attributes['game_type']);
    }

    public function agent_invite(){
        return $this->belongsTo(AgentInvite::class,'invite_id','id');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
