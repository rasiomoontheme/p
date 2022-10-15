<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentFdRate extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'parent_id' => ['name' => 'ID Cha','type' => 'number', 'is_show' => false],
        'member_id' => ['name' => 'ID thành viên hiện tại','type' => 'number', 'is_show' => true],
        'game_type' => ['name' => 'Loại trò chơi','type' => 'select','validate' => 'required','is_show' => true,'data' => 'platform.game_type'],
        'type' => ['name' => 'Loại điểm','type' => 'select','validate' => 'required','is_show' => true,'data' => 'platform.agent_rate_type'],
        'rate' => ['name' => 'Phần trăm chiết khấu (%)','type' => 'number','validate' => 'required','is_show' => true],
        'remark' => ['name' => 'Nhận xét','type' => 'text','is_show' => true]
    ];

    const TYPE_SYSTEM_HIGHEST = 1; // 系统最高返点点位
    const TYPE_SYSTEM_LOWEST = 2; // 系统最低返点点位
    const TYPE_AGENT_MEMBER = 3; // 代理/会员点位 parent_id => 父级代理ID, member_id => '当前会员ID'
    const TYPE_AGENT_CHILD = 4;// 代理下线的默认点位
    const TYPE_SYSTEN_AGENT = 5; // 系统代理默认点位

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function scopeGetMemberFdByGameType($query,$member_id,$game_type){
        return $query->where('type', self::TYPE_AGENT_MEMBER)
            ->where('member_id',$member_id)
            ->where('game_type',$game_type)->latest();//->first();
    }

    public function getGameTypeTextAttribute(){
        return isset_and_not_empty(config('platform.game_type'),$this->attributes['game_type'],$this->attributes['game_type']);
    }

    public function scopeFomatterOutput($query){
        return $query->whereIn('game_type',array_keys(config('platform.game_type')))
            ->get(['game_type','rate'])
            ->each->setAppends(['game_type_text'])->toArray();
    }
}
