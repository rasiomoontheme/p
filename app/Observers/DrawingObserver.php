<?php

namespace App\Observers;

use App\Events\CheckTask;
use App\Models\Drawing;
use App\Models\Task;

class DrawingObserver
{
    // 当提款审核通过时
    public function saved(Drawing $drawing){
        if($drawing->isDirty() && in_array('status',array_keys($drawing->getDirty())) && $drawing->status == Drawing::STATUS_SUCCESS){
            event(new CheckTask($drawing->member,Task::TYPE_SUM_DRAWING));
        }
    }
}
