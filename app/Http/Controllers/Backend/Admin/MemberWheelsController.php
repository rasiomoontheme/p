<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Base;
use App\Models\MemberWheel;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

class MemberWheelsController extends AdminBaseController
{
    protected $create_field = ['member_id','user_id','award_id','award_desc','status'];
    protected $update_field = ['member_id','user_id','award_id','award_desc','status'];

    public function __construct(MemberWheel $model){
        $this->model = $model;
        parent::__construct();
    }

    // 确认发放奖励
    public function ensure(MemberWheel $memberwheel){
        if($memberwheel->status != MemberWheel::STATUS_NOT_SEND) return $this->failed(trans('res.api.common.operate_error'));

        $memberwheel->update([
            'status' => MemberWheel::STATUS_SENDED,
            'user_id' => $this->guard()->user()->id
        ]);

        return $this->success(['reload' => true],trans('res.base.operate_success'));
    }

    public function setting(Request $request){
        $now_currency = $request->get('currency') ?: 'zh_cn';
        $data = systemconfig('wheels_setting_json');
        if($data){
            $data = json_decode($data,1);
            $data = $data[$now_currency] ?? [];

        } else{
            $data = [];
        }

        $lang_list = config('platform.currency_type');


        return view('admin.memberwheel.setting',compact('data', 'lang_list', 'now_currency'));
    }

    public function post_setting(Request $request){
        $data = $request->all();
        $arr = $insert_data = [];
        $old_data = systemconfig('wheels_setting_json');
        if ($old_data){
            $insert_data = json_decode($old_data, true);
        }
        //return $data;
        $currency = $data['currency'];

        if(Arr::get($data,'deposit')){
            // deposit 当日存款,valid_num 有效流水,times 转盘次数 默认为1，is_open
            foreach ($data['deposit'] as $k => $v){
                if($v){
                    array_push($arr,[
                        'deposit' => $v,
                        'valid_num' => isset_and_not_empty($data['valid_num'],$k,''),
                        'times' => 1,
                        'awards' => isset_and_not_empty($data['awards'],$k,''),
                        'is_open' => $data['is_open'][$k] ?? 0
                    ]);
                }
            }
        }

        $insert_data[$currency] = $arr;

        $mod = SystemConfig::query()->getConfig('wheels_setting_json');

        if($mod->update([
            'value' => json_encode($insert_data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }

    // 设置抽奖条件
//    public function setting(){
//        $data = systemconfig('wheels_setting_json');
//        if($data) $data = json_decode($data,1);
//        else $data = [];
//        return view('admin.memberwheel.setting',compact('data'));
//    }
//
//    // 保存抽奖条件
//    public function post_setting(Request $request){
//        $data = $request->all();
//
//        $arr = []; // dd($data);
//
//        // deposit 当日存款,valid_num 有效流水,times 转盘次数 默认为1，is_open
//        foreach ($data['deposit'] as $k => $v){
//            if($v){
//                array_push($arr,[
//                    'deposit' => $v,
//                    'valid_num' => isset_and_not_empty($data['valid_num'],$k,''),
//                    'times' => 1,
//                    'awards' => isset_and_not_empty($data['awards'],$k,''),
//                    'is_open' => $data['is_open'][$k] ?? 0
//                ]);
//            }
//        }
//
//        $mod = SystemConfig::query()->getConfig('wheels_setting_json');
//
//        if($mod->update([
//            'value' => json_encode($arr, JSON_UNESCAPED_UNICODE)
//        ])){
//            return $this->success(['reload' => true],trans('res.base.save_success'));
//        }else{
//            return $this->failed(trans('res.base.save_fail'));
//        }
//    }

    // 奖励设置
    /**
    public function award(){
        $data = systemconfig('wheels_award_json');
        if($data) $data = json_decode($data,1);
        else $data = [];
        return view('admin.memberwheel.award',compact('data'));
    }

    public function post_award(Request $request){
        $data = $request->all();

        $arr = []; // dd($data);

        // min 最小充值金额,max 最大充值金额, 可抽中奖品 awards 数组
        foreach ($data['min'] as $k => $v){

        }
    }
    **/

}
