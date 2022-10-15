<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SystemConfig extends Model
{
    public $guarded = [];

    public $casts = [
        // 'is_open' => 'boolean'
    ];

    const CONFIG_TYPE_TEXT = "text";
    const CONFIG_TYPE_TEXTAREA = "textarea";
    const CONFIG_TYPE_EDITOR = "editor";
    const CONFIG_TYPE_PICTURE = "picture";
    const CONFIG_TYPE_NUMBER = "number";
    const CONFIG_TYPE_TIME = "time";
    const CONFIG_TYPE_URL = 'url';
    const CONFIG_TYPE_BOOLEAN = 'boolean';
    const CONFIG_TYPE_SELECT = 'select';
    const CONFIG_TYPE_FILE = 'file';

    public static $configTypeMap = [
        self::CONFIG_TYPE_TEXT => '文字',
        self::CONFIG_TYPE_TEXTAREA => '段落',
        self::CONFIG_TYPE_PICTURE => '图片',
        self::CONFIG_TYPE_TIME => '时间类型',
        self::CONFIG_TYPE_URL => '链接',
        self::CONFIG_TYPE_BOOLEAN => '开关',
        self::CONFIG_TYPE_SELECT => '下拉框',
        self::CONFIG_TYPE_NUMBER => '数字',
        self::CONFIG_TYPE_EDITOR => '富文本',
        self::CONFIG_TYPE_FILE => '文件'
    ];

    const SECRET_IP_LIST = 'SECRET_IP_LIST';

    public function getTypeTextAttribute(){
        return isset_and_not_empty(self::$configTypeMap,$this->attributes['type'],$this->attributes['type']);
    }

    public static $list_field = [
        'id' => 'ID',
        'name' => 'Tên cấu hình',
        'title' => 'Tiêu đề cấu hình',
        'config_group' => 'Nhóm cấu hình',
        'type' => 'Loại cấu hình',
        'data_config' => 'Cấu hình nguồn dữ liệu',
        'type_text' => 'Mô tả Loại cấu hình',
        'value' => 'Giá trị cấu hình',
        'description' => 'Mô tả cấu hình',
        'weight' => 'Trọng lượng',
        'is_open' => 'Có bật không',
        'is_open_text' => 'Có mở mô tả không',
        'created_at' => 'Tạo mới lúc',
        'updated_at' => 'Cập nhật lúc'
    ];

    protected $appends = ['type_text','is_open_text'];

    public function getIsOpenTextAttribute(){
        return isset_and_not_empty(config('platform.is_open'),$this->attributes['is_open'],$this->attributes['is_open']);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeGetConfigGroup($query,$name){
        return $query->getConfigGroups($name)->pluck('value','name')->toArray();
    }

    public function scopeGetConfigGroups($query,$name){
        return $query->where('config_group',$name)->orderBy('weight','desc')->get();
    }

    public function scopeGetConfigValue($query,$name,$lang = ''){
        try{
            if(!$lang && in_array($name,self::MULTI_LANGS_ARR)) $lang = getRequestLang();

            return $query->getConfig($name,$lang ? $lang : [Base::LANG_CN,Base::LANG_COMMON])->value;
        }catch(Exception $e){
            return '';
        }
    }

    public function scopeGetConfig($query, $name, $lang = ''){
        if(!$lang && in_array($name,self::MULTI_LANGS_ARR)) $lang = [Base::LANG_CN];
        else if($lang && is_string($lang)) $lang = [$lang];
        return $query->where('name',$name)->whereIn('lang', $lang ? $lang : [Base::LANG_CN,Base::LANG_COMMON])->firstOrFail();
    }

    public function scopeForMember($query){
        return $query->where('is_open',1)->orderBy('weight','desc');
    }

    const MULTI_LANGS_ARR = [
        'system_maintenance_message','bank_desc','site_title','site_keyword','site_name',
        'online_pay_title','online_pay_desc','company_pay_title','company_pay_desc',
        'register_remark','register_agreement','nav_jiechi','guideline_desc','hotgame_desc',
        'wheel_rule','credit_detail','credit_rule','credit_xize','credit_borrow','credit_lend',
        'levelup_slot_activity','levelup_slot_example','levelup_slot_level','levelup_slot_month',
        'levelup_live_activity','levelup_live_example','levelup_live_level','levelup_live_month',
        'app_tuiguang','app_xima','app_fanyong','app_xima_text',
    ];

    public function copyConfig($lang){
        return [
            'name' => $this->name,
            'title' => $this->title,
            'config_group' => $this->config_group,
            'type' => $this->type,
            'value' => $this->value,
            'data_config' => $this->data_config,
            'link_html' => $this->link_html,
            'description' => $this->description,
            'is_open' => $this->is_open,
            'weight' => $this->weight,
            'lang' => $lang
        ];
    }

    public function getUniqueKey(){
        return $this->name.'-'.$this->lang;
    }

    /*
    public static function getRegisterUrl(){
        return route('web.index').'/#/Register';
    }

    public static function getSlotUrl(){
        return route('web.index').'/#/Lobby/Game';
    }

    public static function getHowDepositUrl(){
        return systemconfig('site_pc').'/#/How/Deposit';
    }

    public static function getHowDrawingUrl(){
        return systemconfig('site_pc').'/#/How/Drawing';
    }

    public static function getAgentJoinUrl()
    {
        return systemconfig('site_pc').'/#/Partner';
    }

    public static function getAboutUsUrl()
    {
        return systemconfig('site_pc').'/#/AboutUS';
    }

    public static function getContactUrl()
    {
        return systemconfig('site_pc').'/#/Contact';
    }


    public static function getGuideUrl()
    {
        return systemconfig('site_pc').'/#/Guide';
    }
    */

    public static function getIpListArray(){
        $list = cache()->get(self::SECRET_IP_LIST);
        if(!strlen($list)) return [];

        if(\Str::contains($list,'|')) return [$list];

        return explode('|',$list);
    }

    public static function isInWhiteIp(){
        return in_array(get_client_ip(),self::getIpListArray());
    }
}
