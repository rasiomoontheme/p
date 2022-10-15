<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drawing;
use App\Models\MemberMoneyLog;
use App\Models\SystemConfig;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DrawingsController extends AdminBaseController
{
    protected $create_field = ['bill_no','member_id','name','money','account','before_money','after_money','score','counter_fee','fail_reason','member_bank_info','member_remark','confirm_at','status','user_id'];
    protected $update_field = ['bill_no','member_id','name','money','account','before_money','after_money','score','counter_fee','fail_reason','member_bank_info','member_remark','confirm_at','status','user_id'];

    public function __construct(Drawing $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request){
        $params = $request->all();
        $data = $this->model::with('member:id,name,lang')
        ->userName(isset_and_not_empty($params,'user_name',''))
        ->memberName(isset_and_not_empty($params,'member_name',''))
        ->memberLang(isset_and_not_empty($params,'member_lang',''))
        ->where($this->convertWhere($params))->latest()->paginate(5);

        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function confirm(Drawing $drawing,$status){
        return view($this->getEditViewName(),["model" => $drawing,'status' => $status]);
    }

    public function post_confirm(Drawing $drawing, Request $request){
        if($drawing->status != Drawing::STATUS_UNDEAL) return $this->failed(trans('res.drawing.msg.dealed_error'));

        // 通过会员的提款申请
        $data['status'] = Drawing::STATUS_SUCCESS;
        $data['user_id'] = $this->guard()->user()->id;
        $data['confirm_at'] = Carbon::now()->toDateTimeString();

        if($this->updateByModel($drawing,$data)){
            return $this->success(['close_reload' => true], trans('res.base.operate_success'));
        }else{
            return $this->failed(trans('res.api.common.operate_again'));
        }
    }

    public function post_reject(Drawing $drawing, Request $request){
        $data = $request->only('fail_reason');

        $this->validateRequest($data,[
            'fail_reason' => 'required|min:1'
        ]);

        if($drawing->status != Drawing::STATUS_UNDEAL) return $this->failed(trans('res.drawing.msg.dealed_error'));

        $data['status'] = Drawing::STATUS_FAILED;
        $data['user_id'] = $this->guard()->user()->id;

        try{
            DB::transaction(function() use ($drawing, $data){
                $money = $drawing->money + $drawing->counter_fee;
                // 退还会员资金
                MemberMoneyLog::create([
                    'member_id' => $drawing->member_id,
                    'money' => $money,
                    'money_before' => $drawing->member->money,
                    'money_after' => $drawing->member->money + $money,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_DRAWING_RETURN,
                    'user_id' => $data['user_id'],
                    // 'description' => '不通过会员的提现，将金额【'.$money.'元】退还至会员账户，拒绝理由：'.$data['fail_reason']
                    'description' => trans('res.member_money_log.notice.drawing_reject',[
                        'money' => $money,
                        'reason' => $data['fail_reason']
                    ], $drawing->member->lang)
                ]);

                $drawing->member->increment('money',$money);

                $drawing->update($data);
            });
        }catch(Exception $e){
            return $this->failed(trans('res.api.common.operate_again'));
        }
        return $this->success(['close_reload' => true], trans('res.base.operate_success'));
    }

    public function updateRule($id){
        return [
			"counter_fee" => "required",
			"status" => Rule::in(array_keys(config('platform.drawing_status'))),
		];
    }

    // 设置红包大小
    public function setting_size() {
        $data = systemconfig('drawing_money_size_json');
        if($data) {
            $data = json_decode($data,1);
        } else {
            $data = [];
            $lang_list = config('platform.currency_type');
            if ($lang_list) {
                foreach ($lang_list as $k_lang => $v_lang_name) {
                    $data[$k_lang]['a'] = $v_lang_name; // 最小，最大
                    $data[$k_lang]['b'] = [1, 1]; // 最小，最大
                }
            } else {
                $data = [];
            }
        }

        //var_dump($data);exit;

        return view('admin.drawing.setting_size',compact('data'));
    }

    public function post_setting_size(Request $request){
        $data = $request->all();
        //return $data['zh_cn'];
        $old_data = systemconfig('drawing_money_size_json');
        if($old_data) {
            $old_data = json_decode($old_data,true);
        } else {
            $old_data = [];
            $lang_list = config('platform.currency_type');
            if ($lang_list) {
                $arr = $lang_list;
                unset($arr['zh_hk']);
                foreach ($arr as $k_lang => $v_lang_name) {
                    $old_data[$k_lang]['a'] = $v_lang_name; // 最小，最大
                    $old_data[$k_lang]['b'] = [1, 1]; // 最小，最大
                }
            }
        }

        foreach ($old_data as $k_lang => $v) {
            if (isset($data[$k_lang])) {
                $old_data[$k_lang]['b'] = $data[$k_lang];
            }
        }

        $mod = SystemConfig::query()->getConfig('drawing_money_size_json');

        if($mod->update([
            'value' => json_encode($old_data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }
}
