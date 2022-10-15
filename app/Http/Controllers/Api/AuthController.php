<?php

namespace App\Http\Controllers\Api;

use App\Events\AutoInviteFd;
use App\Events\AutoMemberFd;
use App\Events\CheckTask;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentInvite;
use App\Models\Base;
use App\Models\Member;
use App\Models\MemberLog;
use App\Models\SystemConfig;
use App\Models\Task;
use App\Services\CaptchaService;
use App\Services\MemberLogService;
use App\Services\MemberService;
use App\Services\PaasooService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends MemberBaseController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        // 这里额外注意了：官方文档样例中只除外了『login』
        // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
        // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
        // 不过刷新一次作废
        $this->middleware('auth:api', ['except' =>
            ['login','register','captcha','demo','app_register','app_login','send_sms', 'send_sms_for_reset','reset_password','get_register_lang']]);
        // 另外关于上面的中间件，官方文档写的是『auth:api』
        // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回
    }

    public function app_register(Request $request){
        $data = $request->only(['name','password','qk_pwd','register_site','key','captcha','realname']);

        $this->validateRequest($data,[
            'name' => [
                'required','min:6','max:8','unique:members,name','regex:/^[a-z][a-z0-9]*$/'
            ],
            'password' => 'required|min:6',
            'realname' => 'required|min:2|max:20',
            'qk_pwd' => 'required|digits:6|numeric',
            'register_site' => 'required',
            'key' => 'required',
            'captcha' => 'required'
        ],[
            'name.regex' => trans('res.api.team.member_name_regex'),
            'register_site.required' => trans('res.api.common.operate_error'),
            'key.required' => trans('res.api.common.operate_error'),
            'captcha.required' => trans('res.api.register.captcha_required')
        ],$this->getLangAttribute('member'));

        if($request->get('register_site') != 'app') return $this->failed(trans('res.api.register.register_fail'));

        // 验证码是否通过验证
        app(CaptchaService::class)->captchaCheckAPI($data['captcha'],$data['key']);

        $data = \Arr::except($data,['captcha','key']);

        $invite = null;
        //token 表示邀请链接
        if($token = $request->get('token')){
            $invite = AgentInvite::where('token',$token)->first();
            if($invite) $data['top_id'] = $invite->member->agent_id ?? 0;
        }

        try{
            DB::transaction(function() use ($data,$token,$invite){
                $data['invite_code'] = '';
				$data['is_trans_on'] = 0;
                $member = Member::create($data);

                if($invite){
                    Agent::create([
                        'member_id' => $member->id
                    ]);

                    event(new AutoInviteFd($invite,$member));
                }
                // 会员注册时，默认是代理
                else if(systemconfig('is_auto_agent')){
                    Agent::create([
                        'member_id' => $member->id
                    ]);

                    // 成为代理后，自动设置点位
                    event(new AutoMemberFd($member));
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.api.register.register_fail').'：'.$e->getMessage());
        }
        return $this->success([],trans('res.api.register.register_success'));
    }

    public function app_login(Request $request){
        $data = $request->all();

        $this->validateRequest($data,[
            'name' => 'required|min:6',
            'password' => 'required|min:6',
        ],[],$this->getLangAttribute('member'));

        // 判断五分钟内是否失败次数超过三次
        $lastLoginLog = MemberLog::memberLoginSuccess($data['name'])->latest()->first(); //MemberLog::memberLoginFail($data['name']);

        $dead_time = Carbon::now()->subMinutes(5);
        if($lastLoginLog && $lastLoginLog->created_at->gt($dead_time)){
            $dead_time = $lastLoginLog->created_at;
        }

        if(MemberLog::memberLoginFail($data['name'])->where('created_at','>',$dead_time)->count() > 3){

            // 如果验证码参数不存在
            if(!Arr::get($data,'captcha') || !Arr::get($data,'key'))
                return $this->failed(trans('res.api.register.captcha_required'),400,'error',['is_require_captcha' => true]);

            app(CaptchaService::class)->captchaCheckAPI($data['captcha'],$data['key']);
        }

        $credentials = $request->only('name', 'password');

        $time = time();
        // 记录登录的时间戳，放在token的荷载中
        $customClaims = [Member::CUSTOM_CLAIMS_LOGIN_TIME => $time];

        if (!$token = $this->guard()->claims($customClaims)->attempt($credentials)) {
            app(MemberLogService::class)->memberLoginLogCreate(trans('res.api.login.name_psd_err'));
            return $this->failed(trans('res.api.login.name_psd_err'));
        }

        // 登录时，判断检查任务是否完成
        event(new CheckTask($this->guard()->user(),Task::TYPE_SUM_TRANSACTION));

        app(MemberLogService::class)->memberLoginLogCreate('',$token,$time);
        return $this->respondWithToken($token);
    }

    // 用户注册
    public function register(Request $request){
        $data = $request->only(['name','password','password_confirmation','phone','qk_pwd','realname','register_site','captcha','key','is_mobile','lang']);
        $data['is_mobile'] = $request->get('is_mobile',0);

        $data = array_filter($data, function ($temp) {
            return strlen($temp);
        });

        $register_setting = json_decode(SystemConfig::query()->getConfigValue('register_setting_json',Base::LANG_COMMON));
        foreach ($register_setting as $key => $val){
            if($data['is_mobile'] && !Str::contains($key,'_mobile')) continue;

            if(!$data['is_mobile'] && Str::contains($key,'_mobile')) continue;

            if(Str::contains($key,'isRealNameRequred') && $val) $data['realname'] = $request->get('realname');
            if($val) $data['phone'] = $request->get('phone');

            if(Str::contains($key,'isCaptchaRequired') && $val){
                $data['key'] = $request->get('key');
                $data['captcha'] = $request->get('captcha');
            }

            if(Str::contains($key,'isInviteCodeRequired') && $val) $data['invite_code'] = $request->get('invite_code');
        }

        $langs = get_language_fields_array();

        $this->validateRequest($data,[
            'name' => [
                'required','min:6','max:8','unique:members,name','regex:/^[a-z][a-z0-9]*$/'
            ],
            // 'name' => 'required|min:6|max:8|alpha_num|unique:members,name',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'phone' => 'sometimes',
            'qk_pwd' => 'required|digits:6|numeric',
            'realname' => 'sometimes|required|min:2|max:20',
            'register_site' => 'required',
            'key' => 'sometimes|required',
            'captcha' => 'sometimes|required',
            'is_mobile' => 'required|boolean',
            'lang' => ['required',Rule::in(array_keys(get_language_fields_array()))]
        ],[
            'name.regex' => trans('res.api.team.member_name_regex'),
            'register_site.required' => trans('res.api.common.operate_error'),
            'key.required' => trans('res.api.common.operate_error'),
            'captcha.required' => trans('res.api.register.captcha_required')
        ],$this->getLangAttribute('member'));

        // 验证码是否通过验证
        if(Arr::get($data,'captcha') && Arr::get($data,'key'))
            app(CaptchaService::class)->captchaCheckAPI($data['captcha'],$data['key']);

        $data = \Arr::except($data,['password_confirmation','is_mobile','captcha','key']);

        /**
        $agent = Agent::where(function($query) use ($data){
            $query->where('agent_pc_uri',getUrl($data['register_site']))->orWhere('agent_wap_uri',getUrl($data['register_site']));
        })->first();

        if($agent) $top = $agent->member;

        $invite = null;
        //token 表示邀请链接
        if($token = $request->get('token')){
            $invite = AgentInvite::where('token',$token)->first();
            if($invite) {
                $top = $invite->member;
            }
        }
        // i 参数表示 邀请码
        else if($invite_code = $request->get('invite_code')){
            // 查找邀请码是否存在
            $top = Member::where('invite_code',$invite_code)->where('status',Member::STATUS_ALLOW)->first();
        }
        **/
        $top = $this->getTopInfo($request);

        if(array_key_exists('invite_code',$data) && !$top) return $this->failed(trans('res.api.register.invite_code_required'));

        if($top){
            $data['top_id'] = $top->agent_id ?? '';
            $data['lang'] = $top->lang;
        }

        // 如果要求填写短信验证码
        if(systemconfig('vip1_is_register_sms_open')) app(PaasooService::class)->validate_code(Arr::get($data,'phone'), $request->get('sms_code'));

        $invite = null;
        if($token = $request->get('token')) $invite = AgentInvite::where('token',$token)->first();

        try{
            DB::transaction(function() use ($data,$invite){
                $data['invite_code'] = '';
                $member = Member::create($data);

                if($invite){
                    $agent = Agent::create([
                        'member_id' => $member->id
                    ]);
                    $member->update([
                        "agent_id" => $agent->id
                    ]);
                    event(new AutoInviteFd($invite,$member));
                }
                // 会员注册时，默认是代理
                else if(systemconfig('is_auto_agent')){

                    $agent = Agent::create([
                        'member_id' => $member->id
                    ]);

                    $member->update([
                        "agent_id" => $agent->id
                    ]);

                    // 成为代理后，自动设置点位
                    event(new AutoMemberFd($member));
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.api.register.register_fail').'：'.$e->getMessage());
        }

        $time = time();
        // 记录登录的时间戳，放在token的荷载中
        $customClaims = [Member::CUSTOM_CLAIMS_LOGIN_TIME => $time];

        if (!$token = $this->guard()->claims($customClaims)->attempt(['name' => $data['name'], 'password' => $data['password']])) {
            app(MemberLogService::class)->memberLoginLogCreate(trans('res.api.login.name_psd_err'));
            return $this->failed(trans('res.api.login.name_psd_err'));
        }

        app(MemberLogService::class)->memberLoginLogCreate('',$token,$time);

        return $this->success(['token' => $token],trans('res.api.register.register_success'));
        /**
        if(Member::create($data)){
        return $this->success([],'注册成功');
        }else{
        return $this->failed('注册失败，请重试');
        }
         */
    }

    public function get_register_lang(Request $request){
        $top = $this->getTopInfo($request);

        return $this->success(['lang' => $top->lang ?? '']);
    }

    // 参数 register_site 注册网址，末尾不能带斜线
    public function getTopInfo(Request $request){
        $data = $request->all();

        // 1. 根据 register_site 判断
        $agent = Agent::where(function($query) use ($data){
            $query->where('agent_pc_uri',getUrl($data['register_site']))->orWhere('agent_wap_uri',getUrl($data['register_site']));
        })->first();

        if($agent) $top = $agent->member;

        if($token = $request->get('token')){
            $invite = AgentInvite::where('token',$token)->first();
            if($invite) {
                $top = $invite->member;
            }
        }
        // i 参数表示 邀请码
        else if($invite_code = $request->get('invite_code')){
            // 查找邀请码是否存在
            $top = Member::where('invite_code',$invite_code)->where('status',Member::STATUS_ALLOW)->first();
        }

        return $top ?? null;
    }

    public function login(Request $request)
    {
        $data = $request->only('name','password');

        if(\systemconfig('vip1_is_login_captcha_open')){
            $data['key'] = $request->get('key');
            $data['captcha'] = $request->get('captcha');
        }

        $this->validateRequest($data,[
            'name' => 'required|min:6',
            'password' => 'required|min:6',
            'key' => 'sometimes|required',
            'captcha' => 'sometimes|required'
        ],[
            'key.required' => trans('res.api.common.operate_error'),
            'captcha.required' => trans('res.api.register.captcha_required')
            ],$this->getLangAttribute('member'));

        if(\systemconfig('vip1_is_login_captcha_open')){
            // 验证码是否通过验证
            app(CaptchaService::class)->captchaCheckAPI($data['captcha'],$data['key']);
        }

        $credentials = $request->only('name', 'password');

        /*
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->failed('认证失败');
        }
        */
        //var_dump($this->guard()->attempt($credentials));exit;

        $time = time();
        // 记录登录的时间戳，放在token的荷载中
        $customClaims = [Member::CUSTOM_CLAIMS_LOGIN_TIME => $time];

        if (!$token = $this->guard()->claims($customClaims)->attempt($credentials)) {
            app(MemberLogService::class)->memberLoginLogCreate(trans('res.api.login.name_psd_err'));
            return $this->failed(trans('res.api.login.name_psd_err'));
        }

        // 登录时，判断检查任务是否完成
        event(new CheckTask($this->guard()->user(),Task::TYPE_SUM_TRANSACTION));

        app(MemberLogService::class)->memberLoginLogCreate('',$token,$time);
        return $this->respondWithToken($token);
    }

    // 公共API验证码
    public function captcha(){
        return $this->success(['data' => app(CaptchaService::class)->createCodeAPI('flat')]);
    }

    // 生成试玩账号并登录
    public function demo(Request $request){
        // 判断系统是否开启了试玩功能
        if(!systemconfig('is_demo_play_open')) return $this->failed(trans('res.api.login.demo_not_open'));

        // 获取到用户的IP
        $ip = get_client_ip();

        $member = null;
        if($ip && $member = Member::where('register_ip',$ip)->where('is_demo',1)->first()){

        }else{
            $name = app(MemberService::class)->generateDemoName();
            $password = substr(md5($name),0,6);

            $data = [
                'name' => $name,
                'password' => $password,
                'money' => '2000',
                'is_demo' => 1
            ];

            // 不存在则创建试玩账号
            try{
                $member = Member::create($data);
            }catch (\Exception $e){
                return $this->failed(trans('res.api.common.operate_fail').$e->getMessage());
            }
        }

        $login_params = [
            'name' => $member->name,
            'password' => $member->o_password
        ];

        $time = time();
        $customClaims = [Member::CUSTOM_CLAIMS_LOGIN_TIME => $time];
        $token = $this->guard()->claims($customClaims)->attempt($login_params);
        app(MemberLogService::class)->memberLoginLogCreate('',$token,$time);
        return $this->respondWithToken($token);
    }

    public function me()
    {
        $member = $this->getMember(1);
        $userinfo = $member->makeHidden('qk_pwd')->toArray();
        $userinfo['has_qk_pwd'] = $member->qk_pwd ? true : false;
        $userinfo['money'] = floatval($member->money);
        $userinfo['fs_money'] = floatval($member->fs_money);
        // 计算码量
        app(MemberService::class)->updateMemberML($member);
        return $this->success(['data' => $userinfo]);
    }

    public function modify_info(Request $request){
        // 'realname','phone',
        $data = $request->only(['realname','line','facebook','email','phone']);
        $data = array_filter_null($data);
        $this->validateRequest($data,[
            'realname' => 'sometimes|min:2|max:20',
            'phone' => 'sometimes',
            'qq' => 'sometimes|numeric',
            'email' => 'sometimes|max:50|email',
            'facebook' => 'sometimes|required',
            'line' => 'sometimes|required'
        ],[],$this->getLangAttribute('member'));

        if (isset($data['phone'])){
            // 验证短信是否正确
            app(PaasooService::class)->validate_code(Arr::get($data,'phone'), $request->get('sms_code'), MemberLog::LOG_TYPE_MEMBER_BIND_SMS);
        }


        $member = $this->getMember();
        if($member->update($data)) return $this->success([]);
        else return $this->failed(trans('res.api.common.operate_fail'));
    }

    public function logout()
    {
        // JWTAuth::parseToken()->invalidate();
        $this->guard()->logout();
        app(MemberLogService::class)->memberLogoutLogCreate();
        return $this->success([], trans('res.api.common.operate_success'));
    }

    /**
     * Undocumented function
     * 刷新时间指的是在这个时间内可以凭旧 token 换取一个新 token。
     * 例如 token 有效时间为 60 分钟，刷新时间为 20160 分钟。
     * 代表你的 token 在 60 分钟内可以正常使用，超过 60 分钟则过期无法使用。
     * 但在 20160 分钟的期限内你可以在任意时刻凭旧 token 换取新 token。
     * @return void
     * @Description
     */
    public function refresh()
    {
        // JWTAuth::parseToken()->refresh()
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        $expires_time = $this->guard()->factory()->getTTL() * 60;

        return $this->success(['data' => [
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => JWTAuth::factory()->getTTL() * 60
            'expires_in' => $expires_time,
            'expires_at' => Carbon::createFromTimestamp($expires_time + time())->toDateTimeString()
        ]]);
    }

    public function send_sms(Request $request){
        $data = $request->all();

        // 判断是否开启注册发送短信功能
        if(!\systemconfig('vip1_is_register_sms_open')) return $this->failed(trans('res.api.common.operate_error'));

        $this->validateRequest($data,[
            'phone' => 'required'
        ],$this->getLangAttribute('member'));

        // 判断2分钟内该IP是否接收过短信验证码
        $ip = get_client_ip();
        if(!$ip) return $this->failed(trans('res.api.common.net_again_err'));

        $service = app(PaasooService::class);

        $flag = MemberLog::where('type',MemberLog::LOG_TYPE_MEMBER_SMS)
            ->where('ip',$ip)->where('created_at','>',Carbon::now()->subMinutes(PaasooService::VALID_MINUTES))->exists();

        if($flag) return $this->failed(trans('res.api.sms.operation_repeat'));

        try{
            // 发送验证码，并记录日志
            $code = $service->generate_code();

            $service->send_sms($data['phone'],$code);

            // 短信发送成功，记录日志
            app(MemberLogService::class)->sendSmsLogCreate($ip,$code,$data['phone']);

            return $this->success([]);
        }catch (\Exception $e){
            return $this->failed(trans('operate_fail').$e->getMessage());
        }
    }

    // 发送重置密码 验证码
    public function send_sms_for_reset(Request $request){
        $data = $request->all();
        // 判断是否开启注册发送短信功能

        $this->validateRequest($data,[
            'phone' => 'required'
        ],$this->getLangAttribute('member'));

        // 判断2分钟内该IP是否接收过短信验证码
        $ip = get_client_ip();
        if(!$ip) return $this->failed(trans('res.api.common.net_again_err'));

        $user = Member::where('phone', $data['phone'])->first();

        if (!$user)
            return $this->failed(trans('res.api.common.phone_not_exist'));

        $service = app(PaasooService::class);

        $flag = MemberLog::where('type',MemberLog::LOG_TYPE_MEMBER_RESET_SMS)
            ->where('ip',$ip)->where('created_at','>',Carbon::now()->subMinutes(PaasooService::VALID_MINUTES))->exists();

        if($flag) return $this->failed(trans('res.api.sms.operation_repeat'));

        try{
            // 发送验证码，并记录日志
            $code = $service->generate_code();

            $service->send_sms($data['phone'],$code);

            // 短信发送成功，记录日志
            app(MemberLogService::class)->sendSmsLogCreate($ip,$code,$data['phone']);

            return $this->success([]);
        }catch (\Exception $e){
            return $this->failed(trans('operate_fail').$e->getMessage());
        }
    }

    // 发送重置密码 验证码
    public function send_sms_for_bind(Request $request){
        $data = $request->all();
        // 判断是否开启注册发送短信功能

        $this->validateRequest($data,[
            'phone' => 'required'
        ],$this->getLangAttribute('member'));

        // 判断2分钟内该IP是否接收过短信验证码
        $ip = get_client_ip();
        if(!$ip) return $this->failed(trans('res.api.common.net_again_err'));

        $user = Member::where('phone', $data['phone'])->first();

        if ($user)
            return $this->failed(trans('res.api.common.phone_existed'));

        $service = app(PaasooService::class);

        $flag = MemberLog::where('type',MemberLog::LOG_TYPE_MEMBER_BIND_SMS)
                         ->where('ip',$ip)->where('created_at','>',Carbon::now()->subMinutes(PaasooService::VALID_MINUTES))->exists();

        if($flag) return $this->failed(trans('res.api.sms.operation_repeat'));

        try{
            // 发送验证码，并记录日志
            $code = $service->generate_code();

            $service->send_sms($data['phone'],$code);

            // 短信发送成功，记录日志
            app(MemberLogService::class)->sendSmsLogCreate($ip,$code,$data['phone']);

            return $this->success([]);
        }catch (\Exception $e){
            return $this->failed(trans('operate_fail').$e->getMessage());
        }
    }

    public function reset_password(Request $request)
    {
        $data = $request->only(['password','password_confirmation', 'phone', 'sms_code']);
        // 验证短信是否正确
        app(PaasooService::class)->validate_code(Arr::get($data,'phone'), $request->get('sms_code'), MemberLog::LOG_TYPE_MEMBER_RESET_SMS);

        $this->validateRequest($data,[
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ],[],$this->getLangAttribute('modify_pwd'));

        $member = Member::where('phone', $data['phone'])->first();
        if (!$member)
            return $this->failed(trans('res.api.common.member_not_exist'));

        if($member->update([
            'password' => $data['password']
        ])){
            return $this->success([],trans('res.api.modify_pwd.password_success'));
        }else{
            return $this->failed(trans('res.api.modify_pwd.password_fail'));
        }
    }




    // 修改默认的认证字段 email 为 name
    public function username()
    {
        return 'name';
    }

    protected function guard()
    {
        return Auth::guard($this->guard_name);
    }
}
