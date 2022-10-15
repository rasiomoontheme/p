<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Models\Payment;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ThirdPayService {

    public $account_id,$key,$url,$api,$paytype;

    public function __construct(Payment $payment)
    {
        // 判断是否是在线支付
        if(!$payment->isThirdPay()) throw new InvalidRequestException(trans('res.api.recharge.not_third_pay'));

        // 检查参数是否完整
        $params = $payment->params;

        if(!$params || !array_key_exists('account_id',$params) || !array_key_exists('key',$params) || !array_key_exists('url',$params)) throw new InvalidRequestException(trans('res.api.recharge.param_not_all'));

        $this->account_id = Arr::get($params,'account_id');
        $this->key = Arr::get($params,'key');
        $this->url = Arr::get($params,'url');
        $this->api = Arr::get($params,'api','shuxin');
        $this->paytype = Arr::get($params,'paytype','');

        if(!method_exists($this,$this->api)) throw new InvalidRequestException(trans('res.api.recharge.config_err'));

        $this->callback_url = route('pay.callback',[
            'payment' => $payment
        ]);
    }

    public function prepareRequest($data){
        // 检查参数
        if(!array_key_exists('bill_no',$data) || !array_key_exists('money',$data))
            throw new InvalidRequestException(trans('res.api.recharge.param_not_all'));

        $func = $this->api;
        return $this->$func($data['bill_no'],$data['money']);
    }

    // 返回支付的网址
    public function shuxin($bill_no,$money){
        $params = [
            'merchantName'  => $this->account_id,
            'orderId'       => $bill_no,
            'amount'        => $money,
            'noticeUrl'     => $this->callback_url,
        ];

        $params['sign'] = $this->ksortAndMd5($params,$this->key);
        $params['signType'] = 'MD5';

        $json = curls($this->url,$params);
        if(is_null($json)) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        $return = json_decode($json,1);
        if($return['code']) throw new InvalidRequestException(trans('res.api.common.err_msg').$return['msg']);

        return $return['data']['url'];
    }

    public function hrpay($bill_no,$money){
        $params = [
            'p1_customerID' => $this->account_id,
            'p2_orderNO' => $bill_no,
            'p3_amount' => intval($money),
            'p4_paytype' => $this->paytype,
            'p5_returnURL' => systemconfig('site_pc'),
            'p6_notifyURL' => $this->callback_url,
            'p7_remarkMSG' => '',
            'p9_pagetype' => 'json',
            'p10_clientIP' => get_client_ip()
        ];
        $params['p8_signFLAG'] = strtoupper($this->hrsign($params));
        writelog('hrpay request:'.json_encode($params));
        $json = curls($this->url,$params,1);
        writelog('hrpay result:'.$json);
        if(is_null($json)) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        $return = json_decode($json,1);
        if(!is_array($return) || (array_key_exists('code',$return) && $return['code'] !== 'success')) throw new InvalidRequestException(trans('res.api.common.err_msg').$return['message']);
        return $return['PayUrl'];
    }

    public function jlpay($bill_no,$money){
        $params = [
            'mch_id'  => $this->account_id,
            'order_no'       => $bill_no,
            'amount'        => sprintf("%.2f",$money),
            'notify_url'     => $this->callback_url,
            'pay_type' => $this->paytype,
            'time' => time()
        ];

        $params['sign'] = $this->ksortAndMd5($params);
        writelog('jlpay request:'.json_encode($params));
        $json = curls($this->url,$params,1);
        writelog('jlpay result:'.$json);
        if(is_null($json)) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        $return = json_decode($json,1);
        if($return['code'] != 200) throw new InvalidRequestException(trans('res.api.common.err_msg').$return['message']);

        return $return['data']['url'];
    }

    // 1 支付宝名片转账 未开通
    // 3通道:银行卡转账
    // 4通道：微信转银行卡
    // 5通道:微信转手机
    // 11通道吱口令
    // 17通道:支付宝转账
    // 18通道：支付宝转卡
    public function chaoyun($bill_no,$money){
        $params = [
            'time'=> time(),
            'mch_id'=> $this->account_id,
            'ptype'=> $this->paytype,
            'order_sn' => $bill_no,
            'money' => $money,//增加一定随机数金额
            'goods_desc'=> 'buy',
            'client_ip'=> '',
            'format'=> 'page',
            'notify_url'=> $this->callback_url
        ];

        $params['sign'] = $this->ksortAndMd5($params);

        return $this->url.'&'.http_build_query($params);
    }

    public function cgpay($bill_no,$money){
        $params = [
            'MerchantId'=> $this->account_id,
            'MerchantOrderId' => $bill_no,
            'Amount' => $money * 100000000,//增加一定随机数金额
            'OrderTimeLive' => '300',
            'OrderDescription'=> 'buy',
            "Symbol" => $this->paytype,
            'CallBackUrl'=> $this->callback_url,
            'ReferUrl' => systemconfig('site_pc')
        ];

        $params['Sign'] = $this->cgpay_sign($params);
        $json = $this->curl_json($this->url,json_encode($params));
        $res = json_decode($json,1);
        if($res['ReturnCode']) throw new InvalidRequestException(trans('res.api.common.err_msg').$res['ReturnMessage']);

        if(Arr::get($res,'Qrcode')) return Arr::get($res,'Qrcode');
        else throw new InvalidRequestException(trans('res.api.common.net_again_err'));
    }

    public function cgpay_sign($data){
        $data = array_change_key_case($data, CASE_LOWER);
        ksort($data);
        $str = '';
        foreach ($data as $k=>$v){
            if($k !== 'sign' && strlen($v)) $str .= $v.',';
        }
        $str .= $this->key;
        $str = md5($str);
        return strtoupper($str);
    }

    // 先将 所有参数进行 ksort排序，再进行md5加密
    public function ksortAndMd5($data){
        ksort($data);
        $str = '';
        foreach ($data as $k=>$v){
            if($k !== 'sign' && strlen($v) && !Str::contains($k,'sign'))  $str .= $k.'='.$v.'&';
        }
        $str .= 'key='.$this->key;
        $str = md5($str);
        return $str;
    }

    public function hrsign($data){
        ksort($data);
        $str = '';
        foreach ($data as $k=>$v){
            if($k !== 'sign' && strlen($v) && !Str::contains($k,'sign'))  $str .= $k.'='.$v.'&';
        }
        $str .= 'KEY='.$this->key;
        $str = md5($str);
        return $str;
    }

    public function afterSign($params){
        return md5("amount=".\Arr::get($params,'amount')."&orderId=".\Arr::get($params,'orderId')."&key=".$this->key);
    }

    public function cy_after_sign($params){
        $data = [
            'pt_order'=>$params['pt_order'],
            'sh_order'=>$params['sh_order'],
            'money'=>$params['money'],
            'status'=>$params['status'],
            'time'=>$params['time']
        ];

        return $this->ksortAndMd5($data);
    }

    // app(App\Services\ThirdPayService::class,['payment' => App\Models\Payment::find(10)])->curl_json("http://hd.jsa3333.com/pay/callback/10",'{"MerchantId":"c7c286f495a48eef5070decfdaacfdc1","MerchantOrderId":"20201106203503MEynq","PaymentId":"5tcppmvvamdsr","Symbol":"CGP","PayAmount":10100000000,"ExchangeRMB":"101","PayUnixTimestamp":1604666187,"EventId":"","Sign":"3349EAE48B0E070A1181A04739D6EB47","CGPWallet":""}');
    public function curl_json($url, $data_string) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
        );
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // return array('code'=>$return_code, 'result'=>$return_content);
        return $return_content;
    }
}