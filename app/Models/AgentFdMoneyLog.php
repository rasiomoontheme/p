<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentFdMoneyLog extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'member_id' => ['name' => 'ID thành viên người chơi','type' => 'number', 'is_show' => true],
        'member_rate' => ['name' => 'Tỷ lệ hoàn tiền của người chơi (%)','type' => 'number','validate' => 'required','is_show' => false],
        'agent_member_id' => ['name' => 'ID đại lý','type' => 'number', 'is_show' => false],
        'agent_member_rate' => ['name' => 'Tỷ lệ chiết khấu đại lý (%)','type' => 'number','validate' => 'required','is_show' => true,'min-width' => '140px'],
        'child_member_id' => ['name' => 'ID thành viên cấp dưới','type' => 'number', 'is_show' => false],
        'child_member_rate' => ['name' => 'Tỷ lệ chiết khấu thành viên cấp thấp hơn (%)','type' => 'number','validate' => 'required','is_show' => true,'min-width' => '160px'],
        'game_type' => ['name' => 'Loại trò chơi','type' => 'select','validate' => 'required','is_show' => true,'data' => 'platform.game_type'],
        'bet_amount' => ['name' => 'Số tiền đặt cược','type' => 'number','validate' => 'required','is_show' => true],
        'fd_money' => ['name' => 'Số tiền hoàn lại','type' => 'number','validate' => 'required','is_show' => true],
        'money_before' => ['name' => 'Số dư trước khi ghi nhật ký','type' => 'number','validate' => 'required','is_show' => true],
        'money_after' => ['name' => 'Cân bằng sau tạp chí','type' => 'number','validate' => 'required','is_show' => true],
        'remark' => ['name' => 'Nhận xét','type' => 'text','is_show' => true]
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function agent_member(){
        return $this->belongsTo('App\Models\Member','agent_member_id','id');
    }
}
