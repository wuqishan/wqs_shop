<?php
namespace app\admin\controller;
use app\common\model\Admin as AdminModel;
use think\Controller;

//权限认证
class AdminAuth extends Controller
{
    /**
     * 权限验证方法
     * @return bool
     */
    protected function _initialize()
    {
        $request = request();
        //session存在时，不需要验证的权限
        $not_check = array('admin/login','admin/login_action','admin/lostpassword','admin/logout','admin/lost_password');

        //当前操作的请求 模块名/方法名
        if(in_array($request->module().'/'.$request->action(), $not_check) || $request->module() != 'admin'){
            return true;
        }

        //session不存在时，不允许直接访问
        if(!session('admin.id')){
            //未登陆跳转
            $this->error('还没有登录，正在跳转到登录页','admin/login');
        }

        //密码校验
        if(config('auth_password_check')){
            $this->auth_password_check();
        }

        //过期时间校验
        if(config('auth_expired_check')){
            $this->auth_expired_check();
        }
    }

    /**
     * 实时密码验证
     */
    protected function auth_password_check()
    {
        $user = new AdminModel;
        $where_query = array(
            'name' => session('admin.name'),
            'pass' => session('admin.pass')
        );
        $user = $user->where($where_query)->find();
        if (!$user) {
            session(null);
            $this->error('登录失效:用户密码已更改','admin/login');
        }
    }

    /**
     * session 过期验证
     */
    protected function auth_expired_check()
    {
        if (time() - config('auth_expired_time') > session('admin.last_active_time')) {
            session(null);
            $this->error('账号已过期','admin/login');
        } else {
            session('admin.last_active_time', time());
        }
    }
}