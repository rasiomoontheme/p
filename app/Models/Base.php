<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    const LANG_COMMON = 'common';
    const LANG_CN = 'zh_cn';
	const LANG_VN = 'vi';

    const OPEN_TYPE_TRUE = 1;
    const OPEN_TYPE_FALSE = 0;

    public static $isOpenMap = [
        self::OPEN_TYPE_TRUE => '启用',
        self::OPEN_TYPE_FALSE => '不启用'
    ];

    const BOOL_TYPE_TRUE = 1;
    const BOOL_TYPE_FALSE = 0;

    public static $boolTypeMap = [
        self::BOOL_TYPE_TRUE => '是',
        self::BOOL_TYPE_FALSE => '否'
    ];

    public function scopeLangs($query,$lang = ''){
        if(!strlen($lang)) $lang = getRequestLang();
        return $query->whereIn('lang',[self::LANG_COMMON,$lang]);
    }

    public function scopeCnLangs($query,$lang = ''){
        if(!strlen($lang)) $lang = getRequestLang();
        return $query->where('lang','like',substr($lang,0,2).'%');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
