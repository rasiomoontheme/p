<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidRequestException;
use App\Models\SystemConfig;
use App\Models\User;
use App\Services\AdminLogService;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class RbacAdmin
{
    public $user;

    public function __construct()
    {
        $this->user = request()->user('web');
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     * @throws InvalidRequestException
     */
    public function handle($request, Closure $next)
    {
        if ($this->user->status == User::STATUS_FORBIDEN) {
            throw new AuthenticationException("用户被禁用");
        }

        if($this->user->isSingleLogin() && $loginlog = $this->user->getLastLoginLog()){

            if($loginlog->remark != session($this->user->getLoginSessionTag())){
                Auth::logout();

                throw new InvalidRequestException("您的账号已于【".$loginlog->created_at."】在IP地址为【".$loginlog->ip."(".$loginlog->address.")】的设备上登录，如果不是您本人操作，请及时修改密码",401,['redirect' => route("admin.login")]);
            }
        }

        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE']) && !in_array(get_client_ip(),SystemConfig::getIpListArray())) {
            // 记录操作日志
            app(AdminLogService::class)->operateLogCreate();
        }

        // 判断用户是否有权限操作
        if (!$this->user->hasPermission(\Route::currentRouteName())) {
            throw new InvalidRequestException("没有权限操作");
        }

        return $next($request);
    }
}
