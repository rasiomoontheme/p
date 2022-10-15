<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Handlers\FileUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\ApiGame;
use App\Models\Bank;
use App\Models\BankCard;
use App\Models\Base;
use App\Models\DailyBonus;
use App\Models\Drawing;
use App\Models\Favorite;
use App\Models\FsLevel;
use App\Models\GameList;
use App\Models\GameRecord;
use App\Models\InterestHistory;
use App\Models\LevelConfig;
use App\Models\Member;
use App\Models\MemberAgentApply;
use App\Models\MemberBank;
use App\Models\MemberMessage;
use App\Models\MemberMoneyLog;
use App\Models\MemberYuebaoPlan;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Recharge;
use App\Models\SystemConfig;
use App\Models\Transfer;
use App\Models\YuebaoPlan;
use App\Services\ActivityService;
use App\Services\AgentService;
use App\Services\ThirdPayService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
// 游客访问
class MemberController extends MemberBaseController{

    //public $member;

    public function __construct()
    {
        $this->member = $this->guard()->user();
        parent::__construct();
    }

    // 申请 代理
    public function apply_agent(Request $request){
        $this->member = $this->getMember();

        // 判断会员是否是代理
        if($this->member->agent) return $this->failed(trans('res.api.apply_agent.member_is_agent'));

        // 判断是否有正在申请的记录
        $record = MemberAgentApply::query()
            ->where('member_id',$this->member->id)
            ->where('status',MemberAgentApply::STATUS_NOT_DEAL)->first();

        if($record) return $this->failed(trans('res.api.apply_agent.has_applied'));

        $data = $request->all();

        $data = array_filter_null($data);

        $this->validateRequest($data,[
            "name" => "required|min:2",
            "phone" => "sometimes|required",
            "reason" => "required"
        ],[],$this->attributeName(MemberAgentApply::class));

        $data = Arr::only($data,['name','phone','reason']);

        $data['member_id'] = $this->member->id;
        // var_dump($data);exit;

        if($res = MemberAgentApply::create($data)){
            return $this->success([],trans('res.api.apply_agent.apply_success'));
        }else{
            return $this->failed(trans('res.api.apply_agent.apply_fail'));
        }
    }

    // 查询会员的代理申请状态
    public function apply_agent_status(){
        $member = $this->getMember();

        // 查询会员是否是代理
        if($member->isAgent()) return $this->success([],trans('res.api.apply_agent.has_applied'));

        // 查询会员是否申请过代理
        $apply = MemberAgentApply::query()->where('member_id',$member->id)->latest()->first();

        if($apply){
            return $this->success(['data' => $apply]);
        }else{
            return $this->success([],trans('res.api.apply_agent.status_fail'));
        }
    }

    // 收款银行列表
    public function deposit_bank_list(Request $request){
        return $this->success([
            'data' => BankCard::where('is_open',1)->get()
        ]);
    }

    // 公司入款列表
    public function payment_list(Request $request){
        $member = $this->getMember();

        $data = Payment::where('is_open',1)->where('type','like',Payment::PREFIX_COMPANY.'%')->langs($member->lang)->get();
        $data->transform(function($item,$key) use($member){
            if($item->type == Payment::TYPE_BANKPAY){
                $temp = $item->params;
                // $temp['bank_type_text'] = config('platform.bank_type')[$item->params['bank_type']] ?? '';
                // $temp['bank_type_text'] = Arr::get($item->params,'bank_type');
                $temp['bank_type_text'] = Arr::get(Bank::getBankArray($member->lang),$item->params['bank_type'],'');
                $item->params = $temp;
                //$item->params['bank_type_text'] = config('platform.bank_type')[$item->params['bank_type']] ?? '';
            }

            else if($item->type == Payment::TYPE_USDT && !is_array($item->usdt_type_text)){
                $temp = $item->params;
                $temp['usdt_type_text'] = $item->usdt_type_text;
                $item->params = $temp;
            }
            $item->remark_code = random_int(1000,9999);
            return $item;
        });

        return $this->success([
            'data' => $data
        ]);
    }

    // 在线支付列表
    public function payment_online(Request $request){
        $member = $this->getMember();

        $data = Payment::where('is_open',1)->where('type','like',Payment::PREFIX_THIRDPAY.'%')->langs($member->lang)->get();
        return $this->success([
            'data' => $data->makeHidden('params')
        ]);
    }

    // 选择存款方式页面
    public function recharge_payments(Request $request){
        $member = $this->getMember();
        $data = Payment::where('is_open',1)->langs($member->lang)->distinct()->get('type');

        $types = collect([]);
        foreach ($data->toArray() as $item){
            $key = explode('_',$item['type'])[0];

            if(!$types->where('type',$key)->count()){
                $first = mb_strpos($item['type_text'],'(');
                $types->push([
                    'type' => $key,
                    'type_text' => mb_substr($item['type_text'],$first + 1,mb_strlen($item['type_text']) - $first - 2)
                ]);
            }

        }

        return $this->success([
            'data' => $data,
            // 获取分类信息
            'type' => $types
        ]);
    }

    // 用户银行列表
    public function member_bank_list(Request $request){
        $this->member = $this->getMember();
        // 搜索条件
        $data = $request->only(array_keys(Arr::except(MemberBank::$list_field,['member_id'])));
        $data['member_id'] = $this->member->id;

        // $limit = $request->get('limit',10);

        $result = MemberBank::query()->where($this->convertWhere($data))->get();
        $result->transform(function($item,$key){
            $item->url = config('platform.bank_urls')[$item->bank_type] ?? '';
            return $item;
        });

        return $this->success([
            'data' => $result->toArray(),
            // 'bank_type' => config('platform.bank_type')
            'bank_type' => Bank::getBankArray($this->member->lang)
        ]);
    }

	public function information(){
        $member = $this->getMember();
		$member['usdt'] = config('platform.usdt_type');
        return $this->success([
            'data' => $member
        ]);
    }

    public function member_bank_type(){
        // return $this->success(['data' => config('platform.bank_type')]);
        $member = $this->getMember();
        return $this->success([
            'data' => Bank::getBankArray($this->member->lang),
            'usdt' => config('platform.usdt_type')
        ]);
    }

    // 创建用户银行
    public function member_bank_create(Request $request){
        $this->member = $this->getMember();
        // 参数过滤
        $data = $request->only(array_keys(Arr::except(MemberBank::$list_field,['member_id'])));

        $this->validateRequest($data,[
            'card_no' => 'required|min:10',
            // 'bank_type' => ['required',Rule::in(array_keys(config('platform.bank_type')))],
            'bank_type' => ['required',Rule::in(array_keys(Bank::getBankArray($this->member->lang)))],
            "owner_name" => "required",
        ],[],$this->getLangAttribute('memberbank'));

        $data = array_filter_null($data);

        $data['member_id'] = $this->member->id;

        if($result = MemberBank::create($data)){
            return $this->success(['data' => $result],trans('res.api.member_bank.create_success'));
        }else{
            return $this->failed(trans('res.api.member_bank.create_fail'));
        }
    }

    public function member_bank_update(MemberBank $bank,Request $request){
        $this->member = $this->getMember();
        // 参数过滤
        $data = $request->only(array_keys(Arr::except(MemberBank::$list_field,['member_id'])));

        $this->validateRequest($data,[
            'card_no' => 'required|min:10',
            // 'bank_type' => ['required',Rule::in(array_keys(config('platform.bank_type')))],
            'bank_type' => ['required',Rule::in(array_keys(Bank::getBankArray($this->member->lang)))],
            "owner_name" => "required",
        ],[],$this->getLangAttribute('memberbank'));

        $data = array_filter_null($data);

        $data['member_id'] = $this->member->id;

        if($this->updateByModel($bank,$data)){
            return $this->success([],trans('res.api.member_bank.update_success'));
        }else{
            return $this->failed(trans('res.api.member_bank.update_fail'));
        }
    }

    public function member_bank_delete(MemberBank $bank,Request $request){
        if($bank->delete()){
            return $this->success([],trans('res.api.member_bank.delete_success'));
        }else{
            return $this->failed(trans('res.api.member_bank.delete_fail'));
        }
    }

    // 在线充值
    public function recharge_online(Request $request){
        $this->member = $this->getMember();

        $data = $request->only(['money','payment_type']);

        $this->validateRequest($data,[
            "money" => 'required|numeric|min:0',
            "payment_type" => ['required',Rule::in(array_keys(config('platform.payment_type')))]
        ],[],$this->getLangAttribute('recharge'));

        $payment_id = $request->get('payment_id');
        if(!$payment_id) return $this->failed(trans('res.api.common.operate_error'));

        $payment = Payment::find($payment_id);
        if(!$payment->is_open) return $this->failed(trans('res.api.recharge.payment_closed'));

        // 转换汇率
        /**
        if($data['money'] % $payment->forex) return $this->failed(trans('res.api.recharge.pay_money_err'));

        $data['origin_money'] = $data['money'];
        $data['forex'] = $payment->forex;
        $data['lang'] = $payment->lang;
        $money = intval($data['money'] / $payment->forex); // 折算后的金额
        **/

        if(!$payment->isMoneyNoLimited()){
            if($data['money'] > $payment->max || $data['money'] < $payment->min)
            // if($money > $payment->max || $money < $payment->min)
                return $this->failed(trans('res.api.recharge.pay_between',['min' => $payment->min,'max' => $payment->max]));
        }

        $data['bill_no'] = getBillNo();
        $data['member_id'] = $this->member->id;
        $data['payment_detail'] = json_encode(['payment_id' => $payment_id],JSON_UNESCAPED_UNICODE);
        $data['hk_at'] = Carbon::now();

        $url = '';
        try{
             $url = app(ThirdPayService::class,['payment' => $payment])->prepareRequest($data);
            // $url = "http://www.baidu.com";
            // $data['money'] = $money;
            $result = Recharge::create($data);
        }catch (Exception $e){
            return $this->failed($e->getMessage());
        }

        //通过密钥和商户号进行支付，并返回支付网址
        return $this->success(['pay_url' => $url],trans('res.api.recharge.pay_success'));
    }

    // 充值（公司入款）
    public function recharge(Request $request){
        $this->member = $this->getMember();
        // 参数过滤
        $data = $request->only(['name','money','payment_type','account','payment_desc','payment_pic','hk_at']);

        // 过滤空参数
        $data = array_filter($data, function ($temp) {
            return strlen($temp);
        });
		$value = $data['hk_at'];
		$yyyy = explode("-",$data['hk_at']);
		if($yyyy[0] == 'yyyy'){
		    $value = date('Y').'-'.$yyyy[1].'-'.$yyyy[2];
		}
		$data['hk_at'] = $value;
        $this->validateRequest($data,[
            "name" => 'required',
            'money' => 'required|numeric|min:0|integer',
            'account' => 'required',
            'hk_at' => 'required|date',
            'payment_pic' => 'sometimes|url',
            //"payment_type" => ['required',Rule::in(array_keys(config('platform.recharge_type')))],
            "payment_type" => ['required',Rule::in(array_keys(config('platform.payment_type')))],
        ],[],$this->getLangAttribute('recharge'));

        // 比较收款信息中的账号和收款人，判断是否一致
        $payment_detail = $request->only(['payment_id','payment_account','payment_name','payment_bank_type','remark_code']);

        $payment_detail = array_filter_null($payment_detail);

        $this->validateRequest($payment_detail,[
            "payment_id" => 'required|exists:payments,id',
            "payment_account" => 'required',
            "payment_name" => 'sometimes|required',
            // "remark_code" => 'required|numeric|min:1000|max:9999',
        ],[],$this->getLangAttribute('recharge'));

        $payment = Payment::find($payment_detail['payment_id']);
        if(!$payment->is_open) return $this->failed(trans('res.api.recharge.payment_closed'));

        // if($payment->name !== $payment_detail['payment_name'] || $payment->account !== $payment_detail['payment_account'])
        //    return $this->failed(trans('res.api.recharge.payment_change'));

        if($payment->type != Payment::TYPE_USDT && $payment->name != $payment_detail['payment_name']){
            return $this->failed(trans('res.api.recharge.payment_change'));
        }
        if($payment->type == Payment::TYPE_USDT){
            $payment_detail['usdt_rate'] = $payment->params['usdt_rate'];
            $payment_detail['usdt_type'] = $payment->params['usdt_type'];
        }
        if($payment->account !== $payment_detail['payment_account'])
            return $this->failed(trans('res.api.recharge.payment_change'));

        if(!$payment->isMoneyNoLimited()){
            if($data['money'] > $payment->max || $data['money'] < $payment->min)
                return $this->failed(trans('res.api.recharge.pay_between',['min' => $payment->min,'max' => $payment->max]));
        }

        $data = array_filter_null($data);

        $data['bill_no'] = getBillNo();
        $data['member_id'] = $this->member->id;
        $data['payment_detail'] = json_encode($payment_detail,JSON_UNESCAPED_UNICODE);

        if($result = Recharge::create($data)){
            return $this->success(['data' => $data],trans('res.api.recharge.pay_normal_success'));
        }else{
            return $this->failed(trans('res.api.recharge.pay_normal_fail'));
        }
    }

    // 获取用户的充值记录
    public function recharge_list(Request $request){
        $this->member = $this->getMember();
        // 搜索条件
        $data = $request->only(['money','payment_type','status','payment_desc','hk_at']);
        // $this->api_print($this->guard()->user()->name);
        $data['member_id'] = $this->member->id;

        $limit = $request->get('limit',10);

        $mod = Recharge::query()->where($this->convertWhere($data));
        $sum_money = $mod->sum('money');

        $result = $mod->latest()->paginate($limit);
        return $this->success([
            'data' => $result,
            'statistic' => [
                'sum_money' => $sum_money
            ]
        ]);
    }

    public function recharge_detail($recharge,Request $request){

    }

    public function drawing(Request $request){
        $this->member = $this->getMember();
        // 参数过滤
        $data = $request->only(['name','money','account','member_bank_id','member_bank_info','member_remark','qk_pwd']);

        $this->validateRequest($data,[
            "name" => 'required',
            'money' => 'required|numeric|min:0',
            'account' => 'required',
            'qk_pwd' => 'required',
            'member_bank_id' => 'required|exists:member_banks,id'
        ],[
            'qk_pwd.required' => trans('res.api.drawing.qk_pwd_required')
        ],$this->getLangAttribute('drawing'));

        // 判断提款额度是否大于余额
        if($data['money'] > $this->member->money){
            return $this->failed(trans('res.api.drawing.money_not_enough'));
        }

        if($data['member_bank_id']){
            $bank_info = MemberBank::query()
                ->where('member_id',$this->member->id)
                ->where('id',$data['member_bank_id'])->first();
            if(!$bank_info) throw new InvalidRequestException(trans('res.api.drawing.bank_not_exist'));

            $data['member_bank_info'] = json_encode(Arr::except($bank_info->toArray(),['created_at','updated_at','member_id']));
            $data = Arr::except($data,['member_bank_id']);
        }

        // 判断是否在提款时间段内
        $start_at = systemconfig('transfer_start',Base::LANG_COMMON);
        $end_at = systemconfig('transfer_end',Base::LANG_COMMON);

        if(!checkIsBetweenTime($start_at,$end_at)){
            return $this->failed(trans('res.api.drawing.time_not_allow'));
        }

        // 判断提款金额是否在范围内
        $money_size_config = json_decode(systemconfig('drawing_money_size_json'), true);
        $min_money = $money_size_config[$this->member->lang]['b'][0] ?? 0;
        $max_money = $money_size_config[$this->member->lang]['b'][1] ?? 0;

        if($data['money'] < $min_money){
            return $this->failed(trans('res.api.drawing.min_money',['min' => $min_money]));
        }

        if($data['money'] > $max_money){
            return $this->failed(trans('res.api.drawing.max_money',['max' => $max_money]));
        }

        // 判断是否有手续费

        // 判断取款密码是否输入正确
        if($data['qk_pwd'] != $this->member->qk_pwd){
            return $this->failed(trans('res.api.drawing.qk_pwd_error'));
        }

        // 判断提款次数是否超限
        if($drawing_times = systemconfig('drawing_times_per_day',Base::LANG_COMMON)){
            // 获取今日提款申请次数
            if(Drawing::where('member_id',$this->member->id)->whereDate('created_at',Carbon::today())->count() >= $drawing_times){
                return $this->failed(trans('res.api.drawing.times_not_enough'));
            }
        }

        $data = Arr::except($data,'qk_pwd');

        $data = array_filter_null($data);

        $data['bill_no'] = getBillNo();
        $data['member_id'] = $this->member->id;

        $member = $this->member;

        // 扣款前金额
        $money_before = $member->money;

        $money = $data['money'];

        $count_fee = 0;

        // 如果码量有剩余时 money 申请金额，data['money'] 实际提款金额
        if($member->ml_money > 0 && $ml_drawing_percent = systemconfig('ml_drawing_percent',Base::LANG_COMMON)){
            $count_fee = $money * $ml_drawing_percent / 100;
            $data['counter_fee'] = $count_fee;
            $data['money'] = $money - $count_fee;
        }

        // 判断三秒内是否有重复的提现金额
        if(Drawing::where('id',$member->id)->where('created_at','>',Carbon::now()->subSeconds(3))->exists()){
            return $this->failed(trans('res.api.common.operate_error'));
        }

        try{
            DB::transaction(function() use($data,$member,$money_before,$money,$count_fee){

                // $message = $count_fee ? '，会员码量为【'.$member->ml_money.'】,扣除手续费【'.$count_fee.'元】' : '';
                $message = $count_fee ? trans('res.drawing.field.counter_fee',[
                    'ml_money' => $member->ml_money,
                    'count_fee' => $count_fee
                ], $member->lang) : '';

                $member->decrement('money',$money);

                $obj = Drawing::create($data);

                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $money,
                    'money_before' => $money_before,
                    // 'money_after' => $member->money - $data['money'],
                    'money_after' => $member->money,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_SUB,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_MEMBER,
                    // 'description' => '会员最终提现金额为【'.$data['money'].'】'.$message,
                    'description' => trans('res.member_money_log.notice.drawing_request',['money' => $data['money']], $member->lang).$message,
                    'model_name' => \get_class($obj),
                    'model_id' => $obj->id
                ]);
            });
        }catch(Exception $e){
            return $this->failed(trans('res.api.drawing.drawing_fail').$e->getMessage());
        }
        return $this->success([],trans('res.api.drawing.drawing_success'));

    }

    public function drawing_list(Request $request){
        $this->member = $this->getMember();
        // 搜索条件
        $data = $request->only(array_keys(Arr::except(Drawing::$list_field,['member_id','user_id'])));
        $data['created_at'] = $request->get('created_at','');
        $data['member_id'] = $this->member->id;

        $limit = $request->get('limit',10);

        $mod = Drawing::query()->where($this->convertWhere($data));

        $sum_money = $mod->sum('money');

        $result = $mod->paginate($limit);
        return $this->success([
            'data' => $result,
            'statistic' => [
                'sum_money' => $sum_money
            ]
        ]);
    }

    // 投注时间 betTime
    // 派彩时间 created_at
    // 接口名称 api_name
    // 游戏类型 gameType
    // 游戏记录
    public function game_record(Request $request,Member $member = null){
        if(!$member) $member = $this->getMember();

        // 投注时间，派彩时间，只查询未派彩注单
		if($request->has('api_name')){
			$data['api_name'] = $request->get('api_name');
		}
		if($request->has('gameType')){
			$data['gameType'] = $request->get('gameType');
		}
		if($request->has('betTime')){
			$data['betTime'] = $request->get('betTime');
		}
		if($request->has('timezone')){
			$data['timezone'] = $request->get('timezone');
		}
		if($request->has('created_at')){
			$data['created_at'] = $request->get('created_at');
			foreach($data['created_at'] as $key => $value){
		        $yyyy = explode("-",$value);
		        if($yyyy[0] == 'yyyy'){
		        	$value = date('Y').'-'.$yyyy[1].'-'.$yyyy[2];
		        }
		        $data['created_at'][$key] = $value;
		    }
		}
        if(array_key_exists('timezone',$data) && $data['timezone'] == 'na'){
            if($data['created_at']){
                $data['created_at'][0] = Carbon::paras($data['created_at'][0])->addHours(13);
                $data['created_at'][1] = Carbon::paras($data['created_at'][1])->addHours(13);
            }

            if($data['betTime']){
                $data['betTime'][0] = Carbon::paras($data['betTime'][0])->addHours(13);
                $data['betTime'][1] = Carbon::paras($data['betTime'][1])->addHours(13);
            }
        }

        $data['member_id'] = $member->id;

        $limit = $request->get('limit',10);

        $mod = GameRecord::query()->where($this->convertWhere($data))->when($request->get('unpayOnly'),function($query){
            // $query->whereNull('payoffTime');
            $query->where('status','!=',GameRecord::STATUS_COMPLETE);
        });
        $sum_bet_amount = $mod->sum('betAmount');
        $sum_valid_bet_amount = $mod->sum('validBetAmount');
        $sum_net_amount = $mod->sum('netAmount');

        $month_mod = GameRecord::query()->where('member_id',$member->id)->whereBetween('created_at',[Carbon::now()->subMonth(),Carbon::now()]);
        $apis = $month_mod->pluck('api_name')->toArray();
        // 接口类型
        $gametypes = get_unique_array($month_mod->pluck('gameType')->toArray());
        $gametype_arr = [];
        foreach ($gametypes as $item){
            if(array_key_exists($item,array_keys(trans('res.option.game_type')))){
                array_push($gametype_arr,[
                    'key' => $item,
                    'value' => Arr::get(trans('res.option.game_type'),$item)
                ]);
            }
        }

        $result = $mod->latest()->paginate($limit);
        // timezone cn北京时区，na北美时区
        $result->getCollection()->transform(function($item) use($data){
            if(Arr::get($data,'timezone') == 'na') $item->betTime = $item->betTime->subHours(13);
            return $item;
        })->each->append('api_name_text');

        return $this->success([
            'data' => $result,
            'statistic' => [
                'sum_bet_amount' => $sum_bet_amount, // 总投注
                'sum_valid_bet_amount' => $sum_valid_bet_amount, // 总有效投注
                'sum_net_amount' => $sum_net_amount // 总派彩金额
            ],
            'apis' => get_unique_array($apis),
            'gametypes' => $gametype_arr
        ]);
    }

    public function money_log_type(){
        return $this->success([
            'data' => [
                 'operate_type' => trans('res.option.member_money_operate_type'),
                /**
                'money_type' => [
                    'money' => '中心钱包余额',
                    'fs_money' => '返水钱包余额',
                ]
                 */
                'money_type' => trans('res.option.config_money_type')
            ]
        ]);
    }

    // 账户交易记录 （金额变动
    public function money_log(Request $request,Member $member = null){
        if(!$member) $member = $this->getMember();
        // 搜索条件，时间和类型
        // $data = [['created_at','>', '2020-03-23 00:00:00']];
        $data = $request->only(['created_at','operate_type']);
        $limit = $request->get('limit',10);
		foreach($data['created_at'] as $key => $value){
			$yyyy = explode("-",$value);

			if($yyyy[0] == 'yyyy'){
				$value = date('Y').'-'.$yyyy[1].'-'.$yyyy[2];
			}
			$data['created_at'][$key] = $value;
		}
        $data['member_id'] = $member->id;

        $mod = MemberMoneyLog::query()
            ->where($this->convertWhere($data))
            ->when($request->get('money_type'),function($query) use ($request){
                return $query->where('money_type',$request->get('money_type'));
            });

        // 统计信息
        $collection = $mod->get();
        $add_sum = $collection->where('number_type',MemberMoneyLog::MONEY_TYPE_ADD)->sum('money');
        $sub_sum = $collection->where('number_type',MemberMoneyLog::MONEY_TYPE_SUB)->sum('money');

        $result = $mod->latest()->paginate($limit);
        // var_dump($mod->count());exit;

        $month_mod = MemberMoneyLog::query()->where('member_id',$member->id)->whereBetween('created_at',[Carbon::now()->subMonth(),Carbon::now()]);
        $operate_types = get_unique_array($month_mod->pluck('operate_type')->toArray());
        $operate_type_arr = [];
        foreach ($operate_types as $item){
            if(array_key_exists($item,trans('res.option.member_money_operate_type'))){
                array_push($operate_type_arr,[
                    'key' => $item,
                    'value' => Arr::get(trans('res.option.member_money_operate_type'),$item),
                ]);
            }
        }

        return $this->success([
            'data' => $result,
            'operate_type' => $operate_type_arr,
            'statistic' => [
                'sum_money' => round($add_sum + $sub_sum,2),
                'valid_money' => round($add_sum - $sub_sum,2)
            ],
            'money_type' => trans('res.option.config_money_type')
        ]);
    }

    // 获取用户的站内信列表，包含已读和未读
    public function message_list(Request $request){
        $member = $this->getMember(1);

        if($member->isDemo())
            return $this->success([
                'data' => [],
                'unread' => 0
            ]);

        // 查询是否有未创建的用户通知
        $unread = Message::query()->where('visible_type',Message::VISIBLE_TYPE_ALL)
            ->whereNotIn('id',MemberMessage::withTrashed()->where('member_id',$member->id)->pluck('message_id'))
//            ->whereDoesntHave('member_message',function($query) use($member){
//                $query->where('member_id',$member->id)->where('deleted_at',null);
//            })
            // 会员创建之后的站内信通知
            ->where('created_at','>',$member->created_at)
            ->where('lang',$member->lang)
            ->get();

        // 创建未读消息提醒
        if($unread){
            $member_message = [];
            foreach($unread as $item){
                array_push($member_message,[
                    'member_id' => $member->id,
                    'message_id' => $item->id,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->created_at
                ]);
            }

            MemberMessage::insert($member_message);
        }

        $limit = $request->get('limit',10);
        $mod = Message::query()->memberMessage($member->id)->where('messages.pid','=',0);
        $collection = $mod->get();
        $result = $mod->paginate($limit);
        return $this->success([
            'data' => $result,
            // 'data' => $mod->get(),
            'unread' => $collection->where('is_read',0)->count(),
            'notice' => $collection->where('send_type',Message::SEND_TYPE_ADMIN)->where('is_read',0)->count(),
        ]);
    }

    // 获取用户已发送站内信列表
    public function message_send_list(Request $request){
        $this->member = $this->getMember();
        $limit = $request->get('limit',10);
        /**
        $result = Message::query()
            ->with('parent:id,member_id,url,user_id,title,content,created_at')
            ->select('id','member_id','pid','title','content','url','created_at')
            ->where('visible_type',Message::VISIBLE_TYPE_ADMIN)
            ->where('send_type',Message::SEND_TYPE_MEMBER)
            ->where('member_id',$this->member->id)
            ->latest()
            ->paginate($limit);
         */
        $result = Message::query()
            ->with('child:id,member_id,url,user_id,pid,title,content,created_at')
            ->select('id','member_id','pid','title','content','url','created_at')
            ->where('visible_type',Message::VISIBLE_TYPE_ADMIN)
            ->where('send_type',Message::SEND_TYPE_MEMBER)
            ->where('member_id',$this->member->id)
            ->latest()
            ->paginate($limit);
        return $this->success(['data' => $result]);
    }

    // 站内信接口 获取未读信息
    /*
    public function message_unread_list(){
        $member = $this->member;
        // 查询是否有未创建的用户通知
        $unread = Message::query()->where('visible_type',Message::VISIBLE_TYPE_ALL)
            ->whereDoesntHave('member_message',function($query) use($member){
                $query->where('member_id',$member->id);
            })
            // 会员创建之后的站内信通知
            ->where('created_at','>',$member->created_at)
            ->get();

        // 创建未读消息提醒
        if($unread){
            $member_message = [];
            foreach($unread as $item){
                array_push($member_message,[
                    'member_id' => $member->id,
                    'message_id' => $item->id
                ]);
            }

            MemberMessage::insert($member_message);
        }

        $result = Message::query()->memberRead($member->id,false)->get();
        return $this->success(['data' => $result]);
    }
    */

    // 用户发送站内信
    public function message_send(Request $request,Message $message){
        $this->member = $this->getMember();
        $data = $request->only('title','content');

        $this->validateRequest($data,[
            "title" => 'required|min:2',
            'content' => 'required|min:2',
        ],[],$this->getLangAttribute('message'));

        if($message) $data['pid'] = $message->id;
        $data['member_id'] = $this->member->id;
        $data['visible_type'] = Message::VISIBLE_TYPE_ADMIN;
        $data['send_type'] = Message::SEND_TYPE_MEMBER;

        $data = array_filter_null($data);

        if($res = Message::create($data)){
            return $this->success(['data' => $res],trans('res.api.message.send_success'));
        }else{
            return $this->failed(trans('res.api.message.send_fail'));
        }
    }

    // 获取用户已读站内信列表
    /*
    public function message_read_list(){
        $result = Message::query()->memberRead($this->member->id,true)->get();
        return $this->success(['data' => $result]);
    }
    */

    // 站内信标记已读
    /*
    public function message_read(Message $message){
        $this->member = $this->getMember();

        $member_message = MemberMessage::query()
            ->where('member_id',$this->member->id)
            ->where('message_id',$message->id)->firstOrFail();

        if($member_message->update([
            'is_read' => 1,
            'read_at' => Carbon::now()
        ])){
            return $this->success([],'站内信已读成功');
        }else{
            return $this->failed('站内信已读失败');
        }
    }
    */

    public function message_read_state(Request $request){
        $this->member = $this->getMember();

        $data = $request->only('ids','state');

        $this->validateRequest($data,[
            'ids' => 'required',
            'state' => 'required|boolean'
        ]);
		var_dump($data);

        $data['ids'] = is_array($data['ids']) ? $data['ids'] : [$data['ids']];

        //$member_messages = MemberMessage::query()->whereIn('message_id',$data['ids'])->get();

        $msg = Arr::get(trans('res.option.is_read'),intval($data['state']));
        if(MemberMessage::query()->whereIn('message_id',$data['ids'])->update([
            'is_read' => $data['state']
        ])){
            return $this->success([],trans('res.api.message.update_success').$msg);
        }else{
            return $this->success([],trans('res.api.message.update_fail'));
        }
    }

    /**
    public function message_read_batch(Request $request){
        $this->member = $this->getMember();

        $ids = $request->get('ids',[]);

        $member_messages = MemberMessage::query()->whereIn('message_id',$ids)->get();

        if($member_messages->update([
            'is_read' => 1,
            'read_at' => Carbon::now()
        ])){
            return $this->success([],'站内信批量已读成功');
        }else{
            return $this->failed('站内信批量已读失败');
        }
    }

    // 将站内信标记为未读
    public function message_unread(Message $message){
        $this->member = $this->getMember();

        $member_message = MemberMessage::query()
            ->where('member_id',$this->member->id)
            ->where('message_id',$message->id)->firstOrFail();

        if($member_message->update([
            'is_read' => 0,
            // 'read_at' => null
        ])){
            return $this->success([],'站内信标记未读成功');
        }else{
            return $this->failed('站内信标记未读失败');
        }
    }

    public function message_unread_batch(Request $request){
        $this->member = $this->getMember();

        $ids = $request->get('ids',[]);

        $member_messages = MemberMessage::query()->whereIn('message_id',$ids)->get();

        if($member_messages->update([
            'is_read' => 0
        ])){
            return $this->success([],'站内信批量标记未读成功');
        }else{
            return $this->failed('站内信批量标记未读失败');
        }
    }
     */

    // 站内信删除
    public function message_delete(Request $request){
        $this->member = $this->getMember();
        // 如果有 message 参数，表示删除的是 message

        $ids = $request->only('ids'); // 这里的ids 是 message_id 数组
        $ids = is_array($ids) ? $ids : [$ids];

        $mod = MemberMessage::where('member_id',$this->member->id)->whereIn('message_id',$ids);
        if($request->get('message')) $mod = Message::whereIn('id',$ids)->where('member_id',$this->member->id);

        if($mod->delete()){
            return $this->success([],trans('res.api.message.delete_success'));
        }else{
            return $this->failed(trans('res.api.message.delete_fail'));
        }
    }

    public function message_delete_all(Request $request){
        $this->member = $this->getMember();

        $mod = MemberMessage::where('member_id',$this->member->id);

        if($mod->delete()){
            return $this->success([],trans('res.api.message.delete_success'));
        }else{
            return $this->failed(trans('res.api.message.delete_fail'));
        }
    }

    /*
    public function message_delete(Message $message, Request $request){
        $this->member = $this->getMember();
        // 如果有 message 参数，表示删除的是 message
        $mod = MemberMessage::query()
        ->where('member_id',$this->member->id)
        ->where('message_id',$message->id)->first();

        if(!$mod){
            $mod = $message;
        }

        if($mod->delete()){
            return $this->success([],'站内信删除成功');
        }else{
            return $this->failed('站内信删除失败');
        }
    }
    */

    // 修改 会员密码
    public function modify_pwd(Request $request){
        $member = $this->getMember();

        $data = $request->only(['oldpassword','password','password_confirmation']);

        $this->validateRequest($data,[
            'oldpassword' => 'required|min:6',
            'password' => 'required|confirmed|min:6|different:oldpassword',
            'password_confirmation' => 'required|min:6|same:password'
        ],[],$this->getLangAttribute('modify_pwd'));

        if (!Hash::check($data['oldpassword'], $member->password)){
            return $this->failed(trans('res.api.modify_pwd.password_error'));
        }

        if($member->update([
            'password' => $data['password']
        ])){
            return $this->success([],trans('res.api.modify_pwd.password_success'));
        }else{
            return $this->failed(trans('res.api.modify_pwd.password_fail'));
        }
    }

    // 设置取款密码
    public function set_qk_pwd(Request $request){
        $data = $request->only('qk_pwd');

        $member = $this->getMember();

        if($member->qk_pwd && strlen($member->qk_pwd) == 6){
            return $this->failed(trans('res.api.modify_pwd.qk_pwd_set'));
        }

        $this->validateRequest($data,[
            "qk_pwd" => 'required|min:6|max:6',
        ],[],$this->getLangAttribute('qk_pwd'));

        $member = $this->getMember();
        if($member->update([
            'qk_pwd' => $data['qk_pwd']
        ])){
            return $this->success([],trans('res.api.modify_pwd.qk_pwd_success'));
        }else{
            return $this->failed(trans('res.api.modify_pwd.qk_pwd_fail'));
        }
    }

    // 修改 取款密码
    public function modify_qk_pwd(Request $request){
        $member = $this->getMember();

        $data = $request->only(['old_qk_pwd','qk_pwd','qk_pwd_confirmation']);

        $this->validateRequest($data,[
            "old_qk_pwd" => 'required|min:6|max:6',
            "qk_pwd" => 'required|min:6|max:6|different:old_qk_pwd',
            'qk_pwd_confirmation' => 'required|min:6|same:qk_pwd',
        ],[],$this->getLangAttribute('qk_pwd'));

        if($member->qk_pwd != $data['old_qk_pwd']){
            return $this->failed(trans('res.api.modify_pwd.qk_pwd_error'));
        }

        if($member->update([
            'qk_pwd' => $data['qk_pwd']
        ])){
            return $this->success([],trans('res.api.modify_pwd.qk_pwd_set_success'));
        }else{
            return $this->failed(trans('res.api.modify_pwd.qk_pwd_set_fail'));
        }
    }


    // 抢红包接口
    public function get_redbag(Request $request){
        $member = $this->getMember();
        $times = $request->get('times') ? (int) $request->get('times') : 1;
        $times = $times < 1 ? 1 : $times;

        try{
            // 获取红包的最大值和最小值，取随机数
            $config = SystemConfig::getConfigGroup('activity',Base::LANG_COMMON);

            if(!$config['is_redbag_open']) return $this->failed(trans('res.api.redbag.not_open'));

            // 判断用户今日次数是否用完
            $count = MemberMoneyLog::where('member_id',$member->id)
                ->where('operate_type',MemberMoneyLog::OPERATE_TYPE_HONGBAO)
                ->whereDate('created_at',Carbon::today())->count();

            // 根据当日存款金额和有效投注，获取可抢红包的次数
            $can_times = $this->getRedbagTimes($member);
            if($count >= $can_times) return $this->failed(trans('res.api.redbag.no_times'));

            $red_config = $config['redbag_size_setting_json'] ? json_decode($config['redbag_size_setting_json'], true) : [];
            $min_money = $red_config[$member->lang]['b'][0] ?? 0;
            $max_money = $red_config[$member->lang]['b'][1] ?? 0;

            $yet_times = $can_times - $count - $times;
            $yet_times = $yet_times <= 0 ? $times - abs($yet_times) : $yet_times;
            if ($yet_times > 0) {
                for ($i = 0; $i < $yet_times; $i++){
                    $money = randomFloat($min_money,$max_money);
                    $money_type = 'fs_money';
                    if($config['activity_money_type']) $money_type = $config['activity_money_type'];

                    $money_before = $member->$money_type;

                    DB::transaction(function() use($member, $money,$money_before,$money_type,$count){
                        $member->increment($money_type,$money);

                        MemberMoneyLog::create([
                            'member_id' => $member->id,
                            'money' => $money,
                            'money_before' => $money_before,
                            'money_after' => $member->$money_type,
                            'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                            'operate_type' => MemberMoneyLog::OPERATE_TYPE_HONGBAO,
                            'money_type' => $money_type,
                            'description' => '会员【'.$member->name.'】今日第【'.$count.'】次抢红包，红包金额为【'.$money.'元】'
                        ]);
                    });
                }
            }

        }catch(Exception $e){
            return $this->failed(trans('res.api.common.operate_fail').$e->getMessage());
        }

        return $this->success([],trans('res.api.redbag.success',['money' => $money]));
    }

    public function get_redbag_log(Request $request)
    {
        $member = $this->getMember();
        $limit = $request->get('limit',10);

        $data = [
            'operate_type' => MemberMoneyLog::OPERATE_TYPE_HONGBAO,
            'member_id' => $member->id
        ];

        $result = MemberMoneyLog::query()
                                ->where($this->convertWhere($data))
            ->orderByDesc('created_at')
                                ->paginate($limit);

        return $this->success([
            'data' => $result,
        ]);
    }

    public function get_redbag_desc(Request $request)
    {
        $member = $this->getMember();
        if ($member) {
            $times = $this->getRedbagTimes($member);
        }else {
            $times = 0;
        }
        $lang = $request->get('lang') ?: 'zh_cn';
        $data = systemconfig('redbag_desc_setting_json');
        if($data) {
            $data = json_decode($data,1);
            $data = $data[$lang] ?? '';
        } else {
            $data = '';
        }

        return $this->success([
            'data' => $data,
            'times' => $times
        ]);
    }

    public function getRedbagTimes(Member $member){
        $now = Carbon::now();

        // 获取 今天的流水和充值记录
        $save_amount = Recharge::where('member_id',$member->id)
            ->whereDate('created_at',$now)
            ->where('status',Recharge::STATUS_SUCCESS)->sum('money');

        $total_valid_bet = GameRecord::whereDate('created_at',$now)
            ->where('member_id',$member->id)
            ->where('status','<>','X')
            ->sum('validBetAmount');

        $json = \systemconfig('redbag_setting_json',Base::LANG_COMMON);
        $config = json_decode($json,1);
        $config = $config[$member->lang] ?? [];
        if(count($config) == 0) return 0;

        $times = 0;
        foreach ($config as $item){
            if($save_amount >= $item['deposit'] && $total_valid_bet >= $item['deposit'] * $item['valid_num'])
                $times = max($times,$item['times']);
        }

        return $times;
    }

    // 签到接口
    public function daily_bonus_check(Request $request){
        $is_open = SystemConfig::getConfigValue('is_daily_bonus_open',Base::LANG_COMMON);

        if(!$is_open){
            return $this->failed(trans('res.api.dailybonus.not_open'));
        }

        $member = $this->getMember();
        // 判断今天是否已经签到过
        if(DailyBonus::whereDate('created_at',Carbon::today())
            ->where('type',DailyBonus::TYPE_NORMAL_CHECK_IN)
            ->where('lang',$member->lang)
            ->where('member_id',$member->id)->count() > 0){
            return $this->failed(trans('res.api.dailybonus.no_times'));
        }

        // 判断昨天是否签到过
        $yesterday = DailyBonus::whereDate('created_at',Carbon::yesterday())
            ->where('type',DailyBonus::TYPE_NORMAL_CHECK_IN)
            ->where('lang',$member->lang)
            ->where('member_id',$member->id)->first();

        $serial_day = 1;
        $total_day = 1;

        if($yesterday){
            $serial_day = $yesterday->serial_days + 1;
            $total_day = $yesterday->total_days + 1;
        }else{
            // 判断最近是否签过到
            $latest = DailyBonus::where('member_id',$member->id)
                ->where('type',DailyBonus::TYPE_NORMAL_CHECK_IN)
                ->where('lang',$member->lang)
                ->latest()->first();

            if($latest){
                $total_day = $latest->total_days + 1;
            }
        }

        // 插入数据
        $data = [
            'member_id' => $member->id,
            'serial_days' => $serial_day,
            'total_days' => $total_day,
            'type' => DailyBonus::TYPE_NORMAL_CHECK_IN,
            'state' => 1,
            'lang' => $member->lang
        ];

        if(DailyBonus::create($data)){
            return $this->success([],trans('res.api.dailybonus.success'));
        }else{
            return $this->failed(trans('res.api.dailybonus.fail'));
        }
    }

    // 签到领奖
    public function daily_bonus_award(DailyBonus $mod,Request $request){
        // 检查是否符合要求
        if(!$mod->isSetting()){
            return $this->failed(trans('res.api.common.operate_forbidden'));
        }

        $member = $this->getMember();

        // 判断是否已经领奖
        $count = 0;
        $type = $serial_days = $total_days = 0;

        // 连续签到
        if($mod->type == DailyBonus::TYPE_SERIAL_SETTING){
            $type = DailyBonus::TYPE_SERIAL_AWARD;
            $serial_days = $mod->days;

            if(DailyBonus::where('member_id',$member->id)
                    ->where('lang',$member->lang)
                    ->where('type',DailyBonus::TYPE_NORMAL_CHECK_IN)->max('serial_days') < $serial_days)
                return $this->failed(trans('res.api.dailybonus.check_day_not_enough'));

            $count = DailyBonus::where('type',$type)
                ->where('member_id',$member->id)
                ->where('lang',$member->lang)
                ->where('serial_days',$mod->days)
                ->count();
        }else if($mod->type == DailyBonus::TYPE_TOTAL_SETTING){
            $type = DailyBonus::TYPE_TOTAL_AWARD;
            $total_days = $mod->days;

            if(DailyBonus::where('member_id',$member->id)
                    ->where('lang',$member->lang)
                    ->where('type',DailyBonus::TYPE_NORMAL_CHECK_IN)->max('total_days') < $total_days)
                return $this->failed(trans('res.api.dailybonus.check_day_not_enough'));

            $count = DailyBonus::where('type',$type)
                ->where('member_id',$member->id)
                ->where('lang',$member->lang)
                ->where('total_days',$mod->days)
                ->count();
        }

        if($count > 0) return $this->failed(trans('res.api.dailybonus.check_repeat'));

        $isAuto = SystemConfig::getConfigValue('is_daily_bonus_auto',Base::LANG_COMMON);

        $data = [
            'member_id' => $member->id,
            'bonus_money' => $mod->bonus_money,
            'type' => $type,
            'serial_days' => $serial_days,
            'total_days' => $total_days,
            'lang' => $member->lang,
            'state' => $isAuto ? DailyBonus::STATE_ENSURE : DailyBonus::STATE_NOT_DEAL
        ];


        if(DailyBonus::create($data)){
            return $this->success(['data' => $data],$isAuto ? trans('res.api.dailybonus.check_success'):trans('res.api.dailybonus.check_admin_check'));
        }else{
            return $this->failed(trans('res.api.common.operate_again'));
        }
    }

    // 本月签到记录
    public function daily_bonus_history(Request $request){
        $member = $this->getMember();
        $limit = $request->get('limit',10);

        $data = [
            'member_id' => $member->id
        ];

        $result = DailyBonus::whereBetween('created_at',[Carbon::now()->firstOfMonth(),Carbon::now()->lastOfMonth()])
            ->where('member_id',$member->id)
            ->where('lang',$member->lang)
            ->where('type',DailyBonus::TYPE_NORMAL_CHECK_IN)
            ->pluck('created_at')->map(function($item,$key){
                return Carbon::parse($item)->day;
            })->all();
        // $result = ;

        //$this->api_print($result);
        return $this->success(['data' => [
            'checked_day' => $result
        ]]);
    }

    // 签到奖励记录
    public function daily_bonus_money_history(Request $request){

        $member = $this->getMember();
        $limit = $request->get('limit',10);

        $data = [
            'operate_type' => MemberMoneyLog::OPERATE_TYPE_QIANDAO,
            'member_id' => $member->id
        ];

        $result = MemberMoneyLog::query()
                ->where($this->convertWhere($data))
                ->paginate($limit);

        return $this->success([
            'data' => $result,
        ]);
    }

    public function daily_bonus_award_history(Request $request){
        $member = $this->getMember();
        $result = DailyBonus::where('member_id',$member->id)
            ->where('lang',$member->lang)
            ->whereIn('type',[DailyBonus::TYPE_TOTAL_AWARD,DailyBonus::TYPE_SERIAL_AWARD])
            ->where('bonus_money','>',0)
            ->get(['type','serial_days','total_days','bonus_money','state','created_at']);
        return $this->success(['data' => $result]);
    }

    // 可领取奖励列表
    public function daili_award_list(Request $request){
        $member = $this->getMember();

        $result = DailyBonus::whereIn('type',[DailyBonus::TYPE_SERIAL_SETTING,DailyBonus::TYPE_TOTAL_SETTING])
            ->where('lang',$member->lang)
            ->where('bonus_money','>',0)->get();

        return $this->success(['data' => [
            'list' => $result,
            'config' => trans('res.option.daily_bonus_set')
        ]]);
    }

    // 领取实时反水
    public function fs_now_list(){
        $member = $this->getMember(1);

        if($member->isDemo()) return $this->success(['data' => [],'deadtime' => time()]);

        $fslist = $this->getFsNow();

        return $this->success([
            'data' => array_values($fslist->toArray()),
            'deadtime' => time(),
            // 今日洗码，昨日洗码，洗码累计
            'today' => MemberMoneyLog::where('member_id',$member->id)->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)->where('created_at','>',today())->sum('money'),
            'yesterday' => MemberMoneyLog::where('member_id',$member->id)->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)->whereBetween('created_at',[today()->subDay(),today()])->sum('money'),
            'total' => MemberMoneyLog::where('member_id',$member->id)->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)->sum('money')
        ]);
    }

    public function fs_now(Request $request){
        $data = $request->all();

        if(!\systemconfig('is_realtime_fs_mode',Base::LANG_COMMON)) return $this->failed(trans('res.api.fs_now.fs_not_open'));

        $this->validateRequest($data,[
            'deadtime' => 'required|numeric'
        ],[
            'deadtime.required' => trans('res.api.common.operate_error')
        ]);
        $member = $this->getMember();
        $this->checkRequestLimit($member->name,'fs_now',60);
        $fslist = $this->getFsNow($data['deadtime']);

        $money_type = 'fs_money';
        if(\systemconfig('member_fs_money_type',Base::LANG_COMMON)) $money_type = \systemconfig('member_fs_money_type',Base::LANG_COMMON);

        $money = $fslist->sum('fs_money');
        if($money <= 0) return $this->failed(trans('res.api.fs_now.fs_no_data'));

        $time = date('Y-m-d H:i:s',$data['deadtime']);

        try{
            DB::transaction(function() use ($fslist,$member,$time,$money_type,$money){
                GameRecord::where('member_id',$member->id)
                    ->where('created_at','<',$time)
                    ->update([
                        'is_fs' => 1
                    ]);

                $money_before = $member->$money_type;

                foreach ($fslist->toArray() as $item){
                    $item->deadtime = $time;
                    $json = json_encode($item,JSON_UNESCAPED_UNICODE);

                    // 查询该用户三分钟内是否存在该领取记录
                    if(MemberMoneyLog::where('member_id',$member->id)
                        ->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)
                        ->where('remark',$json)->where('created_at','>',Carbon::now()->subMinutes(2))->exists())
                        throw new InvalidRequestException(trans('res.api.fs_now.fs_repeat'));

                    $member->increment($money_type,floatval($item->fs_money));

                    MemberMoneyLog::create([
                        'member_id' => $member->id,
                        'money' => $item->fs_money,
                        'money_before' => $money_before,
                        'money_after' => $member->$money_type,
                        'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                        'operate_type' => MemberMoneyLog::OPERATE_TYPE_FANSHUI,
                        'money_type' => $money_type,
                        // 'description' => "领取日期【{$time}】之前的反水，金额为【{$money}】，游戏类型【".$item->game_type_text."】，发放至反水钱包",
                        'description' => trans('res.member_money_log.notice.get_fs_now',[
                            'time' => $time,
                            'money' => $money,
                            'game_type' => $item->game_type_text
                        ], $member->lang),
                        'remark' => json_encode($item)
                    ]);

                    $money_before = $member->$money_type;
                }

            });
        }catch (Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.api.common.operate_fail').$e->getMessage());
        }

        return $this->success([],trans('res.api.fs_now.get_success'));
    }

    // 返回 collection
    public function getFsNow($deadtime = ''){
        $member = $this->getMember();

        // 判断反水等级是否每个类型都已经设置
        if(FsLevel::where('type',FsLevel::TYPE_SYSTEM)
                ->where('lang',$member->lang)
                ->where('level',1)->distinct()->count() < count(config('platform.game_type')) - 1)
            throw new InvalidRequestException(trans('res.api.fs_now.fs_level_err'));

        // 获取用户所有没有获取过反水的游戏记录，分类获取有效投注金额 和 gametype api_name
        $gamerecords = DB::table('game_records')
            ->select(\DB::raw('sum(validBetAmount) as total_valid,gameType,GROUP_CONCAT(DISTINCT api_name SEPARATOR ",") as api_names'))
            ->where('member_id',$member->id)->where('is_fs',0)
            ->where('validBetAmount','>',0)
            ->when($deadtime,function($query) use($deadtime){
                $query->where('created_at','<',date('Y-m-d H:i:s',$deadtime));
            })
            ->groupBy('gameType');

        // if(!$gamerecords->count()) throw new InvalidRequestException(trans('res.api.fs_now.fs_no_data'));
//            ->get();

        // 匹配反水等级
        $data = DB::table('fs_levels')
            ->rightJoinSub($gamerecords,'gr',function($join){
                $join->on('fs_levels.game_type','=','gr.gameType')
                    ->on('fs_levels.quota','<','gr.total_valid');
            })
            // ->where('fs_levels.quota','>=','fs_levels.quota')
            ->where('fs_levels.rate','>=','fs_levels.rate')
            ->where('fs_levels.lang',$member->lang)
            ->whereIn('member_id',[0,$member->id])
            ->orderBy('game_type','desc')
            ->orderBy('quota','desc')
            ->get(['fs_levels.name','fs_levels.quota','fs_levels.rate','fs_levels.game_type']);

        if(!$data->count()) return collect([]);

        $gamerecords = $gamerecords->get()->transform(function($item) use($data){
            // 获取最大的fs_level
            $fs_level = $data->where('game_type',$item->gameType)->first();

            if(!$fs_level) return [];
            // if(!$fs_level) throw new InvalidRequestException('未配置反水等级，请联系客服');

            $item->rate = $fs_level->rate;
            $item->fs_money = floatval(sprintf("%.2f",  $item->total_valid * $fs_level->rate/100));
            $item->game_type_text = isset_and_not_empty(config('platform.game_type'),$item->gameType,'');
            return $item;
        });

        return $gamerecords->filter(function($value){return $value;});
    }

    public function agent_data(){
        $member = $this->getMember();

        if(!$agent = $member->agent) return $this->failed(trans('res.api.apply_agent.not_agent'));

        $return = [
            'agent_site' => route('agent.login'),
            'share_link' => $agent->getAgentUri(),
            'share_link_qrcode' => 'https://api.pwmqr.com/qrcode/create/?url='.urlencode($agent->getAgentUri()),
            'member_count' => count(app(AgentService::class)->getChildMemberIds($member))
        ];

        return $this->success(['data' => $return]);
    }

    // 获取余额宝方案
    public function getMemberYuebaoList(){
        $member = $this->getMember();

        // 限制时间
        $data = YuebaoPlan::where('is_open',1)->langs($member->lang)
            ->withCount(['member_plans as RemainingCount' => function($query){
            $query->select(DB::raw("(TotalCount - sum(amount))as plans_sum"));
        }])
            ->withCount(['member_plans as UserOrderCount' => function($query) use($member) {
            $query->where('member_id',$member->id)->select(DB::raw("sum(amount) as member_sum"));
            }])->get();

        // 查出会员所有方案的最后一条购买记录
        $lastPlans = MemberYuebaoPlan::whereIn('plan_id',$data->pluck('id'))->latest()->get();

        $data->transform(function($item) use ($lastPlans,$member){
            $last = $lastPlans->where('plan_id',$item->id)->where('member_id',$member->id)->first();
            $item->LimitOrderInterval = ($item->LimitOrderIntervalTime && $last) ? $last->created_at->addHours($item->LimitOrderInterval) : null;
            $item->LimitOrderInterval = ($item->LimitOrderInterval && $item->LimitOrderInterval->gt(Carbon::now())) ? $item->LimitOrderInterval->format('Y-m-d H:i:s') : null;
            $item->RemainingCount = $item->RemainingCount ?? $item->TotalCount;
            return $item;
        });

        return $this->success(['data' => $data]);
    }

    // 获取会员的余额宝购买记录
    public function getMemberPlans(Request $request){
        $member = $this->getMember();

        $status = $request->get('status',0);

        // 计算利息
        app(ActivityService::class)->yuebao_calc($member);

        // 查询符合要求的 member_yuebao_plans
        $member_plans = MemberYuebaoPlan::where('member_id',$member->id)->where('status',$status);

        // Interest 总利润 NextInterestTime 下次利息时间
        $data = DB::table('yuebao_plans')
            ->select('yuebao_plans.*','m.amount','m.created_at as CreatedOn','m.id as member_plan_id','m.drawing_at as drawing_at','m.status as status')
            /*
            ->join('member_yuebao_plans',function($join) use ($member,$status){
            $join->on('member_yuebao_plans.plan_id','=','yuebao_plans.id')
                ->where('member_yuebao_plans.member_id',$member->id)
                ->where('status',$status);
        })
            */
            ->joinSub($member_plans,'m',function($join) {
                $join->on('m.plan_id','=','yuebao_plans.id');
            })->orderByDesc('CreatedOn');

        //

        // 根据 member_plans_id 获取最后结算时间 和 次数
        $histories = InterestHistory::whereIn('member_plan_id',$member_plans->pluck('id'))->orderByDesc('calc_at')->get();

        // 计算统计数据
        $Summery = [
            'TotalCount' => $data->count(),
            'Principal' => $data->sum('amount'),
            'Interest' => $histories->sum('interest'),
            'TotalLimitInterest' => $data->sum('LimitInterest')
        ];

        $paginate_data = $data->paginate(10);

        // 计算分页中的 返利次数和下次返利时间
        $paginate_data->getCollection()->transform(function($item) use($histories){
            $history = $histories->where('member_plan_id',$item->member_plan_id)->first();
            // 计算当前总利息
            $item->Interest = $histories->where('member_plan_id',$item->member_plan_id)->sum('interest');

            // 下次返利时间
            $item->NextInterestTime = Carbon::parse($item->CreatedOn)->addHours($item->SettleTime * ($history ? $history->times + 1 : 1) )->format('Y-m-d H:i:s');

            $item->NextInterestTime = ($item->IsCycleSettle || !$history )? $item->NextInterestTime : $history->calc_at;
            $item->history = $history;

            $item->drawing_at = $item->drawing_at ? Carbon::parse($item->drawing_at)->format('Y-m-d H:i:s') : $item->drawing_at;

            // $item->InterestHistory = $histories->where('member_plan_id',$item->member_plan_id)->sortByDesc('calc_at');
            return $item;
        });

        return $this->success(['data' => $paginate_data,'summery' => $Summery]);
    }

    // 购买余额宝的方案
    public function buy_plans(Request $request){
        $member = $this->getMember();

        $data = $request->all();
        $this->validateRequest($data,[
            'plan_id' => 'required',
            'amount' => ['required','numeric','min:0','regex:/^[1-9][0-9]*0$/']
        ],['plan_id.required' => trans('res.api.yuebao.plan_require'),
            'amount.regex' => trans('res.api.yuebao.amount_regex'),$this->getLangAttribute('yuebao_plan')]);

        $plan = YuebaoPlan::find($data['plan_id']);
        if(!$plan) return $this->failed(trans('res.api.yuebao.plan_not_exist'));

        // 检查剩余数量
        if($plan->TotalCount <= $plan->member_plans->sum('amount')) return $this->failed(trans('res.api.yuebao.plan_sold_out'));

        // 检查限制时间

        // 检查购买数量
        if($plan->LimitUserOrderCount && $plan->LimitUserOrderCount < $plan->member_plans->where('member_id',$member->id)->sum('amount')) return $this->failed(trans('res.api.yuebao.no_enough_amount'));

        // $money_type = 'fs_money';
        // if(\systemconfig('activity_money_type')) $money_type = \systemconfig('activity_money_type');

        $money_type = 'money';
        $money_before = $member->$money_type;

        // 判断账户余额是否足够
        if($data['amount'] > $member->$money_type) return $this->failed(trans('res.api.yuebao.member_no_money'));

        // 确认购买
        try{
            DB::transaction(function() use ($member,$data,$money_type,$money_before){
                // 购买记录
                $mp = MemberYuebaoPlan::create([
                    'member_id' => $member->id,
                    'plan_id' => $data['plan_id'],
                    'amount' => $data['amount'],
                ]);

                // 账户扣除金额
                $member->decrement($money_type,$data['amount']);

                // 金额日志
                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $data['amount'],
                    'money_before' => $money_before,
                    'money_after' => $member->money,
                    'money_type' => $money_type,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_SUB,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_FINANCIAL,
                    'description' => '会员买入余额宝【'.$data['amount'].'元】',
                    'model_name' => \get_class($mp),
                    'model_id' => $mp->id
                ]);

            });
        }catch(Exception $e){
            return $this->failed(trans('res.api.common.operate_fail').$e->getMessage());
        }

        return $this->success([],trans('res.api.yuebao.success'));
    }

    // 历史利息记录
    public function plans_history(Request $request){
        $member = $this->getMember();

        $data = $request->all();

        $this->validateRequest($data,[
            'record_id' => 'required|exists:member_yuebao_plans,id'
        ]);

        $history = InterestHistory::where('member_plan_id',$data['record_id'])->orderByDesc('calc_at')->get();
        return $this->success(['data' => $history]);
    }

    public function yuebao_drawing(Request $request){
        $member = $this->getMember();

        $data = $request->all();

        $this->validateRequest($data,[
            'record_id' => 'required|exists:member_yuebao_plans,id'
        ]);

        // 判断是否一致
        $member_plan = MemberYuebaoPlan::find($data['record_id']);

        if($member_plan->member_id != $member->id || $member_plan->status == MemberYuebaoPlan::STATUS_DONE) return $this->failed(trans('res.api.common.operate_again'));

        $total_interest = $member_plan->history->sum('interest');
        $total_money = $member_plan->amount + $total_interest;

        // 修改 plan 状态，并增加金额和码量，记录日志
        try{
            $money_type = 'money';
            $before_money = $member->money;
            DB::transaction(function() use ($member, $money_type, $before_money, $member_plan,$total_money,$total_interest) {
                $member_plan->update([
                    'status' => MemberYuebaoPlan::STATUS_DONE,
                    'drawing_at' => Carbon::now()
                ]);

                // 记录两次日志，一次 分红日志，一次 赎回日志
                $member->increment($money_type, $member_plan->amount);
                // 分红日志
                MemberMoneyLog::create([
                    'member_id' => $member->id,
                    'money' => $member_plan->amount,
                    'money_before' => $before_money,
                    'money_after' => $member->money,
                    'money_type' => $money_type,
                    'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_FINANCIAL_RETURN,
                    'description' => '余额宝赎回退还本金【'.$member_plan->amount.'元】',
                    'model_name' => \get_class($member_plan),
                    'model_id' => $member_plan->id
                ]);

                if($total_interest) {
                    // 'operate_type' => MemberMoneyLog::OPERATE_TYPE_FINANCIAL_INTEREST,
                    $before_money = $member->money;
                    $member->increment($money_type, $total_interest);
                    $member->increment('ml_money', $total_interest);
                    MemberMoneyLog::create([
                        'member_id' => $member->id,
                        'money' => $total_interest,
                        'money_before' => $before_money,
                        'money_after' => $member->money,
                        'money_type' => $money_type,
                        'number_type' => MemberMoneyLog::MONEY_TYPE_ADD,
                        'operate_type' => MemberMoneyLog::OPERATE_TYPE_FINANCIAL_INTEREST,
                        'description' => '余额宝分红金额【'.$total_interest.'】元，增加利息金额的码量【'.$total_interest.'元】',
                        'model_name' => \get_class($member_plan),
                        'model_id' => $member_plan->id
                    ]);
                }
            });
        }catch (Exception $e) {
            DB::rollBack();
            return $this->failed(trans('res.api.common.operate_fail').$e->getMessage());
        }

        return $this->success(['money' => $total_money],trans('res.api.yuebao.back_success',['money' => $total_money]));
    }

    // 获取所有接口的开通情况和余额，以及钱包余额，计算总余额
    public function api_moneys(){
        $member = $this->getMember(1);

        /**
        $res = DB::table('apis')
            ->select('apis.api_name','apis.api_title','member_apis.money')
            ->leftJoin('member_apis',function($join) use ($member){
            $join->on('apis.api_name','=','member_apis.api_name')
                ->where('member_apis.member_id',$member->id);
        })->where('apis.is_open',1)->orderBy('weight','desc')->get();
        */

        $res = $this->getMemberApiFormatter();

        return $this->success(['data' => [
            'api_moneys' => $res
        ]]);
    }

    // 需要参数 api_code
    // 刷新单个接口的余额，并返回单个接口的余额和中心钱包余额，以及会员的额度转换模式
    public function apimoney_single(Request $request){
        // 判断是否有 api_code 参数
        $data = $request->all();

        $this->validateRequest($data,[
            'api_code' => 'required'
        ]);

        $member = $this->getMember(1);

        $api_codes = [$data['api_code']];

        // 如果中心钱包没有余额，并且存在转入接口游戏的记录，查询接口游戏的余额，并转出游戏

        if($member->is_trans_on && $member->money < 1 && $last_transfer = Transfer::where('member_id',$member->id)->where('transfer_type',Transfer::TRANSFER_TYPE_IN)->latest()->first()){
            if($last_transfer->api_name != $data['api_code']){
                array_push($api_codes,$last_transfer->api_name);

                $request->merge(['api_code' => $last_transfer->api_name]);
                $balance_res = app(SelfController::class)->balance($request);

                $balance_res = json_decode($balance_res->getContent(),1);

                if($balance_res['status'] != 'success') return $this->failed($balance_res['message']);

                if($balance_res['money'] > 0){
                    $request->merge(['api_code' => $last_transfer->api_name,'money' => floor($balance_res['money'])]);
                    app(SelfController::class)->withdrawal($request);
                }
            }
        }

        /**
        $res = DB::table('apis')
            ->select('apis.api_name','apis.api_title','member_apis.money')
            ->leftJoin('member_apis',function($join) use ($member){
                $join->on('apis.api_name','=','member_apis.api_name')
                    ->where('member_apis.member_id',$member->id);
            })->where('apis.is_open',1)->where('apis.api_name',$data['api_code'])->first();
        **/

        $res = $this->getMemberApiFormatter($api_codes);

        if(!$res) return $this->failed(trans('res.api.common.operate_again'));

        $return = [
            'money_info' => $res,
            'is_trans_on' => $member->is_trans_on
        ];

        return $this->success(['data' => $return]);
    }

    public function getMemberApiFormatter($api_code = []){
        $member = $this->getMember(1);

        $res = DB::table('apis')
            ->select('apis.api_name','apis.api_title','member_apis.money')
            ->leftJoin('member_apis',function($join) use ($member){
                $join->on('apis.api_name','=','member_apis.api_name')
                    ->where('member_apis.member_id',$member->id);
            })->where('apis.is_open',1)
            ->when($api_code,function($query) use ($api_code) {
                $query->whereIn('apis.api_name',$api_code);
            })
            //->where('apis.lang','like',substr($member->lang, 0,2).'%')
			->where('apis.lang',$member->lang)
            ->orderBy('apis.weight','desc')
            ->orderBy('apis.created_at','desc')
            ->get()->transform(function($item){
                $item->money = $item->money ?? trans('res.api.transfer.api_not_open');
                return $item;
            });

        $res->prepend([
            'api_name' => 'fs_money',
            'api_title' => trans('res.api.transfer.field.fs_money'),
            'money' => $member->fs_money
        ]);

        $res->prepend([
            'api_name' => 'money',
            'api_title' => trans('res.api.transfer.field.money'),
            'money' => $member->money
        ]);

        return $res;
    }

    // 回收上次接口的分数
    public function recoveryLast(Request $request){
        // return $this->success(['data' => '']);

        $this->handleRecoveryLast();

        $res = $this->getMemberApiFormatter();

        return $this->success(['data' => [
            'api_moneys' => $res
        ]]);
    }

    public function handleRecoveryLast(){
        $member = $this->getMember(1);

        $api_code = request()->get('api_code');
        if(!$api_code){
            $last_transfer = Transfer::where('member_id',$member->id)->where('transfer_type',Transfer::TRANSFER_TYPE_IN)->latest()->first();
            $api_code = $last_transfer->api_name ?? '';

            if($api_code) request()->merge(['api_code' => $api_code]);
        }

        if(!$api_code) return '';

        $balance_res = app(SelfController::class)->balance(request());
        $balance_res = json_decode($balance_res->getContent(),1);

        if($balance_res['status'] != 'success')
            throw new InvalidRequestException($balance_res['message']);
        // return $this->failed($balance_res['message']);

        if($balance_res['money'] > 0){
            request()->merge(['api_code' => $api_code,'money' => floor($balance_res['money'])]);
            app(SelfController::class)->withdrawal(request());
        }

        return $api_code;
    }

    public function change_trans(Request $request){
        $member = $this->getMember(1);

        $data = $request->all();

        $this->validateRequest($data,[
            'status' => 'required|boolean|numeric'
        ],[
            'status.required' => trans('res.api.common.operate_error')
        ]);

        // 修改 自动转入状态
        $member->update([
            'is_trans_on' => $data['status']
        ]);

        if($data['status'] == 0) return $this->success([],trans('res.api.transfer.change_hand'));

        // 将上次转入接口的金额的钱转出至 中心钱包
        //$lastApi = Transfer::where('member_id',$member->id)->where('transfer_type',Transfer::TRANSFER_TYPE_IN)->latest()->first();
        /*
        $maxApi = $member->apis->sortByDesc('money')->first();

        $api_code = '';
        if($maxApi && $maxApi->money > 0){
            $api_code = $maxApi->api_name;

            $request->merge([
                'api_code' => $api_code,
                'money' => $maxApi->money
            ]);

            app(SelfController::class)->withdrawal($request);
        }
        */
        $api_code = $this->handleRecoveryLast();
        return $this->success(['api_code' => $api_code],trans('res.api.transfer.change_auto'));
    }

    // 收藏游戏
    public function add_favorite(Request $request){
        $member = $this->getMember(1);

        $data = $request->all();

        // 判断是否收藏该游戏
        $this->validateRequest($data,[
            'api_name' => 'required',
            'game_type' => ['required',Rule::in(array_keys(config('platform.game_type')))],
            'model_id' => 'required'
        ],[
            'api_name.required' => trans('res.api.common.operate_error'),
            'game_type.required' => trans('res.api.common.operate_error'),
            'model_id.required' => trans('res.api.common.operate_error'),
        ]);

        // 判断该游戏是否存在
        $model_name = app(Favorite::class)->getModelNameByGameType($data['game_type']);

        $mod = app($model_name)->where('api_name',$data['api_name'])->where('id',$data['model_id'])->first();

        if(!$mod) return $this->failed(trans('res.api.common.operate_error'));

        // 判断该游戏是否被该会员收藏过
        $flag = Favorite::where('api_name',$data['api_name'])->where('member_id',$member->id)->whereModel($mod)->exists();

        if(!$flag)
            Favorite::create([
                'member_id' => $member->id,
                'api_name' => $mod->api_name,
                'game_type' => $data['game_type'],
                'model_name' => $model_name,
                'model_id' => $mod->id
            ]);

        return $this->success([]);
    }

    // 取消收藏游戏
    public function delete_favorite(Request $request){
        $member = $this->getMember(1);

        $data = $request->all();

        // 判断是否收藏该游戏
        $this->validateRequest($data,[
            'api_name' => 'required',
            'game_type' => ['required',Rule::in(array_keys(config('platform.game_type')))],
            'model_id' => 'required'
        ],[
            'api_name.required' => trans('res.api.common.operate_error'),
            'game_type.required' => trans('res.api.common.operate_error'),
            'model_id.required' => trans('res.api.common.operate_error'),
        ]);

        // 判断该游戏是否存在
        $model_name = app(Favorite::class)->getModelNameByGameType($data['game_type']);

        $mod = app($model_name)->where('api_name',$data['api_name'])->where('id',$data['model_id'])->first();

        if(!$mod) return $this->failed(trans('res.api.common.operate_error'));

        // 判断该游戏是否被该会员收藏过
        $fav = Favorite::where('api_name',$data['api_name'])->where('member_id',$member->id)->whereModel($mod)->first();

        if($fav){
            $fav->delete();
        }
        return $this->success([]);
    }

    // 获取游戏收藏列表
    public function favorite_list(Request $request){
        $member = $this->getMember(1);

        $isMobile = $request->get('isMobile',0);

        $favs = Favorite::where('member_id',$member->id)
            ->when($request->get('game_type'),function($query) use($request){
                return $query->where('game_type',$request->get('game_type'));
        })->when($request->get('api_name'),function($query) use($request){
                return $query->where('api_name',$request->get('api_name'));
            })->latest()->get();

        $gamelists = GameList::whereIn('id',$favs->whereIn('game_type',[3,6])->pluck('model_id'))
            ->whereIn('client_type',$isMobile ? [0,2] : [0,1])->where('is_open',1)->get();

        $apigames = ApiGame::whereIn('id',$favs->whereNotIn('game_type',[3,6])->pluck('model_id'))
            ->whereIn('client_type',$isMobile ? [0,2] : [0,1])->where('is_open',1)->get();

        /**
        $favs->transform(function($item) use($gamelists,$apigames){
            if(in_array($item->game_type,[3,6])){
                $item->details = $gamelists->where('id',$item->model_id)->first();
            }else{
                $item->details = $apigames->where('id',$item->model_id)->first();
            }
            if($item->details) return null;

            return $item;
        });
        **/

        // 判断 is_open 字段
        return $this->success(['apigames' => $apigames,'gamelists' => $gamelists]);
    }

    // 付款凭证上传接口
    public function recharge_payment_pic_upload(Request $request){
        $member = $this->getMember(1);

        $this->validateRequest($request->all(), ['file' => 'required|file']);

        try{
            $file = $request->file('file');

            // 文件必须带有文件类型
            $file_name = explode('.', $file->getClientOriginalName());
            if (count($file_name) < 2) return $this->failed(trans('res.upload.file_type_error'));

            // 判断文件是否超过大小
            if($file->getSize() > 3 * 1024 * 1024) return $this->failed(trans('res.upload.file_size_error'));

            $result = app(FileUploadHandler::class)->uploadImage($file, 'recharge', $request->get("max_width", false));
        }catch(\Exception $e){
            return $this->failed($e->getMessage());
        }

        if ($result['status'] === true) {
            return $this->success(Arr::only($result['data'],['file_url']));
        } else {
            return $this->failed($result['message']);
        }
    }

    // VIP专属
    public function vip_info(){
        $member = $this->getMember(1);

        $data = LevelConfig::orderBy('level')->where('lang', $member->lang)->get();

        $memberLevels = LevelConfig::where('level',$member->level)->where('lang', $member->lang)->first();

        return $this->success([
            'data' => [
                'levels' => $data,
                'total_bet' => app(GameRecord::class)->getMemberTotalValidBet($member->id),
                'total_deposit' => Recharge::where('member_id',$member->id)->where('status',Recharge::STATUS_SUCCESS)->sum('money'),
                'levelup_types' => trans('res.option.levelup_types'),
                'member_levels' => [
                    'level_bonus' => $memberLevels->level_bonus ?? 0,
                    'day_bonus' => $memberLevels->day_bonus ?? 0,
                    'week_bonus' => $memberLevels->week_bonus ?? 0,
                    'month_bonus' => $memberLevels->month_bonus ?? 0,
                    'year_bonus' => $memberLevels->year_bonus ?? 0,
                ]
            ]
        ]);
    }

    public function vip1_fs_levels(Request $request){
        $member = $this->getMember();

        $data = FsLevel::where('type',FsLevel::TYPE_SYSTEM)
            ->where('lang',$member->lang)
            ->where('game_type',$request->get('game_type'))
            ->orderBy('level')->get();
        return $this->success(['data' => $data]);
    }
}
