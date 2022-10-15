<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'bill_no' => ['name' => 'Transaction serial number','type' => 'text','is_show' => true],
        'api_name' => ['name' => 'Interface ID','type' => 'text','is_show' => true],
        'member_id' => ['name' => 'Member ID','type' => 'text','is_show' => true],
        'transfer_type' => ['name' => 'Transfer type','is_show' => true,'type' => 'select','data' => 'platform.transfer_type','style' => 'platform.style_transfer_type'],
        'money' => ['name' => 'Conversion amount','type' => 'text','is_show' => true],
        'diff_money' => ['name' => 'Spread (bonus) amount','type' => 'text','is_show' => true,'min-width' => '140px'],
        'real_money' => ['name' => 'Actual Conversion Amount','type' => 'text','is_show' => true],
        'before_money' => ['name' => 'Amount before transfer','type' => 'text','is_show' => false],
        'after_money' => ['name' => 'Amount after transfer','type' => 'text','is_show' => false],
        'money_type' => ['name' => 'Amount field type', 'type' => 'select', 'is_show' => true, 'data' => 'platform.member_money_type','style' => 'platform.member_money_type_style'],
    ];

    const TRANSFER_TYPE_IN = 1;
    const TRANSFER_TYPE_OUT = 2;

    public function member()
    {
        return $this->belongsTo('App\Models\Member','member_id','id');
    }

    public function scopeMemberLang($query,$lang){
        return $lang ? $query->whereHas('member',function($q) use($lang){
            $q->where('lang',$lang);
        }) : $query;
    }

    public function scopeMemberName($query,$name){
        return $name ? $query->whereHas('member',function($q) use($name){
            $q->where('name','like','%'.$name.'%');
        }) : $query;
    }
}
