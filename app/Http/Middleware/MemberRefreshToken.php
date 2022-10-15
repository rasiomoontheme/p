<?php

namespace App\Http\Middleware;

use App\Events\CheckTask;
use App\Exceptions\InvalidRequestException;
use App\Models\Member;
use App\Models\Task;
use App\Services\MemberLogService;
use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class MemberRefreshToken extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 判断系统是否在维护
        /**
        if(systemconfig('is_system_maintenance')) throw new InvalidRequestException('系统维护','9999',['redirect' => systemconfig('site_domain')]);
        **/

        // 检查此次请求中是否带有 token，如果没有则抛出异常。
        $this->authToken = $this->auth->getToken();
        if (!$this->authToken) throw new UnauthorizedHttpException('jwt-auth','请提供token参数');

        // 捕捉 token 过期所抛出的 TokenExpiredException  异常
        try{
            if($member = $this->auth->user()){
                // 判断是否被强制踢下线，或者被挤下线
                if($member->status == Member::STATUS_FORCE_OFF){
                    app(MemberLogService::class)->forceMemberOffline($member);
                    return response()->json([
                        'status' => 'error',
                        'code' => 401,
                        'message' => '您已被强制下线',
                        'force_offline' => true
                    ])->setStatusCode('401');
                }

                // 判断token 荷载中的 loginsec 参数是否和上次登录记录中的 remark 相等
                if(($loginsec = $this->auth->payload()->get(Member::CUSTOM_CLAIMS_LOGIN_TIME)) && ($loginlog = $member->getLastLoginLog())){
                    /**
                    writelog('login sec type:'.gettype($loginsec));
                    writelog('login sec value:'.$loginsec);
                    writelog('log remark type:'.gettype($loginlog->remark));
                    writelog('log remark value:'.$loginlog->remark);
                    **/

                    if(bccomp($loginsec,$loginlog->remark) != 0){
                        return response()->json([
                            'status' => 'error',
                            'code' => 401,
                            'message' => "您的账号已于【".$loginlog->created_at."】在IP地址为【".$loginlog->ip."(".$loginlog->address.")】的设备上登录，如果不是您本人操作，请及时修改密码",
                            'force_offline' => true
                        ])->setStatusCode('401');
                    }
                }

                return $next($request);
            }
            
            throw new UnauthorizedHttpException('jwt-auth', '用户未登录');
        }catch(TokenExpiredException $e){
            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，
            // 我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            // writelog('捕获到了 token 过期异常');
            try{
                // 刷新用户的 token
                $token = $this->auth->refresh();

                // 使用一次性登录以保证此次请求的成功
                $this->auth->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);

            }catch (JWTException $exception) {
                // writelog('捕获到了 refresh 过期异常');
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
            }
            
        }

        // 在更新token时，判断检查任务是否完成
        event(new CheckTask($this->auth->user(),Task::TYPE_SUM_TRANSACTION));

        // 更新用户的token
        app(MemberLogService::class)->memberTokenLogCreate($token);

        $response = $next($request);
        // 设置该参数，否则前端无法获取
        $response->headers->set('Access-Control-Expose-Headers','Authorization');

        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($response, $token);

        // 过了 ttl 时间，token就会失效
        // if (!Auth::guard('api')->check()) {
        //     writelog("token失效:".$this->authToken);
        //     throw new InvalidRequestException('token已失效');
        // }
        // writelog('token未失效');

        /*
        $member_id = Auth::guard('api')->payload()['sub'];
        $time = Auth::guard('api')->payload()['exp']; // 过期时间，时间戳

        writelog('token失效时间：'.date('Y-m-d H:i:s',$time));
        writelog('result:'.(time() - $time > config('jwt.ttl') * 60));
        // 判断是否过了 ttl 时间，并在refresh time之间，如果是，则表示需要刷新token
        if ((time() - $time > config('jwt.ttl') * 60) && (time() -$time) > 0) {
            $token = Auth::guard('api')->refresh();
            writelog('超过过期时间，刷新后的token:'.$token);

            if (!$token)  throw new InvalidRequestException('token刷新失败');

            $request->headers->set('Authorization', 'Bearer ' . $token);
            // 在响应头中返回新的 token
            $respone = $next($request);
            if (isset($token) && $token) {
                $respone->headers->set('Authorization', 'Bearer ' . $token);
            }
            return $respone;
        }

        //token通过验证 执行下一补操作
        return $next($request);
        */
    }
}
