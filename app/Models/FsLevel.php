<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FsLevel extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'game_type' => ['name' => 'Loại trò chơi','type' => 'select','validate' => 'required','is_show' => true,'data' => 'platform.game_type'],
        'member_id' => ['name' => 'Mã thành viên','type' => 'number','is_show' => false],
        'level' => ['name' => 'Xếp hạng','type' => 'number','validate' => 'required','is_show' => true],
        'name' => ['name' => 'Tên','type' => 'string','validate' => 'required','is_show' => true],
        'quota' => ['name' => 'Số tiền đặt cược hợp lệ','type' => 'number','validate' => 'required','is_show' => true],
        'type' => ['name' => 'Loại','type' => 'select','data' => 'platform.fs_type','is_show' => true],
        'rate' => ['name' => 'Tỷ lệ','type' => 'number','validate' => 'required','is_show' => true],
        'lang' => ['name' => 'Ngôn ngữ / Tiền tệ','type' => 'select','is_show' => true,'data' => 'platform.lang_select'],
    ];

    const TYPE_SYSTEM = 1;
    const TYPE_MEMBER = 2;

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    // 根据有效投注和游戏类型获取最大的返点
    // FsLevel::memberMaxRate(1,100,1)
    public function scopeMemberMaxRate($query,$member_id,$quota,$gametype){
        return $query->whereIn('member_id',[$member_id,0])->where('quota','<',$quota)->where('game_type',$gametype)->orderBy('rate','desc');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
