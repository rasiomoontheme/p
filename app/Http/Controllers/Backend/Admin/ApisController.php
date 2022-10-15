<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\GameList;
use App\Models\SystemConfig;
use App\Services\SelfService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class ApisController extends AdminBaseController
{
    protected $create_field = ['api_id','api_name','api_title','api_money','prefix','is_open','weight','remark','lang','lang_list', 'icon_url'];
    protected $update_field = ['api_id','api_name','api_title','api_money','prefix','is_open','weight','remark','lang','lang_list', 'icon_url'];

    public function __construct(Api $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $data = $this->model->get();
        $config = SystemConfig::query()->latest()->getConfigGroup('remote_api');
        return view("{$this->view_folder}.index", compact('data','config'));
    }

    public function edit(Api $api){
        return view($this->getEditViewName(),["model" => $api]);
    }

    // 刷新接口额度
    public function refresh(Request $request){
        $this->validateRequest($request->all(),[
            'api_code' => 'required|exists:apis,api_name'
        ]);

        $api_code = $request->get('api_code');

        $money = app(SelfService::class)->refreshApiMoney($api_code);

        return $this->success(['data' => $money]);
    }

    // 更新接口游戏
    public function pull(Request $request){
        $this->validateRequest($request->all(),[
            'api_code' => 'required|exists:apis,api_name'
        ]);

        $api_code = $request->get('api_code');

        $json = app(SelfService::class)->getGamelist($api_code);

        $res = json_decode($json,1);

        if(!is_array($res)) throw new InvalidRequestException(trans('res.api.common.net_again_err'));

        if($res['status']['errorCode'] != '20000') throw new InvalidRequestException(trans('res.api.common.err_code').$res['status']['errorCode'].'，'.trans('res.api.common.err_msg').$res['status']['msg']);

        $count = count($res['data']);

        if(!$count) return $this->success([],trans('res.apis.msg.no_need_update_game'));

        $update_count = $create_count = 0;

        try{
            /**
            // 删除该接口所有的游戏
            GameList::where('api_name',$api_code)->delete();
            foreach ($res['data'] as $v){
                $create_count++;
                GameList::create([
                    'api_name' => $v['api_code'],
                    'name' => $v['cn_name'],
                    'en_name' => $v['en_name'],
                    'game_code' => $v['game_code'],
                    'game_type' => $v['game_type'],
                    //'img_path' => $v['img_path'],
                    //'img_url' => $v['img_url'],
                    'img_url' => $v['remote_url'],
                    'client_type' => $v['client_type'],
                    'platform' => $v['platform'],
                    'param_remark' => $v['extensions'],
                    'is_open' => $v['on_line'],
                    'tags' => 'recommend,new,hot'
                ]);
            }
            **/

            /**
             * {
                    "id": 16880,
                    "api_source_id": 0,
                    "name": "Xô số Đài Loan",
                    "en_name": null,
                    "api_code": "TCGLO3",
                    "api_id": 5803,
                    "client_type": 0,
                    "game_type": 4,
                    "game_code": "4DTWC@",
                    "sub_game_code": null,
                    "extensions": null,
                    "img_path": null,
                    "c_img_url": "https:\/\/images.b332411.com:42666\/VD\/SEA2\/4DTWC@.png",
                    "c_img_mobile_url": "https:\/\/images.b332411.com:42666\/VD\/SEA2\/4DTWC@.png",
                    "img_url": "https:\/\/images.b332411.com:42666\/VD\/SEA2\/4DTWC@.png",
                    "img_mobile_path": null,
                    "img_mobile_url": "https:\/\/images.b332411.com:42666\/VD\/SEA2\/4DTWC@.png",
                    "on_line": 1,
                    "is_hot": 0,
                    "sort": 1000,
                    "lang_list": ["vi"],
                    "lang_data_list": null,
                    "currency": null
            }
             *
             */

            // 将 新游戏插入数据库
            foreach ($res['data'] as $v){
                if(!in_array($v['game_type'], [3, 4, 6])) continue;

                // 判断同一个api_name 和 同一个 game_code 的游戏是否存在
                $gamelist = GameList::where('api_name',$api_code)->where('game_code',$v['game_code'])->first();

                if($gamelist){
                    $update_count++;
                    $gamelist->update([
                        'name' => $v['name'],
                        'en_name' => $v['en_name'],
                        'game_code' => $v['game_code'],
                        'game_type' => $v['game_type'],
                        //'img_path' => $v['img_path'],
                        //'img_url' => $v['img_url'],
                        'img_url' => $v['c_img_url'],
                        'client_type' => $v['client_type'],
                        //'platform' => $v['platform'],
                        'param_remark' => $v['extensions'] ? json_encode($v['extensions'],320)  : '',
                        'is_open' => $v['on_line']
                    ]);
                }else {
                    $create_count++;
                    GameList::create([
                        'api_name' => $api_code,
                        'name' => $v['name'],
                        'en_name' => $v['en_name'],
                        'game_code' => $v['game_code'],
                        'game_type' => $v['game_type'],
                        'img_url' => $v['c_img_url'],
                        'client_type' => $v['client_type'],
                        //'platform' => $v['platform'],
                        'param_remark' => $v['extensions'] ? json_encode($v['extensions'],320)  : '',
                        'is_open' => $v['on_line'],
                        'tags' => 'recommend,new,hot'
                    ]);
                }
            }

                /**
                GameList::updateOrCreate([
                    'api_name' => $v['api_code'],
                    'name' => $v['cn_name'],
                    'en_name' => $v['en_name'],
                    'game_code' => $v['game_code'],
                    'game_type' => $v['game_type'],
                    'img_path' => $v['img_path'],
                    'img_url' => $v['img_url'],
                    'client_type' => $v['client_type'],
                    'platform' => $v['platform'],
                    'param_remark' => $v['extensions'],
                    'is_open' => 1,
                    'tags' => 'new'
                ]);
                 */

        }catch (\Exception $e){
            return $this->failed(trans('res.api.common.operate_error').$e->getMessage());
        }

        // return $this->success([],'成功更新【'.$update_count.'】条游戏数据，成功新增【'.$create_count.'】条游戏数据');
         return $this->success([],trans('res.apis.msg.update_game_success',['update_count' => $update_count,'create_count' => $create_count]));
    }

    public function storeRule(){
        return [
            "api_id" => "required|numeric",
			"api_name" => "required",
			"api_title" => "required",
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
		];
    }

    public function storeHandle($data)
    {
        if(Arr::get($data,'lang_list')){
            $data['lang_list'] = json_encode($data['lang_list']);
        }
        return $data;
    }

    public function updateHandle($data)
    {
        return $this->storeHandle($data);
    }

    public function updateRule($id){
        return [
            "api_id" => "required|numeric",
			"api_name" => "required",
			"api_title" => "required",
			"is_open" => ["required",Rule::in(array_keys(config('platform.is_open')))],
		];
    }
}
