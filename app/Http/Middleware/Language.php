<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class Language
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
        if($request->is('api/*') && ($lang = $request->get('lang') ?? session('applocale','zh_cn')) && array_key_exists($lang,config('platform.language_type'))){
            app()->setLocale($lang);
        }else if($request->is('admin/*') && ($lang = $request->user('web')->lang ?? session('applocale','zh_cn')) && array_key_exists($lang,config('platform.language_type')) ){
            app()->setLocale($lang);
        }else if($request->is('agent/*') && ($lang = $request->user('agent')->lang ?? session('applocale','zh_cn')) && array_key_exists($lang,config('platform.language_type'))){
            app()->setLocale($lang);
        }else{
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
