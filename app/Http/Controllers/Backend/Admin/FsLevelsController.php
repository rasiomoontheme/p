<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\FsLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FsLevelsController extends AdminBaseController
{
    protected $create_field = ['game_type','level','name','quota','rate','member_id','type','lang'];
    protected $update_field = ['game_type','level','name','quota','rate','member_id','type','lang'];

    public function __construct(FsLevel $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(FsLevel $fslevel){
        return view($this->getEditViewName(),["model" => $fslevel]);
    }

    public function storeRule(){
        return [
			"game_type" => ["required",Rule::in(array_keys(config('platform.game_type')))],
			"level" => "numeric|integer|min:0",
			"quota" => "required|numeric|min:0",
			"rate" => "required|numeric|min:0",
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    public function storeHandle($data){
        return $this->checkFsType($data);
    }

    public function updateRule($id){
        return [
			"game_type" => ["required",Rule::in(array_keys(config('platform.game_type')))],
            "level" => "numeric|integer|min:0",
            "quota" => "required|numeric|min:0",
            "rate" => "required|numeric|min:0",
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    public function updateHandle($data){
        return $this->checkFsType($data,true);
    }

    public function checkFsType($data,$isUpdate = false){
        if($data['type'] == FsLevel::TYPE_MEMBER && !array_key_exists('member_id',$data)){
            throw new InvalidRequestException(trans('res.fs_level.msg.select_member'));
        }

        // 检查唯一性
        if($data['type'] == FsLevel::TYPE_SYSTEM)
            if(array_key_exists('member_id',$data)){
                unset($data['member_id']);
            }

            if($count = FsLevel::where('game_type',$data['game_type'])
                ->where('type',$data['type'])
                ->where('level',$data['level'])
                ->where('lang',$data['lang'])
                ->count()){
                if(($count > 0 && !$isUpdate) || ($count > 1 && $isUpdate))
                    throw new InvalidRequestException(trans('res.fs_level.msg.same_data_not_allowed'));

            if(!array_key_exists('name',$data))
                throw new InvalidRequestException(trans('res.fs_level.msg.fs_level_required'));
        }
        return $data;
    }

    public function batch_create(){
        return view('admin.fslevel.batch_create');
    }

    public function post_batch_create(Request $request){
        $data = $request->only($this->create_field);

        $this->validateRequest($data, [
            "level" => "required|numeric|integer|min:0",
            "name" => "required",
            "quota" => "required|numeric|min:0",
            "rate" => "required|numeric|min:0",
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
        ]);

        // 判断是否存在该等级的数据
        $exists_count = FsLevel::where('level',$data['level'])->where('lang',$data['lang'])->count();
        if($exists_count) return $this->failed(trans('res.fs_level.msg.fs_level_repeat'));

        $fslevels = [];
        $now = Carbon::now();
        foreach (config('platform.game_type') as $key => $value){
            $fslevels[] = [
                'game_type' => $key,
                'level' => $data['level'],
                'name' => $data['name'],
                'quota' => $data['quota'],
                'rate' => $data['rate'],
                'lang' => $data['lang'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        if(\DB::table('fs_levels')->insert(array_values($fslevels))){
            return $this->successWithUrl([],trans('res.base.batch_add_success'),$this->indexUrl());
        }else{
            return $this->failed(trans('res.base.batch_add_fail'));
        }
    }
}
