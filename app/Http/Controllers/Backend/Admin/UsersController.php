<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exports\UsersExport;
use App\Models\User;
use App\Services\GoogleAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends AdminBaseController
{
    protected $model;
    //protected $view_folder = "admin.user";

    protected $create_field = ["name", "password", "status"];
    protected $update_field = ["password", "status"];

    public function __construct(User $user){
        $this->model = $user;
        parent::__construct();
    }

    // public function indexUrl(){
    //     return route("admin.users.index");
    // }

    public function edit(User $user){
        return view($this->getEditViewName(),["model" => $user]);
    }

    public function export(){
        return Excel::download(new UsersExport,$this->model_name.'.xlsx');
    }

    public function storeRule(){
        return [
            "name" => "required|min:4|unique:users,name",
            "password" => "required|min:6",
            // "email" => "required|unique:users,email",
            "status" => [
                "required",Rule::in(array_keys(User::$statusMap))
            ]
        ];
    }

    public function updateRule($id){
        return [
            "name" => "min:4|unique:users,name,".$id,
            //"password" => "min:6",
            // "email" => "required|unique:users,email,".$id,
            "status" => [
                "required",Rule::in(array_keys(User::$statusMap))
            ]
        ];
    }

    public function storeHandle($data){
        $data['create_ip'] = get_client_ip();
        return $data;
    }

    public function updateHandle($data){
        if(!$data["password"]){
            return Arr::except($data,"password");
        }
        return $data;
    }

    public function userinfo(Request $request){
        $user = $this->guard()->user();
        return view("admin.user.userinfo",compact("user"));
    }

    public function modify_pwd(Request $request)
    {
        return view("admin.user.modify_pwd");
    }

    public function post_modify_pwd(Request $request)
    {
        // 旧密码，新密码，确认新密码
        $data = $request->only(['oldpassword', 'password', 'password_confirmation']);

        $validator = Validator::make(
            $data,
            [
                'oldpassword' => 'required|min:6',
                'password' => 'required|confirmed|min:6|different:oldpassword',
                'password_confirmation' => 'required|min:6|same:password'
            ]);



        $user = $this->guard()->user();
        $validator->after(function ($validator) use ($data, $user) {
            if (!Hash::check($data['oldpassword'], $user->password)) {
                $validator->errors()->add('oldpassword', trans('res.user.msg.oldpassword_error'));
            }
        });

        if($validator->fails()) $this->dealFailValidator($validator);

        $data = Arr::only($data, ['password']);

        if ($this->updateByModel($user, $data)) {
            // 密码修改成功，退出登录，跳转到登录界面
            $this->UserLogout();
            return $this->success(["redirect" => route("admin.login")],trans('res.user.msg.modify_success_login'));
            // return $this->success(["reload" => true],'密码修改成功');
        } else {
            return $this->failed(trans('res.user.msg.modify_error'));
        }
    }

    public function assign(Request $request,User $user){
        // 获取角色列表
        $roles = Role::query()->where("guard_name",$this->guard_name)->get();
        // 获取用户的所有角色id
        // $roleids = $user->roles
        return view("admin.user.assign",compact("user","roles"));
    }

    public function post_assign(Request $request,User $user){
        $roles = $request->only("roles");
        // dd($roles);
        if($user->syncRoles($roles)){
            return $this->successWithUrl([], trans('res.user.msg.assign_success'), $this->indexUrl());
        } else {
            return $this->failed(trans('res.user.msg.assign_fail'));
        }
    }

    public function lang(){
        $user = $this->guard()->user();
        return view('admin.user.lang',compact('user'));
    }

    public function post_lang(Request $request){
        $data = $request->only('lang');

        $this->validateRequest($data,[
            'lang' => ['required',Rule::in(array_keys(config('platform.language_type')))]
        ]);

        $user = $this->guard()->user();

        if($user->update(['lang' => $data['lang']])){
            session(['applocale' => $data['lang']]);
            return $this->success(['redirect' => route('admin.main')],trans('res.base.update_success'));
        }else {
            return $this->failed(trans('res.base.update_fail'));
        }
    }

    public function google_secret(Request $request, GoogleAuthService $service){
        $user = $this->guard()->user();

        $is_save = $request->get('is_save',0);

        $secret = $user->google_secret;

        // 判断现在是否有 google_secret
        if(!$secret){
            $is_save = 1;
            $secret = $service->createSecret();
        }

        $img_url = $service->getQRCodeGoogleUrl(getUrl(env('ADMIN_URL') ?? env('APP_URL')),$secret);

        return view('admin.user.google',compact('user','is_save','secret','img_url'));
    }

    public function post_google_secret(Request $request,GoogleAuthService $service){
        // 检查参数
        $data = $request->all();

        $this->validateRequest($data,[
            'google_secret' => 'required',
            'code' => 'required|numeric'
        ]);

        // 检查是否匹配
        if(!$service->verifyCode($data['google_secret'], $data['code'], 2)){
            return $this->failed(trans('res.user.login.google_auth_error'));
        }

        $user = $this->guard()->user();

        if($user->update(['google_secret' => $data['google_secret']])){
            return $this->success(["reload" => true]);
        }else{
            return $this->failed(trans('res.base.operate_fail'));
        }
    }

    public function post_reset_google(Request $request,User $user){
        $own = $this->guard()->user();

        if($own->name != 'admin' && $user->id == $own->id) return $this->failed(trans('res.user.google.reset_own_error'));

        if($user->update(['google_secret' => ''])){
            return $this->success(["reload" => true]);
        }else{
            return $this->failed(trans('res.base.operate_fail'));
        }
    }
}
