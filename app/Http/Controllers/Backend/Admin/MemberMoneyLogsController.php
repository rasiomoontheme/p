<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberMoneyLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberMoneyLogsController extends AdminBaseController
{
    protected $create_field = ['money','number_type','description','remark'];
    protected $update_field = ['money','number_type','description','remark'];

    public function __construct(MemberMoneyLog $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model::with('member:id,name,is_in_on')
        // ->whereHas('member',function($query) use($params){
        //     $query->where('name','like','%'.isset_and_not_empty($params,'member_name','').'%');
        // })
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->memberLang(isset_and_not_empty($params,'member_lang',''))
            ->where($this->convertWhere($params))->latest()->paginate(5);

        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function edit(MemberMoneyLog $MemberMoneyLog){
        return view($this->getEditViewName(),["model" => $MemberMoneyLog]);
    }

    public function storeRule(){
        return [
            "money" => "required|min:0",
			"money_type" => Rule::in(array_keys(config('platform.member_money_type'))),
			"number_type" => ["required",Rule::in(array_keys(config('platform.money_number_type')))],
			"operate_type" => Rule::in(array_keys(config('platform.member_money_operate_type'))),
		];
    }

    public function updateRule($id){
        return [
			"money" => "required|min:0",
			"money_type" => Rule::in(array_keys(config('platform.member_money_type'))),
			"number_type" => ["required",Rule::in(array_keys(config('platform.money_number_type')))],
			"operate_type" => Rule::in(array_keys(config('platform.member_money_operate_type'))),
		];
    }
}
