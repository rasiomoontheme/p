<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class IndexController extends AgentBaseController
{
    public function main(){
        return view("agent.main");
    }

    public function index(Request $request){
        $agent_member = $this->getAgent();
        $agent_child_count = Member::getAgentChild($agent_member->id,$agent_member->agent_id)->where('status',Member::STATUS_ALLOW)->count();

        return view("agent.index.index",compact('agent_child_count'));
    }
}
