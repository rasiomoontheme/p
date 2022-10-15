<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberYuebaoPlan extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number', 'is_show' => true],
        'plan_id' => ['name' => 'ID lược đồ','type' => 'number','is_show' => false],
        'amount' => ['name' => 'Giá mua','type' => 'number','is_show' => true],
        'status' => ['name' => 'Trạng thái','type' => 'select','is_show' => true, 'data' => 'platform.yuebao_member_status'],
        'drawing_at' => ['name' => 'Thời gian rút tiền','type' => 'text','is_show' => true]
    ];

    const STATUS_PROCESSING = 0; // '进行中'
    const STATUS_DONE = 1; // 结束

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function plan(){
        return $this->belongsTo('App\Models\YuebaoPlan','plan_id');
    }

    public function history(){
        return $this->hasMany('App\Models\InterestHistory','member_plan_id','id');
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
