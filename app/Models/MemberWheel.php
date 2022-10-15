<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberWheel extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number', 'is_show' => true],
        'user_id' => ['name' => 'ID quản trị viên', 'type' => 'number', 'is_show' => false],
        'award_id' => ['name' => 'ID giải thưởng','type' => 'number','is_show' => false],
        'award_desc' => ['name' => 'Mô tả giải thưởng','type' => 'number','is_show' => true],
        'status' => ['name' => 'Nhận trạng thái','type' => 'select','is_show' => true,'data' => 'platform.wheel_status']
    ];

    const STATUS_NOT_SEND = 1;
    const STATUS_SENDED = 2;
    const STATUS_SENDING = 3;

    protected $appends = ['status_text'];

    public function getStatusTextAttribute(){
        return isset_and_not_empty(config('platform.wheel_status'),$this->attributes['status'],$this->attributes['status']);
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
