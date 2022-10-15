<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberLogsController extends AdminBaseController
{
    protected $create_field = ['member_id','ip','address','ua','type','description','remark'];
    protected $update_field = ['member_id','ip','address','ua','type','description','remark'];

    public function __construct(MemberLog $model){
        $this->model = $model;
        parent::__construct();
    }

    // public function edit(MemberLog $memberlog){
    //     return view($this->getEditViewName(),["model" => $memberlog]);
    // }

    // public function storeRule(){
    //     return [
	// 		"type" => Rule::in(array_keys(config('platform.member_log_type'))),
	// 	];
    // }

    // public function updateRule($id){
    //     return [
	// 		"type" => Rule::in(array_keys(config('platform.member_log_type'))),
	// 	];
    // }
}
