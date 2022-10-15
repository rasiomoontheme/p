<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickUrl;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuickUrlsController extends AdminBaseController
{
    protected $create_field = ['name','title','desc','type','url','is_open','weight'];
    protected $update_field = ['name','title','desc','type','url','is_open','weight'];

    public function __construct(QuickUrl $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(QuickUrl $quickurl){
        return view($this->getEditViewName(),["model" => $quickurl]);
    }

    public function storeRule(){
        return [
            "name" => 'required',
            "url" => 'required',
			"type" => Rule::in(array_keys(config('platform.quick_url_type'))),
			"is_open" => Rule::in(array_keys(config('platform.is_open'))),
		];
    }

    public function updateRule($id){
        return [
            "name" => 'required',
            "url" => 'required',
			"type" => Rule::in(array_keys(config('platform.quick_url_type'))),
			"is_open" => Rule::in(array_keys(config('platform.is_open'))),
		];
    }
}
