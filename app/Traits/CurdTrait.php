<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait CurdTrait
{
    // 不会进行筛选的参数
    protected $parms_not_list = ['page','limit','sort','order'];

    public function add(array $input)
    { 
        $model = $this->model;
        return $model::create($input);
    }

    public function updateById($id, array $input)
    {
        $model = $this->model->findOrFail($id);

        return $this->updateByModel($model, $input);
    }

    public function updateByModel($model, $input)
    {
        $model->fill($input);
        return $model->save($input);
    }

    public function delete($id)
    {
        $model = $this->model;
        return $model::destroy($id);
    }

    /***
     * 将 
     * { username":"ad" }
     * 转换为： ["username","like","%ad%"]
     */
    public function convertWhere($where)
    {
        $condition = [];
        if (!empty($where)) {
            foreach ($where as $field => $value) {
                if (is_array($value)) {

                    // 参数以_at结尾，并且参数类似 "created_at":["2020-01-29T07:50:14.842Z","2020-02-28T07:50:14.842Z"] 
                    // 表示日期时间搜索
                    
                    if(count($value) == 2 && (Str::endsWith($field, '_at') || Str::endsWith($field,'Time'))){
                        list($start_at, $ends_at) = $value;
                        array_push($condition, [$field, '>', $start_at]);
                        array_push($condition, [$field, '<', $ends_at]);
                    } else{
                        list($operate, $val) = $value;
                        array_push($condition,[$field,$operate,$val]);
                    }
                                       
                } else {

                    // 获取model的所有属性 \Schema::getColumnListing('table_bane')
                    if($this->model && !in_array($field,\Schema::getColumnListing($this->model->getTable()))){
                        continue;
                    }

                    // // 参数以_at结尾，并且值中有“~”表示日期搜索
                    if (Str::endsWith($field, '_at') && Str::contains($value, '~')) {

                        list($start_at, $ends_at) = explode('~', $value);
                        array_push($condition, [$field, '>', $start_at]);
                        array_push($condition, [$field, '<', $ends_at]);

                        //array_push($condition,convertDateToArray($value,$field));
                    }
                    
                    // 默认 page 为页数，limit 为每页数量
                    else if(!in_array($field, $this->parms_not_list) && isset($value)) {
                        if(is_numeric($value)){
                            array_push($condition, [$field, '=',  $value ]);
                        }else{
                            array_push($condition, [$field, 'like', '%' . $value . '%']);
                        }
                        
                    }
                }
            }
        }
        // var_dump($condition);exit;
        return $condition;
    }

    // API搜索封装
    // public function convertApiWhere($where){}
}