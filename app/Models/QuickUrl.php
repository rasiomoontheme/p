<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// 页面路由
class QuickUrl extends Model
{
    protected $guarded = ['id'];

    public static $list_field = [
        'name' => ['name' => 'ID Url','type' => 'text','is_show' => true],
        'title' => ['name' => 'Tên Url','type' => 'text','is_show' => true],
        'desc' => ['name' => 'Mô tả','type' => 'text','is_show' => true],
        'type' => ['name' => 'Loại Url','type' => 'select','is_show' => true,'data' => 'platform.quick_url_type'],
        'url' => ['name' => 'Địa chỉ Url','type' => 'text','is_show' => true],

        'is_open' => ['name' => 'Trạng thái','type' => 'radio','data' => 'platform.is_open','is_show' => true],
        'weight' => ['name' => 'Loại','type' => 'number','is_show' => false]
    ];

    public $appends = ['full_url'];

    public function getFullUrlAttribute(){
        switch ($this->type){
            case 'web':
                return systemconfig('site_pc').'/#/'.$this->url;
            case 'index':
                // return route('web.index').'/'.$this->url;
                // 判断是否是 agent开头的
                return (\Str::startsWith($this->url,'agent/') && env('AGENT_URL')) ? (env('AGENT_URL').'/'.$this->url) : (env('APP_URL').'/'.$this->url);
            case 'mobile':
                return systemconfig('site_mobile').'/#/'.$this->url;
            default:
                return '';
        }
    }

    public function getLink($name){
        $link = $this->where('name',$name)->first();
        return $link ? $link->full_url : '';
    }

    public function scopeOpened($query){
        return $query->where('is_open',1)->orderByDesc('weight')->latest();
    }

    // 将不带# 的URL转换为带#的url
    public static function convertToAnchorUrl($url){
        // if()
    }

    // 将带 # 的url 转换为 不带#的url
    public static function convertToNoAnchorUrl($url){
        // 判断是否是合法网址
        if(!preg_match('/(https?|http?|ftp?):\/\/?/i',$url))  exit('1'); //return $url;

        if(!Str::contains($url,'#')) exit('2'); // return $url;

        // preg_match('/#\w+(\/*)/i','#aaa/',$match);

        $pos = strpos($url,'#') + 2;

        $anchor = substr($url,$pos,strlen($url) - $pos);

        $url = substr($url , 0, $pos - 2).'?anchor='.Str::replaceFirst('?','&',$anchor);

        return $url;
    }


}
