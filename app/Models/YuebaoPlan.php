<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YuebaoPlan extends Base
{
    protected $guarded = ['id'];

    public static $list_field = [
        'SettingName' => ['name' => 'Tên d? án','type' => 'text','validate' => 'required','is_show' => true],
        'MinAmount' => ['name' => 'S? ti?n mua t?i thi?u','type' => 'number','validate' => 'required','is_show' => false],
        'MaxAmount' => ['name' => 'S? ti?n mua t?i da','type' => 'number','validate' => 'required','is_show' => false],
        'SettleTime' => ['name' => 'Th?i gian gi?i quy?t (gi?)','type' => 'number','validate' => 'required','is_show' => false],
        'IsCycleSettle' => ['name' => 'Phuong pháp gi?i quy?t','type' => 'radio','validate' => 'required','data' => 'platform.yuebao_settle_type','is_show' => true],
        'Rate' => ['name' => 'T? l? chuong trình','type' => 'number','validate' => 'required','is_show' => true],
        //'RemainingCount' => ['name' => '??????','type' => 'number','validate' => 'required','is_show' => true],
        'TotalCount' => ['name' => 'T?ng s? ti?n k? ho?ch','type' => 'number','validate' => 'required','is_show' => true],
        'LimitInterest' => ['name' => 'Lãi su?t gi?i h?n thành viên','type' => 'number','validate' => 'required','is_show' => true],
        'LimitOrderIntervalTime' => ['name' => 'Kho?ng th?i gian d?t hàng (gi?)','type' => 'number','is_show' => false],
        'InterestAuditMultiple' => ['name' => 'Mã s? thích nhi?u','type' => 'number','is_show' => false],
        'LimitUserOrderCount' => ['name' => 'T?ng s? ti?n mua t?i da c?a thành viên','type' => 'number','is_show' => false],
        'lang' => ['name' => 'Ti?n t?','type' => 'select','is_show' => true,'data' => 'platform.lang_fields'],
        'is_open' => ['name' => 'Nó có m? c?a d? mua không','type' => 'radio','data' => 'platform.is_open','is_show' => true,'style' => 'platform.style_isopen'],
        'weight' => ['name' => 'Lo?i','type' => 'number','is_show' => false]
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function member_plans(){
        return $this->hasMany('App\Models\MemberYuebaoPlan','plan_id','id');
    }

    public function last_member_plans($member_id){
        return $this->hasOne('App\Models\MemberYuebaoPlan','plan_id','id')
            ->where('member_id',$member_id)
            ->orderByDesc('created_at');
    }
}
