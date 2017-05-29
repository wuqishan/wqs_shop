<?php
namespace app\common\model;

use think\Model;
use think\Session;

class Admin extends Model
{
    // 设置完整的数据表（包含前缀）
    protected $table = 'admins';

    public function initLogin($admin, $where_query)
    {
        $admin = [
            'id' => $admin->id,
            'name' => $admin->name,
            'pass' => $admin->pass,
            'last_login_time' => $admin->last_login_time,
            'last_login_ip' => $admin->last_login_ip,
            'last_active_time' => time()
        ];

        Session::set('admin', $admin);

        //更新最后请求IP及时间
        $update_info = [
            'last_login_ip' => request()->ip(),
            'last_login_time' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ];
        $this->where($where_query)->update($update_info);

        return true;
    }



}