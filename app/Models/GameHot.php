<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameHot extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'name' => ['name' => 'Tên hội trường','type' => 'text','validate' => 'required','is_show' => true],
        'api_name' => ['name' => 'Tên giao diện','type' => 'text','validate' => 'required','is_show' => true],
        'game_type' => ['name' => 'Loại trò chơi','validate' => 'required','is_show' => true, 'type' => 'select','data' => 'platform.game_type'],
        'type' => ['name' => 'Loại địa điểm','validate' => 'required','is_show' => true, 'type' => 'select','data' => 'platform.hot_game_place_type'],
        'lang' => ['name' => 'Ngôn ngữ','validate' => 'required','is_show' => true,'type' => 'select', 'data' => 'platform.language_type'],
        'desc' => ['name' => 'Mô tả hội trường','type' => 'text'],
//        'en_name' => ['name' => '厅名称','type' => 'text'],
//        'en_desc' => ['name' => '参数补充','type' => 'text'],
//        'tw_name' => ['name' => '厅名称','type' => 'text'],
//        'tw_desc' => ['name' => '参数补充','type' => 'text'],
//        'th_name' => ['name' => '厅名称','type' => 'text'],
//        'th_desc' => ['name' => '参数补充','type' => 'text'],
//        'vi_name' => ['name' => '厅名称','type' => 'text'],
//        'vi_desc' => ['name' => '参数补充','type' => 'text'],
        'jump_link' => ['name' => 'Nhảy liên kết','type' => 'text'],
        'is_new_window' => ['name' => 'Có nên mở một cửa sổ mới không','type' => 'radio'],
        'game_code' => ['name' => 'Mã game','type' => 'text'],
        'icon_path' => ['name' => 'Biểu tượng trước khi được chọn','type' => 'picture'],
        'icon_path2' => ['name' => 'Biểu tượng sau khi được chọn','type' => 'picture'],
        'img_url' => ['name' => 'Địa chỉ của bản đồ','type' => 'picture'],

        'is_online' => ['name' => 'Online', 'type' => 'radio', 'validate' => 'required', 'data' => 'platform.is_online', 'is_show' => true, 'style' => 'platform.style_boolean'],
        'sort' => ['name' => 'Loại', 'type' => 'number'],
    ];

//    public $appends = ['full_image_url','full_icon_url'];
//
//    public function getFullImageUrlAttribute(){
//        return $this->img_path ? systemconfig('site_domain').'/web/images/game/'.strtolower($this->api_name).'/'.$this->img_path : $this->img_url;
//    }
//
//    public function getFullIconUrlAttribute(){
//        return $this->img_path ? systemconfig('site_domain').'/web/images/game/'.strtolower($this->api_name).'/'.$this->img_path : $this->img_url;
//    }
//
//    public function getImageUrlAttribute(){
//        return getUrlByDomain($this->img_url);
//    }
//
//    public function getIconPathAttribute(){
//        return getUrlByDomain($this->icon_path);
//    }
}
