<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Exceptions\InvalidRequestException;
use App\Models\Agent;
use App\Models\Base;
use App\Models\Member;
use App\Services\MemberLogService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends AgentBaseController
{
    use AuthenticatesUsers;

    public $model;

    /**
     * 登录后跳转的地址
     * @var string
     */
    protected $redirectTo = '/agent/main';

    public function __construct(Agent $agent)
    {
        $this->model = $agent;
        // 1分钟之内只能进行登录操作5次
        $this->middleware('throttle:5,1')->only('login');
    }

    /**
     * 显示登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectTo);
        }
        $lang = \request()->get('language') ?? Base::LANG_VN;
        session(['applocale' => \request()->get('language') ?? 'vi']);
        app()->setLocale($lang);
        return view("agent.login");
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            // 登录成功后的操作,如果状态不是正常不允许登录
            // return $this->sendLoginResponse($request);

            if(!$this->guard()->user()->agent){
                $this->guard()->logout();
                return $this->failed(trans('res.api.apply_agent.not_agent'));
            }

            // 判断是否是代理
            if ($this->guard()->user()->status == Member::STATUS_FORBIDDEN) {
                // 登录失败日志
                app(MemberLogService::class)->agentLoginLogCreate('该账号被禁用');
                $this->guard()->logout();
                throw new InvalidRequestException(trans('res.base.account_forbidden'));
                //return redirect()->route(app(UserService::class)->redirectLoginWithError('该账号被禁用'));
            } else {
                app(MemberLogService::class)->agentLoginLogCreate();
                // 登录成功日志
                return $this->sendLoginResponse($request);
            }

        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        app(MemberLogService::class)->agentLogoutLogCreate();
        $this->UserLogout();
        return $this->successWithUrl([],"",route("agent.login"));
    }

    /**
     * 登录验证
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validateRequest($request->all(), [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ], [
            'captcha.required' => trans('res.api.captcha.check_err'),
            'captcha.captcha' => trans('res.api.captcha.out_of_date')
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? $this->successWithUrl([], trans('res.base.login_success'), url($this->redirectTo))
            : redirect()->intended($this->redirectPath());
    }

    /**
     * 自定义登录参数
     * @return string
     */
    public function username()
    {
        return 'name';
    }

    protected function guard()
    {
        return Auth::guard($this->guard_name);
    }
}
