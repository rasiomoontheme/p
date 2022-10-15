<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentFdMoneyLog;
use App\Models\GameRecord;
use App\Services\AgentService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgentFdMoneyLogsController extends AdminBaseController
{
    protected $create_field = ['member_id','member_rate','agent_id','agent_rate','game_type','bet_amount','fd_money','money_before','money_after','remark'];
    protected $update_field = ['member_id','member_rate','agent_id','agent_rate','game_type','bet_amount','fd_money','money_before','money_after','remark'];

    public function __construct(AgentFdMoneyLog $model){
        $this->model = $model;
        parent::__construct();

        // 判断是否是全民代理模式
        if (!app()->runningInConsole()) {
            app(AgentService::class)->checkAllAgent();
        }
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $mod = $this->model->where($this->convertWhere($params))->latest();
        $total_fd_money = $mod->sum('fd_money');
        $data = $mod->paginate(15);
        return view("{$this->view_folder}.index", compact('data', 'params','total_fd_money'));
    }

    public function edit(AgentFdMoneyLog $agentfdmoneylog){
        return view($this->getEditViewName(),["model" => $agentfdmoneylog]);
    }

    // 发放游戏记录的反点
    public function handle_record(GameRecord $gamerecord){
        $res = app(AgentService::class)->getAgentFdMoneyLogByRecord($gamerecord);
        if($res['code'] < 0) return $this->failed($res['msg']);

        return $this->success(['reload' => true],trans('res.base.operate_success'));
    }
}
