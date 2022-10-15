<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Services\MenuService;

class PermissionsController extends AdminBaseController
{
    protected $create_field = ["name", "icon", "pid", "route_name", "is_show", "weight", "description", "remark","lang_json"];
    protected $update_field = ["name", "icon", "pid", "route_name", "is_show", "weight", "description", "remark","lang_json"];

    public function __construct(Permission $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $data = $this->model->query()->guard($this->guard_name)
            ->orderBy('weight','desc')
            ->latest()->get()
            ->transform(function($item){
                $item->name = $item->getLangName();
                return $item;
            });
        return view("admin.permission.index", compact('data'));
    }


    public function createOrChild(Permission $permission, $pid = null, MenuService $service)
    {
        // 获取父级权限列表
        $data = $this->model->select(['id', 'name', 'pid'])->guard($this->guard_name)->get()->each->append('lang_json_arr');
        return view("{$this->view_folder}.create_and_edit", [
            //'pid' => $pid,
            'html' => MenuService::getModelSelectHtml($data, $pid ?? 0),
            'model' => $permission
        ]);
    }

    public function edit(Permission $permission, Request $request)
    {
        $data = $this->model->select(['id', 'name', 'pid','lang_json'])->guard($this->guard_name)->get()->each->append('lang_json_arr');
        return view($this->getEditViewName(), [
            "model" => $permission,
            'html' => MenuService::getModelSelectHtml($data, $permission->pid ?? 0 ?? 0),
        ]);
    }

    public function storeRule()
    {
        return [
            "name" => "required|min:2|unique:permissions,name",
            'pid' => 'integer',
            'is_show' => 'required|boolean|integer',
            // 'weight' => 'integer'
        ];
    }

    public function updateRule($id)
    {
        return [
            "name" => "min:2|unique:permissions,name," . $id,
            'pid' => 'integer',
            'is_show' => 'boolean|integer',
            // 'weight' => 'integer'
        ];
    }

    public function storeHandle($data){
        $data = $this->dealData($data);
        return $data;
    }

    public function updateHandle($data){
        $data = $this->dealData($data);
        return $data;
    }

    public function dealData($data){
        if(!is_array($data['lang_json']) || !count($data['lang_json'])) throw new InvalidRequestException(trans('res.permission.msg.lang_json_error'));

        $data['lang_json'] = json_encode($data['lang_json'],JSON_UNESCAPED_UNICODE);

        if(isset_and_not_empty($data,'route_name')) app(MenuService::class)->validateRouteName($data['route_name']);

        return $data;
    }
}
