<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentInvite extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'agent_member_id' => ['name' => 'ID thành viên của đại lý','type' => 'number'],
        'token' => ['name' => 'Mã mời','type' => 'text'],
        'is_open' => ['name' => 'Nó mở rồi', 'type' => 'radio', 'validate' => 'required', 'data' => 'platform.is_open', 'is_show' => true, 'style' => 'platform.style_boolean']
    ];

    public function member(){
        return $this->belongsTo(Member::class,'agent_member_id','id');
    }

    public function invite_rates(){
        return $this->hasMany(InviteRate::class,'invite_id','id');
    }

    public function records(){
        return $this->hasMany(AgentInviteRecord::class,'invite_id','id');
    }

    public function getPcInviteUrlAttribute(){
        return quicklink('pc_register').'?token='.$this->token;
    }

    public function getWapInviteUrlAttribute(){
        return quicklink('wap_register').'?token='.$this->token;
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
