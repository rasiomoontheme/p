<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentFdMoneyLog;
use App\Models\AgentFdRate;
use App\Models\Drawing;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\MemberMoneyLog;
use App\Models\Recharge;
use App\Services\AgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberOfflineController extends AgentBaseController
{
    // 下线会员【传统代理模式】
    public function index(Request $request){
        $params = $request->all();
        $data = Member::where('top_id',$this->getAgent()->agent_id)
            ->where($this->convertWhere($params))->latest()->paginate(15);
        return view("agent.memberoffline.index", compact('data', 'params'));
    }

    // 下线列表【全民代理】
    public function allagent(Request $request){
        $params = $request->all();
        $search  = $params;
        if($request->get('agent_id'))
            $search['agent_id'] = $search['agent_id'] > 0 ? ['>',0] : $search['agent_id'];

        $data = Member::whereIn('id',app(AgentService::class)->getAllChildId($this->getAgent()->id))
            ->where($this->convertWhere($search))->latest()->paginate(15);
        return view("agent.memberoffline.index", compact('data', 'params'));
    }

    // 修改代理返点
    public function agent_fd_rate(Request $request,Agent $agent){
        // 判断是否是全民代理模式
        app(AgentService::class)->checkAllAgent();

        // 获取该代理的返点
        $data = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_MEMBER)->where('member_id',$agent->member->id)->pluck('rate','game_type');
        $systemlow = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->pluck('rate','game_type');
        // 获取当前代理的返点
        $agentrates = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_MEMBER)->where('member_id',$this->getAgent()->id)->pluck('rate','game_type');
        // 当前代理的默认返点
        $agentdefault = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_CHILD)->where('member_id',$this->getAgent()->id)->pluck('rate','game_type');

        return view('agent.agent_fd_rate.index',compact('data','systemlow','agentrates','agentdefault','agent'));
    }

    public function post_agent_fd_rate(Request $request,Agent $agent){

        // 判断是否是全民代理模式
        app(AgentService::class)->checkAllAgent();

        /*
        if(!app(AgentService::class)->isAgentChild($this->getAgent()->id, $agent->member_id))
            return $this->failed('该会员不是您的下线，无权操作');
        */

        if(!app(AgentService::class)->isDirectChild($this->getAgent(),$agent->member_id))
            return $this->failed(trans('res.agent_page.notice.direct_rate_modify'));

        $data = $request->all();

        foreach (config('platform.game_type') as $key => $value){
            AgentFdRate::updateOrCreate([
                'type' => AgentFdRate::TYPE_AGENT_MEMBER,
                'member_id' => $agent->member_id,
                'game_type' => $key
            ],['rate' => $data['rate'][$key]]);
        }

        return $this->success(['close_reload' => true,trans('res.api.common.operate_success')]);
    }

    // 修改 下级默认返点
    public function fd_offline(Request $request){
        $data = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_CHILD)->where('member_id',$this->getAgent()->id)->pluck('rate','game_type');

        $systemlow = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->pluck('rate','game_type');
        // 获取当前代理的返点
        $agentrates = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_MEMBER)->where('member_id',$this->getAgent()->id)->pluck('rate','game_type');

        return view('agent.agent_fd_rate.agent',compact('systemlow','agentrates','data'));
    }

    public function post_fd_offline(Request $request){
        $data = $request->all();

        try{
            DB::transaction(function() use ($data){
                foreach (config('platform.game_type') as $key => $value){
                    AgentFdRate::updateOrCreate([
                        'type' => AgentFdRate::TYPE_AGENT_CHILD,
                        'member_id' => $this->getAgent()->id,
                        'game_type' => $key
                    ],['rate' => $data['rate'][$key]]);
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }

        return $this->success(['close_reload' => true,trans('res.api.common.operate_success')]);
    }

    public function money_log(Request $request) {
        $member_ids = app(AgentService::class)->getChildMemberIds($this->getAgent());

        $params = $request->all();
        $data = MemberMoneyLog::whereIn('member_id',$member_ids)->where($this->convertWhere($params))->latest()->paginate(15);
        $member_list = Member::whereIn('id',$member_ids)->pluck('name','id')->toArray();

        return view("agent.offlinemoneylog.index",compact('data','params','member_list'));
    }

    public function money_log_show(Request $request,$id){
        $model = MemberMoneyLog::findOrFail($id);
        return view("layouts.show",compact('model'));
    }

    // 代理返点记录
    public function agent_fd_logs(Request $request){
        $member_ids = app(AgentService::class)->getAgentAndChildMemberIds($this->getAgent()->id);

        $params = $request->all();
        $data = AgentFdMoneyLog::whereIn('agent_member_id',$member_ids)->where($this->convertWhere($params))->latest()->paginate(15);
        $member_list = Member::whereIn('id',$member_ids)->pluck('name','id')->toArray();

        return view("agent.offlinefdlog.index",compact('data','params','member_list'));
    }

    public function drawing_list(Request $request){
        $member_ids = app(AgentService::class)->getChildMemberIds($this->getAgent());

        $params = $request->all();
        $data = Drawing::whereIn('member_id',$member_ids)->where($this->convertWhere($params))->latest()->paginate(15);
        $member_list = Member::whereIn('id',$member_ids)->pluck('name','id')->toArray();

        return view("agent.offlinedrawing.index",compact('data','params','member_list'));
    }

    public function recharge_list(Request $request){
        $member_ids = app(AgentService::class)->getChildMemberIds($this->getAgent());

        $params = $request->all();
        $data = Recharge::whereIn('member_id',$member_ids)->where($this->convertWhere($params))->latest()->paginate(15);
        $member_list = Member::whereIn('id',$member_ids)->pluck('name','id')->toArray();

        return view("agent.offlinerecharge.index",compact('data','params','member_list'));
    }

    public function gamerecords(Request $request){
        $member_ids = app(AgentService::class)->getChildMemberIds($this->getAgent());

        $params = $request->all();
        $mod = GameRecord::whereIn('member_id',$member_ids)->where($this->convertWhere($params));
        $member_list = Member::whereIn('id',$member_ids)->pluck('name','id')->toArray();

        $total_betAmount = sprintf("%.2f",$mod->sum('betAmount'));
        $total_validBetAmount = sprintf("%.2f",$mod->sum('validBetAmount'));
        $total_netAmount = sprintf("%.2f",$mod->sum('netAmount') - $total_betAmount);

        $data = $mod->latest()->paginate(15);

        return view("agent.offlinegamerecord.index",compact('data','params','member_list','total_betAmount','total_validBetAmount','total_netAmount'));
    }

    // 总收益
    public function total_sy(Request $request){
        $member_ids = app(AgentService::class)->getChildMemberIds($this->getAgent());

        $params = $request->all();
        $confirmDate = [];
        $searchDate = [];
        if(array_key_exists('created_at',$params) && $params['created_at']){
            $confirmDate = convertDateToArray($params['created_at'],'confirm_at');
            $searchDate = convertDateToArray($params['created_at'],'created_at');
        }

        $recharge_mod = Recharge::whereIn('member_id',$member_ids)->where($confirmDate)->where('status',Recharge::STATUS_SUCCESS);
        $total_recharge = $recharge_mod->sum('money');
        $recharge_count = $recharge_mod->count();


        $drawing_mod = Drawing::whereIn('member_id',$member_ids)->where($confirmDate)->where('status',Drawing::STATUS_SUCCESS);
        $total_drawing = $drawing_mod->sum('money');
        $drawing_count = $drawing_mod->count();

        // 活动赠送
        $dividend_money_1 = MemberMoneyLog::whereIn('member_id',$member_ids)->where($searchDate)->activityMoney()->sum('money');
        // 反水
        $dividend_money_2 = MemberMoneyLog::whereIn('member_id',$member_ids)->where($searchDate)->where('operate_type',MemberMoneyLog::OPERATE_TYPE_FANSHUI)->sum('money');
        // 其它
        $dividend_money_3 = MemberMoneyLog::whereIn('member_id',$member_ids)->where($searchDate)->otherMoney()->sum('money');

        $total_sy_money = $total_recharge - $total_drawing - $dividend_money_1 - $dividend_money_2 - $dividend_money_3;

        return view("agent.total_sy.index",compact('total_recharge','recharge_count','drawing_count','total_drawing','dividend_money_1','dividend_money_2','dividend_money_3','total_sy_money'));
    }
}
