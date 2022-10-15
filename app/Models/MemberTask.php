<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberTask extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'task_id' => ['name' => 'ID nhiệm vụ','type' => 'number'],
        'member_id' => ['name' => 'Mã thành viên','type' => 'number'],
        'status' => ['name' => 'Trạng thái','type' => 'number'],
    ];

    const STATUS_RECEIVING = 1; //'领取中';
    const STATUS_RECEIVED = 2; //'已领取';

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function task(){
        return $this->belongsTo('App\Models\Task');
    }
}
