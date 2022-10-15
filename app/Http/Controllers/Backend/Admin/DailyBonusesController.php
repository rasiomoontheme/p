<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\DailyBonus;
use App\Models\MemberMoneyLog;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DailyBonusesController extends AdminBaseController
{
    protected $create_field = ['member_id','bonus_money','days','serial_days','total_days','type','state','remark','lang'];
    protected $update_field = ['member_id','bonus_money','days','serial_days','total_days','type','state','remark','lang'];

    public function __construct(DailyBonus $model){
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->model
            ->whereIn('type',[$this->model::TYPE_SERIAL_SETTING,$this->model::TYPE_TOTAL_SETTING])
            ->where($this->convertWhere($params))->latest()->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params'));
    }

    public function record_list(Request $request){
        $params = $request->all();
        $data = $this->model
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->whereNotIn('type',[DailyBonus::TYPE_SERIAL_SETTING,DailyBonus::TYPE_TOTAL_SETTING])
            ->where($this->convertWhere($params))->latest()->paginate(5);
        return view("{$this->view_folder}.record_list", compact('data', 'params'));
    }

    // 修改状态
    public function modify_state(DailyBonus $dailybonus,$state){
        if($dailybonus->update(['state' => $state])){
            return $this->success(['reload' => true],trans('res.base.operate_success'));
        }else{
            return $this->failed(trans('res.base.operate_fail'));
        }
    }

    public function edit(DailyBonus $dailybonus){
        return view($this->getEditViewName(),["model" => $dailybonus]);
    }

    public function storeRule(){
        return [
            "bonus_money" => 'required',
            "days" => 'required',
			"type" => Rule::in(array_keys(config('platform.daily_bonus_type'))),
			"state" => Rule::in(array_keys(config('platform.daily_bonus_state'))),
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    public function updateRule($id){
        return [
            "bonus_money" => 'required',
            "days" => 'required',
			"type" => Rule::in(array_keys(config('platform.daily_bonus_type'))),
			"state" => Rule::in(array_keys(config('platform.daily_bonus_state'))),
            "lang" => Rule::in(array_keys(config('platform.lang_select'))),
		];
    }

    public function checkDaysSetting($data){
        if($this->model->where('type',$data['type'])->where('lang',$data['lang'])->where('days',$data['days'])->count() > 0){
            throw new InvalidRequestException(trans('res.daily_bonus.msg.same_day_error'));
        }

        return $data;
    }

    // 设置红包大小
    public function setting_size() {
        $data = systemconfig('redbag_size_setting_json');
        if($data) {
            $data = json_decode($data,1);
        } else {
            $data = [];
            $lang_list = config('platform.currency_type');
            if ($lang_list) {
                foreach ($lang_list as $k_lang => $v_lang_name) {
                    $data[$k_lang]['a'] = $v_lang_name; // 最小，最大
                    $data[$k_lang]['b'] = [1, 1]; // 最小，最大
                }
            } else {
                $data = [];
            }
        }

        //var_dump($data);exit;

        return view('admin.dailybonus.setting_size',compact('data'));
    }

    public function post_setting_size(Request $request){
        $data = $request->all();
        //return $data['zh_cn'];
        $old_data = systemconfig('redbag_size_setting_json');
        if($old_data) {
            $old_data = json_decode($old_data,true);
        } else {
            $old_data = [];
            $lang_list = config('platform.currency_type');
            if ($lang_list) {
                foreach ($lang_list as $k_lang => $v_lang_name) {
                    $old_data[$k_lang]['a'] = $v_lang_name; // 最小，最大
                    $old_data[$k_lang]['b'] = [1, 1]; // 最小，最大
                }
            }
        }

        foreach ($old_data as $k_lang => $v) {
            if (isset($data[$k_lang])) {
                $old_data[$k_lang]['b'] = $data[$k_lang];
            }
        }

        $mod = SystemConfig::query()->getConfig('redbag_size_setting_json');

        if($mod->update([
            'value' => json_encode($old_data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }

    // 设置红包描述
    public function setting_desc(Request $request) {
        $now_lang = $this->guard()->user()->lang ?? 'zh_cn';
        $data = systemconfig('redbag_desc_setting_json');
        if($data) {
            $data = json_decode($data,1);
            $data = $data[$now_lang] ?? [];
        } else {
            $data = [];
        }

        $lang_list = systemconfig('vip1_lang_fields');
        if ($lang_list){
            $lang_list = json_decode($lang_list, true);
        } else{
            $lang_list = [];
        }

        //var_dump($data);exit;

        return view('admin.dailybonus.setting_desc',compact('data', 'lang_list', 'now_lang'));
    }

    public function post_setting_desc(Request $request){
        $data = $request->all();
        $arr = $insert_data = [];
        $old_data = systemconfig('redbag_desc_setting_json');
        if ($old_data){
            $insert_data = json_decode($old_data, true);
        }
        //return $data;
        $currency = $data['language'];

        $insert_data[$currency] = $request->get('content');

        $mod = SystemConfig::query()->getConfig('redbag_desc_setting_json');

        if($mod->update([
            'value' => json_encode($insert_data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }


    // redbag_setting_json
    public function setting(Request $request){
        $now_currency = $request->get('currency') ?: 'zh_cn';
        $data = systemconfig('redbag_setting_json');
        if($data){
            $data = json_decode($data,1);
            $data = $data[$now_currency] ?? [];

        } else{
            $data = [];
        }

        $lang_list = config('platform.currency_type');


        return view('admin.dailybonus.setting',compact('data', 'lang_list', 'now_currency'));
    }

    public function post_setting(Request $request){
        $data = $request->all();
        $arr = $insert_data = [];
        $old_data = systemconfig('redbag_setting_json');
        if ($old_data){
            $insert_data = json_decode($old_data, true);
        }
        //return $data;
        $currency = $data['currency'];

        // deposit 当日存款,valid_num 有效流水,times 转盘次数 默认为1，is_open
        foreach ($data['deposit'] as $k => $v){
            if($v){
                array_push($arr,[
                    'deposit' => $v,
                    'valid_num' => isset_and_not_empty($data['valid_num'],$k,0),
                    'times' => \Arr::get($data['times'],$k,1),
                    // 'awards' => isset_and_not_empty($data['awards'],$k,''),
                    'is_open' => $data['is_open'][$k] ?? 0
                ]);
            }
        }

        $insert_data[$currency] = $arr;

        $mod = SystemConfig::query()->getConfig('redbag_setting_json');

        if($mod->update([
            'value' => json_encode($insert_data, JSON_UNESCAPED_UNICODE)
        ])){
            return $this->success(['reload' => true],trans('res.base.save_success'));
        }else{
            return $this->failed(trans('res.base.save_fail'));
        }
    }

    public function get_redbag_log(Request $request)
    {
        $params = $request->all();

        $data = MemberMoneyLog::where('operate_type',MemberMoneyLog::OPERATE_TYPE_HONGBAO)
            ->memberName(isset_and_not_empty($params,'member_name',''))
            ->memberLang(isset_and_not_empty($params,'member_lang',''))
            ->latest()->paginate(5);

        return view("{$this->view_folder}.redbag_log", compact('data', 'params'));
    }

    protected function storeHandle($data)
    {
        return $this->checkDaysSetting($data);
    }

    protected function updateHandle($data)
    {
        return $this->checkDaysSetting($data);
    }
}
