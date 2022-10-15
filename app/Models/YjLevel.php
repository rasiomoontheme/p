<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YjLevel extends Model
{
    public $guarded = ['id'];

    public static $list_field = [
        'level' => ['name' => 'Mức hoa hồng','type' => 'number','validate' => 'required','is_show' => true],
        'name' => ['name' => 'Tên lớp','type' => 'string','validate' => 'required','is_show' => true],
        'active_num' => ['name' => 'Những người hoạt động ngoại tuyến','type' => 'number','validate' => 'required','is_show' => true],
        'min' => ['name' => 'Số tiền doanh thu tối thiểu','type' => 'number','validate' => 'required','is_show' => true],
        'rate' => ['name' => 'Tỷ lệ hoa hồng (phần trăm)','type' => 'number','validate' => 'required','is_show' => true],
        'lang' => ['name' => 'Tiền tệ','type' => 'select','is_show' => true,'data' => 'platform.lang_fields'],
    ];

    public static function getYjLevel($num,$money,$lang = Base::LANG_CN){
        return YjLevel::where('active_num','<=',$num)->where('min','<=',$money)->where('lang',$lang)->orderBy('level','desc')->first();
    }
}
