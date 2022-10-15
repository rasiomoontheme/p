<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Services\GoogleAuthService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AdminLogService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminBaseController
{
    use AuthenticatesUsers;

    public $model;

    /**
     * 登录后跳转的地址
     * @var string
     */
    protected $redirectTo = '/admin/main';

    public function __construct(User $user)
    {
        $this->model = $user;
        // 1分钟之内只能进行登录操作5次
        // $this->middleware('throttle:5,1')->only('login');
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
        return view("admin.login");
    }

    public function login(Request $request,GoogleAuthService $service)
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

            $user = $this->guard()->user();

            // 验证谷歌验证码
            if($user->google_secret && systemconfig('is_backend_google_auth')){
                if(!$service->verifyCode($user->google_secret,$request->get('code'))){
                    return $this->failed(trans('res.user.login.google_auth_error'));
                }
            }

            if ($user->status == User::STATUS_FORBIDEN) {
                // 登录失败日志
                app(AdminLogService::class)->loginLogCreate(trans('res.base.account_forbidden'));
                throw new InvalidRequestException(trans('res.base.account_forbidden'));
                //return redirect()->route(app(UserService::class)->redirectLoginWithError('该账号被禁用'));
            } else {
                app(AdminLogService::class)->loginLogCreate();

                // 登录成功日志
                return $this->sendLoginResponse($request);
            }

        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
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
            'captcha.required' => trans('res.api.register.captcha_required'),
            'captcha.captcha' => trans('res.api.register.captcha_required')
        ]);
    }

    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->UserLogout();
        //return $this->loggedOut($request) ?: redirect(route('admin.login'));
        return $this->successWithUrl([],"",route("admin.login"));
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
