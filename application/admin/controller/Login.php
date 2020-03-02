<?php
/**
 * Created by PhpStorm.
 * User: CGHang
 * Date: 2019/1/6
 * Time: 12:23
 */
namespace app\admin\controller;
use app\common\controller\Common;

class Login extends Common {
    /**
     * 蚂蚁防红 - 登录首页
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index()
    {
        //登录检测
        is_admin_login() && $this->redirect(url('admin/index/index'));
        return $this->fetch();
    }

    /**
     * 蚂蚁防红 - 退出登陆
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function logout(){
        $this->result(
            $this->logicLogin->logout()
    );
    }


    /**
     * 蚂蚁防红 - 管理员登陆
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $username
     * @param string $password
     * @param string $vercode
     */
    public function login($username = "",$password = "",$vercode = ""){
        $this->result($this->logicLogin->dologin($username, $password, $vercode));
    }
}