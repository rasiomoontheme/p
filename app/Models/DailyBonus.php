<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DailyBonus extends Model
{
    protected $guarded = ['id'];

    // 用户签到管理，和签到设置
    public static $list_field = [
        'member_id' => ['name' => 'Mã thành viên', 'type' => 'number', 'is_show' => false],
        'bonus_money' => ['name' => 'Số tiền thưởng khi đăng ký','type' => 'text','is_show' => true],
        'days' => ['name' => 'Đăng ký để đặt số ngày','type' => 'text','is_show' => true],
        'serial_days' => ['name' => 'Ngày đăng ký liên tục','type' => 'text','is_show' => false],
        'total_days' => ['name' => 'Số ngày nhận phòng tích lũy','type' => 'text','is_show' => false],
        'type' => ['name' => 'Loại hình','type' => 'select' ,'is_show' => true,'data' => 'platform.daily_bonus_type'],
        'state' => ['name' => 'Tiểu bảng','type' => 'select', 'is_show' => false,'data' => 'platform.daily_bonus_state'],
        'lang' => ['name' => 'Ngôn ngữ / Tiền tệ','type' => 'select','is_show' => true,'data' => 'platform.lang_select'],
        'remark' => ['name' => 'Nhận xét','type' => 'text','is_show' => false]
    ];

    const TYPE_SERIAL_SETTING = -2;
    const TYPE_TOTAL_SETTING = -1;
    const TYPE_NORMAL_CHECK_IN = 0;
    const TYPE_TOTAL_AWARD = 1;
    const TYPE_SERIAL_AWARD = 2;

    const STATE_ENSURE = 1;
    const STATE_NOT_DEAL = 0;
    const STATE_REJECT = -1;

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }

    // 判断是否是 签到设置
    public function isSetting(){
        if($this->member_id == 0
            && $this->days > 0
            && $this->bonus_money > 0
            && in_array($this->type,[DailyBonus::TYPE_SERIAL_SETTING,DailyBonus::TYPE_TOTAL_SETTING])){
            return true;
        }else{
            return false;
        }
    }

    protected $appends = ['state_text'];

    public function getStateTextAttribute(){
        return isset_and_not_empty(trans('res.option.daily_bonus_state'),$this->attributes['state'],$this->attributes['state']);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // 发放签到奖励
    public function sendBonus(){
        $member = $this->member;
        try{
            if($this->bonus_money <= 0 && $this->state != self::STATE_ENSURE){
                return;
            }

            $money_type = 'fs_money';

            DB::transaction(function() use($member, $money_type){
                MemberMoneyLog::create([
                    'member_id' => $this->member_id,
                    'money' => $this->bonus_money,
                    'money_before' => $member->$money_type,
                    'money_after' => $member->$money_type + $this->bonus_money,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_QIANDAO,
                    'money_type' => $money_type,
                    // 'description' => '会员【'.$member->name.'】领取签到奖励【'.$this->bonus_money.'元】',
                    'description' => trans('res.api.dailybonus.get_bonus_success',['name' => $member->name,'money' => $this->bonus_money],$member->lang),
                    //'remark' => $this->id
                    'model_name' => \get_class($this),
                    'model_id' => $this->id,
                ]);

                $member->increment($money_type, $this->bonus_money);
            });

        }catch(Exception $e){
            return $this->failed('操作异常:'+$e->getMessage());
        }
    }
}
