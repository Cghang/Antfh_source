<?php
/**
 * Created by PhpStorm.
 * User: CGHang
 * Date: 2019/1/6
 * Time: 12:35
 */

namespace app\admin\logic;
use app\common\library\enum\CodeEnum;

class Login extends BaseAdmin
{

    /**
     * 蚂蚁防红 - 登陆
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $username
     * @param $password
     * @return array
     */
    public function dologin($username,$password){

        $validate = $this->validateLogin->check(compact('username','password'));

        if (!$validate) {
            return [ 'code' => CodeEnum::ERROR, 'msg' => $this->validateLogin->getError()];
        }
        $admin = $this->logicAdmin->getAdminInfo(['username' => $username]);
        //print_r(data_md5_key($password));exit;
        if (!empty($admin['password']) && data_md5_key($password) == $admin['password']) {

            $this->logicAdmin->setAdminValue(['id' => $admin['id']], 'update_time', time());

            $auth = ['id' => $admin['id'], 'update_time'  =>  time()];

            session('admin_info', $admin);
            session('admin_auth', $auth);
            session('admin_auth_sign', data_auth_sign($auth));

            action_log('登录', '管理员'. $username .'登录成功');

            return [ 'code' => CodeEnum::SUCCESS, 'msg' => '登录成功','data' => ['access_token'=> data_auth_sign($auth)]];

        } else {

            return [  'code' => CodeEnum::ERROR, 'msg' => empty($admin['id']) ? '用户账号不存在' : '密码输入错误'];
        }
    }

    /**
     * 蚂蚁防红 - 注销当前用户
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return array
     */
    public function logout()
    {

        clear_admin_login_session();

        return [ 'code' => CodeEnum::SUCCESS, 'msg' => '注销成功'];
    }

    /**
     * 蚂蚁防红 - 清理缓存
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return array
     */
    public function clearCache()
    {

        \think\Cache::clear();

        return [ 'code' => CodeEnum::ERROR, 'msg' =>  '清理成功'];
    }
}