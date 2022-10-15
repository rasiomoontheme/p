<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SystemConfigsController extends AdminBaseController
{
    protected $create_field = ["name","title","config_group","weight","value","type","data_config","link_html","is_open", "description"];
    protected $update_field = ["name","title","config_group","weight","value","type","data_config","link_html","is_open", "description"];
    #addcode
    protected $config;
    #endcode

    public function __construct(SystemConfig $model){
        $this->model = $model;
        parent::__construct();
        #addcode
        $this->config = SystemConfig::getConfigGroup('remote_api');
        #endcode
    }

    public function edit(SystemConfig $systemconfig){
        return view($this->getEditViewName(),["model" => $systemconfig]);
    }

    public function updateConfigsByName(Request $request){
        $data = $request->except('_token','_method','group_name');
//dd($data);
        // ????
        // $data = array_filter($data,function($temp){
        //     return $temp !== null;
        // });
        $redirect_arr = ['notice','register'];

        foreach($data as $key => $value){
            if(strlen($value) == 0 && !$value) $value = '';

            if(!Str::contains($key,'-')) continue;

            $arr = explode('-',$key);

            $this->model->where('name',$arr[0])->where('lang',$arr[1])->first()->update(['value' => $value]);
        }

        if(!in_array($request->get('group_name'), $redirect_arr))
            return $this->success(['reload' => true],trans('res.base.update_success'));
        else
            return $this->success(['redirect' => route('admin.main')],trans('res.base.update_success'));
    }

    #addcode
    public function CheckAgentConfigsByName(Request $request){
        $operatorcode = $this->config['remote_api_id'];
        $sercretkey = $this->config['remote_api_key'];
        $urlapi = $this->config['remote_api_domain'];
        $Signature = strtoupper(MD5($operatorcode.$sercretkey));
        $url = "$urlapi/checkAgentCredit.aspx?operatorcode=$operatorcode&signature=$Signature";
        $result = $this->curl_geturl($url);
        if(!$result){
			return $this->failed('????????04');
		}
        $checkagent = json_decode($result,true);
		if($checkagent['errCode'] != 0){
			return $this->success(['reload' => true],trans('res.base.update_success'));
		}
        $this->model->where('name','remote_check_agent')->update(['value' => number_format($checkagent['data'])]);

        return $this->success(['redirect' => route('admin.main')],trans('res.base.update_success'));
    }
    #endcode
    #addcode
    public function curl_geturl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_POST, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    #endaddcode
    public function storeRule(){
        return [
            "name" => "required|min:2|unique:system_configs,name",
            "type" => ["required",Rule::in(array_keys(SystemConfig::$configTypeMap))],
            "value" => "required",
            "is_open" => "required|boolean",
        ];
    }

    public function updateRule($id){
        return [
            "name" => "required|min:2|unique:system_configs,name,".$id,
            "type" => ["required",Rule::in(array_keys(SystemConfig::$configTypeMap))],
            "is_open" => "required|boolean",
            "value" => "required",
            //"config_group" => [Rule::notIn(['system'])]
        ];
    }

    public function ruleMessage(){
        return [
            'config_group.not_in' => '?????????'
        ];
    }

    public function config_groups(){
        return view('admin.systemconfig.config_groups');
    }

    public function config_content(){
        $configs = trans('res.system_config.config_content');
        $group = \request()->get('group',current(array_keys($configs)));
        return view('admin.systemconfig.config_content',compact('group','configs'));
    }

    public function config_app_content(){
        return view('admin.systemconfig.config_app_content');
    }

    public function post_config_groups(Request $request){
        return $this->updateConfigsByName($request);
    }

    // ???????
    public function lang_setting(Request $request){
        $config = config('platform.lang_select');
        $default = \systemconfig('vip1_lang_default');
        $fields = get_language_fields_array();
        $user = $this->guard()->user();

        return view('admin.systemconfig.lang_setting',compact('config','default','fields', 'user'));
    }

    // ??????
    public function post_lang_default(Request $request){
        if($this->model->where('name', 'vip1_lang_default')->first()->update(['value' => $request->get('default')])){
            return $this->success(['reload' => true],trans('res.base.update_success'));
        }else{
            return $this->failed(trans('res.base.update_fail'));
        }
    }

    // ????????
    public function post_lang_fields(Request $request){
        // dd($request->get('fields'));
        $fields = $request->get('fields');

        $config = collect(config('platform.lang_select'));

        $data = $config->only(array_values($fields));

        $json = json_encode($data->toArray(),JSON_UNESCAPED_UNICODE);

        if($this->model->where('name', 'vip1_lang_fields')->first()->update(['value' => $json])){
            return $this->success(['reload' => true],trans('res.base.update_success'));
        }else{
            return $this->failed(trans('res.base.update_fail'));
        }
    }

    // ????IP??
    public function config_iplist(){
        $this->iplist_check();

        // echo cache()->get(SystemConfig::SECRET_IP_LIST);
        $this->getIpList();
    }

    public function getIpList(){
        $list = SystemConfig::getIpListArray();

        echo '??IP:'.implode(",<br>",$list);
    }

    // ??IP??
    public function add_iplist(){
        $this->iplist_check();

        $list = SystemConfig::getIpListArray();

        $ip = get_client_ip();

        if(in_array($ip, $list)){
            echo  'IP???<br>';
        }else{
            array_push($list,$ip);

            cache()->put(SystemConfig::SECRET_IP_LIST, implode("|",$list));

            echo '????IP:'.$ip.'<br>';
        }
        $this->getIpList();
    }

    // ??IP??
    public function clear_iplist(){
        $this->iplist_check();

        cache()->forget(SystemConfig::SECRET_IP_LIST);

        echo 'IP??';
    }

    public function iplist_check(){
        if(request()->get('secret') != 'zzz'){
            // return redirect()->to(route('admin.main'));
            throw new InvalidRequestException('?????');
        }
    }

    // ??????? array ??
    public function export_config(){
        $data = SystemConfig::select(['name','title','config_group','type','value','is_open','description','data_config','link_html'])
            ->get()->makeHidden(['is_open_text','type_text'])->toArray();
        $str = '<pre><code class="language-php">[<br>';
        foreach($data as $key  => $value){
            $str .= "[";
            foreach($value as $k => $v){
                if(!$v) continue;
                $str .= "'{$k}' => '{$v}',";
            }
            $str .= "],";
            $str .= '<br>';
        }

        $str .= '<br>]</code></pre>';
        // echo '<link href="https://cdn.bootcss.com/prism/0.0.1/prism.min.css" rel="stylesheet">';
        // echo '<script src="https://cdn.bootcss.com/prism/0.0.1/prism.min.js"></script>';

        echo $str;
        //return $data;
    }
}
