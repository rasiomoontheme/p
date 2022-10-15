<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\InvalidRequestException;
use App\Models\Activity;
use App\Models\ActivityApply;
use App\Models\ApiGame;
use App\Models\Base;
use App\Models\BlackIp;
use App\Models\CreditPayRecord;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\MemberMoneyLog;
use App\Models\MemberWheel;
use App\Models\Recharge;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexController extends WebBaseController
{
    public function __construct()
    {
        if (Str::contains(\request()->url(), 'credit_pay'))
            $this->checkCredit();

        parent::__construct();
    }

    // http://laravel-iframe.test/#/Register?i=awLE80B
    public function index(Request $request)
    {
        // return redirect('http://127.0.0.1:8080');
        return redirect($this->isMobile ? systemconfig('site_mobile') : systemconfig('site_pc'));
    }

    // 活动大厅
    public function activity_list()
    {
        return $this->index(request());

        $data = Activity::forMember()->get();

        return view($this->getViewName('activity_list'), compact('data'));
    }

    // 会员活动申请相关,同一活动，一天只能申请一次
    public function activity_apply(Activity $activity, Request $request)
    {

        if ($activity->apply_type != Activity::APPLY_TYPE_HALL) return $this->failed('该活动不需要申请');

        // 获取活动需要填写的字段
        $apply_field = $activity->hall_field_array;
        array_push($apply_field, 'captcha');
        //$apply_field = array_keys(config('platform.activity_apply_field'));

        $params = $request->only($apply_field);
        // dd($params);

        $this->validateRequest(
            $params,
            [
                'member_name' => 'required|min:6|max:8|exists:members,name',
                'recharge_money' => 'integer|min:0|max:1000000',
                'bill_no' => 'max:16',
                'game_type' => Rule::in(array_keys(config('platform.game_type'))),
                'api_game_type' => 'exists:api_games,id',
                'captcha' => 'required|captcha'
            ],
            [
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '请输入正确的验证码'
            ],
            config('platform.activity_apply_field')
        );

        $member = Member::getMemberByName($params['member_name']);
        if ($member->is_demo) return $this->failed('试玩账号无法申请活动');

        // 删除验证码字段
        unset($params['captcha']);

        $data = [
            'member_id' => $member->id,
            'activity_id' => $activity->id
        ];

        // 判断该会员今天是否申请过该活动
        if (ActivityApply::where($this->convertWhere($data))->whereDate('created_at', Carbon::today())->count() > 0) {
            return $this->failed('您今日已经申请过该活动，请勿重复申请');
        }

        $data['status'] = ActivityApply::STATUS_NOT_DEAL;
        $data['data_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        // $this->api_print($apply_field);

        if (ActivityApply::create($data)) {
            return $this->success([], '申请成功，请等待处理结果');
        } else {
            return $this->failed('申请失败，请重试');
        }
    }

    public function activity_apply_form(Activity $activity)
    {
        $html = '<form enctype="multipart/form-data" id="form1" onsubmit="return false" action="#" method="post">';
        $html .= '<div id="vote_form"><div class="form_item"><div class="form_label">申请主题</div><div class="form_html title">' . $activity->title . '</div></div>';

        foreach ($activity->hall_field_array as $item) {
            $html .= '<div class="form_item form_input"><div class="form_label">' . config('platform.activity_apply_field')[$item] . '</div><div class="form_html">';

            if ($item == 'game_type') {
                $html .= '<select name="game_type" id="game_type">';
                foreach (config('platform.game_type') as $k => $v)
                    $html .= '<option value="' . $k . '">' . $v . '</option>';

                $html .= '</select>';
            } else if ($item == 'api_game_type') {
                $html .= '<select name="game_type" id="game_type">';
                foreach (ApiGame::where('is_open', 1)->get()->pluck('api_game_type_text', 'id') as $k => $v)
                    $html .= '<option value="' . $k . '">' . $v . '</option>';

                $html .= '</select>';
            } else if (in_array($item, ['member_name', 'bill_no', 'recharge_money'])) {
                $html .= '<input ';
                if ($item == 'recharge_money') $html .= 'type="number"';
                else $html .= 'type="text"';
                $html .= ' name="' . $item . '"value="" placeholder="请输入' . config('platform.activity_apply_field')[$item] . '"/>';
            }

            $html .= '</div></div>';

        }

        // 验证码
        $html .= '<div class="form_item form_input"><div class="form_label">验证码</div><div class="form_html"><input type="text" type="text" name="captcha" style="width: 80px" placeholder="请输入验证码"><img src="' . captcha_src('hall') . '" class="pull-right" id="captcha" style="cursor: pointer;"onclick="this.src=this.src+\'?d=\'+Math.random();" title="点击刷新" alt="captcha"></div></div>';

        // 提交按钮
        $html .= '<div class="form_item"><div class="form_label">&nbsp;</div><div class="form_html"><button type="button" id="sub" class="btn-sub" data-id="' . $activity->id . '" style="width: 222px"></button></div></div></div>';
        $html .= '</form>';
        return $html;
    }

    public function activity_detail(Activity $activity)
    {

        return view($this->getViewName('activity_detail'), compact('activity'));
    }

    public function activity_apply_config()
    {
        return $this->success([
            'data' => [
                'game_type_array' => config('platform.game_type'),
                'api_game_type_type' => ApiGame::where('is_open', 1)->get()->pluck('api_game_type_text', 'id')
            ]
        ]);
    }

    // 查询审核结果 member_name
    public function activity_apply_result(Request $request)
    {
        $params = $request->only('member_name', 'activity_id');

        $this->validateRequest($params, [
            'member_name' => 'required|exists:members,name',
            //'activity_id' => 'exists:activities,id'
        ], [], [
            'member_name' => '会员名称',
            'activity_id' => '活动信息'
        ]);

        $params = array_filter_null($params);

        if (array_key_exists('activity_id', $params)) {
            $activity = Activity::find($params['activity_id']);
        }

        $member = Member::getMemberByName($params['member_name']);
        if ($member->is_demo) return $this->failed('试玩账号无法查询活动信息');

        $limit = 5;

        $data = ActivityApply::with(['member:id,name', 'activity:id,title'])
            ->where('member_id', $member->id)
            ->when(array_key_exists('activity_id', $params), function ($query) use ($params) {
                return $query->where('activity_id', $params['activity_id']);
            })->paginate($limit);

        return $this->success(['data' => $data]);
    }

    public function wheel()
    {
        if (!systemconfig('activity_wheel_is_open', Base::LANG_COMMON)) exit('活动未开启');

        $setting = $this->getWheelSetting(getRequestLang());
        return view('web.wheel', compact('setting'));
    }

    public function getWheelSetting($lang = Base::LANG_CN)
    {
        return collect(Arr::get(json_decode(systemconfig('wheels_setting_json', Base::LANG_COMMON), 1), $lang))->where('is_open', 1)->sortBy('deposit');
    }

    // laravel-iframe.test/wheel/scrollMessages
    public function scroll_messages()
    {
        $json = '[{"account":"cf0****","prize":"8\u5143\u7b79\u7801"},{"account":"aa1****","prize":"8\u5143\u7b79\u7801"},{"account":"Z56****","prize":"8\u5143\u7b79\u7801"},{"account":"zz0****","prize":"8\u5143\u7b79\u7801"},{"account":"wf2****","prize":"8\u5143\u7b79\u7801"},{"account":"hsy****","prize":"8\u5143\u7b79\u7801"},{"account":"a54****","prize":"8\u5143\u7b79\u7801"},{"account":"qq4****","prize":"8\u5143\u7b79\u7801"},{"account":"cf1****","prize":"8\u5143\u7b79\u7801"},{"account":"a31****","prize":"8\u5143\u7b79\u7801"},{"account":"yan****","prize":"8\u5143\u7b79\u7801"},{"account":"liu****","prize":"18\u5143\u7b79\u7801"},{"account":"yl1****","prize":"8\u5143\u7b79\u7801"},{"account":"a15****","prize":"8\u5143\u7b79\u7801"},{"account":"h31****","prize":"8\u5143\u7b79\u7801"},{"account":"W1A****","prize":"8\u5143\u7b79\u7801"},{"account":"dw5****","prize":"8\u5143\u7b79\u7801"},{"account":"zjw****","prize":"8\u5143\u7b79\u7801"},{"account":"qq5****","prize":"8\u5143\u7b79\u7801"},{"account":"h15****","prize":"8\u5143\u7b79\u7801"},{"account":"dq2****","prize":"8\u5143\u7b79\u7801"},{"account":"aa0****","prize":"8\u5143\u7b79\u7801"},{"account":"aaa****","prize":"8\u5143\u7b79\u7801"},{"account":"XXP****","prize":"8\u5143\u7b79\u7801"},{"account":"a99****","prize":"8\u5143\u7b79\u7801"},{"account":"SB8****","prize":"8\u5143\u7b79\u7801"},{"account":"cmx****","prize":"100\u900120\u4f18\u60e0\u5238"},{"account":"cyy****","prize":"8\u5143\u7b79\u7801"},{"account":"Za3****","prize":"8\u5143\u7b79\u7801"},{"account":"ccs****","prize":"8\u5143\u7b79\u7801"}]';

        $data = json_decode($json, 1);

        foreach ($data as $key => $item) {
            $data[$key]['created_at'] = date('Y-m-d');
        }

        return $this->success([
            'data' => $data
        ]);
    }

    public function wheel_detail($name)
    {
        // 获取会员信息
        $member = Member::where('name', $name)->first();

        if (!$member) return $this->failed('请输入有效的会员名', 200);

        if ($member->is_demo) return $this->failed('试玩账号无法参与该活动');

        // 当天产生的转盘次数在第二天两点后生效
        $recordhDate = Carbon::now()->hour > 2 ? Carbon::yesterday() : Carbon::now()->subDay(2)->toDateString();

        // 判断会员昨天或前天（美东时间）存款和流水是否达标
        $save_amount = Recharge::where('member_id', $member->id)
            // ->whereDate('created_at', Carbon::today())
            ->whereDate('created_at', $recordhDate)
            ->where('status', Recharge::STATUS_SUCCESS)->sum('money');

        $bet_amount = GameRecord::where('member_id', $member->id)
            //->whereDate('created_at', Carbon::today())
            //->whereDate('created_at',$recordhDate)
            ->whereDate('betTime', $recordhDate)
            ->where('status', '!=', 'X')
            ->sum('validBetAmount');

        $searchDate = [new Carbon('last tuesday'), Carbon::today()];

        $total_times = $this->getWheelTimesAndMaxDeposit($member, $searchDate)['total_time'];

        // 2. 查询已抽奖次数
        // 查询抽奖历史记录
        $record = MemberWheel::where('member_id', $member->id)->where('created_at', '>', $searchDate[1])->get();

        $total_times = $total_times - $record->count() > 0 ? $total_times : 0;
        $total_times = $total_times > 3 ? 3 : $total_times;

        return $this->success(['data' => [
            'bet_amount' => $bet_amount,
            'save_amount' => $save_amount, // 当日总存款
            'cjcs' => $total_times,
            'record' => $record,
            'liebiao' => $this->getRecordHtml($record),
            //'max_v1' => "5000",
            //'max_v2' => "15000",
        ]]);
    }

    // 抽奖
    public function wheel_award($name)
    {
        // 根据当前的充值金额，获取可以抽奖的奖项
        // $key = collect(array_keys(config('platform.wheel_awards')))->random();

        // $award = config('platform.wheel_awards')[$key];
        if (!systemconfig('activity_wheel_is_open', Base::LANG_COMMON)) return $this->failed('该活动未开启');

        $member = Member::where('name', $name)->first();
        if ($member->is_demo) return $this->failed('试玩账号无法参与该活动');

        $searchDate = [new Carbon('last tuesday'), Carbon::today()];

        // 最近一周可抽奖次数
        $res = $this->getWheelTimesAndMaxDeposit($member, $searchDate);
        $times = $res['total_time'];
        $max_deposit = $res['max_deposit'];

        // 根据最大充值金额，获取奖励
        $key = $this->getAwardIdByDeposit($max_deposit);
        // $award = config('platform.wheel_awards')[$key];
        $award = Arr::get(trans('res.option.wheel_awards', [], $member->lang), $key);

        // 最近一周已抽奖次数
        $count = MemberWheel::where('member_id', $member->id)->where('created_at', '>', $searchDate[1])->count();

        if ($times - $count < 1) return $this->failed('可抽奖次数不够');

        // 创建奖励领取记录
        try {
            DB::transaction(function () use ($member, $award, $key) {
                $memberwheel = MemberWheel::create([
                    'member_id' => $member->id,
                    'award_id' => $key,
                    'award_desc' => $award['desc'],
                    'status' => $award['type'] == 1 ? MemberWheel::STATUS_SENDING : MemberWheel::STATUS_NOT_SEND
                ]);

                if ($award['type'] == 1) {
                    $money_type = systemconfig('activity_money_type', Base::LANG_COMMON) ?? 'fs_money';
                    $money_before = $member->$money_type;

                    $money = intval($award['desc']);

                    $member->increment($money_type, $money);

                    MemberMoneyLog::create([
                        'member_id' => $member->id,
                        'money' => $money,
                        'money_before' => $money_before,
                        'money_after' => $member->$money_type,
                        'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                        'operate_type' => MemberMoneyLog::OPERATE_TYPE_WHEEL,
                        'money_type' => $money_type,
                        'description' => '会员【' . $member->name . '】在幸运转盘中获得现金【' . $money . '元】'
                    ]);
                }
            });
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failed('错误：' . $e->getMessage());
        }

        return $this->success(['data' => [
            'prize' => $award['desc'],
            'position' => $key
        ]]);
    }

    public function getAwardIdByDeposit($deposit)
    {
        $award_list = $this->getWheelSetting(getRequestLang());;

        $key = 12;
        $award_ids = [];
        foreach ($award_list as $item) {
            if ($item['deposit'] < $deposit && $item['awards']) {
                $award_ids = array_merge($award_ids, explode(',', $item['awards']));
            }
        }

        try {
            $key = array_rand($award_ids);
            $key = $award_ids[$key];
            $key = $key < 1 || $key > 12 ? 12 : $key;
        } catch (\Exception $e) {
            $key = 12;
        }
        return $key;
    }

    public function getWheelTimesAndMaxDeposit(Member $member, $searchDate)
    {
        // 统计这几天的金额信息
        $deposit_group = DB::table('recharges')->where('member_id', $member->id)
            ->whereBetween('created_at', $searchDate)
            ->where('status', Recharge::STATUS_SUCCESS)
            ->selectRaw('DATE(created_at) as date,SUM(money) as deposit_money,status')
            ->groupBy('date', 'status')->pluck('deposit_money', 'date')->toArray();

        $bet_group = DB::table('game_records')->where('member_id', $member->id)
            //->selectRaw('DATE(created_at) as date,SUM(validBetAmount) as valid_money')
            ->selectRaw('DATE(betTime) as date,SUM(validBetAmount) as valid_money')
            ->whereBetween('created_at', $searchDate)->groupBy('date')
            ->pluck('valid_money', 'date')->toArray();

        // 获取日期集合
        $dates = array_merge(array_keys($deposit_group), array_keys($bet_group));

        // 抽奖条件
        /**
         * $condition = collect([
         * ['deposit' => 500,'valid_num' => 3,'times' => 1],
         * ['deposit' => 1000,'valid_num' => 3,'times' => 1],
         * ['deposit' => 1500,'valid_num' => 3,'times' => 1]
         * ])->sortBy('deposit');
         **/
        $condition = $this->getWheelSetting($member->lang);

        // 查询今日可抽奖次数
        // 1. 查询所有可抽奖次数
        $times = [];
        $max_deposit = 0;
        foreach ($dates as $item) {
            if (!array_key_exists($item, $deposit_group) || !array_key_exists($item, $bet_group)) continue;

            foreach ($condition as $v) {
                if ($deposit_group[$item] > $v['deposit'] && $bet_group[$item] > $v['deposit'] * $v['valid_num']) {
                    $max_deposit = $max_deposit > $deposit_group[$item] ? $max_deposit : $deposit_group[$item];
                    $times[$item] = $v['times'];
                } else {
                    break;
                }
            }
        }

        $total_times = collect($times)->sum();

        return [
            'total_time' => $total_times >= 1 ? $total_times : 0,
            'max_deposit' => $max_deposit
        ];
    }

    public function getRecordHtml($record)
    {
        $html = '<table class="zjjl-table table"><thead><tr><th width="40%">Phần thưởng</th><th width="30%">Trạng thái</th><th width="30%">Thời gian nhận</th></tr></thead><tbody>';

        foreach ($record as $item) {
            $html .= '<tr><td>' . $item->award_desc . '</td><td>' . $item->status_text . '</td><td>' . $item->created_at . '</td></tr>';
        }

        $html .= '</tbody></table>';
        return $html;
    }

    // 电子升级模式
    public function slotLevelUp()
    {
        // 获取所有晋升等级数据
        $data = Task::systemLevel()->get();
        // 获取所有晋升等级
        $levels = Task::systemLevel()->distinct('level')->select('level')->orderBy('level', 'asc')->pluck('level');
        $info = [];
        return view('web.slot_levelup', compact('data', 'levels', 'info'));
    }

    // 电子升级模式 搜索
    public function slotLevelSearch(Request $request)
    {
        // 获取所有晋升等级数据
        $data = Task::systemLevel()->get();
        // 获取所有晋升等级
        $levels = Task::systemLevel()->distinct('level')->select('level')->orderBy('level', 'asc')->pluck('level');

        $name = $request->get('name');
        $member = null;
        $info = [];
        $errmsg = '';
        if ($name) {
            $member = Member::where('name', $request->get('name'))->where('is_demo', 0)->where('status', Member::STATUS_ALLOW)->first();

            $info = $this->getMemberAwardInfo($member);
        }

        return view('web.slot_levelup', compact('data', 'levels', 'member', 'info', 'errmsg', 'name'));
    }

    public function getMemberAwardInfo($member)
    {
        $member_id = $member ? $member->id : 0;
        $member_level = $member ? $member->level : 0;

        // 领取周俸禄和 等级礼金 记录
        $list = MemberMoneyLog::where('member_id', $member_id)->whereIn('operate_type', [
            MemberMoneyLog::OPERATE_TYPE_WEEKE_AWARD, MemberMoneyLog::OPERATE_TYPE_MONTH_AWARD, MemberMoneyLog::OPERATE_TYPE_LEVELUP
        ])->get(['created_at', 'money', 'operate_type', 'money_type']);

        $next_level = Task::systemLevelAndType(intval($member_level) + 1, Task::LEVEL_TYPE_LEVEL)->first();

        $total_bet = app(GameRecord::class)->getMemberTotalValidBet($member_id);

        $return = [
            'name' => $member->name ?? '',
            'level' => $member_level,
            'total_bet' => $total_bet,
            'level_award' => $member_level ? \Arr::get(Task::systemLevelAndType($member_level, Task::LEVEL_TYPE_LEVEL)->first()->award_content, 'money') : 0,
            'week_award' => $member_level ? \Arr::get(Task::systemLevelAndType($member_level, Task::LEVEL_TYPE_WEEK)->first()->award_content, 'money') : 0,
            'month_award' => $member_level ? \Arr::get(Task::systemLevelAndType($member_level, Task::LEVEL_TYPE_MONTH)->first()->award_content, 'money') : 0,
            'remain_bet' => $next_level ? intval($next_level->condition_money) - intval($total_bet) : 0,
            'list' => $list
        ];

        return $return;
    }

    public function liveLevelUp(Request $request)
    {
        // 获取所有晋升等级数据
        $data = Task::systemLevel()->get();
        // 获取所有晋升等级
        $levels = Task::systemLevel()->distinct('level')->select('level')->orderBy('level', 'asc')->pluck('level');

        $name = $request->get('name');
        $member = null;
        $info = [];
        if (\request('sou') == 'wei' && $name) {
            $member = Member::where('name', $request->get('name'))->where('is_demo', 0)->where('status', Member::STATUS_ALLOW)->first();

            // if($member) $info = $this->getMemberAwardInfo($member);
            $info = $this->getMemberAwardInfo($member);
        }
        // if(\request('sou') == 'wei') $member = 1;
        return view('web.live_levelup', compact('data', 'levels', 'member', 'info', 'name'));
    }

    // 判断 借呗是否开启
    public function checkCredit()
    {
        if (!systemconfig('activity_jiebei_enable', Base::LANG_COMMON))
            throw new InvalidRequestException(trans('res.api.credit_pay.not_open'));
    }

    public function checkLevelUp()
    {
        if (!systemconfig('activity_shengji_enable', Base::LANG_COMMON))
            throw new InvalidRequestException(trans('res.api.redbag.not_open'));
    }

    // 借呗
    public function creditPay()
    {
        return view($this->getViewName('credit_pay.index'));
    }

    public function creditRecord()
    {
        $page_size = 5;
        $records = CreditPayRecord::whereIn('status', [CreditPayRecord::STATUS_SUCCESS, CreditPayRecord::STATUS_RETURN])
            ->latest()->paginate($page_size);
        $page_count = $records->lastPage();
        $row_count = $records->total();
        return view($this->getViewName('credit_pay.record'), compact('page_size', 'page_count', 'row_count'));
    }

    // 借/还款记录
    public function creditRecordList(Request $request)
    {
        $limit = $request->get('limit', 5);

        $records = CreditPayRecord::with('member:id,name,level')
            ->whereIn('status', [CreditPayRecord::STATUS_SUCCESS, CreditPayRecord::STATUS_RETURN])
            ->latest()->paginate($limit);

        $count = $records->total();
        $page = $records->lastPage();

        /**
         * $records = $records->getCollection()->transform(function($item){
         * $item->status_text = \Arr::get(config('platform.credit_status'),$item->status);
         * return $item;
         * });
         **/

        $html = '';
        foreach ($records as $item) {
            $html .= "<tr>";
            // 会员账号
            $html .= '<td style="background:#fff;">' . func_substr_replace($item->member->name) . '</td>';
            $html .= '<td class="co_1" style="background:#fff;">' . $item->member->level . '级</td>';
            $html .= '<td style="background:#fff;">￥' . intval($item->money) . '元</td>';
            $html .= '<td class="co_2" style="background:#fff;' . ($item->status == CreditPayRecord::STATUS_SUCCESS ? 'color:red;' : 'color:green;') . '">' . \Arr::get(config('platform.credit_status'), $item->status) . '</td>';
            $html .= "</tr>";
        }

        return [
            'list' => $html,
            'page_count' => $page,
            'page_size' => $limit,
            'row_count' => $count
        ];
    }

    public function creditBorrow()
    {
        return view($this->getViewName('credit_pay.borrow'));
    }

    // 借款操作
    public function creditBorrowPost(Request $request)
    {
        $data = $request->all();

        $this->validateRequest($data, [
            'name' => 'required',
            'realname' => 'required',
            'money' => 'required|min:0|numeric',
            'days' => 'required|integer|min:0|max:' . CreditPayRecord::CREDIT_PAY_DAYS
        ], [], [
            'name' => '会员账号',
            'realname' => '会员姓名',
            'money' => '借款金额',
            'days' => '借款天数'
        ]);

        $member = Member::where('name', $data['name'])->where('status', Member::STATUS_ALLOW)->first();

        if (!$member) return $this->failed(trans('res.api.credit_pay.member_not_exist_or_forbidden'));

        if ($member->is_demo) return $this->failed(trans('res.api.common.demo_not_allowed'));

        if ($member->realname && $member->realname != $data['realname']) return $this->failed(trans('res.api.credit_pay.member_info_error'));

        if ($member->used_credit > 0) return $this->failed(trans('res.api.credit_pay.user_credit_remained'));

        if ($member->total_credit < $data['money']) return $this->failed(trans('res.api.credit_pay.borrow_max', ['money' => $member->total_credit]));

        CreditPayRecord::create([
            'member_id' => $member->id,
            'money' => $data['money'],
            'type' => CreditPayRecord::TYPE_BORROW,
            'borrow_day' => $data['days']
        ]);

        return $this->success([], trans('res.api.credit_pay.borrow_success'));
    }

    public function creditLend()
    {
        return view($this->getViewName('credit_pay.lend'));
    }

    // 还款操作
    public function creditLendPost(Request $request)
    {
        $data = $request->all();

        $this->validateRequest($data, [
            'name' => 'required',
            'realname' => 'required',
            'money' => 'required|min:0|numeric'
        ], [], $this->getLangAttribute('member'));

        $member = Member::where('name', $data['name'])->where('status', Member::STATUS_ALLOW)->first();

        if (!$member) return $this->failed(trans('res.api.credit_pay.member_not_exist_or_forbidden'));

        if ($member->is_demo) return $this->failed(trans('res.api.common.demo_not_allowed'));

        // 判断是否需要进行还款操作
        if (bccomp($member->used_credit, $data['money'])) return $this->failed(trans('res.api.credit_pay.lend_total'));

        if ($member->money < $member->used_credit) return $this->failed(trans('res.api.credit_pay.money_not_enough'));

        // 找出会员最近一条未还款的借款记录
        $last_record = CreditPayRecord::where('member_id', $member->id)->where('type', CreditPayRecord::TYPE_BORROW)
            ->where('status', CreditPayRecord::STATUS_SUCCESS)->where('is_return', 0)->latest()->first();

        try {
            DB::transaction(function () use ($member, $last_record) {
                // 创建还款成功记录
                $record = CreditPayRecord::create([
                    'member_id' => $member->id,
                    'type' => CreditPayRecord::TYPE_LEND,
                    'status' => CreditPayRecord::STATUS_RETURN,
                    'money' => $member->used_credit
                ]);

                if ($last_record) {
                    $last_record->update([
                        'is_return' => 1
                    ]);
                }

                $money_before = $member->money;
                $money_credit_before = $member->used_credit;

                $member->decrement('money', $member->used_credit);
                $member->decrement('used_credit', $member->used_credit);

                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $member->used_credit,
                    'money_before' => $money_credit_before,
                    'money_after' => $member->used_credit,
                    'money_type' => 'used_credit',
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_CREDIT_LEND,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_SUB,
                    'description' => '会员进行借呗还款操作，扣除中心账户金额【' . $record->money . '】给会员，扣除会员的借呗使用额度【' . $record->money . '元】',
                    'model_name' => get_class($record),
                    'model_id' => $record->id
                ]);

                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $member->used_credit,
                    'money_before' => $money_before,
                    'money_after' => $member->money,
                    'money_type' => 'money',
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_CREDIT_LEND,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_SUB,
                    'description' => '会员进行借呗还款操作，扣除中心账户金额【' . $record->money . '】给会员，扣除会员的借呗使用额度【' . $record->money . '元】',
                    'model_name' => get_class($record),
                    'model_id' => $record->id
                ]);
            });
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failed($e->getMessage());
        }

        return $this->success([], trans('res.api.credit_pay.lend_success'));
    }

    public function creditCheckMember(Request $request)
    {
        $data = $request->all();

        $this->validateRequest($data, [
            'name' => 'required'
        ], [], [
            'name' => trans('res.common.member_name')
        ]);

        $member = Member::where('name', $data['name'])->where('status', Member::STATUS_ALLOW)->first();

        if (!$member) return $this->failed(trans('res.api.credit_pay.member_not_exist_or_forbidden'));

        if ($member->is_demo) return $this->failed(trans('res.api.common.demo_not_allowed'));

        return $this->success(['data' => $member->used_credit]);
    }

    // 信用额度查询
    public function creditSearchPost(Request $request)
    {
        $data = $request->all();

        $limit = $request->get('limit', 5);

        $this->validateRequest($data, [
            'name' => 'required'
        ], [], [
            'name' => trans('res.common.member_name')
        ]);

        $member = Member::where('name', $data['name'])->where('status', Member::STATUS_ALLOW)->first();

        if (!$member) return $this->failed(trans('res.api.credit_pay.member_not_exist_or_forbidden'));

        if ($member->is_demo) return $this->failed(trans('res.api.common.demo_not_allowed'));

        $list = CreditPayRecord::where('member_id', $member->id)->latest()->paginate($limit);

        $total = $list->total();
        $pageNum = $list->lastPage();

        $list = $list->getCollection()->transform(function ($item, $key) use ($member) {
            $item->name = $member->name;
            $item->borrow_money = $item->type !== CreditPayRecord::TYPE_BORROW ? 0 : $item->money;
            $item->lend_money = $item->type !== CreditPayRecord::TYPE_BORROW ? $item->money : 0;
            $item->borrow_day = $item->type !== CreditPayRecord::TYPE_BORROW ? 0 : $item->borrow_day;
            $item->remain_day = $item->dead_at ? Carbon::now()->diffInDays($item->dead_at) : 0;
            $item->status_text = \Arr::get(config('platform.credit_status'), $item->status);
            $item->created_date = $item->created_at->toDateString();
            return $item;
        });
        //print_r($list->toArray());exit;

        // 统计信息
        $statistic = [
            'name' => $member->name,
            'level' => $member->level,
            'total_credit' => $member->total_credit,
            'used_credit' => $member->used_credit,

            // 总借款 还款
            'total_borrow' => app(CreditPayRecord::class)->getMemberTotalBorrow($member->id),
            'total_lend' => app(CreditPayRecord::class)->getMemberTotalLend($member->id),
        ];

        $table = '<tr class="nicheng"><td colspan="4">会员账号：<span>' . $member->name . '</span></td></tr>';
        $table .= '<tr class="tr-top"><td>VIP等级</td><td>已借款</td><td>累计借款</td><td>累计还款</td></tr><tr><td>' . $member->level . '</td><td>￥' . $member->used_credit . '</td><td>￥' . $statistic['total_borrow'] . '</td><td>￥' . $statistic['total_lend'] . '</td></tr>';
        foreach ($list as $item) {
            $table .= '<tr class="tr-lan"><td>借款金额</td><td colspan="2">还款金额</td><td>借款天数</td></tr>';
            $table .= '<tr><td>￥' . $item->borrow_money . '</td><td colspan="2">￥' . $item->lend_money . '</td><td>￥' . $item->borrow_day . '</td></tr>';

            $table .= '<tr class="tr-lan"><td>还款倒计时</td><td colspan="2">审核进度</td><td>日期</td></tr>';
            $table .= '<tr class=""><td>' . $item->remain_day . '天</td><td colspan="2" ' . ($item->status == CreditPayRecord::STATUS_SUCCESS ? 'style="color:#288cea"' : 'style="color:green"') . '>' . $item->status_text . '</td><td>' . $item->created_date . '</td></tr>';
        }

        return $this->success([
            'list' => $list,
            'row' => $statistic,
            'pageNum' => $pageNum,
            'pageSize' => $limit,
            'rowCount' => $total,
            'table' => $table
        ]);
    }

    // 维护页面
    public function regionBlock()
    {
        $ip = get_client_ip();

        if (!in_array($ip, BlackIp::getIpArray())) {
            return redirect(route('web.index'));
        }

        return view('web.regionBlock');
    }
}
