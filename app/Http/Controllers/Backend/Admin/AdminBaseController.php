<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminBaseController extends BaseController
{
    protected $guard_name = "web";

    // view根目录文件夹名称
    protected $root_folder = "admin";

    public function __construct(){
        parent::__construct();
    }

    protected function guard()
    {
        return Auth::guard($this->guard_name);
    }



}
