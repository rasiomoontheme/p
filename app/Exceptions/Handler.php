<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Throwable;


class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        InvalidRequestException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if($exception instanceof AuthenticationException){
            return parent::render($request, $exception);
        }

        if (env('APP_DEBUG')) {
            return parent::render($request, $exception);
        }

       // writelog('exception:'.(get_class($exception)).',msg:'.$exception->getMessage());

        if($request->ajax() || $request->wantsJson()){
            if($exception instanceof ThrottleRequestsException){
                return $this->failed("请勿频进行繁点击操作，请稍后再试",$exception->getCode());
            }else if($exception instanceof ValidationException){
                return $this->failed($exception->validator->getMessageBag()->first(),$exception->getCode());
            }else if(property_exists($exception,'validator')){
                return $this->failed($exception->validator->getMessageBag()->first(),$exception->getCode());
            }else{
                return $this->failed($exception->getMessage(),$exception->getCode());
            }
        }
        else{
            return response()->view('layouts.errors', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 系统抛出 AuthenticationException 异常时会调用该函数
     */
    public function unauthenticated($request, AuthenticationException $exception)
    {
        // web guard 没有登录则跳转
        if (in_array('web', $exception->guards())) {
            // return redirect()->guest(route("admin.login"));
            //echo '<script>window.onload=function(){window.top.location.href='.route("admin.login").'}</script>';exit;
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.','redirect' => route("admin.login")], 401);
            }

            echo '<script>window.top.alert("登录超时，请重新登录");window.top.location.href="'.route("admin.login").'";</script>';exit;

            // window.top.location.href="'.route("admin.login").'";
        }

        if (in_array('agent', $exception->guards())) {
            echo '<script>window.top.alert("登录超时，请重新登录");window.top.location.href="'.route("agent.login").'";</script>';exit;
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
