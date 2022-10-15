<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {
        return redirect()->to(request()->url() == env('AGENT_URL') ? route('agent.login') : route('admin.login'));
    }
}
