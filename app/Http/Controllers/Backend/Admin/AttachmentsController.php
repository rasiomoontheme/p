<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends AdminBaseController
{
    public function __construct(Attachment $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    // public function index(Request $request)
    // {
    //     $params = $request->all();
    //     $data = $this->model->query()->with('owner')->where($this->convertWhere($params))->paginate(5);
    //     return view("{$this->view_folder}.index", compact('data', 'params'));
    // }
}
