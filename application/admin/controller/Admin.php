<?php
namespace app\admin\controller;

use app\common\model\Admin as AdminModel;
use think\Validate;
use think\Session;

class Admin extends AdminAuth
{
    public function login()
    {
        $this->view->engine->layout(false);
        return view();
    }

    public function login_action()
    {
        $admin_model = new AdminModel();
        $data = input('post.');
        $rule = [
            'username|管理员账号' => 'require|min:5',
            'password|管理员密码' => 'require|min:5',
            'code|验证码'=>'require|captcha'
        ];

        // 数据验证
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(! $result){
            $this->error($validate->getError()); ;
        }

        $preview = $admin_model->where(array('name' => $data['username']))->find();
        if(! $preview){
            $this->error('用户不存在');
        }

        $where_query = array(
            'name' => $data['username'],
            'pass' => (isset($preview['salt']) && $preview['salt']) ? md5($data['password'].$preview['salt']) : md5($data['password']),
        );

        if ($admin = $admin_model->where($where_query)->find()) {
            $admin_model->initLogin($admin, $where_query);

            return $this->success('登录成功', 'admin');
        } else {
            $this->error('登录失败:账号或密码错误');
        }
    }


}