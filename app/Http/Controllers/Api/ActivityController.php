<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Models\ActivityApply;
use App\Models\CreditPayRecord;
use App\Models\Member;
use App\Models\Task;
use App\Services\CaptchaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActivityController extends  MemberBaseController {

    public function __construct()
    {
        if(Str::contains(\request()->url(),'credit'))
            app(IndexController::class)->checkCredit();

        if(Str::contains(\request()->url(),'levelup'))
            app(IndexController::class)->checkLevelUp();

        parent::__construct();
    }

    // http://laravel-iframe.test/api/act/list
    public function activity_list(){
        $data = Activity::forMember()->langs($this->getMemberLang())->get();

        $random = [];
        if($data->count()){
            foreach (range(1,10,1) as $item){
                $random[] = [
                    'name' => getFakeName(),
                    'title' => $data->random()->title
                ];
            }
        }

        return $this->success(['data' => [
            'activity' => $data,
            'random' => $random
        ]]);
    }

    // // http://laravel-iframe.test/api/act/
    public function activity_detail(Activity $activity){
        return $this->success(['data' => $activity]);
    }

    // http://laravel-iframe.test/api/act/apply
    public function activity_apply(Activity $activity,Request $request){

        if ($activity->apply_type != Activity::APPLY_TYPE_HALL) return $this->failed(trans('res.api.activity.no_need_apply'));

        // 获取活动需要填写的字段
        $apply_field = $activity->hall_field_array;
        array_push($apply_field, 'captcha','key');

        $params = $request->only($apply_field);

        $this->validateRequest(
            $params,
            [
                'member_name' => 'required|min:6|max:8|exists:members,name',
                'recharge_money' => 'integer|min:0|max:1000000',
                'bill_no' => 'max:16',
                'game_type' => Rule::in(array_keys(config('platform.game_type'))),
                'api_game_type' => 'exists:api_games,id',
                'captcha' => 'required',
                'key' => 'required',
            ],
            [
                'captcha.required' => trans('res.api.register.captcha_required'),
                'key.required' => trans('res.api.common.operate_error'),
            ],
            trans('res.option.activity_apply_field')
        );

        $member = Member::getMemberByName($params['member_name']);
        if($member->is_demo) return $this->failed(trans('res.api.common.demo_not_allowed'));

        // 验证码是否通过验证
        app(CaptchaService::class)->captchaCheckAPI($params['captcha'],$params['key']);

        // 删除验证码字段
        unset($params['captcha']);
        unset($params['key']);

        $data = [
            'member_id' => $member->id,
            'activity_id' => $activity->id
        ];

        // 判断会员的币种和活动是否统一
        if($member->lang != $activity->lang){
            return $this->failed(trans('res.api.activity.apply_fail'));
        }

        // 判断该会员今天是否申请过该活动
        if (ActivityApply::where($this->convertWhere($data))->whereDate('created_at', Carbon::today())->count() > 0) {
            return $this->failed(trans('res.api.activity.apply_repeat'));
        }

        $data['status'] = ActivityApply::STATUS_NOT_DEAL;
        $data['data_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        if (ActivityApply::create($data)) {
            return $this->success([], trans('res.api.activity.apply_success'));
        } else {
            return $this->failed(trans('res.api.activity.apply_fail'));
        }
    }

    // http://laravel-iframe.test/api/act/apply/config
    public function activity_apply_config(){
        return app(IndexController::class)->activity_apply_config();
    }

    // http://laravel-iframe.test/api/act/apply/result
    public function activity_apply_result(Request $request){
        return app(IndexController::class)->activity_apply_result($request);
    }

    public function wheel_setting(){
        $lang = getRequestLang();

        $pic = asset('web/images/wheel/'.$lang.'/turntable.png');

        // 获取所有的抽奖条件
        $awards = collect(trans('res.option.wheel_awards',[],$lang))
            ->where('type','<>',3)
            ->pluck('desc');

        // 中奖滚动信息
        $random = [];
        $today = today()->toDateString();
        foreach (range(1,30) as $item){
            $random[] = [
                'account' => getFakeName(),
                'prize' => $awards->random(),
                'created_at' => $today
            ];
        }

        return $this->success([
            'data' => [
                'desc' => $this->getWheelDesc(), // 活动描述
                'scroll' => $random, // 中奖信息
                'rule' => systemconfig('wheel_rule'), // 活动条款与规则
                'award' => $this->getWheelAwardPics(),
                'condition' => $this->getVisbleWheelSetting(),
                // 转盘图片地址
                'wheel' => $pic
            ]
        ]);
    }

    //  app(App\Http\Controllers\Api\ActivityController::class)->getVisbleWheelSetting()
    public function getVisbleWheelSetting(){
        $member = $this->getMember();
        $col = app(IndexController::class)->getWheelSetting($member->lang ?? getRequestLang());

        if(!$col) return [];

        return $col->transform(function($item){
            unset($item['awards']);
            unset($item['is_open']);
            return $item;
        });
    }

    // 根据会员账号查询 当日总存款，当日有效投注
    public function wheel_query(Request $request){
        $name = $request->get('name');

        return app(IndexController::class)->wheel_detail($name);
    }

    // 抽奖
    public function wheel_award(Request $request){
        $name = $request->get('name');

        return app(IndexController::class)->wheel_award($name);
    }

    // 获取最低的存款要求条件
    // app(App\Http\Controllers\Api\ActivityController::class)->getWheelDesc()
    public function getWheelDesc(){
        $condition = app(IndexController::class)->getWheelSetting()->first();

        if(!$condition) return '';

        return trans('res.api.wheel.wheel_desc',[
            'name' => systemconfig('site_name',getRequestLang()),
            'money' => $condition['deposit'],
            'times' => $condition['times'],
            'award' => collect(trans('res.option.wheel_awards'))->where('type',3)->implode('desc','，')
        ]);
    }

    // app(App\Http\Controllers\Api\ActivityController::class)->getWheelAwardPics()
    public function getWheelAwardPics(){
        return collect(trans('res.option.wheel_awards'))->transform(function($item){
            $item['pic'] = asset($item['pic']);
            return $item;
        });
    }

    // 借呗 规则
    public function credit_rule(){
        return $this->success([
            'data' => [
                'credit_detail' => systemconfig('credit_detail'),
                'credit_rule' => systemconfig('credit_rule'),
                'credit_xize' => systemconfig('credit_xize'),
                'credit_borrow' => systemconfig('credit_borrow'), // 借款说明
                'credit_lend' => systemconfig('credit_lend'), // 还款说明
            ]
        ]);
    }

    // 借还款记录
    public function credit_record(){
        $member = $this->getMember();
        $isApp = $member ? true : false;

        $page_size = 5;
        $data = CreditPayRecord::with('member:id,name,level')
            ->when($isApp,function($query) use ($member){
                $query->where('member_id',$member->id);
            })
            ->whereIn('status',[CreditPayRecord::STATUS_SUCCESS,CreditPayRecord::STATUS_RETURN])
            ->latest()->paginate($page_size);

        $data->getCollection()->transform(function ($item) use ($isApp){
            $item->member_name = $isApp ? $item->member->name : func_substr_replace($item->member->name);
            $item->status_text = $item->status_text;
            return $item;
        });

        return $this->success(['data' => $data]);
    }

    // 借款
    public function credit_borrow(Request $request){
        return app(IndexController::class)->creditBorrowPost($request);
    }

    // 还款
    public function credit_lend(Request $request){
        return app(IndexController::class)->creditLendPost($request);
    }

    // 查询欠款额度
    public function credit_check(Request $request){
        return app(IndexController::class)->creditCheckMember($request);
    }

    // 信用额度查询
    public function credit_search(Request $request){
        return app(IndexController::class)->creditSearchPost($request);
    }

    // 电子升级
    public function levelup_slot_setting(Request $request){
        return $this->success([
            'data' => [
                'levels' => $this->getLevelData(),
                'text' => [
                    'levelup_slot_activity' => systemconfig('levelup_slot_activity'),
                    'levelup_slot_example' => systemconfig('levelup_slot_example'),
                    'levelup_slot_level' => systemconfig('levelup_slot_level'),
                    'levelup_slot_month' => systemconfig('levelup_slot_month')
                ]
            ]
        ]);
    }

    public function getLevelData(){
        // 获取所有晋升等级数据
        $data = Task::systemLevel()->get();
        // 获取所有晋升等级
        $levels = Task::systemLevel()->distinct('level')->select('level')->orderBy('level','asc')->pluck('level');

        $total_level_money = 0;
        $level_data = [];
        foreach ($levels as $level){
            $level_money = $data->where('level',$level)->where('level_award_type',Task::LEVEL_TYPE_LEVEL)->first()->award_content['money'];
            $total_level_money = $total_level_money + $level_money;

            $level_data[] = [
                // 等级
                'level' => $level,
                // 打码
                'dama' => float_number($data->where('level',$level)->where('condition_money','>',0)->first()->condition_money),
                // 等级礼金
                'level_money' => $level_money,
                // 累计礼金
                'total_level_money' => $total_level_money,
                // 周俸禄
                'week_award' => money_unit($data->where('level',$level)->where('level_award_type',Task::LEVEL_TYPE_WEEK)->first()->award_content['money'] ?? ''),
                // 月俸禄
                'month_award' => money_unit($data->where('level',$level)->where('level_award_type',Task::LEVEL_TYPE_MONTH)->first()->award_content['money'] ?? ''),
                // 借呗额度
                'credit' => money_unit($data->where('level',$level)->where('level_award_type',Task::LEVEL_TYPE_BORROW)->first()->award_content['money'] ?? ''),
                'is_vip' => 1,
                'is_speed' => 1,
                'is_special' => 1,
                'is_fs' => 1
            ];
        }

        return $level_data;
    }

    public function levelup_search(Request $request){
        $name = $request->get('name');
        $member = Member::where('name',$request->get('name'))->where('is_demo',0)->where('status',Member::STATUS_ALLOW)->first();
        if(!$member || !$name) return $this->failed(trans('res.api.common.member_not_exist'));

        return $this->success([
            'data' => app(IndexController::class)->getMemberAwardInfo($member)
        ]);
    }

    public function levelup_live_setting(Request $request){
        return $this->success([
            'data' => [
                'levels' => $this->getLevelData(),
                'text' => [
                    'levelup_slot_activity' => systemconfig('levelup_live_activity'),
                    'levelup_slot_example' => systemconfig('levelup_live_example'),
                    'levelup_slot_level' => systemconfig('levelup_live_level'),
                    'levelup_slot_month' => systemconfig('levelup_live_month')
                ]
            ]
        ]);
    }


}
