<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class About extends Base
{
    protected $guarded = [];

    protected $appends = ['type_text'];

    public static $list_field = [
        'id' => ['name' => 'ID','is_show' => false],
        'title' => ['name' => 'Tiêu đề','is_show' => true],
        'subtitle' => ['name' => 'Phụ đề','is_show' => false],
        'cover_img' => ['name' => 'Ảnh bìa','type' => 'picture','is_show' => true],
        'content' => ['name' => 'Nội dung','is_show' => false],
        'type' => ['name' => 'Loại hình','type' => 'select','is_show' => true,'data' => 'platform.about_type'],
        'is_open' => ['name' => 'Nó mở rồi','type' => 'radio','validate' => 'required','data' => 'platform.is_open','is_show' => true,'style' => 'platform.style_boolean'],
        'is_hot' => ['name' => 'Nó có phổ biến không','type' => 'radio','validate' => 'required','data' => 'platform.boolean','style' => 'platform.style_boolean'],
        'weight' => ['name' => 'Trọng lượng','type' => 'number'],
        'lang' => ['name' => 'Ngôn ngữ','type' => 'select','is_show' => true,'data' => 'platform.lang_fields'],
    ];

    const TYPE_GYWM = 1;
    const TYPE_CKBZ = 2;
    const TYPE_QKBZ = 3;
    const TYPE_CJWT = 4;
    const TYPE_HZHB = 5;
    const TYPE_YLXY = 6;
    const TYPE_LLWM = 7;
    const TYPE_TKGZ = 8;

    public static $typeTextMap = [
        self::TYPE_GYWM => "关于我们",
        self::TYPE_CKBZ => "存款帮助",
        self::TYPE_QKBZ => "取款帮助",
        self::TYPE_CJWT => "常见问题",
        self::TYPE_HZHB => "合作伙伴",
        self::TYPE_YLXY => "联营协议",
        self::TYPE_LLWM => "联络我们",
        self::TYPE_TKGZ => "条款规则",
    ];

    public function getTypeTextAttribute(){
        return Arr::get(trans('res.option.about_type'),$this->type,$this->type);
    }

}
