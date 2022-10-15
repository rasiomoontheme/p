<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
/**
 * 系统内部异常
 * Class InternalException
 * @package App\Exceptions
 */
class InternalException extends Exception
{
    use ApiResponseTrait;
    protected $msgForUser;

    /**
     * InternalException constructor.
     * @param string $message 原本应该有的异常信息比如连接数据库失败
     * @param string $msgForUser 展示给用户的信息,通常来说只需要告诉用户 系统内部错误 即可，因为不管是连接 Mysql 失败还是连接 Redis 失败对用户来说都是一样的
     * @param int $code
     */
    public function __construct(string $message, string $msgForUser = '系统内部错误', int $code = 500)
    {
        parent::__construct($message, $code);
        $this->msgForUser = $msgForUser;
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            //return response()->json(['msg' => $this->msgForUser], $this->code);
            return $this->failed($this->msgForUser,$this->code);
        }
        //return parent::render();
        return view('layouts.errors', ['msg' => $this->msgForUser,'code' => $this->code]);
    }
}
