<?php

namespace App\Http\Middleware;

use App\Models\BlackIp;
use App\Models\SystemConfig;
use Closure;
use Exception;

class CheckForSystemMaintenanceMode
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
        $url = '';
        $ip = get_client_ip();

        try{
            // 如果后台开启了系统维护
            if(systemconfig('is_system_maintenance')){
                // 如果不在网站的白名单中
                if(!in_array($ip,explode('|',systemconfig('system_maintenance_whitelist'))))
                {
                    $url = env('APP_URL').'/activity';
                }
            }else{
                // 否则限制黑名单无法访问
                if(in_array($ip,BlackIp::getIpArray())){
                    $url = route('web.regionBlock');
                }
            }
        }catch(Exception $e){
            return $next($request);
        }

        if(!$url){
            return $next($request);
        }else{
            if($request->ajax() || $request->wantsJson()){
                return response()->json(['status' => 'error','code' => 503,'message' => '系统维护中','redirect' => $url ?? ''])->setStatusCode('503');
            }else{
                // 跳转到维护界面
                return redirect($url);
            }
        }

    }
}
