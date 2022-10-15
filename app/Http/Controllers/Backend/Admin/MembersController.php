<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Events\AutoMemberFd;
use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\AgentFdRate;
use App\Models\Base;
use App\Models\Drawing;
use App\Models\Member;
use App\Models\MemberLog;
use App\Models\MemberMoneyLog;
use App\Models\Recharge;
use App\Models\MemberApi;
use App\Models\SystemConfig;
use App\Services\AgentService;
use App\Services\MemberService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Services\SelfService;
use App\Http\Controllers\Member\SelfController;

class MembersController extends AdminBaseController
{
    protected $create_field = ['name', 'password', 'nickname', 'realname', 'email', 'phone', 'qq','line','facebook', 'gender', 'status', 'is_tips_on', 'is_in_on','qk_pwd','lang'];
    protected $update_field = ['name', 'password', 'nickname', 'realname', 'email', 'phone', 'qq','line','facebook', 'gender', 'status', 'is_tips_on', 'is_in_on','qk_pwd','lang'];

    public function __construct(Member $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model->with(['logs' => function($query){
            $query->whereIn('type',[MemberLog::LOG_TYPE_API_ACTION,MemberLog::LOG_TYPE_AGENT_LOGIN])->latest()->first();
        }])->where($this->convertWhere($params))->latest()->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }
    **/

    public function index(Request $request)
    {
        $online_list = $this->getOnlineMember()->toArray();
        $params = $request->all();
        $isOnline = $request->get('is_online');

        $data = $this->model->where($this->convertWhere($params))
            ->when(strlen($isOnline),function($query) use ($online_list,$isOnline){
                if($isOnline)
                    $query->whereIn('id',$online_list);
                else
                    $query->whereNotIn('id',$online_list);
            })->filterDemoAccount()
            ->latest()->paginate(15);
        return view("{$this->view_folder}.index", compact('data', 'params','online_list'));
    }

    // ????????
    public function getOnlineMember(){
        $last_hour_log = MemberLog::where('created_at','>',Carbon::now()->subHour())
            ->where('member_id','>',0)->get();

        $ids = $last_hour_log->pluck('created_at','member_id');

        $ids = collect(array_keys($ids->toArray()));

        foreach ($last_hour_log->where('type',MemberLog::LOG_TYPE_API_LOGOUT) as $item){

            $max_created_at = $last_hour_log->where('type','<>',MemberLog::LOG_TYPE_API_LOGOUT)->max('created_at');

            if($item->created_at->gte($max_created_at)){
                $ids = $ids->filter(function($v) use ($item){
                    return $v != $item->member_id;
                });
            }
        }
        return $ids;
    }

    public function edit(Member $member)
    {
        return view($this->getEditViewName(), ["model" => $member]);
    }

    public function modify_top(Member $member){
        return view('admin.member.modify_top', ['model' => $member]);
    }

    // ??????? ????????????
    public function post_modify_top(Member $member, Request $request){
        $top_id = $request->get('top_id',0);
        $top_id = $top_id ?? 0;

        $old_top_id = $member->top_id;
        $top = null;
        if($top_id) $top = Member::where('agent_id',$top_id)->where('status',1)->first();

        try{
            DB::transaction(function() use ($old_top_id,$top_id,$member,$top){
                $member->update(['top_id' => $top_id]);

                // ??????????,??
                if(!$old_top_id){
                    // ?????,??????????
                    if($member->agent){
                        AgentFdRate::where('member_id',$member->id)->where('type',AgentFdRate::TYPE_AGENT_MEMBER)->delete();
                    }

                    event(new AutoMemberFd($member));
                }else{
                    // ???????????
                    $member_list = app(AgentService::class)->getAllChildId($member->id);
                    if($top && in_array($top->id,$member_list))
                        throw new InvalidRequestException(trans('res.base.illegal_operation'));

                    // ????? agent_fd_rate ? type = 3 ???
                    AgentFdRate::where('member_id',$member->id)
                        ->where('type',AgentFdRate::TYPE_AGENT_MEMBER)->update([
                            'parent_id' => $top->id
                        ]);
                }
            });
        }catch (Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.base.operate_fail').$e->getMessage());
        }
        return $this->success(['close_reload' => true],trans('res.base.operate_success'));
    }

    public function modify_money(Member $member)
    {
        // ????
        app(MemberService::class)->updateMemberML($member);
        return view('admin.member.modify_money', ['model' => $member]);
    }

    public function post_modify_money(Request $request, Member $member)
    {
        $data = $request->only(['money', 'money_type', 'number_type', 'description', 'remark']);

        $this->validateRequest($data, [
            "money" => "required|numeric|min:0",
            'money_type' => ['required', Rule::in(array_keys(config('platform.member_money_type')))],
            "number_type" => ["required", Rule::in(array_keys(config('platform.money_number_type')))],
        ], [], [
            'money' => trans('res.member_money_log.field.money'),
            'money_type' => trans('res.member_money_log.field.money_type'),
            'number_type' => trans('res.member_money_log.field.number_type'),
        ]);


        $data['money'] = floatval(sprintf("%.2f",$data['money']));

        $field = $data['money_type'];

        if($member->$field + $data['number_type'] * $data['money'] < 0){
            return $this->failed(trans('res.member.msg.money_negative_error'));
        }

        $data['member_id'] = $member->id;
        $data['operate_type'] = MemberMoneyLog::OPERATE_TYPE_ADMIN;
        $data['money_before'] = floatval($member->$field);
        $data['money_after'] = $member->$field + $data['number_type'] * $data['money'];
        $data['user_id'] = $this->guard()->user()->id;

        $data = array_filter($data,function($temp){
            return $temp !== null;
        });

        try {
            DB::transaction(function () use ($member, $data,$request) {

                if ($data['number_type'] > 0) {
                    $member->increment($data['money_type'], $data['money']);

                    if($request->get('is_add_ml') == 1){
                        $percent = systemconfig('ml_percent');
                        $percent = sprintf("%.2f", $percent / 100);
                        $member->increment('ml_money',sprintf("%.2f",$data['money'] * $percent));
                    }
                } else {
                    $member->decrement($data['money_type'], $data['money']);
                }

                if(!SystemConfig::isInWhiteIp()) MemberMoneyLog::create($data);
            });
        } catch (Exception $e) {
            DB::rollback();
            return $this->failed(trans('res.base.operate_fail').$e->getMessage());
        }

        return $this->success(['close_reload' => true],trans('res.base.operate_success'));
    }

    public function storeRule()
    {
        return [
            "name" => "required|min:6|max:8|alpha_num|unique:members,name",
            "password" => "min:6",
            "invite_code" => "unique:members,invite_code",
            "gender" => Rule::in(array_keys(config('platform.gender'))),
            "status" => Rule::in(array_keys(config('platform.member_status'))),
            "is_tips_on" => Rule::in(array_keys(config('platform.boolean'))),
            "is_in_on" => Rule::in(array_keys(config('platform.boolean'))),
        ];
    }

    public function updateRule($id)
    {
        return [
            "name" => "required|min:6|max:8|alpha_num|unique:members,name," . $id,
            // "password" => "min:6",
            "invite_code" => "unique:members,invite_code," . $id,
            "gender" => Rule::in(array_keys(config('platform.gender'))),
            "status" => Rule::in(array_keys(config('platform.member_status'))),
            "is_tips_on" => Rule::in(array_keys(config('platform.boolean'))),
            "is_in_on" => Rule::in(array_keys(config('platform.boolean'))),
        ];
    }

    protected function updateHandle($data)
    {
        if(array_key_exists('password',$data)){
            if(!$data['password']){
                unset($data['password']);
            }else if(strlen($data['password']) < 6 ){
                throw new InvalidRequestException(trans('res.member.msg.password_at_least_6'));
            }
        }
        return $data;
    }

    // ????
    public function money_report(Request $request){
        $params = $request->all();
        $confirmDate = [];
        $searchDate = [];

        $data = [];
        $total_recharges = $total_drawings = $total_fs = $total_dividend = $total_other = $total_yinli = 0;

        if(!count($params) || !$request->get('lang'))
            return view('admin.member.money_report',compact('data','params','total_recharges','total_drawings',
                'total_fs','total_dividend','total_other','total_yinli'));

        if(array_key_exists('created_at',$params) && $params['created_at']){
            $confirmDate = convertDateToArray($params['created_at'],'confirm_at');
            $searchDate = convertDateToArray($params['created_at'],'created_at');
        }

        // ??????
        $mod = Member::where('status',Member::STATUS_ALLOW)
            ->where('lang',$request->get('lang'))
            ->filterInnerAccount()
            ->filterDemoAccount()
            ->when($request->get('name'),function($query) use ($request){
                $query->where('name','like','%'.$request->name.'%');
        })
            // rechargeSum ???????
            ->withCount(['recharges as rechargeSum' => function($query) use($params,$confirmDate) {
            $query->where($confirmDate)->where('status',Recharge::STATUS_SUCCESS)->select(DB::raw("sum(money) as member_recharge_sum"));
        }])
            // rechargeCount ???????
            ->withCount(['recharges as rechargeCount' => function($query) use($params,$confirmDate) {
            $query->where($confirmDate)->where('status',Recharge::STATUS_SUCCESS);
        }])
            // drawingSum ???????
            ->withCount(['drawings as drawingSum' => function ($query) use ($confirmDate) {
                $query->where($confirmDate)->where('status',Drawing::STATUS_SUCCESS)->select(DB::raw("sum(money) as member_drawing_sum"));
            }])
            // drawingCount ???????
            ->withCount(['drawings as drawingCount' => function($query) use ($confirmDate) {
                $query->where($confirmDate)->where('status',Drawing::STATUS_SUCCESS);
            }])

            ->withCount(['moneylogs as moneylogSumFanshui' => function($query) use ($searchDate) {
                $query->where($searchDate)->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)->select(DB::raw("sum(money) as member_fanshui_sum"));
            }])
            ->withCount(['moneylogs as moneylogSumHongli' => function($query) use ($searchDate) {
                $query->where($searchDate)->activityMoney()->select(DB::raw("sum(money) as member_hongli_sum"));
            }])
            ->withCount(['moneylogs as moneylogSumOther' => function($query) use ($searchDate) {
                $query->where($searchDate)->otherMoney()->select(DB::raw("sum(money) as member_other_sum"));
            }])
            ->withCount(['moneylogs as moneylogSumDebit' => function($query) use ($searchDate) {
                $query->where($searchDate)->DebitMoney()->select(DB::raw("sum(money) as member_debit_sum"));
            }]);
        $all_data = $mod->latest()->get();

        // ??
		$total_debit = $all_data->sum('moneylogSumDebit'); //??????
        $total_recharges = $all_data->sum('rechargeSum');
        $total_drawings = $all_data->sum('drawingSum');
        $total_fs = $all_data->sum('moneylogSumFanshui');
        $total_dividend = $all_data->sum('moneylogSumHongli');
        $total_other = $all_data->sum('moneylogSumOther') - $total_debit;

        $total_yinli = $total_recharges - $total_drawings - $total_fs - $total_dividend - $total_other;

        $data = $mod->paginate(15);

        return view('admin.member.money_report',compact('data','params','total_recharges','total_drawings',
            'total_fs','total_dividend','total_other','total_yinli'));
    }

    public function member_apis(Member $member){
        $data = $member->apis;
        return view('admin.member.member_apis',compact('data','member'));
    }

    // ?????????
    public function refresh_api(MemberApi $member_api, Request $request){
        $gamecode = $request->get('gamecode');
        $username = $request->get('username');
        $api_code = $member_api->api_name;
        $password = $member_api->password;
        $res = json_decode(app(SelfService::class)->balance($api_code, $username, $password, $gamecode),true);
        if($res['errCode'] != 0){
            return $this->failed(trans('res.member.msg.balance_error').$res['errMsg']);
        }
        $money = sprintf("%.2f",$res['balance']);
        if($money != $member_api->money){
            $member_api->update([
                'money' => $money
            ]);
        }
        return $this->success(['data' => $money]);
    }

    //addcode
    public function changepassword_api(MemberApi $member_api, Request $request){
        $gamecode = $request->get('gamecode');
        $username = $request->get('username');
        $api_code = $member_api->api_name;
        $password = $member_api->password;
        $passwordnew = $this->generatePassword();
        $res = json_decode(app(SelfService::class)->changepassword($api_code, $username, $password, $gamecode, $passwordnew),true);
        if($res['errCode'] != 0){
            return $this->failed(trans('res.member.msg.balance_error').$res['errMsg']);
        }
        if($res['errCode'] == 0){
            $member_api->update([
                'password' => $passwordnew
            ]);
        }
        return $this->success(['data' => $res['errMsg']]);
    }

    public function checkproduct_api(Request $request){
        $gamecode = $request->get('gamecode');
        $username = $request->get('username');
        $res = json_decode(app(SelfService::class)->checkproduct($gamecode, $username),true);
        if($res['errCode'] != 0){
            return $this->failed(trans('res.member.msg.balance_error').$res['errMsg']);
        }
        return $this->success(['data' => $res['errMsg']]);
    }

    function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }
    //endcode

    // ????????
    public function recycle_api(MemberApi $member_api,Request $request){
        $member = $member_api->member;

        $params = [
            'api_code' => $member_api->api_name,
            'name' => $member->name,
        ];

        $request->merge($params);

        // 1.?????
        $balance_res = app(SelfController::class)->balance_admin($request);

        $balance_res = json_decode($balance_res->getContent(),1);

        if($balance_res['status'] != 'success') return $this->failed($balance_res['message']);

        $money = $balance_res['money'];

        if($money < 1) return $this->success(['data' => $money]);

        // 2.??????
        $amount = floor($balance_res['money']);

        $request->merge(['money' => $amount]);

        $withdrawal_res = app(SelfController::class)->withdrawal_admin($request);

        $withdrawal_res = json_decode($withdrawal_res->getContent(),1);

        if($withdrawal_res['status'] != 'success') return $this->failed($withdrawal_res['message']);

        $member_api = MemberApi::find($member_api->id);

        return $this->success(['data' => $member_api->money]);
    }

    // ??????
    public function make_offline(Member $member){
        if($member->isOnline()){
            $member->update([
                'status' => Member::STATUS_FORCE_OFF
            ]);
            return $this->success(['reload'=>true],trans('res.member.msg.offline_success',['name' => $member->name]));
        }else{
            return $this->success([],trans('res.member.msg.member_offlined',['name' => $member->name]));
        }
    }

    // ??????
    public function register_setting(){
        $data = SystemConfig::query()->getConfigValue('register_setting_json',Base::LANG_COMMON);
        if($data) $data = json_decode($data,1);
        else $data = [];
        return view('admin.member.register_setting',compact('data'));
    }

    public function post_register_setting(Request $request){
        $data = $request->only(array_keys(config('platform.register_setting_field')));
        $mod = SystemConfig::query()->getConfig('register_setting_json',Base::LANG_COMMON);

        if($mod->update([
            'value' => json_encode($data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['close_reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }
}
