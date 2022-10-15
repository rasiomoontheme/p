<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'home_team_name' => ['name' => 'Tên đội nhà','type' => 'text','validate' => 'required','is_show' => true],
        'home_team_name_en' => ['name' => 'Tên đội nhà','type' => 'text','validate' => 'required','is_show' => false],
        'home_team_img' => ['name' => 'Hình ảnh đội chủ nhà','type' => 'picture','validate' => 'required','is_show' => true],
        'home_odds' => ['name' => 'Tỷ lệ cược tại nhà','type' => 'number','validate' => 'required','is_show' => true],

        'visiting_team_name' => ['name' => 'Tên đội khách','type' => 'text','validate' => 'required','is_show' => true],
        'visiting_team_name_en' => ['name' => 'Thăm tên đội bằng tiếng anh','type' => 'text','validate' => 'required','is_show' => false],
        'visiting_team_img' => ['name' => 'Hình ảnh đội khách','validate' => 'required','type' => 'picture','is_show' => true],
        'visiting_odds' => ['name' => 'Tỷ lệ cược trên sân khách','type' => 'number','validate' => 'required','is_show' => true],

        'let_ball' => ['name' => '让球','type' => 'number','validate' => 'required','is_show' => true],

        'match_cup' => ['name' => 'Tên trò chơi','type' => 'text','validate' => 'required'],
        'match_cup_en' => ['name' => 'Tên cuộc thi bằng tiếng Anh','type' => 'text','validate' => 'required','is_show' => false],

        'match_at' => ['name' => 'Thời gian cạnh tranh','validate' => 'required','type' => 'datetime'],

        'is_open' => ['name' => 'Có mở không','type' => 'radio','validate' => 'required','data' => 'platform.boolean','style' => 'platform.style_boolean','is_show' => true],
        'weight' => ['name' => 'Trọng lượng','type' => 'number'],
    ];
}
