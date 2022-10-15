<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAgentApply extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên','type' => 'text','is_show' => true,'validate' => 'required'],
        'name' => ['name' => 'Tên thật','type' => 'text','is_show' => true],
        'phone' => ['name' => 'Số điện thoại','type' => 'text','is_show' => true],
        'email' => ['name' => 'email','type' => 'text','is_show' => true],
        'msn_qq' => ['name' => 'Liên hệ với MSN / QQ','type' => 'text','is_show' => true,'min-width' => '140px'],
        'reason' => ['name' => 'Lý do ứng dụng','type' => 'text','is_show' => true],
        'status' => ['name' => 'Tình trạng ứng dụng','type' => 'select','is_show' => true,'data' => 'platform.apply_status'],
        'fail_reason' => ['name' => 'Lý do thất bại','type' => 'text','is_show' => false]
    ];

    const STATUS_NOT_DEAL = 0;
    const STATUS_ENSURE = 1;
    const STATUS_REJECT = 2;

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }
}
