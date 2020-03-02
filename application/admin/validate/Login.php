<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 登录验证器
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class Login extends Validate
{

    /**
     * 蚂蚁防红
     *
     * @auth Dany <cgh@tom.com>
     *
     * @var array
     */
    protected $rule =   [

        'username'  => 'require',
        'password'  => 'require',
    ];

    /**
     * 验证消息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @var array
     */
    protected $message  =   [

        'username.require'    => '用户名不能为空',
        'password.require'    => '密码不能为空',
    ];
}
