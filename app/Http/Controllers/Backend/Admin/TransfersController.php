<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\SelfService;

class TransfersController extends AdminBaseController
{
    protected $create_field = ['bill_no','api_name','member_id','transfer_type','money','diff_money','real_money','before_money','after_money','money_type'];
    protected $update_field = ['bill_no','api_name','member_id','transfer_type','money','diff_money','real_money','before_money','after_money','money_type'];

    public function __construct(Transfer $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $mod = $this->model::with('member:id,name,is_in_on')
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->memberLang(isset_and_not_empty($params,'member_lang',''))
            ->where($this->convertWhere($params))->latest();

        $total_money = $mod->sum('money');
        $total_diff_money = $mod->sum('diff_money');
        $data = $mod->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params','total_money','total_diff_money'));
    }

    public function TransactionStatus(Request $request){
        $referenceid = $request->get('referenceid');
        $res = json_decode(app(SelfService::class)->checktransaction($referenceid),true);
        if($res['errCode'] != 0){
            return $this->failed(trans('res.member.msg.balance_error').$res['errMsg']);
        }
        if($res['errCode'] == 0){
            return $this->success(['data' => $res['errMsg']]);
        }
    }
    /*
    public function edit(Transfer $transfer){
        return view($this->getEditViewName(),["model" => $transfer]);
    }

    public function storeRule(){
        return [
			"transfer_type" => Rule::in(array_keys(config('platform.transfer_type'))),
			"money_type" => Rule::in(array_keys(config('platform.member_money_type'))),
		];
    }

    public function updateRule($id){
        return [
			"transfer_type" => Rule::in(array_keys(config('platform.transfer_type'))),
			"money_type" => Rule::in(array_keys(config('platform.member_money_type'))),
		];
    }
    */
}
