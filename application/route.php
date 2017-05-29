<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name'  => '\w+',
        'id'    => '\d+',
        'year'  => '\d{4}',
        'month' => '\d{2}',
    ],

    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    'admin/login/'                               => 'admin/index/login',
    'admin/login_action/'                        => 'admin/admin/login_action',

    'admin/index/'                               => 'admin/index/index',

    'admin/goods/'                               => 'admin/goods/index',
    'admin/goods_add/'                           => 'admin/goods/add',
    'admin/goods_add_action/'                    => 'admin/goods/add_action',
];
