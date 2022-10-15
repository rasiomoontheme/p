<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\MemberLog;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PaasooService {

    protected $api_key;
    protected $api_secret;

    // 短信过期时间
    const VALID_MINUTES = 2;

    public function __construct()
    {
        // 检查参数是否存在
        if(!env('PAASOO_API_KEY') || !env('PAASOO_API_SECRET'))
            throw new InvalidRequestException(trans('res.api.common.server_error'));

        $this->api_key = env('PAASOO_API_KEY');
        $this->api_secret = env('PAASOO_API_SECRET');
    }

    // 发送验证码
    public function send_sms($phone,$code){
        $url = 'https://api.paasoo.cn/json?key='.$this->api_key.'&secret='.$this->api_secret.'&from=SMS&to='.$phone.'&text='.$code;

        $json = curls($url,[],0);

        if(!$json) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        $result = json_decode($json,1);

        if(!is_array($result)) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        if(Arr::get($result,'status')) throw new InvalidRequestException(trans('res.api.common.err_code').$result['status']);
    }

    // 验证短信验证码
    public function validate_code($phone,$code,$type = MemberLog::LOG_TYPE_MEMBER_SMS){
        if(!$code) throw new InvalidRequestException(trans('res.api.sms.code_required'));

        $member_log = MemberLog::where('type',$type)->where('remark','like','%'.$phone.'%')->latest()->first();

        if(!$member_log) throw new InvalidRequestException(trans('res.api.sms.code_get_first'));

        if(Carbon::now()->diffInMinutes($member_log->created_at) > self::VALID_MINUTES)
            throw new InvalidRequestException(trans('res.api.sms.code_expired'));

        if(json_decode($member_log->remark,1)['code'] != $code) throw new InvalidRequestException(trans('res.api.sms.code_error'));
    }

    // 生成验证码
    public function generate_code(){
        return str_pad(mt_rand(0,999999),6,0,STR_PAD_LEFT);
    }
}
