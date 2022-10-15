<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberBank;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberBanksController extends AdminBaseController
{
    protected $create_field = ['member_id','card_no','bank_type','phone','owner_name','bank_address','remark'];
    protected $update_field = ['card_no','bank_type','phone','owner_name','bank_address'];

    public function __construct(MemberBank $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model::with('member:id,name,is_in_on')
        ->memberName(isset_and_not_empty($params,'member_name',''))
        ->where($this->convertWhere($params))->latest()->paginate(5);

        return view("{$this->view_folder}.index", compact('data', 'params'));
    }



    public function edit(MemberBank $memberbank){
        return view($this->getEditViewName(),["model" => $memberbank]);
    }

    /*
    public function storeRule(){
        return [
			"card_no" => "required",
			"bank_type" => Rule::in(array_keys(config('platform.bank_type'))),
			"owner_name" => "required",
		];
    }
    */
    public function updateRule($id){
        return [
			"card_no" => "required",
			"bank_type" => Rule::in(array_keys(config('platform.bank_type'))),
			"owner_name" => "required",
		];
    }

}
