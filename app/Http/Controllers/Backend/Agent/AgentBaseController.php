<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class AgentBaseController extends BaseController
{
    protected $guard_name = "agent";

    protected function guard()
    {
        return Auth::guard($this->guard_name);
    }

    protected function getAgent(){
        // 对应 Member Model
        $member = $this->guard()->user();
        if(!$member->agent){
            $this->guard()->logout();
            throw new InvalidRequestException('您还不是代理，请先申请');
        }

        if($member->status == Member::STATUS_FORBIDDEN){
            $this->guard()->logout();
            throw new InvalidRequestException('该账号被禁用');
        }

        return $member;
    }

    protected function api_print($str){
        var_dump($str);exit;
    }
}
