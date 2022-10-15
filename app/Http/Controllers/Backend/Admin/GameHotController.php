<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\GameHot;
use App\Models\GameList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GameHotController extends AdminBaseController
{
    protected $create_field = ['name','api_name','lang','game_type', 'type','jump_link', 'is_new_window','desc','icon_path','icon_path2','game_code','img_url','is_online', 'sort'];
    protected $update_field = ['name','api_name','lang','game_type', 'type','jump_link','is_new_window','desc','icon_path','icon_path2','game_code','img_url','is_online', 'sort'];

    protected $update_success_data = ['close_reload' => true];

    public function __construct(GameHot $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model
            ->where($this->convertWhere($params))
            ->paginate(15);

        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function edit(GameHot $gamehot){
        return view($this->getEditViewName(),["model" => $gamehot]);
    }

    public function storeRule(){
        return [
            "name" => "required",
            "is_online" => ["required",Rule::in(array_keys(config('platform.is_online')))],
            "sort" => "required",
        ];
    }

    public function storeHandle($data){
//        $api = Api::where('api_name', $data['api_name'])->first();
//        if ($api){
//            $data['lang'] = $api->lang;
//        }
        return $data;
    }

    public function updateRule($id){
        return [
            "name" => "required",
            "is_online" => ["required",Rule::in(array_keys(config('platform.is_online')))],
            "sort" => "required",
        ];
    }

    public function updateHandle($data){
//        $api = Api::where('api_name', $data['api_name'])->first();
//        if ($api){
//            $data['lang'] = $api->lang;
//        }
        return $data;
    }
}
