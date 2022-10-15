<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GameListsController extends AdminBaseController
{
    protected $create_field = ['api_name','name','en_name','game_type','game_code','tcg_game_type','param_remark','img_path','img_url','client_type','platform','is_open','weight','tags'];
    protected $update_field = ['api_name','name','en_name','game_type','game_code','tcg_game_type','param_remark','img_path','img_url','client_type','platform','is_open','weight','tags'];

    protected $update_success_data = ['close_reload' => true];

    public function __construct(GameList $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->except('tags','client_type');
        $data = $this->model
            ->whereTags($request->get('tags',[]))
            ->where($this->convertWhere($params))
            ->when($request->get('client_type'),function($query) use($request) {
                $query->whichClientType($request->get('client_type'));
            })
            ->latest()
            ->paginate(15);
        $params = $request->all();
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function edit(GameList $gamelist){
        return view($this->getEditViewName(),["model" => $gamelist]);
    }

    public function storeRule(){
        return [
			"api_name" => "required",
			"name" => "required",
			"game_type" => Rule::in(array_keys(config('platform.game_type'))),
			"game_code" => "required",
			// "tcg_game_type" => Rule::in(array_keys(config('platform.tcg_game_type'))),
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
		];
    }

    public function storeHandle($data){
        if(array_key_exists('tags',$data)) $data['tags'] = implode(',',$data['tags']);
        else $data['tags'] = "";
        return $data;
    }

    public function updateRule($id){
        return [
			"api_name" => "required",
			"name" => "required",
			"game_type" => Rule::in(array_keys(config('platform.game_type'))),
			"game_code" => "required",
			// "tcg_game_type" => Rule::in(array_keys(config('platform.tcg_game_type'))),
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
		];
    }

    public function updateHandle($data){
        if(array_key_exists('tags',$data)) $data['tags'] = implode(',',$data['tags']);
        else $data['tags'] = "";
        return $data;
    }
}
