<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Config\Repository\Config;

class Activity extends Base
{
    // "['".implode("','",array_keys(App\Models\Activity::$list_field))."']"
    public static $list_field = [
        'title' => ['name' => 'Tiêu đề','type' => 'text','validate' => 'required','is_show' => true],
        'subtitle' => ['name' => 'Phụ đề','type' => 'text'],

        'cover_image' => ['name' => 'Liệt kê ảnh bìa','type' => 'picture','is_show' => true],
        'content' => ['name' => 'Mô tả sự kiện','type' => 'editor','validate' => 'required'],

        //'is_apply' => ['name' => '是否需要申请','type' => 'radio','validate' => 'required','data' => 'platform.activity_is_apply','style' => 'platform.style_boolean'],
        'type' => ['name' => 'Loại hoạt động','type' => 'select','validate' => 'required','data' => 'platform.activity_type','is_show' => true],
        'apply_type' => ['name' => 'Loại áp dụng','type' => 'select','validate' => 'required','data' => 'platform'],
        'apply_url' => ['name' => 'Url áp dụng','type' => 'text'],
        'apply_desc' => ['name' => 'Mô tả ứng dụng','type' => 'editor'],

        'hall_image' => ['name' => 'Ảnh bìa hội trường','type' => 'picture','is_show' => true],
        'hall_field' => ['name' => 'Điền thông tin ứng dụng','type' => 'text','is_show' => false],

        /*
        'money' => ['name' => '活动所需达到的金额','type' => 'number'],
        'rate' => ['name' => '赠送比例','type' => 'number'],
        'gift_limit_money' => ['name' => '赠送的上限金额','type' => 'number'],
        */

        'date_desc' => ['name' => 'Mô tả thời gian sự kiện','type' => 'text'],
        'start_at' => ['name' => 'Thời gian bắt đầu sự kiện','type' => 'datetime','is_show' => true],
        'end_at' => ['name' => 'Thời hạn sự kiện','type' => 'datetime','is_show' => true],

        'rule_content' => ['name' => 'Quy tắc hoạt động','type' => 'editor'],

        'is_open' => ['name' => 'Nó mở rồi','type' => 'radio','validate' => 'required','data' => 'platform.is_open','is_show' => true,'style' => 'platform.style_boolean'],
        'is_hot' => ['name' => 'Nó có phổ biến không','type' => 'radio','validate' => 'required','data' => 'platform.boolean','style' => 'platform.style_boolean'],
        'weight' => ['name' => 'Trọng lượng','type' => 'number'],
        //'title_content' => ['name' => '标题内容','type' => 'editor'],

        'lang' => ['name' => 'Ngôn ngữ','type' => 'select','is_show' => true,'data' => 'platform.lang_fields'],
    ];

    public $guarded = [];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected $appends = ['type_text'];

    const APPLY_TYPE_NO_NEED = 0; // 无需申请
    const APPLY_TYPE_KEFU = 1; // 联系客服申请
    const APPLY_TYPE_HALL = 2; // 活动大厅申请
    const APPLY_TYPE_URL = 3; // 跳转查看详情

    public function getTypeTextAttribute()
    {
        if(!array_key_exists('type',$this->attributes)){

            return '';
        }
        return isset_and_not_empty(trans('res.option.activity_type'), $this->attributes['type'], $this->attributes['type']);
    }

    // apply_field_array
    /**
    public function getApplyFieldArrayAttribute(){
    return \Str::contains($this->apply_field,',') ? explode(',',$this->apply_field) : [$this->apply_field];
    }
     */
    public function getHallFieldArrayAttribute(){
        return \Str::contains($this->hall_field,',') ? explode(',',$this->hall_field) : [$this->hall_field];
    }

    public function scopeIsApp($query){
        return $query->where('is_app',intval(isApp()));
    }

    public function getDateDescriptionAttribute(){
        if($this->date_desc) return $this->date_desc;

        $result = '';
        if($this->start_at) $result .= '开始时间：'.$this->start_at;
        if($this->end_at) $result = ($result ? $result.'，' : ''). '截止时间：'.$this->end_at;
        return $result;
    }

    public function scopeForMember($query){
//        return $query->where('is_open',1)->where('is_apply',1)->orderBy('weight','desc');
        return $query->where('is_open',1)->where('apply_type',self::APPLY_TYPE_HALL)->orderBy('weight','desc');
    }
}
