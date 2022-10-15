<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BanksController extends AdminBaseController
{
    protected $create_field = ['key','name','url','is_open','weight','lang'];
    protected $update_field = ['key','name','url','is_open','weight','lang'];

    public function __construct(Bank $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(Bank $bank){
        return view($this->getEditViewName(),["model" => $bank]);
    }

    public function storeRule(){
        return [
            "key" => "required|unique:banks,key",
            "name" => "required",
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
			"lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    public function updateRule($id){
        return [
            "key" => "required|unique:banks,key,".$id,
            "name" => "required",
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
			"lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }
}
