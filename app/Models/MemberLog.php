<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberLog extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public $hidden = ['access_token'];

    // 详情页面的数据解释
    public static $list_field = [
        // 'id' => 'ID',
        'member_id' => ['name' => 'Mã thành viên','type' => 'text','is_show' => 'true'],
        'ip' => ['name' => 'IP hoạt động','type' => 'text','is_show' => true],
        'address' => ['name' => 'Địa chỉ IP thực','type' => 'text','is_show' => true],
        'ua' => ['name' => 'Môi trường hoạt động','type' => 'text','is_show' => false],
        'type' => ['name' => 'Loại hoạt động','type' => 'select','is_show' => true,'data' => 'platform.member_log_type'],
        // 'access_token' => ['name' => 'TOKEN','is_show' => ],
        'description' => ['name' => 'Hoạt động Mô tả','type' => 'text','is_show' => true],
        'remark' => ['name' => '备注','type' => 'text','is_show' => true],
    ];

    const LOG_TYPE_API_LOGIN = 1; // 会员登录
    const LOG_TYPE_API_LOGOUT = 2;// 会员登出
    const LOG_TYPE_API_ACTION = 3; // 会员操作
    const LOG_TYPE_AGENT_LOGIN = 4; // 代理后台登录
    const LOG_TYPE_AGENT_LOGOUT = 5; // 代理后台登出
    const LOG_TYPE_TRANSFER_ERROR = 6;// 会员转入接口异常
    const LOG_TYPE_MEMBER_SMS = 7; // 会员短信注册
    const LOG_TYPE_MEMBER_RESET_SMS = 8; // 会员短信注册
    const LOG_TYPE_MEMBER_BIND_SMS = 9; // 会员绑定手机

    const STATUS_NORMAL = 0; // 0 正常
    const STATUS_NOT_DEAL = 1; // 1 待处理
    const STATUS_DEALED = 2;// 2 已处理

    public function member()
    {
        return $this->belongsTo('App\Models\Member','member_id');
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public function scopeMemberRecent($query){
        return $this->where('type',self::LOG_TYPE_API_LOGIN)
            // ->whereIn('member_id',Member::where('is_tips_on',1)->pluck('id'))
            ->whereBetween('created_at',[Carbon::now()->subSeconds(15),Carbon::now()]);
    }

    public function scopeMemberLoginFail($query,$name){
        return $query->where('member_id',0)->where('type',self::LOG_TYPE_API_LOGIN)
            ->where('description','like','%'.$name.'%');
    }

    public function scopeMemberLoginSuccess($query,$name){
        return $query->where('member_id','>',0)->where('type',self::LOG_TYPE_API_LOGIN)
            ->where('description','like','%'.$name.'%');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
