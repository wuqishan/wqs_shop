<?php
namespace app\admin\controller;

class Goods extends AdminAuth
{
    public function index()
    {
        $this->view->engine->layout(false);
        return view();
    }

    public function add()
    {
        $this->view->engine->layout(false);
        return view();
    }

    public function add_action()
    {

        dump($_POST);exit;
    }
}