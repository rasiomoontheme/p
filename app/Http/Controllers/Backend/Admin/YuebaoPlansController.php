<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\YuebaoPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class YuebaoPlansController extends AdminBaseController
{
    protected $create_field = ['SettingName','MinAmount','MaxAmount','SettleTime','IsCycleSettle','Rate','TotalCount','LimitInterest','LimitOrderIntervalTime','InterestAuditMultiple','LimitUserOrderCount','is_open','lang','weight'];
    protected $update_field = ['SettingName','MinAmount','MaxAmount','SettleTime','IsCycleSettle','Rate','TotalCount','LimitInterest','LimitOrderIntervalTime','InterestAuditMultiple','LimitUserOrderCount','is_open','lang','weight'];

    public function __construct(YuebaoPlan $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model->where($this->convertWhere($params))->latest()->paginate(15);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function edit(YuebaoPlan $yuebaoplan){
        return view($this->getEditViewName(),["model" => $yuebaoplan]);
    }

    public function storeRule(){
        return [
			"SettingName" => "required",
			"MinAmount" => "required|numeric|min:0",
			"MaxAmount" => "required|numeric|min:0",
			"SettleTime" => "required|numeric|min:0",
			"IsCycleSettle" => "required|boolean",
			"Rate" => "required|numeric|min:0",
			"TotalCount" => "required|numeric|min:0",
			"LimitInterest" => "required|numeric|min:0",
            "LimitUserOrderCount" => "min:0"
		];
    }

    public function updateRule($id){
        return [
            "SettingName" => "required",
            "MinAmount" => "required|numeric|min:0",
            "MaxAmount" => "required|numeric|min:0",
            "SettleTime" => "required|numeric|min:0",
            "IsCycleSettle" => "required|boolean",
            "Rate" => "required|numeric|min:0",
            "TotalCount" => "required|numeric|min:0",
            "LimitInterest" => "required|numeric|min:0",
            "LimitUserOrderCount" => "min:0"
        ];
    }

    public function storeHandle($data)
    {
        return $this->checkFields($data);
    }

    public function updateHandle($data){
        return $this->checkFields($data);
    }

    public function checkFields($data){
        if($data['MinAmount'] > $data['MaxAmount']) throw new InvalidRequestException(trans('res.yuebao_plan.msg.min_money_err'));

        if($data['MaxAmount'] > $data['TotalCount']) throw new InvalidRequestException(trans('res.yuebao_plan.msg.max_money_err'));

        if(!array_key_exists('LimitUserOrderCount',$data) || !$data['LimitUserOrderCount']){
            $data['LimitUserOrderCount'] = 0;
        }

        return $data;
    }
}
