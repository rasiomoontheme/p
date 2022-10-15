<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentInviteRecord extends Model
{
    public $guarded = ['id'];

    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
