<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Events\AutoMemberFd;
use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Member;
use App\Models\MemberAgentApply;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MemberAgentAppliesController extends AdminBaseController
{
    protected $create_field = ['member_id', 'name', 'email', 'msn_qq', 'reason', 'status', 'fail_reason'];
    protected $update_field = ['member_id', 'name', 'email', 'msn_qq', 'reason', 'status', 'fail_reason'];

    public function __construct(MemberAgentApply $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function edit(MemberAgentApply $memberagentapply)
    {
        $this->checkAllowModify($memberagentapply->id);
        return view($this->getEditViewName(), ["model" => $memberagentapply]);
    }

    public function storeRule()
    {
        return [
            // "member_id" => "required",
            // "status" => Rule::in(array_keys(config('platform.apply_status'))),
        ];
    }

    public function checkAllowModify($id){
        $mod = $this->model->findOrFail($id);
        if($mod->status != 0) throw new InvalidRequestException(trans('res.member_agent_apply.msg.saved_cannot_modify'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAllowModify($id);
        $data = $request->only($this->update_field);

        $this->validateRequest(
            $data,
            $this->updateRule($id),
            method_exists($this, 'ruleMessage') ? $this->ruleMessage() : [],
            method_exists($this, 'attributeName') ? $this->attributeName($this->model) : []
        );

        $member = Member::find($data['member_id']);

        $data = array_filter($data, function ($temp) {
            return $temp !== null;
        });

        $redirectUrl = $this->indexUrl();
        $returnMsg = trans('res.base.update_success');

        // 如果审核通过，给会员分配代理
        try {
            DB::transaction(function () use ($member, $data, $id) {
                // 审核通过时，给会员分配 代理
                if ($data['status'] == 1) {

                    $agent = Agent::create([
                        'member_id' => $member->id,
                        'apply_data' => json_encode($data, JSON_UNESCAPED_UNICODE)
                    ]);

                    $member->update([
                        'agent_id' => $agent->id,

                        // 更新会员信息
                        'realname' => isset_and_not_empty($data,'name',''),
                        'phone' => isset_and_not_empty($data,'phone',''),
                    ]);

                    // 成为代理后，自动设置点位
                    event(new AutoMemberFd($member));
                }

                // 更新申请状态
                $this->updateById($id, $data);
            });
        } catch (Exception $e) {
            return $this->failed(trans('res.base.update_fail').'：' . $e->getMessage());
        }

        if ($member->agent) {
            $redirectUrl = route('admin.agents.edit', ['agent' => $member->agent->id]);
            $returnMsg = trans('res.member_agent_apply.msg.update_and_fill_data');
        }

        return $this->successWithUrl([], $returnMsg, $redirectUrl);
    }

    public function updateRule($id)
    {
        return [
            "member_id" => "required|exists:members,id",
            "status" => Rule::in(array_keys(config('platform.apply_status'))),
        ];
    }
}
