<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    public $guarded = ["id"];

    public static $list_field = [
        'bill_no' => ['name' => 'Mã giao dịch','type' => 'text','is_show' => true],
        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number','validate' => 'required', 'is_show' => true],
        'name' => ['name' => 'Tên người nhận','type' => 'text','is_show' => true],
        'account' => ['name' => 'Chuyển tài khoản','type' => 'text','is_show' => true],

        /**
        'origin_money' => ['name' => '折算前充值金额','type' => 'text','is_show' => false],
        'forex' => ['name' => '交易（折算）比例','type' => 'text','is_show' => false],
         **/
        'lang' => ['name' => 'Ngôn ngữ / Tiền tệ','type' => 'select','is_show' => false,'data' => 'platform.lang_fields'],

        'money' => ['name' => 'Số tiền nạp','type' => 'number','is_show' => true],
        // 'payment_type' => ['name' => '支付类型','type' => 'select','is_show' => true,'data' => 'platform.recharge_type'],
        'payment_type' => ['name' => 'Phương thức thanh toán','type' => 'select','is_show' => true,'data' => 'platform.payment_type'],
        'payment_pic' => ['name' => 'Chứng từ thanh toán','type' => 'picture','is_show' => true],

        'diff_money' => ['name' => 'Tín dụng','type' => 'number','validate' => 'required','is_show' => true],
        'before_money' => ['name' => 'Số tiền trước khi nạp tiền','type' => 'number','is_show' => false],
        'after_money' => ['name' => 'Số tiền sau khi nạp tiền','type' => 'number','is_show' => false],
        'score' => ['name' => 'Điểm','type' => 'number','is_show' => false],

        'fail_reason' => ['name' => 'Lý do thất bại','type' => 'text'],
        'hk_at' => ['name' => 'Thời gian chuyển tiền do khách hàng điền','type' => 'datetime'],
        'confirm_at' => ['name' => 'Xác nhận thời gian chuyển','type' => 'datetime'],

        'status' => ['name' => 'Trạng thái','type' => 'select','is_show' => true,'data' => 'platform.recharge_status'],
        'user_id' => ['name' => 'ID quản trị viên', 'type' => 'number', 'is_show' => true],
    ];

    const STATUS_UNDEAL = 1; // 待确认
    const STATUS_SUCCESS = 2; // 审核通过
    const STATUS_FAILED = 3; // 审核失败

    const PREFIX_THIRDPAY = 'online_';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member','member_id','id');
    }

    protected $appends = ['status_text','payment_type_text'];

    public function getStatusTextAttribute(){
        return isset_and_not_empty(config('platform.recharge_status'),$this->attributes['status'],$this->attributes['status']);
    }

    public function getPaymentTypeTextAttribute(){
        // return isset_and_not_empty(config('platform.recharge_type'),$this->attributes['payment_type'],$this->attributes['payment_type']);
        return isset_and_not_empty(config('platform.payment_type'),$this->attributes['payment_type'],$this->attributes['payment_type']);
    }

    public function getPaymentDetailAttribute(){
        return $this->attributes['payment_detail'] && !is_array($this->attributes['payment_detail']) ? json_decode($this->attributes['payment_detail'],1) : $this->attributes['payment_detail'];
    }

    public function getPaymentRate(){
        if(array_key_exists('payment_id',$this->payment_detail)){
            return Payment::find($this->payment_detail['payment_id'])->rate;
        }
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public function scopeUserName($query,$name){
        return $name ? $query->whereHas('user',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public function scopeMemberLang($query,$lang){
        return $lang ? $query->whereHas('member',function($q) use($lang){
            $q->where('lang',$lang);
        }) : $query;
    }

    public function isThirdPay(){
        return \Str::contains($this->payment_type,self::PREFIX_THIRDPAY);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function addRechargeML(){
        $percent = systemconfig('ml_percent');

        if(!$percent) return;

        $percent = sprintf("%.2f", $percent / 100);

        // 增加会员的码量
        $this->member->increment('ml_money',sprintf("%.2f",$this->money * $percent));
    }
}
