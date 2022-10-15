<?php

namespace App\Observers;

use App\Models\Agent;

class AgentObserver
{
    //当模型已存在，不是新建的时候，依次触发的顺序是:saving -> updating -> updated -> saved
    //当模型不存在，需要新增的时候，依次触发的顺序则是:saving -> creating -> created -> saved

    // 创建 agent 之后，修改member的agent_id
    public function created(Agent $agent){
        if(!$agent->member->agent_id){
            $agent->member->update([
                "agent_id" => $agent->id
            ]);
        }
    }
}
