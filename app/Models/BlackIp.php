<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlackIp extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'ip' => ['name' => 'Địa chỉ IP','is_show' => true,'type' => 'text'],
        'is_open' => ['name' => 'Có mở không','is_show' => true,'type' => 'radio','data' => 'platform.is_open'],
        'remark' => ['name' => 'Nhận xét','is_show' => true,'type' => 'text']
    ];

    // \App\Models\BlackIp::getIpArray()
    public function scopeGetIpArray($query){
        return $query->where('is_open',1)->pluck('ip')->toArray();
    }
}
