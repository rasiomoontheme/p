<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Events\AutoMemberFd;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Member;
use App\Models\SystemConfig;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AgentsController extends AdminBaseController
{
    protected $create_field = ['member_id','agent_wap_uri','agent_pc_uri','agent_uri_pre','apply_data','remark','assign_type'];
    protected $update_field = ['agent_wap_uri','agent_pc_uri','agent_uri_pre','apply_data','remark'];

    public function __construct(Agent $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(Agent $agent){
        $member = $agent->member;
        return view($this->getEditViewName(),["member" => $member,"model" => $agent,'is_delete' => false]);
    }

    public function assign(Member $member){
        $is_delete = Agent::onlyTrashed()->where('member_id',$member->id)->first();
        $is_delete = $is_delete ? true : false;
        return view('admin.agent.create_and_edit',['member' => $member,'is_delete' => $is_delete]);
    }

    public function post_assign(Member $member,Request $request){
        $data = $request->only($this->create_field);

        $this->validateRequest(
            $data,
            $this->storeRule(),
            method_exists($this, 'ruleMessage') ? $this->ruleMessage() : [],
            method_exists($this, 'attributeName') ? $this->attributeName($this->model) : []
        );

        $data = array_filter($data,function($temp){
            return $temp !== null;
        });

        $oldagent = Agent::onlyTrashed()->where('member_id',$member->id)->latest()->first();
        if($oldagent && !array_key_exists('assign_type',$data)) return $this->failed(trans('res.agent.msg.assign_type_required'));

        // 沿用旧代理账号
        if($oldagent && $data['assign_type'] == Agent::ASSING_TYPE_OLDER){
            try{
                DB::transaction(function() use($member,$oldagent) {
                    $oldagent->restore();
                    $member->update([
                        'agent_id' => $oldagent->id
                    ]);
                });
            }catch (Exception $e){
                DB::rollback();
                return $this->failed(trans('res.agent.msg.assign_operate_error').$e->getMessage());
            }
            return $this->successWithUrl(['close_reload' => true], trans('res.agent.msg.assign_operate_success'), route('admin.members.index'));
        }

        unset($data['assign_type']);

        try{
            DB::transaction(function () use ($member, $data){
                $res = $this->add($data);

                $member->update([
                    'agent_id' => $res->id
                ]);

                // 成为代理后，自动设置点位
                event(new AutoMemberFd($member));
            });
        }catch(Exception $e){
            DB::rollback();
            return $this->failed(trans('res.agent.msg.assign_operate_error').$e->getMessage());
        }
        return $this->successWithUrl(['close_reload' => true], trans('res.agent.msg.assign_operate_success'), route('admin.members.index'));
    }

    public function storeRule(){
        return [
			"member_id" => "required",
            //"agent_pc_uri" => "min:2|unique:agents,agent_pc_uri",
            //"agent_wap_uri" => "min:2|unique:agents,agent_wap_uri",
			//"agent_uri" => "required|min:2|unique:agents,agent_uri",
            //"assign_type" => Rule::in(array_values(config('platform.agent_assign_types')))
			// "agent_uri_pre" => "required",
		];
    }

    public function updateRule($id){
        return [
			// "member_id" => "required",
			//"agent_uri" => "required|min:2|unique:agents,agent_uri,".$id,
            //"agent_pc_uri" => "min:2|unique:agents,agent_pc_uri".$id,
            //"agent_wap_uri" => "min:2|unique:agents,agent_wap_uri".$id,
            // "agent_uri_pre" => "required",
		];
    }

    // 删除代理,并将

    public function destroy(Request $request, $id)
    {
        try{
            DB::transaction(function() use ($id){
                $this->delete($id);
                Member::where('agent_id',$id)->update([
                    'agent_id' => 0
                ]);
            });
        }catch (Exception $e){
            DB::rollBack();
            return $this->failed(trans('res.base.delete_fail').'：'.$e->getMessage());
        }

        return $this->success(['reload' => true],trans('res.base.delete_success'));
    }


    public function active_member() {
        $data = systemconfig('daili_active_money_json');
        if($data) {
            $data = json_decode($data,1);
        } else {
            $data = [];
            $lang_list = systemconfig('vip1_lang_fields');
            if ($lang_list) {
                $arr = json_decode($lang_list, true);
                unset($arr['zh_hk']);
                foreach ($arr as $k_lang => $v_lang_name) {
                    $data[$k_lang]['a'] = $v_lang_name; // 最小，最大
                    $data[$k_lang]['b'] = 50; // 最小，最大
                }
            } else {
                $data = [];
            }
        }


        return view('admin.agent.active_member',compact('data'));
    }

    public function post_active_member(Request $request){
        $data = $request->all();
        //return $data['zh_cn'];
        $old_data = systemconfig('daili_active_money_json');
        if($old_data) {
            $old_data = json_decode($old_data,true);
        } else {
            $old_data = [];
            $lang_list = systemconfig('vip1_lang_fields');
            if ($lang_list) {
                $arr = json_decode($lang_list, true);
                unset($arr['zh_hk']);
                foreach ($arr as $k_lang => $v_lang_name) {
                    $old_data[$k_lang]['a'] = $v_lang_name; // 最小，最大
                    $old_data[$k_lang]['b'] = 50; // 最小，最大
                }
            }
        }

        foreach ($old_data as $k_lang => $v) {
            if (isset($data[$k_lang])) {
                $old_data[$k_lang]['b'] = $data[$k_lang][0];
            }
        }

        $mod = SystemConfig::query()->getConfig('daili_active_money_json');

        if($mod->update([
            'value' => json_encode($old_data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }

}
