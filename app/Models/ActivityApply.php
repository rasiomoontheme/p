<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityApply extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number', 'is_show' => true],
        'user_id' => ['name' => 'ID quản trị viên', 'type' => 'number', 'is_show' => true],

        'activity_id' => ['name' => 'ID sự kiện','type' => 'number','is_show' => false],
        'data_content' => ['name' => 'Thông tin ứng dụng','type' => 'text','is_show' => false],
        'status' => ['name' => 'Trạng thái','type' => 'select','is_show' => true,'data' => 'platform.activity_apply_status'],
        'remark' => ['name' => 'Nhận xét','type' => 'text','is_show' => false],
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public function scopeMemberLang($query,$lang){
        return $lang ? $query->whereHas('member',function($q) use($lang){
            $q->where('lang',$lang);
        }) : $query;
    }

    public function activity(){
        return $this->belongsTo('App\Models\Activity');
    }

    const STATUS_NOT_DEAL = 0; // 待审核
    const STATUS_ENSURE = 1;// 已确认
    const STATUS_REJECT = 2;// 已拒绝
    const STATUS_BONUS = 3; // 优惠已下发

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        if(!array_key_exists('status',$this->attributes)){

            return '';
        }
        return isset_and_not_empty(config('platform.activity_apply_status'), $this->attributes['status'], $this->attributes['status']);
    }
}
