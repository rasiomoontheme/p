<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsideAdv extends Base
{
    protected $guarded = ['id'];

    public static $list_field = [
        'name' => ['name' => 'Tên','type' => 'text','validate' => 'required','is_show' => true],
        'group' => ['name' => 'Tên nhóm','type' => 'text','is_show' => true],
        'pic_url' => ['name' => 'Hình ảnh quảng cáo','type' => 'picture','is_show' => true],
        'pic_index' => ['name' => 'chỉ mục hình ảnh','type' => 'number','is_show' => false],

        'vertical' => ['name' => 'Vị trí thẳng đứng','type' => 'radio','is_show' => true,'data' => 'platform.adv_vertical'],
        'horizontal' => ['name' => 'Vị trí nằm ngang','type' => 'radio','is_show' => true,'data' => 'platform.adv_horizontal'],

        'effect' => ['name' => 'hiệu ứng','type' => 'select','is_show' => false,'data' => 'platform.adv_effect'],
        'url_id' => ['name' => '跳转路由','type' => 'select','is_show' => false,'data' => 'platform.adv_horizontal'],

        'remark' => ['name' => '备注信息','type' => 'text','is_show' => false],
        'lang' => ['name' => 'Ngôn ngữ','type' => 'select','is_show' => true,'data' => 'platform.lang_fields'],
        'is_open' => ['name' => 'Trạng thái','type' => 'radio','data' => 'platform.is_open','is_show' => true],
        'weight' => ['name' => '排序','type' => 'number','is_show' => false]
    ];

    public function quickurl(){
        return $this->hasOne('App\Models\QuickUrl','id','url_id');
    }

    public function advs(){
        return $this->hasMany('App\Models\AsideAdv','group','group');
    }
}
