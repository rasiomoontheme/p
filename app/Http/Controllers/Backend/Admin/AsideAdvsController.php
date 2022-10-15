<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Handlers\FileUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\AsideAdv;
use App\Models\QuickUrl;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsideAdvsController extends AdminBaseController
{
    protected $create_field = ['name','group','pic_url','pic_index','vertical','horizontal','url_id','remark','is_open','weight','effect','lang'];
    protected $update_field = ['name','group','pic_url','pic_index','vertical','horizontal','url_id','remark','is_open','weight','effect','lang'];

    public function __construct(AsideAdv $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(AsideAdv $asideadv){
        return view($this->getEditViewName(),["model" => $asideadv]);
    }

    public function storeRule(){
        return [
			"name" => "required",
			"vertical" => Rule::in(array_keys(config('platform.adv_vertical'))),
			"horizontal" => Rule::in(array_keys(config('platform.adv_horizontal'))),
			//"url_id" => 'required|exists:quick_urls',
			"is_open" => Rule::in(array_keys(config('platform.is_open'))),
		];
    }

    public function updateRule($id){
        return [
            "name" => "required",
            "vertical" => Rule::in(array_keys(config('platform.adv_vertical'))),
            "horizontal" => Rule::in(array_keys(config('platform.adv_horizontal'))),
            //"url_id" => 'required|exists:quick_urls',
            "is_open" => Rule::in(array_keys(config('platform.is_open'))),
		];
    }

    public function storeHandle($data)
    {
        return $this->fillFields($data);
    }

    public function updateHandle($data)
    {
        return $this->fillFields($data);
    }

    public function fillFields($data){
        $dimensions = app(FileUploadHandler::class)->getImageSizeByUrl($data['pic_url']);

        if($dimensions){
            $data['pic_width'] = explode('*',$dimensions)[0];
            $data['pic_height'] = explode('*',$dimensions)[1];
        }

        if(array_key_exists('group',$data) && !array_key_exists('pic_index',$data)){
            // 判断是否存在同group
            $pic_index = AsideAdv::where('group', $data['group'])->max('pic_index');

            // $data['pic_index'] = isset_and_not_empty($data,'pic_index',0) > 0 ? $data['pic_index'] : ($pic_index >= 0? $pic_index + 1 : 0);
            $data['pic_index'] = $pic_index >= 0? $pic_index + 1 : 0;
        }

        if(array_key_exists('url_id', $data) && $data['url_id']){
            $qu = QuickUrl::find($data['url_id']);

            if(!$qu || !$qu->is_open) throw new InvalidRequestException('跳转路由无效，请检查');
        }

        return $data;
    }
}
