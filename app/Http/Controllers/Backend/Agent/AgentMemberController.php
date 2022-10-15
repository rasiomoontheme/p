<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class AgentMemberController extends AgentBaseController
{
    public function index(Request $request){
        $params = $request->all();
        // $data = Member::where('agent_id',$this->getAgent()->id)->paginate(5);
        $data = [$this->getAgent()];
        return view("agent.agentmember.index", compact('data', 'params'));
    }
}
