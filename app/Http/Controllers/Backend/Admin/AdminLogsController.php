<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use Illuminate\Http\Request;

class AdminLogsController extends AdminBaseController
{
    // protected $create_field = ["name", "icon", "pid", "route_name", "is_show", "weight", "description", "remark"];
    // protected $update_field = ["name", "icon", "pid", "route_name", "is_show", "weight", "description", "remark"];

    public function __construct(AdminLog $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $title = $request->get('title');
        $params = $request->all();
        $data = $this->model->query()->with('user')->where($this->convertWhere($params))->latest()->paginate(5);
        return view("{$this->view_folder}.index", compact('data', 'params','title'));
    }

    public function typelogin(){
        return redirect()->to(route('admin.adminlogs.index',['type' => AdminLog::LOG_TYPE_LOGIN,'title' => trans('res.admin_log.title.login_title')]));
    }

    public function typelogout(){
        return redirect()->to(route('admin.adminlogs.index',['type' => AdminLog::LOG_TYPE_LOGOUT,'title' => trans('res.admin_log.title.logout_title')]));
    }

    public function typeaction(){
        return redirect()->to(route('admin.adminlogs.index',['type' => AdminLog::LOG_TYPE_ACTION,'title' => trans('res.admin_log.title.operate_title')]));
    }

    public function typesystem(){
        return redirect()->to(route('admin.adminlogs.index',['type' => AdminLog::LOG_TYPE_SYSTEM,'title' => trans('res.admin_log.title.system_title')]));
    }
}
