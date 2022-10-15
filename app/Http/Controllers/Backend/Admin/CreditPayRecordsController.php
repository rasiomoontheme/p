<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditPayRecord;
use App\Models\MemberMoneyLog;
use App\Services\ActivityService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreditPayRecordsController extends AdminBaseController
{
    protected $create_field = ['member_id','money','type','status','dead_at'];
    protected $update_field = ['member_id','money','type','status','dead_at'];

    public function __construct(CreditPayRecord $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $type = $request->get('type',CreditPayRecord::TYPE_BORROW);
        $data = $this->model->memberName(isset_and_not_empty($params,'member_name',''))
            ->where($this->convertWhere($params))->latest()->paginate(15);

        if(($request->get('is_overdue') == 1) && ($request->get('is_read') == 0))
            app(ActivityService::class)->read_credit();

        return view("{$this->view_folder}.index", compact('data', 'params','type'));
    }

    // 借款记录
    public function borrow_record(Request $request){
        return redirect()->to(route('admin.creditpayrecords.index',array_merge($request->all(),[
            'type' => CreditPayRecord::TYPE_BORROW,'title' => trans('res.credit_pay_record.index.title_borrow')])));
    }

    // 还款记录
    public function lend_record(){
        return redirect()->to(route('admin.creditpayrecords.index',[
            'type' => CreditPayRecord::TYPE_LEND,'title' => trans('res.credit_pay_record.index.title_lend')]));
    }

    // 确认借款
    public function confirm(Request $request,CreditPayRecord $record){
        $money_type = 'money';

        try{
            DB::transaction(function() use($money_type,$record) {
                $member = $record->member;
                $before_money = $member->$money_type;
                $before_used_credit = $member->used_credit;

                $member->increment($money_type,$record->money);
                $member->increment('used_credit',$record->money);

                $record->update([
                    'status' => CreditPayRecord::STATUS_SUCCESS,
                    'dead_at' => Carbon::now()->addDays($record->borrow_day)
                ]);

                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $record->money,
                    'money_before' => $before_money,
                    'money_after' => $member->$money_type,
                    'money_type' => $money_type,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_CREDIT_BORROW,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'user_id' => $this->guard()->user()->id,
                    'description' => '通过会员的借呗申请，发放金额【'.$record->money.'】给会员，周期【'.$record->borrow_day.'天】',
                    'model_name' => get_class($record),
                    'model_id' => $record->id
                ]);

                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $record->money,
                    'money_before' => $before_used_credit,
                    'money_after' => $member->used_credit,
                    'money_type' => 'used_credit',
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_CREDIT_BORROW,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'user_id' => $this->guard()->user()->id,
                    'description' => '通过会员的借呗申请，发放金额【'.$record->money.'】给会员，周期【'.$record->borrow_day.'天】',
                    'model_name' => get_class($record),
                    'model_id' => $record->id
                ]);
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.base.operate_msg').$e->getMessage());
        }

        return $this->success(['reload' => true],trans('res.base.operate_success'));
    }

    // 拒绝借款
    public function reject(Request $request,CreditPayRecord $record){
        $record->update([
            'status' => CreditPayRecord::STATUS_FAILED
        ]);

        return $this->success(['reload' => true],trans('res.base.operate_success'));
    }

    public function edit(CreditPayRecord $creditpayrecord){
        return view($this->getEditViewName(),["model" => $creditpayrecord]);
    }

    public function storeRule(){
        return [
			"money" => "required",
			"type" => Rule::in(array_keys(config('platform.credit_type'))),
			"status" => Rule::in(array_keys(config('platform.credit_status'))),
		];
    }

    public function updateRule($id){
        return [
			"money" => "required",
			"type" => Rule::in(array_keys(config('platform.credit_type'))),
			"status" => Rule::in(array_keys(config('platform.credit_status'))),
		];
    }
}
