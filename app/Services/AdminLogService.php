<?php

namespace App\Services;

use App\Models\SystemConfig;
use App\Traits\CurdTrait;
use Zhuzhichao\IpLocationZh\Ip;
use App\Models\AdminLog;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

class AdminLogService{

    use CurdTrait;

    public $model;

    public function __construct(AdminLog $model){
        $this->user = request()->user("web");
        $this->model = $model;
    }

    /**
     * 日志格式化
     * @param int $type
     * @param string $remark
     * @return array
     */
    public function getLogFormatter($type = 2,$description = '', $remark = ''){
        $ip = get_client_ip() ?? '';
        $data = ($type == AdminLog::LOG_TYPE_LOGIN) ? request()->except(['_token','password']) : (request()->except('_token') ?? []);
        $data = http_build_query($data, false);
        $data = string_limit($data,200);

        $ipaddress = Ip::find($ip);
        return [
            'user_id' => $this->user->id ?? 0,
            'url' => request()->url() ?? '',
            'ip' => $ip,
            'address' => is_array($ipaddress) ? implode(' ',$ipaddress) : $ip,
            'ua' => request()->userAgent() ?? '',
            'data' => $data ,
            'type' => $type,
            'description' => $description,
            'remark' => $remark
        ];
    }

    /**
     * 记录管理员登录日志
     * @param $request
     * @param string $err
     * @return mixed
     */
    public function loginLogCreate($err = ''){
        if(SystemConfig::isInWhiteIp()) return;

        $description = $err
            ? " 登录失败，失败原因：{ $err }，登录的账号为：".request()->get('name')."　密码为：".request()->get('password')
            : "管理员: {$this->user->name} 登录成功";

        $remark = '';

        // 如果账号 admin 登录成功，记录sessionId
        if(!$err && $this->user->isSingleLogin()){
            $remark = time();
            session([$this->user->getLoginSessionTag() => $remark]);
        }

        $data = $this->getLogFormatter(AdminLog::LOG_TYPE_LOGIN,$description,$remark);
        
        return $this->add($data);
    }

    /**
     * 记录管理员注销日志
     * @param $request
     * @param string $remark 备注
     * @return mixed
     */
    public function logoutLogCreate($remark = '')
    {
        if(SystemConfig::isInWhiteIp()) return;

        $description = "管理员: {$this->user->name} 注销账号";

        $data = $this->getLogFormatter(AdminLog::LOG_TYPE_LOGOUT, $description, $remark);

        return $this->add($data);
    }

    /**
     * 记录管理员操作日志
     * @param $request
     * @return bool
     */
    public function operateLogCreate()
    {
        if(SystemConfig::isInWhiteIp()) return;

        $route = Route::currentRouteName();

        if($route == 'admin.notice') return;

        $permission = Permission::where('route_name',$route)->orderBy('level')->first();

        if (!$permission) return false;

        // if ($permission->pid) {
        //     $parent_permission = Permission::findById($permission->pid);
        // }

        $description = "管理员: {$this->user->name} 操作了"; 
        
        $description .= $permission->pid && $permission->parent ? "【" . $permission->parent->name . "】- " : "";

        $description .= "【{$permission->name}】 模块";

        $data = $this->getLogFormatter(AdminLog::LOG_TYPE_ACTION, $description); //dd($data);

        return $this->add($data);
    }

    // app(App/Services/AdminLogService::class)->systemLogCreate('测试记录');
    public function systemLogCreate($description){
        $data = $this->getLogFormatter(AdminLog::LOG_TYPE_SYSTEM,$description);
        return $this->add($data);
    }
}