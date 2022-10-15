<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RolesController extends AdminBaseController
{
    protected $create_field = ["name", "description"];
    protected $update_field = ["description"];

    public function __construct(Role $model){
        $this->model = $model;
        parent::__construct();
    }

    public function edit(Role $role){
        return view($this->getEditViewName(),["model" => $role]);
    }

    public function storeRule(){
        return [
            "name" => "required|min:2|unique:roles,name",
        ];
    }

    public function updateRule($id){
        return [
            "name" => "min:2|unique:roles,name,".$id,
        ];
    }

    public function storeHandle($data){
        $data['guard_name'] = $this->guard_name;
        return $data;
    }

    public function assign(Request $request,Role $role,MenuService $service){
        // 获取权限列表
        // $permissions = $service->getFirstLevelPermission($this->guard_name);
        $permissions = Permission::where("guard_name",$this->guard_name)->where("level",0)->orderBy("weight")->get();
        // 角色的权限id数组
        $permission_ids = $role->permissions->pluck('id')->toArray();
        return view("admin.role.assign",compact("role","permissions","permission_ids"));
    }

    public function post_assign(Request $request,Role $role){
        $permissions = $request->only("permissions");
        // dd($permissions);
        if($role->syncPermissions($permissions)){
            return $this->successWithUrl([], trans('res.role.msg.assign_success'), $this->indexUrl());
        } else {
            return $this->failed(trans('res.role.msg.assign_fail'));
        }
    }
}
