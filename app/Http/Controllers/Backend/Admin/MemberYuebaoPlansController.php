<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterestHistory;
use App\Models\MemberYuebaoPlan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\MemberMoneyLog;
use Carbon\Carbon;

class MemberYuebaoPlansController extends AdminBaseController
{
    protected $create_field = ['member_id','plan_id','amount','status','drawing_at'];
    protected $update_field = ['member_id','plan_id','amount','status','drawing_at'];

    public function __construct(MemberYuebaoPlan $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        // 更新今天的购买记录
        MemberMoneyLog::where('operate_type',MemberMoneyLog::OPERATE_TYPE_FINANCIAL)
            ->where('model_name',get_class(app(MemberYuebaoPlan::class)))
            ->where('remark','')
            ->whereBetween('created_at',[Carbon::now()->subDay(),Carbon::now()])
            ->update([
                'remark' => time()
            ]);

        // return parent::index($request);

        $params = $request->all();
        $data = $this->model->withCount(['history as interest_sum' =>function($query){
                $query->select(\DB::raw("sum(interest) as relationsum"));
            }])
            ->where($this->convertWhere($params))
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->latest()->paginate(15);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function interest_history(Request $request,MemberYuebaoPlan $plan){
        $params = $request->all();

        $data = InterestHistory::where('member_plan_id',$plan->id)
            ->where($this->convertWhere($params))->latest()->paginate(15);

        return view("admin.memberyuebaoplan.interest_history",compact('data', 'params','plan'));
    }
}
