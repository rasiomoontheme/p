<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\YjLevel;
use App\Services\AgentService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class YjLevelsController extends AdminBaseController
{
    protected $create_field = ['level','name','min','rate','active_num','lang'];
    protected $update_field = ['level','name','min','rate','active_num','lang'];

    public function __construct(YjLevel $model){
        $this->model = $model;
        parent::__construct();

        // 判断是否是传统代理模式
        app(AgentService::class)->checkTraditional();
    }

    public function edit(YjLevel $yjlevel){
        return view($this->getEditViewName(),["model" => $yjlevel]);
    }

    public function storeRule(){
        return [
			"level" => "required",
			"name" => "required",
			"min" => "required",
			"rate" => "required",
            'active_num' => 'required'
		];
    }

    public function updateRule($id){
        return [
			"level" => "required",
			"name" => "required",
			"min" => "required",
			"rate" => "required",
            'active_num' => 'required'
		];
    }
}
