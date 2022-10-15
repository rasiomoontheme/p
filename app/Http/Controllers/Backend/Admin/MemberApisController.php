<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberApi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberApisController extends AdminBaseController
{
    // protected $create_field = ['api_name','username','password','money','last_login_at','description'];
    // protected $update_field = ['api_name','username','password','money','last_login_at','description'];

    public function __construct(MemberApi $model){
        $this->model = $model;
        parent::__construct();
    }

    // public function edit(MemberApi $memberapi){
    //     return view($this->getEditViewName(),["model" => $memberapi]);
    // }


}
