<?php
namespace app\admin\controller;

class Index extends AdminAuth
{
    public function index()
    {
        $this->view->engine->layout(false);
        return view();
    }

}