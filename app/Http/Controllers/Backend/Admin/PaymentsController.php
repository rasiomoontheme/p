<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class PaymentsController extends AdminBaseController
{
    protected $create_field = ['account','name','desc','type','qrcode','memo','rate','is_open','params','min','max','lang'];
    protected $update_field = ['account','name','desc','type','qrcode','memo','rate','is_open','params','min','max','lang'];

    public function __construct(Payment $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(Payment $payment){
        return view($this->getEditViewName(),["model" => $payment]);
    }

    public function storeRule(){
        return [
			"type" => Rule::in(array_keys(config('platform.payment_type'))),
            "min" => 'required|min:0|numeric',
            "max" => 'required|min:0|numeric',
		];
    }

    public function updateRule($id){
        return [
			"type" => ['required',Rule::in(array_keys(config('platform.payment_type')))],
            "min" => 'required|min:0|numeric',
            "max" => 'required|min:0|numeric',
		];
    }

    public function storeHandle($data)
    {
        return $this->checkRule($data);
    }

    public function updateHandle($data)
    {
        return $this->checkRule($data);
    }

    public function checkRule($data){
        // 如果是第三方支付
        //if($data['type'] == Payment::TYPE_THIRDPAY){
        if(\Str::contains($data['type'],Payment::PREFIX_THIRDPAY)){
            if(!array_key_exists('params',$data)) throw new InvalidRequestException(trans('res.api.common.operate_error'));

            if(!array_key_exists('account_id',$data['params']) || !$data['params']['account_id'])
                throw new InvalidRequestException(trans('res.payment.msg.account_id_required'));

            if(!array_key_exists('key',$data['params']) || !$data['params']['key'])
                throw new InvalidRequestException(trans('res.payment.msg.key_required'));

            if(!array_key_exists('url',$data['params']) || !$data['params']['url'])
                throw new InvalidRequestException(trans('res.payment.msg.url_required'));

            $data['params'] = json_encode($data['params'],JSON_UNESCAPED_UNICODE);

        }else if($data['type'] == Payment::TYPE_BANKPAY){
            if(!array_key_exists('params',$data)) throw new InvalidRequestException(trans('res.api.common.operate_error'));

            if(!array_key_exists('bank_type',$data['params']) || !$data['params']['bank_type'])
                throw new InvalidRequestException(trans('res.payment.msg.bank_type_required'));

            if(!array_key_exists('account',$data) || !$data['account'])
                throw new InvalidRequestException(trans('res.payment.msg.account_required'));

            if(!array_key_exists('name',$data) || !$data['name'])
                throw new InvalidRequestException(trans('res.payment.msg.name_required'));

            $data['params'] = json_encode($data['params'],JSON_UNESCAPED_UNICODE);
        // }else if($data['type']){
        }else if($data['type'] == Payment::TYPE_USDT){

            if(!array_key_exists('account',$data) || !$data['account'])
                throw new InvalidRequestException(trans('res.payment.msg.usdt_account_required'));
            if(!array_key_exists('params',$data)) throw new InvalidRequestException('操作异常');
            if(!array_key_exists('usdt_rate',$data['params']) || !$data['params']['usdt_rate'])
                throw new InvalidRequestException(trans('res.payment.msg.usdt_rate_required'));
            if(!is_numeric($data['params']['usdt_rate']) || $data['params']['usdt_rate'] <= 0){
                throw new InvalidRequestException(trans('res.payment.msg.usdt_rate_valid'));
            }
            if(!array_key_exists('usdt_type',$data['params'])
                || !$data['params']['usdt_type']
                || !Arr::get(config('platform.usdt_type'),$data['params']['usdt_type']))
                throw new InvalidRequestException(trans('res.api.common.operate_error'));
            $data['params'] = json_encode($data['params'],JSON_UNESCAPED_UNICODE);

        }else if(\Str::contains($data['type'],Payment::PREFIX_COMPANY)){
            if(!array_key_exists('account',$data) || !$data['account'])
                throw new InvalidRequestException(trans('res.payment.msg.account_required'));

            if(!array_key_exists('name',$data) || !$data['name'])
                throw new InvalidRequestException(trans('res.payment.msg.name_required'));
        }

        if($data['max'] < $data['min']) throw new InvalidRequestException(trans('res.payment.msg.money_range_err'));

        return $data;
    }
}
