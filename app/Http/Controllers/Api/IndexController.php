<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Activity;
use App\Models\ActivityApply;
use App\Models\Agent;
use App\Models\Api;
use App\Models\ApiGame;
use App\Models\AsideAdv;
use App\Models\Banner;
use App\Models\Base;
use App\Models\FsLevel;
use App\Models\GameHot;
use App\Models\QuickUrl;
use App\Models\GameList;
use App\Models\Member;
use App\Models\Sport;
use App\Models\SystemConfig;
use App\Models\SystemNotice;
use App\Services\ActivityService;
use App\Services\JzService;
use App\Services\SelfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

// 游客访问
class IndexController extends MemberBaseController
{
    // 获取 banner 数据
    public function getBannerListByGroups(Request $request)
    {

        $data = Banner::query()
            ->select(['title', 'url', 'groups', 'dimensions', 'weight','jump_link','is_new_window'])
            //->where('is_open',1)->where('groups',$request->get('group', ''))
            ->where($this->convertWhere([
                'is_open' => true,
                'groups' => $request->get('group', ''),
            ]))->langs()
            ->orderByDesc('weight')
            ->get();

        return $this->success(['data' => $data]);
    }

    // 获取首页游戏分类数据（手机）
    public function getMainGameList(){
        $json = SystemConfig::query()->getConfigValue('mobile_category_json',Base::LANG_COMMON);
        // 只返回开放的数据
        $category = collect(json_decode($json, 1))
            ->where('is_open','true')
            ->sortByDesc('weight');
            //->only(['title','icon']);

        $collection = ApiGame::query()->isMobile(1)->langs($this->getMemberLang())->displayFormatter();

            // $this->api_print($collection->toArray());

        $online_apis = Api::where('is_open',1)->cnLangs($this->getMemberLang())->pluck('api_name');

        $collection = $collection
            ->whereIn('api_name',$online_apis)
            ->whereIn('game_type_cn_text', $category->pluck('title'))
            ->groupBy(function($item,$key){
                return $item['game_type_cn_text'];
            });

        $result = [];

        foreach($category as $value){
            $temp = [
                'title' => $value['title'],
                'icon_before' => $value['icon_before'],
                'icon_after' => $value['icon_after'],
            ];
            if($value['title'] == '热门'){
                $temp['child'] = ApiGame::query()->isMobile(1)->langs($this->getMemberLang())->whereTags(['hot'])->whereIn('api_name',$online_apis)->displayFormatter()->toArray();
                $temp['title'] = trans('res.option.tag_type.hot');
            }else{
                $temp['child'] = $collection->get($value['title']);
                $temp['title'] = Arr::get(trans('res.option.game_type'),$value['game_type']);
            }
            array_push($result, $temp);
        }

        // 电脑首页排序
        $web = SystemConfig::query()->getConfigValue('web_category_json',Base::LANG_COMMON);
        $web_data = $web ? json_decode($web,1) : [];
        $web_data = collect($web_data)->sortByDesc('weight');

        return $this->success(['data' => $result,'web' => array_values($web_data->all())]);
    }

    public function getAllApiGames(){
        $data = ApiGame::select(['title','api_name','class_name','game_type','params','weight','is_open','tags','lang'])
            ->where('is_open',1)
            ->langs($this->getMemberLang())
            ->whereIn('api_name',Api::where('is_open',1)->langs($this->getMemberLang())->pluck('api_name'))
            ->orderBy('weight','desc')->get();

        return $this->success(['data' => $data]);
    }

    // 获取 system_config 数据
    public function getSystemConfig(Request $request){
        $group = $request->get('group','system');

        $lang = getRequestLang();
        if(!strlen($lang)) $lang = [Base::LANG_COMMON,Base::LANG_CN];
        else $lang = [$lang,Base::LANG_COMMON];

        // 默认是 system group
        $data = SystemConfig::query()->whereIn('lang',$lang)->getConfigGroup($group);

        $url = $request->get('url');
        if($group == 'system' && $url){
            $agent = Agent::where(function($query) use($url){
                $query->where('agent_pc_uri','like','%'.$url.'%')->orWhere('agent_wap_uri','like','%'.$url.'%');
            })->first();

            if($agent){
                $data['site_mobile'] = $agent->agent_wap_uri ?? $data['site_mobile'];
                $data['site_pc'] = $agent->agent_pc_uri ?? $data['site_pc'];
            }

        }

        return $this->success(['data' => $data]);
    }

	public function getSystemGlobal(Request $request){
        $lang = getRequestLang();
        if(!strlen($lang)) $lang = [Base::LANG_COMMON,Base::LANG_CN];
        else $lang = [$lang,Base::LANG_COMMON];

        // 默认是 system group
        //$data = SystemConfig::query()->whereIn('lang',$lang)->getConfigGroup($group);
		$configs = DB::table('system_configs')
					->whereIn('lang',$lang)
                    //->whereIn('id', [1, 2, 3])
                    ->get();

        /* $url = $request->get('url');
        if($group == 'system' && $url){
            $agent = Agent::where(function($query) use($url){
                $query->where('agent_pc_uri','like','%'.$url.'%')->orWhere('agent_wap_uri','like','%'.$url.'%');
            })->first();

            if($agent){
                $data['site_mobile'] = $agent->agent_wap_uri ?? $data['site_mobile'];
                $data['site_pc'] = $agent->agent_pc_uri ?? $data['site_pc'];
            }

        } */
		$data = [];
		foreach($configs AS $conf){
			$data[$conf->name] = $conf->value;
		}

		$url = $request->get('url');
        if($url){
            $agent = Agent::where(function($query) use($url){
                $query->where('agent_pc_uri','like','%'.$url.'%')->orWhere('agent_wap_uri','like','%'.$url.'%');
            })->first();

            if($agent){
                $data['site_mobile'] = $agent->agent_wap_uri ?? $data['site_mobile'];
                $data['site_pc'] = $agent->agent_pc_uri ?? $data['site_pc'];
            }

        }

        return $this->success(['data' => $data]);
    }

    // 获取 system_notice数据
    public function getSystemNotice(Request $request)
    {
        $data = SystemNotice::query()
            ->select(['title', 'content', 'url'])
            ->groupName(SystemNotice::GROUP_MAIN)
            ->langs()
            ->get();

        $alert = SystemNotice::query()
            ->select(['title', 'content', 'url']);
        if($request->get('isMobile')) $alert = $alert->groupName(SystemNotice::GROUP_MOBILE);
        else $alert = $alert->groupName(SystemNotice::GROUP_PC);

        $alert = $alert->langs()->get();
        return $this->success(['data' => $data,'alert' => $alert]);
    }

    public function getAppNotice(){
        $data = SystemNotice::query()->select(['title','text_content','url'])
            ->where($this->convertWhere([
                'is_open' => true,
                'is_app' => true
            ]))
            ->langs()
            ->orderByDesc('weight')->get();
        return $this->success(['data' => $data]);
    }

    // 获取首页的热门游戏

    // 获取活动类型
    public function getActivityType(){
        return $this->success(['data' => config('platform.activity_type')]);
    }

    // 获取活动数据 ,包括封面图片，id
    public function getActivityList()
    {
        $data = Activity::query()
            ->where('is_open', 1)
            ->isApp()
            ->where('cover_image','!=','')
            ->langs($this->getMemberLang())
            ->orderByDesc('weight')
            ->latest()
            ->get(['id','title','subtitle','cover_image','type','weight']);
        return $this->success(['data' => $data]);
    }

    // 获取 activity 详情
    public function getActivityDetail(Activity $activity,Request $request){
        //return $this->success(['data' => $activity->append('type_text')]);
        return app(ActivityService::class)->getActivityDetailHtml($activity);
    }

    // 获取所有电子游戏类型和封面图

    // 根据 游戏类型 获取电子游戏列表

    // 获取 about 数据
    public function getAbouts(Request $request)
    {
        $mod = About::query()->where('is_open', 1)->langs();

        if($request->get('id'))
            $mod = $mod->where('id',$request->get('id'));
        else
            $mod = $mod->where('type',$request->get('type',1));

        $data = $mod->orderByDesc('weight')->firstOrFail();
        /**
        $data = About::query()
            ->where('is_open', 1)
            // ->where('type',$request->get('type',1))
            ->when($request->get)
            ->langs()
            ->orderByDesc('weight')->firstOrFail();
         */
        return $this->success(['data' => $data]);
    }

    public function getAboutList(Request $request){
        $data = About::query()
            ->where('is_open', 1)
            ->langs()
            ->orderByDesc('weight')->get(['id','title','weight','type','lang']);
        return $this->success(['data' => $data]);
    }

    // 获取除了电子之外的游戏，如果Api表中关闭，那么都不显示
    public function getGameApiList(Request $request){
        if(!$gameType = $request->get('gameType')) return $this->failed('gameType parameters cannot be null');

        $isMobile = $request->get('isMobile',0);

        $lang = $this->getMemberLang();

        $data = DB::table('api_games')->select('api_games.*')->join('apis',function($join) {
            $join->on('apis.api_name','=','api_games.api_name')->where('apis.is_open',1);
        })->where('api_games.game_type',$gameType)
            ->when($isMobile,function($query) use ($isMobile){
                $query->whereIn('client_type',$isMobile ? [0,2] : [0,1]);
            })
            ->where('api_games.is_open',1)
            ->whereIn('api_games.lang',[ApiGame::LANG_COMMON,$lang])
            ->orderBy('api_games.weight','desc')
            ->latest()
            ->get()->transform(function($item) use($lang){
                $item->title = Str::contains($item->lang_json,$lang) ? Arr::get(json_decode($item->lang_json,1),$lang,$item->title) : $item->title;
                $api = Api::where('api_name', $item->api_name)->first();
                $item->icon_url = $api ? $api->icon_url : '';
                // $item->logo_url = $api ? $api->logo_url : '';
                return $item;
            });

        return $this->success(['data' => $data]);
    }

    // 获取 game_lists 中的游戏
    public function getGameLists(Request $request){
        if(!$gameType = $request->get('gameType')) return $this->failed('gameType参数不能为空');

        $tag = $request->get('tag','');
        $tag = ($tag && $tag != 'all')? [$tag] : [];

        if($gameType == 2){
            $mod = ApiGame::whereIn('api_name',Api::where('is_open',1)->cnLangs($this->getMemberLang())->pluck('api_name'))
                ->langs($this->getMemberLang())
                ->isMobile($request->get('isMobile',0))
                ->when($request->get('api_code'),function($query) use($request){
                    $query->where('api_name',$request->get('api_code'));
                })
                ->when($request->get('keyword',''),function($query) use($request){
                    $query->where('title','like','%'.$request->get('keyword').'%');
                })->where('game_type',$gameType)
                ->whereTags($tag)->where('is_open',1)
                ->orderBy('weight','desc');

            $data = $request->get('isMobile') ? $mod->get() : $mod->paginate($request->get('limit',15));
            return $this->success(['data' => $data]);
        }

        $mod = GameList::whereIn('api_name', Api::where('is_open',1)->cnLangs($this->getMemberLang())->pluck('api_name'))
            ->with('api:api_name,api_title')->when($request->get('api_code'),function($query) use($request){
                $query->where('api_name',$request->get('api_code'));
            })
            ->when($request->get('isMobile'),function($query) use($request) {
                $query->whichClientType($request->get('isMobile') ? 2 : 1);
            })
            ->when($request->get('keyword',''),function($query) use($request){
                $query->where('name','like','%'.$request->get('keyword').'%');
            })
            ->where('game_type',$gameType)
            ->whereTags($tag)
            ->where('is_open',1)->orderBy('weight','desc');
            //->paginate($request->get('limit',15));

        $data = $request->get('isMobile') ? $mod->get() : $mod->paginate($request->get('limit',15));

        return $this->success(['data' => $data]);
    }

    /*public function getLotteryList(Request $request){
        $lang = $this->getMemberLang();

        $api = Api::where('is_open',1)->cnLangs($lang)
            ->where('api_name','like','%TCG%')->first();

        if(!$api) return $this->failed('no lottery api');

        // $config = ['zh_cn' => 'TCGLOTTOCN'];

        // $groups = ['K3','11X5','SSC','FFC','PK10','3D','OTHERS'];
        $groups = trans('res.api.lottery',[],$lang);
        if(!is_array($groups) || !count($groups)) return $this->failed('error lottery list');

        $data = $request->all();
        $data['api_code'] = 'TCGLOTTOCN';

        $mod = GameList::where('api_name', $api->api_name)
            ->with('api:api_name,api_title')
            ->when($request->get('isMobile'),function($query) use($request) {
                $query->whichClientType($request->get('isMobile') ? 2 : 1);
            })
            ->when($request->get('keyword',''),function($query) use($request){
                $query->where('name','like','%'.$request->get('keyword').'%');
            })
            ->where('is_open',1)->orderBy('weight','desc')->get();

        // $res = $request->get('isMobile') ? $mod->get() : $mod->paginate($request->get('limit',15));
        $res = [];
        $ids = [];
        foreach ($groups as $key => $group){
            $temp = $mod->filter(function($item) use ($key){
                return Str::contains($item->game_code,$key);
            });

            if(!$temp->count()) continue;

            $res[$group] = array_values($temp->toArray());
            $ids = array_merge($ids,$temp->pluck('id')->toArray());
        }

        $res[$groups['OTHERS']] = array_values($mod->whereNotIn('id',$ids)->toArray());

        return $this->success(['data' => $res]);
    }*/
    public function getLotteryList(Request $request){
		$data = $request->all();
        //$lang = $this->getMemberLang();
        $lang = $data['lang'];
        $res = DB::table('game_lists')
            ->select('game_lists.*')
            ->leftJoin('apis',function($join) use ($lang){
                $join->on('game_lists.api_name','=','apis.api_name');
            })->where('apis.is_open',1)
			->where('game_lists.is_open',1)
			->where('game_lists.game_type',4)
            //->where('apis.lang','like',substr($member->lang, 0,2).'%')
			->where('apis.lang',$lang)
            ->orderBy('apis.weight','desc')
            ->orderBy('apis.created_at','desc')
            ->get()->toArray();

        foreach ($res as $key => $group){
			$group->api = array('api_name'=>$group->api_name,'api_title'=>$group->name);
			$group->full_image_url = $group->img_url;
			$res[$key] = $group;

		}
        $ress['全部'] = $res;

        return $this->success(['data' => $ress]);
    }

    public function getSlotLogoList(Request $request){
        if(!$gameType = $request->get('gameType')) return $this->failed('gameType parameters cannot be null');

        $data = ApiGame::where('game_type',$gameType)->langs($this->getMemberLang())->where('is_open',1)->pluck($request->get('isMobile') ? 'mobile_pic':'web_pic','api_name');
        return $this->success(['data' => $data]);
    }

    // 手机端

    // 获取首页所有游戏列表（包括游戏地址，游戏图标，游戏名称），按游戏种类分类，
    public function game_type(Request $request){
        // 获取系统彩的游戏名称
        $sys_cp = Api::where('api_name','LY')->first();

        $data = collect(trans('res.option.game_type'))->map(function($item, $key) use ($sys_cp){
            $data = [];
            $data['key'] = $key;
            $data['value'] = ($key == 99 && $sys_cp && $sys_cp->api_title) ? $sys_cp->api_title : $item;
            $data['isLobbyPage'] = $key == 3 || $key == 6;
            return $data;
        });
        return $this->success(['data' => array_values($data->toArray())]);
    }

    public function getAsideList(){
        $adv_ids = AsideAdv::query()->langs()->where('is_open',1)->pluck('id','group')->toArray();

        $advs = AsideAdv::query()
            ->select(['vertical','horizontal','group','url_id','effect'])
            ->with('advs:pic_url,pic_height,pic_width,group')
            ->whereIn('id',array_values($adv_ids))->get();

        $advs->transform(function($item){
            $item->full_url = $item->url_id ? $item->quickurl->full_url : '';
            return $item;
        });

        return $this->success(['data' => $advs],'');
        //return $this->success([],'');
    }

    public function getCommonLink(){
        $data = QuickUrl::opened()->get()->makeHidden(['created_at','updated_at','is_open']);
        return $this->success(['data' => $data]);
    }

    // 首页热门游戏的列表
    public function getMainPageHotSlotGame(){
        $apis = ['FMG','BBIN','PT','AG','JDB','HB','ISB','CQ9','KY'];

        $apilists = Api::whereIn('api_name',$apis)->get(['api_title','api_name']);

        $sql = '(SELECT a.* FROM game_lists AS a WHERE (SELECT COUNT(*) FROM game_lists AS b WHERE b.api_name = a.api_name AND b.id >= a.id ) < 11 AND a.tags LIKE "%new%" ORDER BY a.api_name ASC,a.weight desc) cc';
        // $data = \DB::select('SELECT a.* FROM game_lists AS a WHERE (SELECT COUNT(*) FROM game_lists AS b WHERE b.api_name = a.api_name AND b.id >= a.id ) < 11 AND a.tags LIKE "%new%" ORDER BY a.api_name ASC,a.weight desc');
        $data = \DB::table(\DB::raw($sql))->get();
        /*
        ->transform(function($item){
            $item->img_path = getUrlByDomain($item->img_path);
            return $item;
        }); */
        // $data = collect($data);

        // $data = $data->whereIn('api_name',$apis)->groupBy('api_name');
        $return = $apilists->map(function($item) use ($data){
            $item->list = $data->where('api_name',$item->api_name);
            return $item;
        });

        return $this->success(['data' => $return]);
    }

    // app(App\Http\Controllers\Api\IndexController::class)->lotterylist()
    public function lotterylist(){
        return $this->lotteryMethod('gamelist');
    }

    public function lotteryhot(){
        return $this->lotteryMethod('hotlist',\request()->only('count'));
    }

    public function lotteryMethod($method,$params = []){
        $json = app(JzService::class)->getLotteryApiResult($method,$params);
        if(!isJson($json)) return $this->failed('error response');

        $data = json_decode($json,1);
        if(Arr::get($data,'code') != '200') return $this->failed($data['msg']);

        return $this->success(['data' => $data['data'],'url' => app(JzService::class)->getApiDomain()]);
    }

    // 对应首页的三个活动
    public function vip1_main_advertise(){
        $data = [];

        foreach (['#/Promotion','#/Lobby/Game','#/Lobby/Live'] as $key => $item){
            $index = $key + 1;

            $data[] = [
                'title' => trans('res.api.index.main_advertise_title_'.$index),
                'subtitle' => trans('res.api.index.main_advertise_sub_title_'.$index),
                'pic' => env('APP_URL').'/images/main_advertise/image_'.$index.'.png',
                'url' => \systemconfig('site_pc').'/'.$item
            ];
        }

        return $this->success(['data' => $data]);
    }

    // 对应首页三个热门游戏
//    public function vip1_main_hotgame(){
//        // 1.斗鸡 2.电子 3.视讯
//        // $apigames = [24,51,25];
//        $apigames = ['AG','MW','OG'];
//        $data = [];
//
//        foreach ($apigames as $key => $apigame){
//            $index = $key + 1;
//
//            $data[] = [
//                'subtitle' => trans('res.api.index.hotgame_sub_title_'.$index),
//                'detail' => ApiGame::where('is_open',1)->where('api_name','like',$apigame.'%')->langs($this->getMemberLang())->first(),
//                'img_normal' => env('APP_URL').'/images/hotgame/pic_hover_'.$index.'.png',
//                'img_hover' => env('APP_URL').'/images/hotgame/pic_normal_'.$index.'.png',
//            ];
//        }
//
//        return $this->success(['data' => $data]);
//    }

    public function vip1_main_hotgame(Request $request)
    {
        $type = $request->get('type') ?: 1;
        $lang = getRequestLang();
        //$lang = $lang == 'zh_hk' ? 'zh_cn' :$lang;

        $data = DB::table('game_hots')->select('game_hots.*')->join('apis',function($join) {
            $join->on('game_hots.api_name','=','apis.api_name')->where('apis.is_open',1);
        })->where('game_hots.is_online',1)->where('game_hots.type', $type)->where('game_hots.lang', $lang)->orderBy('game_hots.sort')->get();
        //return $data;

//        $data->transform(function($item) use($lang){
//            return $item;
//        });

        return $this->success(['data' => $data]);
    }

    public function vip1_sports(){
        $data = Sport::where('is_open',1)->latest()->orderByDesc('weight')->get();

        $lang = getRequestLang();

        $data->transform(function($item) use($lang){
            if(!Str::startsWith($lang,'zh')){
                $item->home_team_name = $item->home_team_name_en;
                $item->visiting_team_name = $item->visiting_team_name_en;
                $item->match_cup = $item->match_cup_en;
            }
            return $item;
        });

        return $this->success(['data' => $data]);
    }

    public function vip1_languages(){
        $default = \systemconfig('vip1_lang_default');
        return $this->success([
            'data' => [
                'default' => $default,
                'list' => get_language_fields_array()
            ]
        ]);
    }
}
