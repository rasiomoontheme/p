<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SystemNoticesController extends AdminBaseController
{
    protected $create_field = ['title','content','weight','text_content','group_name','url','is_open','is_app','lang'];
    protected $update_field = ['title','content','weight','text_content','group_name','url','is_open','is_app','lang'];

    public function __construct(SystemNotice $model){
        $this->model = $model;
        parent::__construct();
    }

    public function app_index(){
        return redirect(route('admin.systemnotices.index',['is_app' => 1]));
    }

    public function index(Request $request){
        if(!$request->has('is_app')) $request->merge(['is_app' => 0]);
        return parent::index($request);
    }

    public function edit(SystemNotice $systemnotice){
        return view($this->getEditViewName(),["model" => $systemnotice]);
    }

    public function indexUrl()
    {
        $models = Str::plural($this->model_name);
        return route("{$this->root_folder}.{$models}.index",['is_app' => isApp()]);
    }

    public function storeRule(){
        if(!isApp())
            return [
                "title" => "required|min:2",
                "content" => "required",
                "is_open" => Rule::in(array_keys(config('platform.is_open'))),
                //"url" => "sometimes|url"
            ];
        else
            return [
                "title" => "required|min:2",
                "text_content" => "required",
                "is_open" => Rule::in(array_keys(config('platform.is_open'))),
                //"url" => "sometimes|url"
            ];
    }

    public function updateRule($id){
        return $this->storeRule();
    }
}
