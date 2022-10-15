<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\AgentYjLog;
use App\Models\Base;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\AgentService;

class SendAgentController extends AdminBaseController{

    protected $create_field = [];

    public function __construct(){
        // 判断是否是传统代理模式
        app(AgentService::class)->checkTraditional();
    }

    public function index(Request $request){
        $params = $request->only('agent_id','created_at','lang');

        if(!$request->get('created_at'))
            $params['created_at'] = Carbon::now()->subDays(30)->toDateTimeString().' ~ '.Carbon::yesterday()->startOfDay()->toDateTimeString();

        if(!$request->get('lang')) $params['lang'] = Base::LANG_CN;

        $data = Member::where('agent_id','>',0)
            //->where($this->convertWhere($params))
            ->when($request->get('agent_id'),function($query) use ($request){
                $query->where('agent_id',$request->get('agent_id'));
            })
            ->where('lang',$params['lang'])
            ->latest()->paginate(10);
        return view('admin.sendagent.index',compact('data','params'));
    }

    /***
     * "ids" => array:1 [
        0 => "1"
        ]
        "yl_money" => array:1 [
        1 => "-5.77"
        ]
        "money" => array:1 [
        1 => "-0"
        ]
        "remark" => array:1 [
        1 => null
        ]
     * @param Request $request
     */
    public function store(Request $request){
        if(!$request->get('ids')) return $this->failed(trans('res.base.item_select_required'));

        if(!$request->get('created_at')) return $this->failed(trans('res.agent_yj_log.msg.time_range_required'));

        $data = $request->all();
        $month = date('m', strtotime('-1 month'));

        try{
            DB::transaction(function() use ($data, $month){
                foreach ($data['ids'] as $member_id){
                    if(floatval($data['yl_money'][$member_id]) < 0) continue;

                    $member = Member::find($member_id);
                    if($member && $data['money'][$member_id] && $member->agent_id > 0){
                        $member->increment('money',$data['money'][$member_id]);

                        AgentYjLog::create([
                            'agent_id' => $member->agent_id,
                            'yl_money' => $data['yl_money'][$member_id],
                            'money' => $data['money'][$member_id],
                            'last_month' => $month,
                            'remark' => $data['remark'][$member_id] ?? ''
                        ]);
                    }
                }
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.agent_yj_log.msg.yj_send_fail').$e->getMessage());
        }

        return $this->success(['reload' => true],trans('res.agent_yj_log.msg.yj_send_success'));
    }
}
