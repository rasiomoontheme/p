<?php

namespace App\Http\Controllers\Web;

use App\Models\Member;
use App\Models\Payment;
use App\Models\Recharge;
use App\Services\ThirdPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PayController extends WebBaseController
{
    public function third_callback(Payment $payment, Request $request)
    {
        // 根据 支付通道类型 进行回调
        $api = Arr::get($payment->params, 'api', 'shuxin');

        writelog('pay notify:' . json_encode($request->all()));

        switch ($api) {
            case 'shuxin':
                return $this->sx_callback($request, $payment);
                break;
            case 'chaoyun':
                return $this->cy_callback($request, $payment);
                break;
            case 'cgpay':
                return $this->cgpay_callback($request, $payment);
                break;
            case 'jlpay':
                return $this->jlpay_callback($request, $payment);
                break;
            case 'hrpay':
                return $this->hrpay_callback($request, $payment);
                break;
        }
    }

    public function hrpay_callback(Request $request, Payment $payment)
    {
        $data = $request->all();

        if (count($data) == 0) exit('error');

        if ($data['p8_signFLAG'] != strtoupper(app(ThirdPayService::class, ['payment' => $payment])->hrsign($data))) exit('error sign');

        $recharge = Recharge::where('bill_no', $data['p2_orderNO'])->where('status', Recharge::STATUS_UNDEAL)->first();
        if ($recharge) {
            //获取用户的帐号
            $member = Member::findOrFail($recharge['member_id']);
            if (!$member) exit('error user');

            try {
                DB::transaction(function () use ($recharge, $data, $member) {
                    //充值成功
                    if ($data['p6_status'] == 'SUCCESS') {
                        //往中心帐户加钱
                        $member->increment('money', $recharge->money);

                        $recharge->update([
                            'status' => 2,
                            'confirm_at' => date('Y-m-d H:i:s'),
                            'after_money' => $member->money
                        ]);

                        echo 'SUCCESS';
                        return;
                    } else {
                        //充值失败
                        $recharge->update([
                            'status' => 3,
                            'confirm_at' => date('Y-m-d H:i:s')
                        ]);
                        echo 'FAIL';
                        return;
                    }
                });
            } catch (Exception $e) {
                DB::rollback();
                return 'update error';
            }
        } else {
            echo 'error record';
            exit;
        }
    }

    public function sx_callback(Request $request, Payment $payment)
    {
        $data = $request->all();

        if (count($data) == 0) exit('error');

        if ($data['sign'] != app(ThirdPayService::class, ['payment' => $payment])->afterSign($data)) exit('error sign');

        $recharge = Recharge::where('bill_no', $data['orderId'])->where('status', Recharge::STATUS_UNDEAL)->first();
        if ($recharge) {
            //获取用户的帐号
            $member = Member::findOrFail($recharge['member_id']);
            if (!$member) exit('error user');

            try {
                DB::transaction(function () use ($recharge, $data, $member) {
                    //充值成功
                    if ($data['state'] == '收款成功') {
                        //往中心帐户加钱
                        $member->increment('money', $recharge->money);

                        $recharge->update([
                            'status' => 2,
                            'confirm_at' => date('Y-m-d H:i:s', time()),
                            'after_money' => $member->money
                        ]);

                        echo 'success';
                        return;
                    } else {
                        //充值失败
                        $recharge->update([
                            'status' => 3,
                            'confirm_at' => date('Y-m-d H:i:s')
                        ]);
                        echo 'success';
                        return;
                    }
                });
            } catch (Exception $e) {
                DB::rollback();
                return 'update error';
            }
        } else {
            echo 'error record';
            exit;
        }
    }

    public function cy_callback(Request $request, Payment $payment)
    {
        $data = $request->all();

        if (count($data) == 0) exit('error');

        if ($data['sign'] != app(ThirdPayService::class, ['payment' => $payment])->cy_after_sign($data)) exit('error sign');

        $recharge = Recharge::where('bill_no', $data['sh_order'])->where('status', Recharge::STATUS_UNDEAL)->first();
        if ($recharge) {
            //获取用户的帐号
            $member = Member::findOrFail($recharge['member_id']);
            if (!$member) exit('error user');

            try {
                DB::transaction(function () use ($recharge, $data, $member) {
                    //充值成功
                    if ($data['status'] == 'success') {
                        $recharge->update([
                            'status' => 2,
                            'confirm_at' => date('Y-m-d H:i:s', time()),
                            'after_money' => $member->money
                        ]);

                        //往中心帐户加钱
                        $member->increment('money', $recharge->money);
                        echo 'success';
                        return;
                    } else {
                        //充值失败
                        $recharge->update([
                            'status' => 3,
                            'confirm_at' => date('Y-m-d H:i:s'),
                            'after_money' => $member->money
                        ]);
                        echo 'success';
                        return;
                    }
                });
            } catch (Exception $e) {
                DB::rollback();
                return 'update error';
            }
        } else {
            echo 'error record';
            exit;
        }
    }

    public function cgpay_callback(Request $request, Payment $payment)
    {
        // $data = $request->all();

        $json = file_get_contents('php://input');
        writelog('cgpay callback:' . $json);

        $data = json_decode($json, 1);

        if (!is_array($data) || count($data) == 0) exit('error');

        if ($data['Sign'] != app(ThirdPayService::class, ['payment' => $payment])->cgpay_sign($data)) exit('error sign');

        $recharge = Recharge::where('bill_no', $data['MerchantOrderId'])->where('status', Recharge::STATUS_UNDEAL)->first();
        if ($recharge) {
            //获取用户的帐号
            $member = Member::findOrFail($recharge['member_id']);
            if (!$member) exit('error user');

            try {
                DB::transaction(function () use ($recharge, $data, $member) {
                    //充值成功
                    if ($data['ExchangeRMB']) {
                        //往中心帐户加钱
                        $member->increment('money', $recharge->money);

                        $recharge->update([
                            'status' => 2,
                            'confirm_at' => date('Y-m-d H:i:s', $data['PayUnixTimestamp']),
                            'after_money' => $member->money
                        ]);

                        echo 'success';
                        return;
                    }
                });
            } catch (Exception $e) {
                DB::rollback();
                return 'update error';
            }
        } else {
            echo 'error record';
            exit;
        }
    }

    public function jlpay_callback(Request $request, Payment $payment)
    {
        $data = $request->all();

        if (count($data) == 0) exit('error');

        if ($data['sign'] != app(ThirdPayService::class, ['payment' => $payment])->ksortAndMd5($data)) exit('error sign');

        $recharge = Recharge::where('bill_no', $data['order_no'])->where('status', Recharge::STATUS_UNDEAL)->first();
        if ($recharge) {
            //获取用户的帐号
            $member = Member::findOrFail($recharge['member_id']);
            if (!$member) exit('error user');

            try {
                DB::transaction(function () use ($recharge, $data, $member) {
                    //充值成功
                    if ($data['status'] == 'success') {
                        //往中心帐户加钱
                        $member->increment('money', $recharge->money);

                        $recharge->update([
                            'status' => 2,
                            'confirm_at' => $data['pay_time'],
                            'after_money' => $member->money
                        ]);

                        echo 'SUCCESS';
                        return;
                    } else {
                        //充值失败
                        $recharge->update([
                            'status' => 3,
                            'confirm_at' => date('Y-m-d H:i:s')
                        ]);
                        echo 'FAIL';
                        return;
                    }
                });
            } catch (Exception $e) {
                DB::rollback();
                return 'update error';
            }
        } else {
            echo 'error record';
            exit;
        }
    }

    public function sx_test()
    {
        $arr = [];
        return curls('http://laravel-iframe.test/pay/sx_callback', $arr);
    }
}
