<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    protected $guard_name = 'web';

    const STATUS_NORMAL = 1;
    const STATUS_FORBIDEN = -1;

    public static $statusMap = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_FORBIDEN => '禁止'
    ];

    public static $list_field = [
        'name' => ['name' => '用户名'],
        'password' => ['name' => '密码'],
    ];

    protected $fillable = [
        'name', 'password','create_ip','status','lang','google_secret'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    public function hasPermission($route){
        // 如果有 超级管理员角色
        if(in_array(1,$this->roles->pluck('id')->toArray())) return true;

        return in_array($route,$this->getAllPermissions()
            ->where('route_name','<>',null)
            ->pluck('route_name')
            ->toArray()
        );
    }

    // 是否需要单用户登录
    public function isSingleLogin(){
        // return $this->name == 'admin';
        // return true; // 所有后台用户都是单用户登录
        return !in_array(get_client_ip(),SystemConfig::getIpListArray());
    }

    public function getLastLoginLog(){
        return AdminLog::where('type',AdminLog::LOG_TYPE_LOGIN)
            ->where('user_id',$this->id)->where('remark','!=','')
            ->latest()->first();
    }

    public function getLoginSessionTag(){
        return 'user_'.$this->id.'_tag';
    }
}
