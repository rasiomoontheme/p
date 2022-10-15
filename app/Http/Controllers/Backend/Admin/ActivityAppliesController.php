<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityApply;
use App\Models\Member;
use App\Models\MemberMoneyLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ActivityAppliesController extends AdminBaseController
{
    protected $create_field = ['status','remark'];
    protected $update_field = ['status','remark'];

    public function __construct(ActivityApply $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model->with(['activity:id,title','member:id,name,lang','user:id,name'])
            ->memberLang(isset_and_not_empty($params,'member_lang',''))
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->where($this->convertWhere($params))->latest()->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    // public function edit(ActivityApply $activityapply){
    //     return view($this->getEditViewName(),["model" => $activityapply]);
    // }

    public function confirm(ActivityApply $activityapply,$status,Request $request){
        return view($this->getEditViewName(),["model" => $activityapply,'status' => $status]);
    }

    public function post_confirm(ActivityApply $activityapply,$status,Request $request){
        $this->validateRequest(['status' => $status],[
			"status" => Rule::in(array_keys(config('platform.activity_apply_status'))),
        ]);

        if(in_array($activityapply->status,[ActivityApply::STATUS_REJECT, ActivityApply::STATUS_BONUS]))
            return $this->failed(trans('res.activity_apply.edit.dealed_error'));

        $data = [
            'user_id' => $this->guard()->user()->id,
            'status' => $status,
            'remark' => $request->get('remark',null)
        ];

        $data = array_filter($data,function($temp){
            return $temp !== null;
        });

        // dd($activityapply);
        if($activityapply->update($data)){
            return $this->success(['close_reload' => true],trans('res.base.operate_success'));
        }else{
            return $this->failed(trans('res.base.operate_fail'));
        }
    }

    public function bonus(ActivityApply $activityapply,Request $request){
        return view('admin.activityapply.bonus',[
            'model' => $activityapply
        ]);
    }

    public function post_bonus(ActivityApply $activityapply,Request $request){
        $params = $request->only('fs_money');

        if(in_array($activityapply->status,[ActivityApply::STATUS_REJECT, ActivityApply::STATUS_BONUS]))
            return $this->failed(trans('res.activity_apply.edit.dealed_error'));

        $this->validateRequest($params,[
            'fs_money' => 'required|min:0'
        ]);

        $member = Member::findOrFail($activityapply->member->id);

        $money = $params['fs_money'];
        $money_type = 'fs_money';
        if(\systemconfig('activity_money_type')) $money_type = \systemconfig('activity_money_type');

        $data = [
            'member_id' => $member->id,
            'operate_type' => MemberMoneyLog::OPERATE_TYPE_ACTIVITY,
            'money_before' => $member->$money_type,
            'user_id' => $this->guard()->user()->id,
            'money_type' => $money_type,
            'money' => $money,
            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
            'model_name' => \get_class($activityapply),
            'model_id' => $activityapply->id,
            // 'description' => '发放活动【'.($activityapply->activity->title ?? '').'】奖金【'.$money.'元】至会员【'.$member->name.'】'
            'description' => trans('res.member_money_log.notice.activity_bonus',[
                'title' => $activityapply->activity->title ?? '',
                'money' => $money,
                'member' => $member->name], $member->lang)
        ];

        try {
            DB::transaction(function () use ($member, $data, $params,$money,$activityapply,$money_type) {

                $activityapply->update([
                    'user_id' => $this->guard()->user()->id,
                    'status' => ActivityApply::STATUS_BONUS
                ]);

                $member->increment($money_type, $money);

                $data['money_after'] = $member->$money_type;

                MemberMoneyLog::create($data);
            });
        } catch (Exception $e) {
            DB::rollback();
            return $this->failed(trans('res.base.operate_msg').$e->getMessage());
        }
        return $this->success(['close_reload' => true],trans('res.base.operate_success'));
    }



    // public function storeRule(){
    //     return [
	// 		"status" => Rule::in(array_keys(config('platform.activity_apply_status'))),
	// 	];
    // }

    // public function updateRule($id){
    //     return [
	// 		"status" => Rule::in(array_keys(config('platform.activity_apply_status'))),
	// 	];
    // }
}
