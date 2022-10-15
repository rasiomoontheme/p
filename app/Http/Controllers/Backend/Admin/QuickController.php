<?php

namespace App\Http\Controllers\Backend\Admin;

// 快捷功能
use App\Models\Api;
use App\Models\Member;
use App\Models\MemberBank;
use App\Models\MemberMoneyLog;
use App\Models\Transfer;
use App\Services\SelfService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class QuickController extends AdminBaseController{

    // laravel-iframe.test/quick/arbitrage_query
    public function arbitrage_query(Request $request){
        // $tabs = config('platform.arbitrage_conditions');
        $tabs = trans('res.option.arbitrage_conditions');

        $sum = [];
        $data = [];
        // 查找注册统一IP的会员
        $sum['ip'] = Member::sumField('register_ip'); // [['count' => 1,'data' => '']]

        $data['ip'] = Member::fieldGroup('register_ip',$sum['ip']->pluck('register_ip'));
        // App
        //App\Models\Member::where('register_ip','127.0.0.1')->select('name','register_ip')->get()->mapToGroups(function ($item, $key) {return [$item['register_ip'] => $item['name']];});

        $sum['psw'] = Member::sumField('o_password');
        $data['psw'] = Member::fieldGroup('o_password',$sum['psw']->pluck('o_password'));

        $sum['phone'] = Member::sumField('phone');
        $data['phone'] = Member::fieldGroup('phone',$sum['phone']->pluck('phone'));

        $card_col = MemberBank::select('member_id','owner_name')->groupBy('member_id','owner_name')->get();
        // 统计出现次数
        $sum['card'] =  $card_col->countBy(function($item){
            return $item->owner_name;
        })->map(function($item,$key){
            return ['count' => $item,'owner_name' => $key];
        })->filter(function($value,$key){
            return $value['count'] > 1;
        }); //array_values(->toArray());


        $data['card'] = $card_col->mapToGroups(function ($item, $key){
            return [$item->owner_name => $item->member->name ?? ""];
        })->filter(function($value,$key){
            return count($value) > 1;
        });
        // dd($sum);
        return view('admin.quick.arbitrage_query',compact('tabs','data','sum'));
    }

    public function member_arbitrage_query(Request $request){
        $params = $request->all();

        $data = [];

        $member = null;

        if($params){
            $this->validateRequest($params,[
                'member_id' => 'required',
                'type' => ["required",Rule::in(array_keys(config('platform.arbitrage_conditions')))]
            ],[],[
                'member_id' => trans('res.common.member_name'),
                'type' => trans('res.quick.member_arbitrage_query.arbitrage_type')
            ]);

            $member = Member::find($params['member_id']);

            switch ($params['type']){
                case 'ip':
                    $data = Member::fieldGroup('register_ip',[$member->register_ip]);
                    break;
                case 'psw':
                    $data = Member::fieldGroup('o_password',[$member->o_password]);
                    break;
                case 'phone':
                    $data = Member::fieldGroup('phone',[$member->phone]);
                    break;
                case 'card':
                    $data = MemberBank::select('member_id','owner_name')
                        ->groupBy('member_id','owner_name')->get()
                        ->mapToGroups(function ($item, $key) {
                            return [$item->owner_name => $item->member->name];
                        })
                        ->filter(function($value,$key) use ($member) {
                            return count($value) > 1 && in_array($member->name, $value->toArray());
                        });

                    break;
            }
        }

        return view('admin.quick.member_arbitrage_query',compact('params','data','member'));
    }

    // 检查会员额度转换是否掉单
    public function transfer_check(Request $request){

        $params = $request->all();

        $error_msg = '';
        $transfer_list = null;
        $local_transfer_list = null;

        if($params){
            $this->validateRequest($request->all(),[
                'member_id' => 'required|exists:members,id',
                'start_at' => 'required',
                'end_at' => 'required'
            ],[],['member_id' => trans('res.common.member_name')]);

            $json = app(SelfService::class)->checktransfer(Member::find($params['member_id']),$params['end_at'],$params['start_at']);

            try{
                $res = json_decode($json,1);

                if(!is_array($res))  throw new \Exception(trans('res.api.common.net_again_err'));

                if($res['status']['errorCode'] != '20000') throw new \Exception($res['status']['msg']);

                $transfer_list = $res['data'];

                if(count($transfer_list) == 0) throw new \Exception(trans('res.quick.transfer_check.no_transfer_data',['end_at' => $params['end_at'],'start_at' => $params['start_at']]));

                $transfer_list = collect($transfer_list);

                $local_transfer_list = Transfer::whereIn('bill_no',$transfer_list->pluck('merchant_bill_no'))
                    ->where('member_id',$params['member_id'])
                    ->pluck('bill_no');

                // if($local_transfer_list->count() == $transfer_list->count()) throw new \Exception('该会员【'.$params['end_at'].'】之前【'.$local_transfer_list->count().'】条记录并未掉单');
                if($local_transfer_list->count() == $transfer_list->count()) throw new \Exception(trans('res.quick.transfer_check.transfer_count_success',['start_at' => $params['start_at'],'end_at' => $params['end_at'],'count' => $local_transfer_list->count()]));

                // $error_msg = '【'.$params['created_at'].'】之前【'.$local_transfer_list->count().'】条记录中有'.($transfer_list->count() - $local_transfer_list->count()).'笔订单掉单';
                 $error_msg = trans('res.quick.transfer_check.transfer_count_fail',['start_at' => $params['start_at'],'end_at' => $params['end_at'],'count' => $local_transfer_list->count(),'fail_count' => $transfer_list->count() - $local_transfer_list->count()]);
            }catch (\Exception $e){
                $error_msg = $e->getMessage();
            }

        }

        return view('admin.quick.transfer_check',compact('error_msg','params','transfer_list','local_transfer_list'));
    }

    /**
     * "json" => "{"id":3,"bill_no":"20210525144525","merchant_bill_no":"2105251445244806","api_id":1301,"merchant_id":1,"user_id":3,"agent_id":1,"agent_name":"agent111","merchant_name":"merchant111","username":"aaatest01","api_name":"AG","api_currency":"CNY","transfer_rate":"1.0000","exchange_rate":"1.0000","transfer_type":1,"type":1,"money":"10.00","diff_money":"0.00","real_money":"0.00","before_money":"0.00","after_money":"10.00","in_account":null,"out_account":null,"merchant_before_money":"100000.00","merchant_after_money":"99991.00","platform_before_money":"1000.00","platform_after_money":"1000.00","status":0,"result":"{\"info\":\"0\",\"msg\":\"\"}","created_at":"2021-05-25 14:45:26","updated_at":"2021-05-25 14:45:26"}"
     *
     * {
            "id": 3,
            "bill_no": "20210525144525",
            "merchant_bill_no": "2105251445244806",
            "api_id": 1301,
            "merchant_id": 1,
            "user_id": 3,
            "agent_id": 1,
            "agent_name": "agent111",
            "merchant_name": "merchant111",
            "username": "aaatest01",
            "api_name": "AG",
            "api_currency": "CNY",
            "transfer_rate": "1.0000",
            "exchange_rate": "1.0000",
            "transfer_type": 1,
            "type": 1,
            "money": "10.00",
            "diff_money": "0.00",
            "real_money": "0.00",
            "before_money": "0.00",
            "after_money": "10.00",
            "in_account": null,
            "out_account": null,
            "merchant_before_money": "100000.00",
            "merchant_after_money": "99991.00",
            "platform_before_money": "1000.00",
            "platform_after_money": "1000.00",
            "status": 0,
            "result": "{\"info\":\"0\",\"msg\":\"\"}",
            "created_at": "2021-05-25 14:45:26",
            "updated_at": "2021-05-25 14:45:26"
            }
     *
    "type" => "1"
     * type 1 仅补单 2 补单并扣除/增加金额
     * @param Request $request
     */
    public function add_transfer(Request $request){
        $data = $request->all();

        $this->validateRequest($data,[
            'json' => 'required',
            'type' => ['required',Rule::in([1,2])],
            'member_id' => 'required|exists:members,id'
        ]);

        // 补单
        try{
            $record = json_decode($data['json'],1);

            DB::transaction(function() use ($data,$record){
                $member = Member::find($data['member_id']);

                if($data['type'] == 2 && $record['transfer_type'] == 2 && $member->money < $record['money']) throw new \Exception(trans('res.quick.transfer_check.money_not_enough'));

                $api = Api::where('api_id',$record['api_id'])->first();

                // =2 转出游戏，=1 转入游戏
                $api_code = $api->api_name;
                // $api_code = $record['transfer_type'] == 1 ? Str::ascii($record['transfer_out_account']) : Str::ascii($record['transfer_in_account']);

                // 判断接口是否存在
                $api = Api::where('api_name',$api_code)->firstOrFail();

                $transfer = Transfer::create([
                    'bill_no' => isset_and_not_empty($record,'merchant_bill_no'),
                    'api_name' => $api_code,
                    'member_id' => $data['member_id'],
                    'transfer_type' => intval($record['transfer_type']),
                    'money' => $record['money'],
                    'real_money' => $record['money'],
                    'money_type' => 'money',
                    'result' => $data['json'],
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at']
                ]);

                MemberMoneyLog::create([
                    'member_id' => $data['member_id'],
                    'money' => $record['money'],
                    'number_type' => $record['transfer_type'] == 2 ? MemberMoneyLog::MONEY_TYPE_ADD : MemberMoneyLog::MONEY_TYPE_SUB,
                    'operate_type' => MemberMoneyLog::OPERATE_TYPE_GAME_IN_OUT,
                    'description' => $record['transfer_type'] == 2 ? '转出【'.$api->api_title.'】游戏【'.$record['money'].'元】，增加账户金额': '转入【'.$api->api_title.'】游戏【'.$record['money'].'元】，扣除账户金额',
                    'model_name' => \get_class($transfer),
                    'model_id' => $transfer->id
                ]);

                if($data['type'] == 2){
                    // 如果之前是转出游戏（transfer_type = 2），需要增加余额
                    // 反之，需要扣除余额

                    $money_before = $member->money;
                    $money_type = 'money';

                    if($record['transfer_type'] == 2){
                        $member->increment($money_type, $record['money']);
                    }else{
                        $member->decrement($money_type, $record['money']);
                    }

                    MemberMoneyLog::create([
                        'member_id' => $data['member_id'],
                        'money' => $record['money'],
                        'number_type' => $record['transfer_type'] == 2 ? MemberMoneyLog::MONEY_TYPE_ADD : MemberMoneyLog::MONEY_TYPE_SUB,
                        'money_before' => $money_before,
                        'money_after' => $member->$money_type,
                        'operate_type' => MemberMoneyLog::OPERATE_TYPE_LOSE_RECORD,
                        'user_id' => $this->guard()->user()->id,
                        'money_type' => $money_type,
                        'description' => ($record['transfer_type'] == 2 ?'补上': '扣除').'掉单金额【'.$record['money'].'元】'
                    ]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.base.operate_fail').$e->getMessage());
        }

        return $this->success([],trans('res.base.operate_success'));
    }

    public function database_clean(Request $request){
        return view('admin.quick.database_clean');
    }

    public function post_database_clean(Request $request){
        $data = $request->all();

        $this->validateRequest($request->all(),[
            'days' => 'required|numeric|min:1',
            'ids' => 'required'
        ],[],['member_id' => trans('res.common.member_name'),
            'ids' => trans('res.quick.database_clean.content'),
            'days' => trans('res.quick.database_clean.days')]);

        if($member_id = $request->get('member_id')){
            $member = Member::findOrFail($member_id);
        }

        if(count($data['ids']) <= 0) return $this->failed(trans('res.quick.database_clean.item_select_required'));

        try{
            $start_at = Carbon::now()->subDays($data['days']);

            DB::transaction(function() use ($data, $start_at) {

                foreach ($data['ids'] as $k){
                    $table_name = app($k)->getTable();

                    $table_field = Schema::getColumnListing($table_name);

                    $mod = DB::table($table_name)->where('created_at','<',$start_at);
                    if(in_array('member_id',$table_field)){
                        $mod = $mod->when($data['member_id'],function($query) use ($data){
                            $query->where('member_id',$data['member_id']);
                        });
                    }

                    $mod->delete();
                    /**
                    if(in_array('deleted_at',$table_field) && method_exists($mod,'forceDelete')){
                        $mod->forceDelete();
                    }else{
                        $mod->delete();
                    }


                    if(in_array('member_id',Schema::getColumnListing($table_name))){

                        if(in_array('deleted_at',Schema::get))
                        DB::table($table_name)
                            ->when($data['member_id'],function($query) use ($data){
                                $query->where('member_id',$data['member_id']);
                            })
                          //  ->where('created_at','>',$start_at)->delete();
                            ->where('created_at','<',$start_at)
                            ->forceDelete();
                            //->delete();

                    }else{
                        // DB::table($table_name)->where('created_at','>',$start_at)->delete();
                        DB::table($table_name)
                            ->where('created_at','<',$start_at)
                            ->forceDelete();
                        //->delete();
                    }
                     */
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.base.operate_msg').$e->getMessage());
        }

        return $this->success(['reload' => true],trans('res.base.operate_success'));
    }
}
