<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AboutsController extends AdminBaseController
{
    protected $create_field =  [
        "title","subtitle","cover_image","content","type","is_open","is_hot","weight","lang",
    ];
    protected $update_field = [
        "title","subtitle","cover_image","content","type","is_open","is_hot","weight","lang",
    ];

    public function __construct(About $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(About $about){
        return view($this->getEditViewName(),["model" => $about]);
    }

    public function storeRule(){
        return [
            "title" => "required|min:2",
            "type" => ["required",Rule::in(array_keys(config('platform.about_type')))],
            "cover_img" => "url",
            "content" => "required",
            "is_open" => "required|boolean",
            // "weight" => "integer"
        ];
    }

    public function updateRule($id){
         //dd(\request()->content);
        return [
            "title" => "required|min:2",
            "type" => ["required",Rule::in(array_keys(config('platform.about_type')))],
            "cover_img" => "url",
            "content" => "required",
            "is_open" => "required|boolean",
            // "weight" => "integer"
        ];
    }
}
