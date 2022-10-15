<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;

class WebBaseController extends BaseController
{
    public $isMobile;

    // 判断手机还是电脑浏览
    public function __construct()
    {
        $this->isMobile = is_Mobile();
    }

    public function getViewName($view)
    {
        $view_name = $this->isMobile ? 'wap' : 'web';
        $view_name .= '.' . $view;
        return $view_name;
    }
}
