<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActivitiesController extends AdminBaseController
{
    /**
    protected $create_field = ['title','subtitle','content','is_apply','apply_field','cover_image','hall_image','type','money','rate','gift_limit_money','date_desc','start_at','end_at','is_open','is_hot','weight','title_content','rule_content'];
    protected $update_field = ['title','subtitle','content','is_apply','apply_field','cover_image','hall_image','type','money','rate','gift_limit_money','date_desc','start_at','end_at','is_open','is_hot','weight','title_content','rule_content'];
    */
    protected $create_field = ['title','subtitle','cover_image','content','type','apply_type','apply_url','apply_desc','hall_field','hall_image','money','rate','gift_limit_money','date_desc','start_at','end_at','is_open','is_hot','weight','rule_content','is_app','lang'];
    protected $update_field = ['title','subtitle','cover_image','content','type','apply_type','apply_url','apply_desc','hall_field','hall_image','money','rate','gift_limit_money','date_desc','start_at','end_at','is_open','is_hot','weight','rule_content','is_app','lang'];


    public function __construct(Activity $model){
        $this->model = $model;
        parent::__construct();
    }

    public function app_index(Request $request){
        return redirect(route('admin.activities.index',['is_app' => 1]));
    }

    public function index(Request $request){
        if(!$request->has('is_app')) $request->merge(['is_app' => 0]);
        return parent::index($request);
    }

    public function edit(Activity $activity){
        return view($this->getEditViewName(),["model" => $activity]);
    }

    public function indexUrl()
    {
        $models = Str::plural($this->model_name);
        return route("{$this->root_folder}.{$models}.index",['is_app' => isApp()]);
    }

    public function storeRule(){
        return [
            "title" => "required|min:2",
            "content" => "required",
			//"is_apply" => ["required",Rule::in(array_keys(config('platform.activity_is_apply')))],
            "apply_type" => ["required",Rule::in(array_keys(config('platform.activity_apply_type')))],
			"type" => ["required",Rule::in(array_keys(config('platform.activity_type')))],
			"is_open" => [Rule::in(array_keys(config('platform.is_open')))],
			"is_hot" => [Rule::in(array_keys(config('platform.boolean')))],
        ];
    }

    public function updateRule($id){
        return [
            "title" => "required|min:2",
            "content" => "required",
            "apply_type" => ["required",Rule::in(array_keys(config('platform.activity_apply_type')))],
			// "is_apply" => ["required",Rule::in(array_keys(config('platform.activity_is_apply')))],
			"type" => ["required",Rule::in(array_keys(config('platform.activity_type')))],
			"is_open" => [Rule::in(array_keys(config('platform.is_open')))],
			"is_hot" => [Rule::in(array_keys(config('platform.boolean')))],
        ];
    }



    public function checkApplyField($data){
        /*
        if($data['is_apply']){
            if($data['apply_field']){
                $data['apply_field'] = implode(',',$data['apply_field']);

                if(!strstr($data['apply_field'],'member_name')){
                    // 默认都需要会员名称
                    $data['apply_field'] = 'member_name,'.$data['apply_field'];
                }

            }else{
                $data['apply_field'] = 'member_name';
            }

        }else{
            $data['apply_field'] = '';
        }
        return $data;
        */

        if($data['apply_type'] == Activity::APPLY_TYPE_HALL){
            if($data['hall_field']){
                $data['hall_field'] = implode(',',$data['hall_field']);

                if(!strstr($data['hall_field'],'member_name')){
                    // 默认都需要会员名称
                    $data['hall_field'] = 'member_name,'.$data['hall_field'];
                }

            }else{
                $data['hall_field'] = 'member_name';
            }

            if(!$data['hall_image']) throw new InvalidRequestException(trans('res.activity.msg.hall_image_required'));

        }else if($data['apply_type'] == Activity::APPLY_TYPE_URL){
            if(!$data['apply_url']) throw new InvalidRequestException(trans('res.activity.msg.apply_url_required'));
        }
        return $data;
    }

    protected function storeHandle($data)
    {
        return $this->checkApplyField($data);
    }

    protected function updateHandle($data)
    {
        return $this->checkApplyField($data);
    }

    public function activity_type(){
        $data = json_decode(systemconfig('activity_type_json'),1) ?? [];

        return view('admin.activity.type',compact('data'));
    }

    public function post_activity_type(Request $request){
        $data = $request->all();

        $arr = [];

        foreach ($data['number'] as $k => $v){
            if($v){
                $arr[$v] = isset_and_not_empty($data['text'],$k,'');
            }
        }

        $mod = SystemConfig::query()->getConfig('activity_type_json');

        if($mod->update([
            'value' => json_encode($arr, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['close_reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }

}
