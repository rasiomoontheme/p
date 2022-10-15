<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestHistory extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'member_plan_id' => ['name' => 'ID gói thành viên','type' => 'number','is_show' => false],
        'interest' => ['name' => 'Quan tâm','type' => 'number' ,'is_show' => true],
        'times' => ['name' => 'Thời gian','type' => 'number' ,'is_show' => false],
        'calc_at' => ['name' => 'Thời gian giải quyết','type' => 'text','is_show' => true]
    ];
}
