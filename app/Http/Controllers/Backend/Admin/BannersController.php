<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InternalException;
use App\Handlers\FileUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;

class BannersController extends AdminBaseController
{
    protected $create_field = ['title','description','url','is_open','groups','weight','lang','jump_link','is_new_window'];
    protected $update_field = ['title','description','url','is_open','groups','weight','lang','jump_link','is_new_window'];

    public function __construct(Banner $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function edit(Banner $banner){
        return view($this->getEditViewName(),["model" => $banner]);
    }

    public function storeRule(){
        return [
            "title" => "required|min:2|unique:banners,title",
            "url" => "required|url",
            "is_open" => "required|boolean",
            // "weight" => "integer"
        ];
    }

    public function storeHandle($data){
        $data['dimensions'] = app(FileUploadHandler::class)->getImageSizeByUrl($data['url']);
        return $data;
    }

    protected function updateHandle($data)
    {
        $data['dimensions'] = app(FileUploadHandler::class)->getImageSizeByUrl($data['url']);
        return $data;
    }

    public function updateRule($id){
        return [
            "title" => "required|min:2|unique:banners,title,".$id,
            "url" => "required|url",
            "is_open" => "required|boolean",
            // "weight" => "integer"
        ];
    }
}
