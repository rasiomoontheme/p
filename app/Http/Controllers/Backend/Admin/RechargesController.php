<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberMoneyLog;
use App\Models\Recharge;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RechargesController extends AdminBaseController
{
    protected $create_field = ['member_id','name','money','payment_type','diff_money','before_money','after_money','score','fail_reason','hk_at','status','user_id'];
    protected $update_field = ['member_id','name','money','payment_type','diff_money','before_money','after_money','score','fail_reason','hk_at','status','user_id'];

    public function __construct(Recharge $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request){
        $params = $request->all();
        $data = $this->model::with('member:id,name,is_in_on')
        ->userName(isset_and_not_empty($params,'user_name',''))
        ->memberName(isset_and_not_empty($params,'member_name',''))
        ->memberLang(isset_and_not_empty($params,'member_lang',''))
        ->where($this->convertWhere($params))->latest()->paginate(5);

        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function confirm(Recharge $recharge,$status){
        return view($this->getEditViewName(),["model" => $recharge,'status' => $status]);
    }

    // 通过充值验证
    public function post_confirm(Recharge $recharge, Request $request){
        $data = $request->only('diff_money');

        $data = array_filter_null($data);

        $this->validateRequest($data,[
            'diff_money' => 'numeric'
        ]);

        if($recharge->status != Recharge::STATUS_UNDEAL) return $this->failed(trans('res.recharge.msg.recharge_dealed'));

        $data['status'] = Recharge::STATUS_SUCCESS;
        $data['confirm_at'] = Carbon::now()->toDateTimeString();
        $data['user_id'] = $this->guard()->user()->id;

        try{
            DB::transaction(function() use ($data,$recharge){
                $diff_money = isset_and_not_empty($data,'diff_money',0);

                $data['before_money'] = $recharge->member->money;

                // 如果存在赠送金额
                if($diff_money > 0){
                    MemberMoneyLog::create([
                        'member_id' => $recharge->member_id,
                        'money' => $diff_money,
                        'money_before' => $data['before_money'],
                        'money_after' => $data['before_money'] + $diff_money,
                        'operate_type' => MemberMoneyLog::OPERATE_TYPE_RECHARGE_GIVEN,
                        'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                        'user_id' => $data['user_id'],
                        'model_name' => get_class($recharge),
                        'model_id' => $recharge->id
                    ]);
                }

                $m = $recharge->money + $diff_money;
                $data['after_money'] = $data['before_money'] + $m;

                // 记录充值日志
                MemberMoneyLog::create([
                    'member_id' => $recharge->member_id,
                    'money' => $recharge->money,
                    'money_before' => $data['before_money'] + $diff_money,
                    'money_after' => $data['before_money'] + $recharge->money + $diff_money,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_MEMBER,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'user_id' => $data['user_id'],
                    'model_name' => get_class($recharge),
                    'model_id' => $recharge->id
                ]);

                $recharge->update($data);

                $recharge->member->increment('money',$m);
                $recharge->addRechargeML();
            });
        }catch(Exception $e){
            return $this->failed(trans('res.base.update_fail').$e->getMessage());
        }
        return $this->success(['close_reload' => true], trans('res.base.update_success'));
    }

    public function post_reject(Recharge $recharge,Request $request){
        $data = $request->only('fail_reason');

        $this->validateRequest($data,[
            'fail_reason' => 'required|min:1'
        ]);

        if($recharge->status != Recharge::STATUS_UNDEAL) return $this->failed(trans('res.recharge.msg.recharge_dealed'));

        $data['status'] = Recharge::STATUS_FAILED;
        // $data['confirm_at'] = Carbon::now()->toDateTimeString();
        $data['user_id'] = $this->guard()->user()->id;

        if($res = $recharge->update($data)){
            return $this->success(['close_reload' => true], trans('res.base.update_success'));
        } else {
            return $this->failed(trans('res.base.update_fail'));
        }
    }

    public function updateRule($id){
        return [
			"member_id" => "required",
			//"payment_type" => Rule::in(array_keys(config('platform.recharge_type'))),
            "payment_type" => Rule::in(array_keys(config('platform.payment_type'))),
			"diff_money" => "required",
			"status" => Rule::in(array_keys(config('platform.recharge_status'))),
		];
    }

    public function payment_detail(Request $request,Recharge $recharge){
        return view('admin.recharge.payment_detail',['model' => $recharge]);
    }
}
