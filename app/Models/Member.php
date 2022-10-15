<?php

namespace App\Models;

use App\Services\AgentService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    use Notifiable;

    const CUSTOM_CLAIMS_LOGIN_TIME = "loginsec";

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token','original_password','o_password','qk_pwd'
    ];

    public static $list_field = [
        'name' => ['name' => 'Tên tài khoản', 'type' => 'text', 'validate' => 'required', 'is_show' => false],
        'password' => ['name' => 'Mật khẩu', 'type' => 'password', 'validate' => 'required', 'is_show' => false],
        'original_password' => ['name' => 'Mật khẩu API', 'type' => 'password', 'is_show' => false],
        'o_password' => ['name' => 'Mật khẩu ban đầu', 'type' => 'password', 'is_show' => false],

        'nickname' => ['name' => 'Nick name', 'type' => 'text',  'is_show' => true],
        'realname' => ['name' => 'Tên thật', 'type' => 'text',  'is_show' => false],
        'email' => ['name' => 'Email', 'type' => 'text',  'is_show' => false],
        'phone' => ['name' => 'Số điện thoại', 'type' => 'text',  'is_show' => false],
        'qq' => ['name' => 'Số QQ', 'type' => 'text',  'is_show' => false],
        'line' => ['name' => 'Line', 'type' => 'text',  'is_show' => false],
        'facebook' => ['name' => 'FaceBook', 'type' => 'text',  'is_show' => false],

        'gender' => ['name' => 'Giới tính', 'type' => 'radio',  'is_show' => false, 'data' => 'platform.gender'],
        'invite_code' => ['name' => 'Mã mời', 'type' => 'text',  'is_show' => false],
        'qk_pwd' => ['name' => 'Mật khẩu rút tiền', 'type' => 'password', 'is_show' => false],

        'money' => ['name' => 'Số dư tài khoản chính', 'type' => 'number', 'is_show' => true],
        'fs_money' => ['name' => 'Hoàn trả số dư tài khoản', 'type' => 'number', 'is_show' => true],
        'total_money' => ['name' => 'Tổng số tiền cá cược của nền tảng', 'type' => 'number', 'is_show' => false],
        'score' => ['name' => 'Điểm', 'type' => 'number', 'is_show' => false],

        'register_ip' => ['name' => 'Đăng ký IP', 'type' => 'text', 'is_show' => true],
        'register_area' => ['name' => 'Khu vực đăng ký','type' => 'text','is_show' => false],
        'register_site' => ['name' => 'Đăng ký kênh','type' => 'text','is_show' => false],

        'status' => ['name' => 'Trạng thái', 'type' => 'radio', 'is_show' => true,'data' => 'platform.member_status','style' => 'platform.style_status'],
        // 'is_login' => ['name' => '是否登录', 'type' => 'radio', 'is_show' => true,'data' => 'platform.boolean','style' => 'platform.style_boolean'],
        'is_tips_on' => ['name' => 'Có bật lời nhắc đăng nhập hay không', 'type' => 'radio', 'is_show' => false,'data' => 'platform.boolean','style' => 'platform.style_boolean'],
        'is_in_on' => ['name' => 'Cho dù đó là một tài khoản nội bộ', 'type' => 'radio', 'is_show' => true,'data' => 'platform.boolean','style' => 'platform.style_boolean'],

        // top_id 表示该会员上级的代理（agent表中的）ID
        'top_id' => ['name' => '上级代理id', 'type' => 'text', 'is_show' => false],

        // agent_id 如果大于0表示该会员是代理，agent_id 对应的是 AGENT表中的ID
        'agent_id' => ['name' => 'id đại lý', 'type' => 'text', 'is_show' => false],

        'lang' => ['name' => 'Ngôn ngữ / Tiền tệ','type' => 'select','is_show' => true,'data' => 'platform.lang_select']
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function agent(){
        return $this->hasOne('App\Models\Agent','id','agent_id');
    }

    // 会员的top_id等于代理的id，等于会员的agent_id
    public function agentchild(){
        return $this->hasMany('App\Models\Member','top_id','agent_id');
    }

    public function top(){
        return $this->hasOne('App\Models\Agent','id','top_id');
    }

    public function top_member(){
        return $this->hasOne('App\Models\Member','agent_id','top_id');
    }

    public function apis(){
        return $this->hasMany('App\Models\MemberApi','member_id','id');
    }

    public function logs(){
        return $this->hasMany('App\Models\MemberLog','member_id','id');
    }

    public function lastLoginLog(){
        return $this->hasOne(MemberLog::class,'member_id','id')
            ->where('type',MemberLog::LOG_TYPE_API_LOGIN)
            ->where('remark','!=','')->orderByDesc('created_at');
    }

    public function moneylogs(){
        return $this->hasMany('App\Models\MemberMoneyLog','member_id','id');
    }

    public function tasks(){
        return $this->hasMany('App\Models\MemberTask');
    }

    public function isOnline(){
        // 获取最近一条非退出登录日志
        if(!$this->logs->count()) return false;

        $log = $this->logs->sortByDesc('created_at')->first();

        if(!$log) return false;

        if($log->type == MemberLog::LOG_TYPE_API_LOGOUT) return false;

        if(Carbon::now()->diffInMinutes($log->created_at) <= 60) return true;

        return false;

        /*
        if($this->logs->first() && Carbon::now()->diffInMinutes($this->logs->sortByDesc('created_at')->first()->created_at) <= 60){
            return true;
        }else{
            return false;
        }
        */
    }

    public function scopeGetMemberByName($query,$name){
        return $query->where('name',$name)->firstOrFail();
    }

    const STATUS_ALLOW = 1; // 启用
    const STATUS_FORBIDDEN = -1; // 禁用
    const STATUS_FORCE_OFF = -2; //强制踢下线

    public function scopeNormal($query){
        return $query->where('status',self::STATUS_ALLOW);
    }

    public function scopeGetAgentArray($query){
        return $query->where('agent_id','>',0)->pluck('name','agent_id')->toArray();
    }

    public function scopeGetMemberArray($query){
        return $query->pluck('name','id')->toArray();
    }

    public function scopeGetAgentChild($query,$member_id,$member_agent_id){
        if(app(AgentService::class)->isTraditionalMode()){
            return $query->where('top_id',$member_agent_id);
        }else {
            return $query->whereIn('id',app(AgentService::class)->getAllChildId($member_id));
        }
    }

    public function isAgent(){
        return $this->agent_id > 0;
    }

    public function isDemo(){
        return $this->is_demo == 1;
    }

    // 统计相同字段出现的次数
    public function scopeSumField($query,$field){
        return $query->select(\DB::raw('count(*) as count,'.$field))->where($field,'!=','')->groupBy($field)->having('count','>',1)->get();
    }

    // 统计相同字段出现的次数 并 group
    public function scopeFieldGroup($query,$field,$data){
        return $query->whereIn($field,$data)
            ->select('name',$field)->where($field,'!=','')->get()
            ->mapToGroups(function ($item, $key) use($field){
                return [$item[$field] => $item['name']];
            });

    }

    public function recharges(){
        return $this->hasMany('App\Models\Recharge','member_id','id');
    }

    public function drawings(){
        return $this->hasMany('App\Models\Drawing','member_id','id');
    }

    public function scopeFilterInnerAccount($query){
        return $query->where('is_in_on',0);
    }

    // filterDemoAccount()
    public function scopeFilterDemoAccount($query){
        return $query->where('is_demo',0);
    }

    public static function demoIdLists(){
        return Member::where('is_demo',1)->pluck('id');
    }

    public function getLastLoginLog(){
        return MemberLog::where('member_id',$this->id)
            ->where('type',MemberLog::LOG_TYPE_API_LOGIN)
            ->where('remark','!=','')
            ->latest()->first();
    }

    // 获取活跃下线ID列表
    public function getActiveChildIds($lang){
        return Member::
        withCount(['recharges as recharges_sum' =>function($query){
            $query->where('status',Recharge::STATUS_SUCCESS)->select(\DB::raw("sum(money) as rechargeSum"));
        }])->where('top_id',$this->agent_id)->get()
            ->where('recharges_sum','>=', $this->getDailiActiveMoney($lang)?? 0);
    }

    public function getDailiActiveMoney($lang = 'zh_cn'){
        $json = systemconfig('daili_active_money_json');

        if(!$json) return;

        $data = json_decode($json,1);

        if(!is_array($data) || !array_key_exists($this->lang,$data)) return ;

        return $data[$this->lang]['b'];
    }

    /**
    public function scopeActiveMember($query){
    return $query->withCount(['recharges as recharges_sum' =>function($query){
    $query->where('status',Recharge::STATUS_SUCCESS)->select(\DB::raw("sum(money) as rechargeSum"));
    }])->where('recharges_sum','>=',systemconfig('daili_active_money') ?? 0);
    }
     */

    // 获取 会员的返点信息
    public function agentfdrates(){
        return $this->hasMany(AgentFdRate::class,'member_id','id')->where('type',AgentFdRate::TYPE_AGENT_MEMBER);
    }

    public function getMemberLevelByConditionType($condition_type){
        $field_name = $this->getMemberLevelFieldByConditionType($condition_type);
        return $this->$field_name ?? 0;
    }

    public function getMemberLevelFieldByConditionType($condition_type){
        return $this->getFieldByConditionType($condition_type).'_level';
    }

    public function getMemberTotalBetMoneyFieldByConditionType($condition_type){
        return 'total_'.$this->getFieldByConditionType($condition_type).'_money';
    }

    public function getMemberTotalBetMoneyByConditionType($condition_type){
        $field_name = $this->getMemberTotalBetMoneyFieldByConditionType($condition_type);
        return $this->$field_name ?? 0;
    }

    public function getFieldByConditionType($condition_type){
        if($condition_type == Task::TYPE_SUM_TRANSACTION_SLOT) return 'slot';
        else if($condition_type == Task::TYPE_SUM_TRANSACTION_LIVE) return 'live';
        else return '';
    }
}