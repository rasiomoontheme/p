<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Base
{
    protected $guarded = [];

    public static $list_field = [
        'id' => ['name' => 'ID','is_show' => false],
        'title' => ['name' => 'Tiêu đề','type' => 'text','is_show' => true],
        'description' => ['name' => 'Mô tả','type' => 'text','is_show' => false],
        'url' => ['name' => 'Địa chỉ Url','type' => 'picture','is_show' => true],
        'dimensions' => ['name' => 'Chiều rộng chiều cao','type' => 'text','is_show' => true],
        'groups' => ['name' => 'Nhóm','type' => 'text','is_show' => true],
        'jump_link' => ['name' => 'Liên kết','type' => 'text'],
        'is_new_window' => ['name' => 'có mở một cửa sổ mới không','type' => 'radio'],
        'weight' => ['name' => 'Trọng lượng','type' => 'text','is_show' => true],
        'lang' => ['name' => 'Ngôn ngữ','type' => 'select','is_show' => true,'data' => 'platform.lang_fields'],
        'is_open' => ['name' => 'Có mở không','type' => 'radio','is_show' => true,'data' => 'platform.is_open','style' => 'platform.style_isopen'],
        'created_at' => ['name' => 'Tạo mới lúc','type' => 'text','is_show' => true],
        'updated_at' => ['name' => 'Cập nhật lúc','is_show' => false]
    ];
}
