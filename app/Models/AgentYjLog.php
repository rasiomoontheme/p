<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentYjLog extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'agent_id' => ['name' => 'Id đại lý', 'type' => 'number', 'is_show' => true],
        'yl_money' => ['name' => 'Số tiền lợi nhuận', 'type' => 'number', 'validate' => 'required', 'is_show' => true],
        'money' => ['name' => 'Tiền', 'type' => 'number', 'validate' => 'required', 'is_show' => true],
        'last_month' => ['name' => 'Tháng cuối cùng của khoản thanh toán hoa hồng','type' => 'text','is_show' => true],
        'remark' => ['name' => 'Ghi chú hoạt động', 'type' => 'text', 'is_show' => true],
    ];

    public function member(){
        return $this->belongsTo('App\Models\Member','agent_id','agent_id');
    }
}
