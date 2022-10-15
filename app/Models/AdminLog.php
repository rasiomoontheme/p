<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminLog extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    const LOG_TYPE_LOGIN = 1; // 后台登录
    const LOG_TYPE_LOGOUT = 2;// 后台登出
    const LOG_TYPE_ACTION = 3; // 后台操作
    const LOG_TYPE_SYSTEM = 4; // 系统异常

    public static $logTypeMap = [
        self::LOG_TYPE_LOGIN => '后台登录',
        self::LOG_TYPE_LOGOUT => '后台登出',
        self::LOG_TYPE_ACTION => '后台操作',
        self::LOG_TYPE_SYSTEM => '系统异常'
    ];

    // 详情页面的数据解释
    public static $list_field = [
        'id' => 'ID',
        'user_id' => 'ID quản trị viên',
        'user_name' => 'Tên người dùng quản trị',
        'url' => 'Địa chỉ hoạt động',
        'data' => 'Dữ liệu hoạt động',
        'ip' => 'IP hoạt động',
        'address' => 'Địa chỉ IP thực',
        'ua' => 'Môi trường hoạt động',
        'type' => 'Loại hoạt động',
        'type_text' => 'Mô tả loại hoạt động',
        'description' => 'Hoạt động Mô tả',
        'remark' => 'Ghi chú hoạt động',
        'created_at' => 'Tạo mới lúc',
        'updated_at' => 'Cập nhật lúc'
    ];

    protected $appends = ['type_text','user_name'];

    public function getTypeTextAttribute(){
        return isset_and_not_empty(self::$logTypeMap,$this->attributes['type'],$this->attributes['type']);
    }

    public function getUserNameAttribute(){
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
