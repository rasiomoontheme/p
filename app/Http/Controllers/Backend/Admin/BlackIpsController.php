<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlackIp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlackIpsController extends AdminBaseController
{
    protected $create_field = ['ip','is_open','remark'];
    protected $update_field = ['ip','is_open','remark'];

    public function __construct(BlackIp $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(BlackIp $blackip){
        return view($this->getEditViewName(),["model" => $blackip]);
    }

    public function storeRule(){
        return [
            "ip" => 'required|ip',
			"is_open" => Rule::in(array_keys(config('platform.is_open'))),
		];
    }

    public function updateRule($id){
        return [
            "ip" => 'required|ip',
			"is_open" => Rule::in(array_keys(config('platform.is_open'))),
		];
    }
}
