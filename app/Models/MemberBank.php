<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberBank extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number', 'is_show' => true],
        'card_no' => ['name' => 'Số thẻ', 'type' => 'text', 'validate' => 'required', 'is_show' => true],
        'bank_type' => ['name' => 'Loại ngân hàng', 'type' => 'text', 'is_show' => false],
        'bank_type_text' => ['name' => 'Loại ngân hàng', 'type' => 'text', 'is_show' => true],
        'phone' => ['name' => 'Số điện thoại', 'type' => 'text', 'is_show' => false],
        'owner_name' => ['name' => 'Tên chủ thẻ', 'type' => 'text','validate' => 'required', 'is_show' => true],
        'bank_address' => ['name' => 'Địa chỉ mở tài khoản', 'type' => 'text', 'is_show' => true],
        'remark' => ['name' => 'Ghi chú hoạt động', 'type' => 'text', 'is_show' => false],
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public $appends = ['bank_type_text'];

    public function getBankTypeTextAttribute(){
        // return isset_and_not_empty(config('platform.bank_type'), $this->attributes['bank_type'], $this->attributes['bank_type']);
        return isset_and_not_empty(Bank::getAllBankArray(), $this->attributes['bank_type'], $this->attributes['bank_type']);
    }
}
