<?php

namespace App\Observers;
use App\Models\Permission;

class PermissionObserver
{
    /**
     * 当模型已存在，不是新建的时候，依次触发的顺序是:saving -> updating -> updated -> saved
     * 当模型不存在，需要新增的时候，依次触发的顺序则是:saving -> creating -> created -> saved
     * @param Permission $model
     */

    public function saving(Permission $model){
        if(!$model->isModelHasPid($model)){
            $model->pid = null;
            $model->level = 0;
            $model->path = '-';
        }else{
            if($model->parent){
                if(!$model->level) $model->level = $model->parent->level + 1;
                if(!$model->path) $model->path = $model->parent->path.$model->pid.'-';
            }

            // dd($model->getAttributes());
        }
    }
}
