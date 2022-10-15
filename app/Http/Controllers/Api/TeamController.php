<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Admin\MembersController;
use App\Models\Agent;
use App\Models\AgentFdMoneyLog;
use App\Models\AgentFdRate;
use App\Models\AgentInvite;
use App\Models\AgentInviteRecord;
use App\Models\AgentYjLog;
use App\Models\Drawing;
use App\Models\GameRecord;
use App\Models\InviteRate;
use App\Models\Member;
use App\Models\MemberMoneyLog;
use App\Models\Recharge;
use App\Services\AgentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TeamController extends MemberBaseController {

    // 如果没有开启全民代理，则无法访问改功能
    public function __construct()
    {
        if (!app()->runningInConsole()) {
            app(AgentService::class)->checkAllAgent();
        }
    }

    protected function getAgent(){
        $member = $this->getMember();

        if(!$member->agent_id || $member->agent) throw new InvalidRequestException(trans('res.api.apply_agent.not_agent'));

        return $member->agent;
    }



    public function checkRelation(Member $member,$childMember){
        if(!app(AgentService::class)->isDirectChild($member,$childMember)) throw new InvalidRequestException(trans('res.api.team.not_direct_child'));
    }

    // 获取当前代理各个游戏类型的点位，和默认开户设置的最低点位，获取直属下级的返点比例
    // child_member_id
    public function getAgentFdInfo(Request $request){
        $member = $this->getMember(1);

        $return = [];

        // 获取当前代理的点位
        $return['agent_rates'] = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_MEMBER)
            ->where('member_id',$member->id)
            ->fomatterOutput();

        // 获取系统的最低点位
        $return['sys_low'] = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->fomatterOutput();

        if($child_member_id = $request->get('child_member_id')){
            if(app(AgentService::class)->isDirectChild($member,$child_member_id)){
                $return['child_member_rate'] = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_CHILD)
                    ->where('member_id',$child_member_id)->fomatterOutput();
            }
        }

        return $this->success(['data' => $return]);
    }

    // 团队开户功能，填写用户名，密码，各个游戏类型的返点
    // name password,{game_type,rate}
    public function createChildMember(Request $request){
        $this->validateRequest($request->all(),[
            'name' => [
                'required','min:6','max:8','unique:members,name','regex:/^[a-z][a-z0-9]*$/'
            ],
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'rates' => ['required'],
            'rates.*.game_type' => [
                'required',Rule::in(array_keys(config('platform.game_type')))
            ],
            'rates.*.rate' => 'required|min:0|numeric'
        ],[
            'name.regex' => trans('res.api.team.member_name_regex'),
        ],$this->getLangAttribute('register'));

        $agent = $this->getMember();

        $params = $request->only('name','password');
        $params['top_id'] = $agent->agent_id;

        $rates = $request->get('rates');
        if(count($rates) < count(config('platform.game_type'))) return $this->failed(trans('res.api.team.not_set_rate'));

        try{
            DB::transaction(function() use($params,$rates,$agent){
                $member = Member::create($params);

                Agent::create([
                    'member_id' => $member->id
                ]);

                // 创建会员的返点信息
                foreach ($rates as $key => $value){
                    AgentFdRate::create([
                        'parent_id' => $agent->id ?? 0,
                        'member_id' => $member->id,
                        'game_type' => $value['game_type'],
                        'type' => AgentFdRate::TYPE_AGENT_MEMBER,
                        'rate' => sprintf("%.2f", $value['rate'])
                    ]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }
        return $this->success([]);
    }

    // 获取代理下线的列表
    public function agentChildList(Request $request){
        // 获取所有的下线代理
        $member = $this->getMember();

        // 获取 返点（各个游戏类型），下线会员人数，个人余额，团队余额，注册日期，最后登录时间
        $member_list = Member::with('agentfdrates:member_id,game_type,rate','lastLoginLog:member_id,type,remark,created_at')
            ->withCount(['agentchild' => function($query){
                $query->where('status',1);
            }])
            ->withCount(['agentchild as agent_child_sum' => function($query){
                $query->select(DB::raw("sum(money) as child_sum"));
            }])
            //->select('id','money','created_at','status','agent_id')
            ->where('status',1)
            ->where('agent_id','>',0)
            ->when($request->get('name'),function($query) use ($request){
                return $query->where('name','like','%'.$request->get('name').'%');
            })
            ->whereIn('id',app(AgentService::class)->getAllChildId($member->id))
            ->latest()
            ->paginate($request->get('limit',10));

        $team_total= app(AgentService::class)->getAllChildId($member->id);
        $team_direct = app(AgentService::class)->getDirectChildMemberIds($member);
        $today_count = Member::whereIn('id',$team_total)->where('created_at','>',Carbon::today())->count();

        return $this->success([
            'data' => $member_list,
            'game_type' => config('platform.game_type'),
            'sum' => [
                'team_total_count' => count($team_total),
                'team_direct_count' => count($team_direct),
                'today_new_count' => $today_count
            ]
        ]);
    }

    // 获取下级的投注记录，账变记录
    public function getGameRecord(Request $request){
        $member = $this->getMember();

        $child_member_id = $request->get('member_id');

        if(!app(AgentService::class)->isAgentChild($member->id,$child_member_id))
            return $this->failed(trans('res.api.team.not_direct_child'));

        return app(MemberController::class)->game_record($request,Member::find($child_member_id));
    }

    public function getMoneyLog(Request $request){
        $member = $this->getMember();

        $child_member_id = $request->get('member_id');

        if(!app(AgentService::class)->isAgentChild($member->id,$child_member_id))
            return $this->failed(trans('res.api.team.not_direct_child'));

        return app(MemberController::class)->money_log($request,Member::find($child_member_id));
    }

    // 修改直属下级的点位
    public function modifyChildRates(Request $request){
        $this->validateRequest($request->all(),[
            'child_member_id' => 'required',
            'rates' => 'required',
            'rates.*.game_type' => [
                'required',Rule::in(array_keys(config('platform.game_type')))
            ],
            'rates.*.rate' => 'required|min:0|numeric'
        ]);

        $member = $this->getMember();
        $child_member_id = $request->get('child_member_id');
        $this->checkRelation($member,$child_member_id);

        $child_member = Member::find($child_member_id);
        $rates = $request->get('rates');

        try{
            DB::transaction(function() use($member,$rates,$child_member){
                foreach ($rates as $item){
                    $r = AgentFdRate::getMemberFdByGameType($child_member->id,$item['game_type'])->first();
                    $r->update([
                        'rate' => sprintf("%.2f", $item['rate'])
                    ]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }

        return $this->success([]);
    }

    // 默认搜索今天的数据
    public function teamReport(Request $request){
        $this->validateRequest($request->all(),[
            'created_at' => 'required'
        ]);

        $member = $this->getMember();
        $member_list = $member->agentchild->where('status',1)->pluck('id');

        $params = $request->all();
        $confirmDate = [];
        $searchDate = [];
        $betDate = [];
        if(array_key_exists('created_at',$params) && $params['created_at']){
            $confirmDate = convertDateToArray($params['created_at'],'confirm_at');
            $searchDate = convertDateToArray($params['created_at'],'created_at');
            $betDate = convertDateToArray($params['created_at'],'betTime');
        }

        $return = [
            'total_recharge' => Recharge::whereIn('member_id',$member_list)
                ->where($confirmDate)->where('status',Recharge::STATUS_SUCCESS)->sum('money'),
            'total_drawing' => Drawing::whereIn('member_id',$member_list)
                ->where($confirmDate)->where('status',Drawing::STATUS_SUCCESS)->sum('money'),
            'total_validbet_amount' => GameRecord::whereIn('member_id',$member_list)->where($betDate)
                ->where('status','<>',GameRecord::STATUS_X)->sum('validBetAmount'),
            'total_online' => count(array_intersect(app(MembersController::class)->getOnlineMember()->toArray(),$member_list->toArray())),
            'total_count' => count($member_list),
            'active_count' => count(array_intersect(app(Member::class)->getActiveChildIds()->pluck('id')->toArray(),Member::whereIn('id',$member_list)->where($searchDate)->pluck('id')->toArray())),
            'total_shuyin' => GameRecord::whereIn('member_id',$member_list)
                ->where('status',GameRecord::STATUS_COMPLETE)->get()->sum(function($item){
                   return $item->netAmount - $item->betAmount;
                }),
            'total_hongli' => MemberMoneyLog::whereIn('member_id',$member_list)->where($searchDate)->activityMoney()->sum('money'),
            'total_fanshui' => MemberMoneyLog::whereIn('member_id',$member_list)->where($searchDate)->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)->sum('money'),
            'total_other' => MemberMoneyLog::whereIn('member_id',$member_list)->where($searchDate)->otherMoney()->sum('money'),
            'new_member_count' => Member::whereIn('id',$member_list)->where($searchDate)->count()
        ];

        $return['total_validbet_amount'] = sprintf("%.2f", $return['total_validbet_amount']);
        $return['total_shuyin'] = sprintf("%.2f", $return['total_shuyin']);
        $return['total_sy'] = sprintf("%.2f", $return['total_recharge'] - $return['total_hongli'] - $return['total_fanshui'] - $return['total_other']);

        return $this->success(['data' => $return]);
    }

    /**
     * rows: [
            {date:'1/1',recharge:0,drawing:0,game_record:0,win:0,fanshui:0,hongli:0},
        ]
     * @throws InvalidRequestException
     */
    public function teamChart(){
        $member = $this->getMember();
        $member_list = $member->agentchild->where('status',1)->pluck('id');

        $return = [
            'recharge' => $this->table_total($member_list,'recharges'),
            'drawing' => $this->table_total($member_list,'drawings'),
            'game_record' => $this->table_total($member_list,'game_records','betTime','sum','validBetAmount'),
            'win' => $this->table_total($member_list,'game_records','betTime','sum','validBetAmount',[['status','=',GameRecord::STATUS_COMPLETE]]),
            'fanshui' => $this->table_total($member_list,'member_money_logs','created_at','sum','money',[['operate_type','=',MemberMoneyLog::OPERATE_TYPE_FANSHUI]]),
            'hongli' => $this->table_total($member_list,'member_money_logs','created_at','sum','money','operate_type in ('.implode(MemberMoneyLog::activityTypes,',').')'),
            // 'active_count' => Member::select(DB::raw('count(*) as member_count'))
        ];

        $rows = [];

        $dates = [];
        for($i = 0;$i<15;$i++){
            $dates[] = date('Y-m-d',time() - $i * 86400);
        }

        foreach ($return as $key => $item){
            $item = collect($item);
            foreach ($dates as $date){
                $rows[$date]['date'] = $date;
                $mod = $item->where('date',$date)->first();
                $rows[$date][$key] = $mod ? $mod->result : 0.00;
            }
        }

        return $this->success(['data' => array_values($rows)]);
    }

    public function table_total($member_list,$table,$date_field = 'created_at',$func = 'sum',$money_field = 'money',$condition = []){
        $mod = DB::table($table)
            // ->select(DB::raw($func."(".$money_field.") as ".$table."_".$func.", date_format(".$date_field.", '%Y-%m-%d') as date"))
             ->select(DB::raw($func."(".$money_field.") as result, date_format(".$date_field.", '%Y-%m-%d') as date"))
            ->where($date_field,'>', Carbon::now()->subDays(14)->startOfDay())
            ->whereIn('member_id',$member_list);

        $mod = is_string($condition) ? $mod->whereRaw($condition) : $mod->where($condition);
        return $mod->groupBy('date')->get();
    }

    // 创建邀请链接
    public function agentInviteCreate(Request $request){
        $data = $request->all();

        $member = $this->getMember();

        $this->validateRequest($data,[
            'rates' => ['required'],
            'rates.*.game_type' => [
                'required',Rule::in(array_keys(config('platform.game_type')))
            ],
            'rates.*.rate' => 'required|min:0|numeric'
        ],[],$this->attributeName(AgentInvite::class));

        $rates = $request->get('rates');
        if(count($rates) < count(config('platform.game_type'))) return $this->failed(trans('res.api.team.not_set_rate'));

        try{
            DB::transaction(function() use($data,$member,$rates){
                $mod = AgentInvite::create([
                    'agent_member_id' => $member->id,
                    'token' => md5($member->id.time()),
                    'is_open' => 1
                ]);

                foreach ($rates as $k => $v){
                    InviteRate::create([
                        'invite_id' => $mod->id,
                        'game_type' => $v['game_type'],
                        'rate' => sprintf("%.2f", $v['rate'])
                    ]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }
        return $this->success([]);
    }

    public function agentInviteUpdate(Request $request){
        $data = $request->all();

        $member = $this->getMember();

        $this->validateRequest($data,[
            'invite_id' => 'required',
            'is_open' => 'required|boolean|numeric',
            'rates' => ['required'],
            'rates.*.game_type' => [
                'required',Rule::in(array_keys(config('platform.game_type')))
            ],
            'rates.*.rate' => 'required|min:0|numeric'
        ],[],$this->attributeName(AgentInvite::class));

        $rates = $request->get('rates');
        try{
            DB::transaction(function() use($data,$member,$rates){
                $mod = AgentInvite::find($data['invite_id']);

                if(!$mod) throw new \Exception(trans('res.api.common.operate_error'));

                $mod->update([
                    'is_open' => $data['is_open']
                ]);

                foreach ($rates as $k => $v){
                    $mod = InviteRate::where('invite_id',$data['invite_id'])
                        ->where('game_type',$v['game_type'])->first();
                    if($mod){
                        $mod->update([
                            'rate' => sprintf("%.2f", $v['rate'])
                        ]);
                    }
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }
        return $this->success([]);
    }

    public function agentInviteList(Request $request){
        $member = $this->getMember();

        $data = AgentInvite::with('invite_rates:invite_id,game_type,rate')
            ->withCount('records')->where('agent_member_id',$member->id)
            ->latest()->paginate($request->get('limit',10));

            $data->getCollection()->transform(function($item){
                $item->pc_invite_url = $item->pc_invite_url;
                $item->wap_invite_url = $item->wap_invite_url;
                return $item;
            });

        return $this->success(['data' => $data]);
    }

    public function agentInviteRecords(Request $request){
        $data = $request->all();
        $this->validateRequest($data,[
            'invite_id' => 'required'
        ]);

        $member = $this->getMember();
        $invite = AgentInvite::find($data['invite_id']);
        if(!$invite || $invite->agent_member_id != $member->id) return $this->failed(trans('res.api.common.operate_error'));

        $records = AgentInviteRecord::with('member:id,name')
            ->where('invite_id',$invite->id)->latest()
            ->paginate($request->get('limit',10));
        return $this->success(['data' => $records]);
    }

    // 业绩查询接口
    // 总业绩，直推业绩，代理业绩
    // 业务类型，总业绩，最高返佣，直推业绩，代理业绩
    public function performanceQueryTotal(Request $request){
        $member = $this->getMember();
        $mod = AgentFdMoneyLog::where('agent_member_id',$member->id);

        $total_award = $mod->sum('fd_money');

        $direct_child_ids = app(AgentService::class)->getDirectChildMemberIds($member);
        $total_direct_award = $mod->whereIn('member_id',$direct_child_ids)->sum('fd_money');
        $total_agent_award = sprintf("%.2f",$total_award - $total_direct_award);

        $times = $request->get('created_at',[Carbon::yesterday(),Carbon::today()]);
        $mod = $mod->whereBetween('created_at',$times)->get(['game_type','fd_money']);

        $res = [];
        foreach (config('platform.game_type') as $k => $v){
            $total = $mod->where('game_type',$k)->sum('fd_money');
            $direct = $mod->where('game_type',$k)->whereIn('member_id',$direct_child_ids)->sum('fd_money');
            $res[] = [
                'game_type' => $k,
                'game_type_text' => $v,
                'total_awrad' => $total,
                'direct_award' => $direct,
                'agent_award' => sprintf("%.2f",$total - $direct),
                'max' => $mod->max('fd_money') ?? 0.00,
            ];
        }

        return $this->success([
            'sum' => [
                // 总业绩
                'total_award' => $total_award,
                // 直推业绩
                'total_direct_award' => $total_direct_award,
                // 代理业绩
                'total_agent_award' => $total_agent_award,
            ],
            'total' => $res
        ]);
    }

    // is_direct 1 直推，0代理
    // is_direct,game_type,created_at
    // 下级账号，计算日期，投注金额，返佣金额
    // 下级账号，计算日期，投注金额，返佣金额
    public function performanceQueryDetail(Request $request){
        $member = $this->getMember();

        $data = $request->all();
        $this->validateRequest($data,[
            // 'game_type' => ['required',Rule::in(array_keys(config('platform.game_type')))],
            'is_direct' => 'required|numeric|boolean'
        ]);
        $mod = AgentFdMoneyLog::with('member:id,name')
            ->where('agent_member_id',$member->id)
            ->when($request->get('game_type'),function($query) use($request) {
                return $query->where('game_type',$request->get('game_type'));
            });
            // ->where('game_type',$data['game_type']);

        $direct_child_ids = app(AgentService::class)->getDirectChildMemberIds($member);
        if($data['is_direct']) $mod = $mod->whereIn('member_id',$direct_child_ids);
        else $mod = $mod->whereNotIn('member_id',$direct_child_ids);

        $data = $mod->select(['member_id','created_at','fd_money','bet_amount'])->paginate($request->get('limit',5));

        return $this->success([
            'data' => $data
        ]);
    }

    // 团队统计
    // 团队总数，直属用户，今日添加（统计）
    // 筛选条件 created_at,name 会员姓名
    // 团队人数，直属人数，团队投注，团队充值
    //  改为 团队人数，个人余额，团队余额，最后登录
    /**
    public function teamTotal(Request $request){
        $member = $this->getMember();

        $params = $request->all();

        $team_total= app(AgentService::class)->getAllChildId($member->id);
        $team_direct = app(AgentService::class)->getDirectChildMemberIds($member);
        $today_count = Member::whereIn('id',$team_total)->where('created_at','>',Carbon::today())->count();

        $created_at = $request->get('created_at',[Carbon::today(),Carbon::now()]);
        $confirmDate = convertDateToArray($created_at,'confirm_at');
        $searchDate = convertDateToArray($created_at,'created_at');
        $betDate = convertDateToArray($created_at,'betTime');


    }
    **/

    // 昨日总佣金，团队总人数，昨日直推佣金，直属会员总数
    public function teamDetail(Request $request){
        $member = $this->getMember();

        $child_member_id = $request->get('member_id');

        if(!app(AgentService::class)->isAgentChild($member->id,$child_member_id))
            return $this->failed(trans('res.api.team.not_direct_child'));

        $child_member = Member::find($child_member_id);
        $team_total = app(AgentService::class)->getAllChildId($child_member_id);
        $team_direct = app(AgentService::class)->getDirectChildMemberIds($child_member);

        // 昨日总佣金
        $mod = AgentFdMoneyLog::where('agent_member_id',$child_member_id)
            ->whereBetween('created_at',[Carbon::yesterday(),Carbon::today()]);
        $total_awarad = $mod->sum('fd_money');
        $total_direct = $mod->whereIn('child_member_id',$team_direct)->sum('fd_money');

        return $this->success([
            'data' => [
                'name' => $child_member->name,
                'register_at' => $child_member->created_at->toDateTimeString(),
                'team_total_count' => count($team_total), // 团队总人数
                'team_direct_count' => count($team_direct), // 直属会员总数
                'total_award' => $total_awarad, // 昨日总佣金
                'total_direct' => $total_direct // 昨日直推佣金
            ]
        ]);
    }
}
