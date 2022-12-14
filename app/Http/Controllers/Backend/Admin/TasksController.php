<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TasksController extends AdminBaseController
{
    protected $create_field = ['title','condition_type','condition_number','condition_money','condition_day','award_content','award_type','remark'];
    protected $update_field = ['title','condition_type','condition_number','condition_money','condition_day','award_content','award_type','remark'];

    public function __construct(Task $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model->where($this->convertWhere($params))->notSystem()->latest()->paginate(15);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function edit(Task $task){
        return view($this->getEditViewName(),["model" => $task]);
    }

    public function storeRule(){
        // dd(\request()->all());
        return [
            "title" => 'required',
            "condition_type" => ['required',Rule::in(array_keys(config('platform.task_condition_types')))],
            "condition_money" => 'required|numeric',
            //"condition_number" => 'numeric',
            //"condition_day" => 'numeric',
            "award_type" => ["required",Rule::in(array_keys(config('platform.task_award_type')))],
        ];
    }

    public function updateRule($id){
        return [
            "title" => 'required',
            "condition_type" => ['required',Rule::in(array_keys(config('platform.task_condition_types')))],
            "condition_money" => 'required|numeric',
            //"condition_number" => 'numeric',
            //"condition_day" => 'numeric',
            "award_type" => ["required",Rule::in(array_keys(config('platform.task_award_type')))],
        ];
    }

    public function storeHandle($data)
    {
        return $this->checkData($data);
    }

    public function updateHandle($data)
    {
        return $this->checkData($data);
    }

    public function checkData($data){
        if(!\request()->get('award_content')) throw new InvalidRequestException('?????????????????????');

        if($data['condition_type'] == Task::TYPE_SINGLE_RECHARGE){
            if(!array_key_exists('condition_number',$data)){
                throw new InvalidRequestException('?????????????????????????????????');
            }

            if(!array_key_exists('condition_day',$data)){
                throw new InvalidRequestException('?????????????????????????????????');
            }
        }

        // ?????????????????????
        if($data['award_type'] == Task::AWARD_TYPE_FD){
            if(!array_key_exists('fd_percent',$data['award_content'])){
                throw new InvalidRequestException('?????????????????????');
            }

            if(!array_key_exists('game_type',$data['award_content'])){
                throw new InvalidRequestException('?????????????????????');
            }

        }else if($data['award_type'] == Task::AWARD_TYPE_MONEY){
            if(!array_key_exists('money',$data['award_content'])){
                throw new InvalidRequestException('?????????????????????');
            }

            if(!array_key_exists('money_times',$data['award_content'])){
                throw new InvalidRequestException('??????????????????????????????');
            }

            if(!array_key_exists('money_per_day',$data['award_content'])){
                throw new InvalidRequestException('???????????????????????????');
            }
        }

        unset($data['award_content']);
        $data['award_content'] = json_encode(\request()->get('award_content'),JSON_UNESCAPED_UNICODE);

        return $data;
    }

    // ????????????
    public function level_setting(){
        // ??????????????????????????????
        $data = Task::systemLevel()->get();
        // ????????????????????????
        $levels = Task::systemLevel()->distinct('level')->select('level')->orderBy('level','asc')->pluck('level');
        return view('admin.task.level_setting',compact('data','levels'));
    }

    // ?????????????????????????????????????????????
    // ???????????????????????????????????????
    /**
     * [
    "ml_money" => "30000.00"
    "level_award" => "15"
    "level_week" => "1"
    "level_month" => "3"
    "level_borrow" => "40"
    ]
     */
    public function post_level_setting(Request $request,$level){
        $data = $request->all();
        $this->validateRequest($data,[
            'ml_money' => 'required|numeric|min:0',
        ]);

        // ??????????????????
        // $level_award = Task::where('level',$level)->systemLevelAndType($level,);

        try{
            DB::transaction(function() use ($data,$level){
                foreach (\Arr::except($data,'ml_money') as $key => $value){
                    $this->operate_task_level($level,$key,$data['ml_money'],$value);
                }

                // ?????? ????????????????????????
                $task = Task::systemLevelAndType($level,Task::LEVEL_TYPE_NAME)->first();
                if(!$task)
                    Task::create(app(Task::class)->getLevelNameData($level,$data['ml_money']));
            });
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }

        return $this->success(['reload' => true],'??????????????????');
    }

    protected function operate_task_level($level,$level_type,$ml_money,$money){
        // ??????????????????
        $task = Task::systemLevelAndType($level, $level_type)->first();

        if($task){
            if($money > 0){
                $award_content = $task->award_content;
                if(bccomp($award_content['money'],$money) !== 0){
                    $award_content['money'] = $money;
                    $task->update([
                        'award_content' => json_encode($award_content)
                    ]);
                }
            }else{
                $task->delete();
            }
        }else{
            // ????????? ?????????
            Task::create(app(Task::class)->getLevelDataByType($level,$ml_money,$money,$level_type));
        }
    }

    public function delete_level_setting(Request $request,$level){
        // ???????????????????????????task??????
        Task::where('level',$level)->whereIn('level_award_type',array_keys(config('platform.level_award_type')))->delete();
        return $this->success(['reload' => true],'????????????');
    }
}
