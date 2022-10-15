<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberApi extends Model
{
    protected $guarded = ["id"];

    public static $list_field = [
        'api_name' => ['name' => 'ID giao diện','is_show' => true],
        'member_id' => ['name' => 'Mã thành viên','is_show' => true],
        'username' => ['name' => 'Tài khoản','is_show' => true],
        'password' => ['name' => 'Mật khẩu','is_show' => true],
        'money' => ['name' => 'Số dư','is_show' => true],
        'last_login_at' => ['name' => 'Lần đăng nhập cuối cùng','is_show' => true],
        'description' => ['name' => 'Mô tả','is_show' => true]
    ];

    protected function scopeApi($query, $api_code){
        return $query->where('api_name',$api_code)->first();
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member','member_id','id');
    }

    public function api(){
        return $this->hasOne('App\Models\Api','api_name','api_name');
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }
}
