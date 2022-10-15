<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'card_no' => ['name' => 'Số thẻ', 'type' => 'text', 'validate' => 'required', 'is_show' => true],
        'card_type' => ['name' => 'Loại thẻ', 'type' => 'radio', 'is_show' => true,'data' => 'platform.card_type'],
        'bank_type' => ['name' => 'Loại ngân hàng', 'type' => 'select', 'is_show' => true, 'data' => 'platform.bank_type'],
        'phone' => ['name' => 'Số điện thoại đăng ký thẻ', 'type' => 'text', 'is_show' => true],
        'owner_name' => ['name' => 'Tên chủ thẻ', 'type' => 'text','validate' => 'required', 'is_show' => true],
        'bank_address' => ['name' => 'Địa chỉ mở tài khoản', 'type' => 'text', 'is_show' => true],
        'is_open' => ['name' => 'Có bật không','type' => 'radio','validate' => 'required','data' => 'platform.is_open','is_show' => true,'style' => 'platform.style_boolean'],
    ];

    public $appends = ['bank_type_text'];

    public function getBankTypeTextAttribute(){
        return isset_and_not_empty(config('platform.bank_type'), $this->attributes['bank_type'], $this->attributes['bank_type']);
    }
}
