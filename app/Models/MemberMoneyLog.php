<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMoneyLog extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [

        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number', 'is_show' => true],
        'user_id' => ['name' => 'ID quản trị viên', 'type' => 'number', 'is_show' => true],

        'money' => ['name' => 'Số tiền', 'type' => 'number', 'validate' => 'required', 'is_show' => true],
        'money_before' => ['name' => 'Số tiền trước khi hoạt động', 'type' => 'number', 'is_show' => true],
        'money_after' => ['name' => 'Số tiền sau khi hoạt động', 'type' => 'number', 'is_show' => true],

        'money_type' => ['name' => 'Loại trường số tiền', 'type' => 'select', 'is_show' => true, 'data' => 'platform.member_money_type','style' => 'platform.member_money_type_style'],
        'number_type' => ['name' => 'Loại số lượng', 'validate' => 'required', 'type' => 'radio', 'is_show' => true, 'data' => 'platform.money_number_type','style' => 'platform.money_number_style'],
        'operate_type' => ['name' => 'Loại thay đổi số tiền', 'type' => 'select', 'is_show' => true, 'data' => 'platform.member_money_operate_type'],

        'model_name' => ['name' => 'Tên mô hình','type' => 'text','is_show' => false],
        'model_id' => ['name' => 'ID mô hình','type' => 'number','is_show' => false],

        'description' => ['name' => 'Hoạt động Mô tả', 'type' => 'text', 'is_show' => true],
        'remark' => ['name' => 'Ghi chú hoạt động', 'type' => 'text', 'is_show' => false],

    ];

    // 对应 platform.member_money_operate_type
    const OPERATE_TYPE_ADMIN = 1; // 管理员操作
    const OPERATE_TYPE_SYSTEM = 2; //系统赠送
    const OPERATE_TYPE_GAME_IN_OUT = 3; // 游戏转入/转出
    const OPERATE_TYPE_FANSHUI = 4; // 返水发放
    const OPERATE_TYPE_QIANDAO = 5; // 签到活动领取
    const OPERATE_TYPE_RECHARGE_ACTIVITY = 6; // 充值活动
    const OPERATE_TYPE_HONGLI = 7; // 平台红利
    const OPERATE_TYPE_HONGBAO = 8; // 抢红包
    const OPERATE_TYPE_MEMBER = 9; // 充值提现
    const OPERATE_TYPE_RECHARGE_GIVEN = 10; // 充值赠送
    const OPERATE_TYPE_DRAWING_RETURN = 11; // 拒绝提现退还
    const OPERATE_TYPE_DEPOSIT_RETURN = 12;
    const OPERATE_TYPE_ACTIVITY = 13;// 活动发放
    const OPERATE_TYPE_YONGJIN = 14;// 代理佣金
    const OPERATE_TYPE_WHEEL = 15; // 转盘抽奖
    const OPERATE_TYPE_FINANCIAL = 16; // 购买理财产品
    const OPERATE_TYPE_FINANCIAL_INTEREST = 17; // 理财产品分红
    const OPERATE_TYPE_LOSE_RECORD = 18; // 掉单退还/扣除
    const OPERATE_TYPE_FINANCIAL_RETURN = 19; // 理财产品赎回
    const OPERATE_TYPE_LEVELUP = 20;// 晋级奖励
    const OPERATE_TYPE_WEEKE_AWARD = 21; // 周俸禄
    const OPERATE_TYPE_MONTH_AWARD = 22; // 月俸禄
    const OPERATE_TYPE_CREDIT_BORROW = 23; // 借呗借款
    const OPERATE_TYPE_CREDIT_LEND = 24; // 借呗还款

    const OPERATE_TYPE_DAY_BONUS = 25; // 每日礼金
    const OPERATE_TYPE_WEEK_BONUS = 26; // 每周礼金
    const OPERATE_TYPE_MONTH_BONUS = 27; // 每月礼金
    const OPERATE_TYPE_YEAR_BONUS = 28; // 每年礼金
    const OPERATE_TYPE_LEVEL_BONUS = 29; // 晋升礼金

    const MONEY_TYPE_ADD = 1;
    const MONEY_TYPE_SUB = -1;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function scopeMemberLang($query,$lang){
        return $lang ? $query->whereHas('member',function($q) use($lang){
            $q->where('lang',$lang);
        }) : $query;
    }

    protected $appends = ['operate_type_text','money_type_text'];

    public function getOperateTypeTextAttribute(){
        return isset_and_not_empty(trans('res.option.member_money_operate_type'),$this->attributes['operate_type'],$this->attributes['operate_type']);
    }

    public function getMoneyTypeTextAttribute(){
        return isset_and_not_empty(trans('res.option.member_money_type'),$this->attributes['money_type'],$this->attributes['money_type']);
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    public function scopeWhereModel($query,Model $model){
        return $query->where('model_name',get_class($model))->where('model_id',$model->id);
    }

    public function child(){
        if($this->model_name && $this->model_id){
            return $this->hasOne($this->model_name,'id','model_id');
        }
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    const activityTypes = [
        self::OPERATE_TYPE_QIANDAO,
        self::OPERATE_TYPE_RECHARGE_ACTIVITY,
        self::OPERATE_TYPE_HONGLI,
        self::OPERATE_TYPE_HONGBAO,
        self::OPERATE_TYPE_RECHARGE_GIVEN,
        self::OPERATE_TYPE_ACTIVITY,
        self::OPERATE_TYPE_WHEEL,
        self::OPERATE_TYPE_FINANCIAL_INTEREST,
        self::OPERATE_TYPE_LEVELUP,
        self::OPERATE_TYPE_WEEKE_AWARD,
        self::OPERATE_TYPE_MONTH_AWARD,
        self::OPERATE_TYPE_DAY_BONUS,
        self::OPERATE_TYPE_WEEK_BONUS,
        self::OPERATE_TYPE_MONTH_BONUS,
        self::OPERATE_TYPE_YEAR_BONUS,
        self::OPERATE_TYPE_LEVEL_BONUS,
    ];

    const levelUpAwardTypes = [
        self::OPERATE_TYPE_DAY_BONUS,
        self::OPERATE_TYPE_WEEK_BONUS,
        self::OPERATE_TYPE_MONTH_BONUS,
        self::OPERATE_TYPE_YEAR_BONUS,
        self::OPERATE_TYPE_LEVEL_BONUS,
    ];

    // 活动赠送金额
    public function scopeActivityMoney($query){
        return $query->where('number_type',self::MONEY_TYPE_ADD)->whereIn('operate_type',self::activityTypes)->realMoney();
    }

    // 其它情况
    public function scopeOtherMoney($query){
        return $query->where('number_type',self::MONEY_TYPE_ADD)->whereIn('operate_type',[
            self::OPERATE_TYPE_ADMIN,
            self::OPERATE_TYPE_SYSTEM
        ])->realMoney();
    }
    // 其它情况管理员扣款
    public function scopeDebitMoney($query){
        return $query->where('number_type',self::MONEY_TYPE_SUB)->whereIn('operate_type',[
            self::OPERATE_TYPE_ADMIN,
        ])->realMoney();
    }
    public function scopeRealMoney($query){
        return $query->whereIn('money_type',['money','fs_money']);
    }

    public static function getAwardTypeByDay($day){
        switch ($day){
            case 1:
                return self::OPERATE_TYPE_DAY_BONUS;
            case 7:
                return self::OPERATE_TYPE_WEEK_BONUS;
            case 30:
                return self::OPERATE_TYPE_MONTH_BONUS;
            case 365:
                return self::OPERATE_TYPE_YEAR_BONUS;
        }

        return 0;
    }
}
