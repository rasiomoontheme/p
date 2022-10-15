<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentFdRate;
use App\Services\AgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class AgentFdRatesController extends AdminBaseController
{
    protected $create_field = ['parent_id','member_id','game_type','type','rate','remark'];
    protected $update_field = ['parent_id','member_id','game_type','type','rate','remark'];

    public function __construct(AgentFdRate $model){
        $this->model = $model;
        parent::__construct();

        // 判断是否是全民代理模式
        if (!app()->runningInConsole()) {
            app(AgentService::class)->checkAllAgent();
        }
    }

    // 显示代理的返点列表
    public function index(Request $request){
        $params = $request->all();
        $data = $this->model->where('type',AgentFdRate::TYPE_AGENT_MEMBER)->where($this->convertWhere($params))->latest()->paginate(15);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function edit(AgentFdRate $agentfdrate){
        return view($this->getEditViewName(),["model" => $agentfdrate]);
    }

    public function storeRule(){
        return [
			"game_type" => ["required",Rule::in(array_keys(config('platform.game_type')))],
			"type" => "required",
			"rate" => "required",
		];
    }

    public function updateRule($id){
        return [
			"game_type" => ["required",Rule::in(array_keys(config('platform.game_type')))],
			"type" => "required",
			"rate" => "required",
		];
    }

    // 设置代理点位
    public function agent(Agent $agent){
        $data = AgentFdRate::where('type',AgentFdRate::TYPE_AGENT_MEMBER)->where('member_id',$agent->member->id)->pluck('rate','game_type');
        $systemlow = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->pluck('rate','game_type');
        $systemhigh = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_HIGHEST)->pluck('rate','game_type');
        $sys = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEN_AGENT)->pluck('rate','game_type');
        return view('admin.agentfdrate.agent',compact('data','systemlow','systemhigh','sys','agent'));
    }

    public function post_agent(Agent $agent,Request $request){
        $data = $request->all();

        foreach (config('platform.game_type') as $key => $value){
            AgentFdRate::updateOrCreate([
                'type' => AgentFdRate::TYPE_AGENT_MEMBER,
                'member_id' => $agent->member->id,
                'game_type' => $key
            ],['rate' => $data['rate'][$key]]);
        }

        return $this->success(['close_reload' => true,trans('res.base.operate_success')]);
    }

    // 系统默认点位页面
    public function system(){
        $systemhigh = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_HIGHEST)->get();
        $systemlow = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->get();
        $sys = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEN_AGENT)->get();
        return view('admin.agentfdrate.system',compact('systemhigh','systemlow','sys'));
    }

    // 系统默认点位保存
    public function post_system(Request $request){
        $data = $request->all();
        if($request->get('type') == AgentFdRate::TYPE_SYSTEM_HIGHEST){
            $systemlow = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->pluck('rate','game_type');

            // 判断是否低于最小值
            foreach ($data['rate'] as $game_type => $rate){
                 if($systemlow[$game_type] > $rate)
                     // return $this->failed("系统游戏类型【".config('platform.game_type')[$game_type]."】的最高反水点位低于该类型最低的反水点位，请检查");
                    return $this->failed(trans('res.agent_fd_rate.msg.system_highest_error',['game_type' => Arr::get(trans('res.option.game_type'),$game_type)]));
            }

            foreach ($data['rate'] as $game_type => $rate){
                AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_HIGHEST)->where('game_type',$game_type)->update(['rate' => $rate]);
            }

            return $this->success(['reload' => true],trans('res.base.operate_success'));
        }else if($request->get('type') == AgentFdRate::TYPE_SYSTEM_LOWEST){
            $systemhigh = AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_HIGHEST)->pluck('rate','game_type');

            // 判断是否高于最大值
            foreach ($data['rate'] as $game_type => $rate){
                if($systemhigh[$game_type] < $rate)
                    // return $this->failed("系统游戏类型【".config('platform.game_type')[$game_type]."】的最低反水点位高于该类型最高的反水点位，请检查");
                    return $this->failed(trans('res.agent_fd_rate.msg.system_lowest_error',['game_type' => Arr::get(trans('res.option.game_type'),$game_type)]));
            }

            foreach ($data['rate'] as $game_type => $rate){
                AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEM_LOWEST)->where('game_type',$game_type)->update(['rate' => $rate]);
            }

            return $this->success(['reload' => true],trans('res.base.operate_success'));
        }else if($request->get('type') == AgentFdRate::TYPE_SYSTEN_AGENT){
            foreach ($data['rate'] as $game_type => $rate){
                AgentFdRate::where('type',AgentFdRate::TYPE_SYSTEN_AGENT)->where('game_type',$game_type)->first()->update(['rate' => $rate]);
            }

            return $this->success(['reload' => true],trans('res.base.operate_success'));
        }
    }
}
