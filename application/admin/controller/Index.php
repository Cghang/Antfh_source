<?php

namespace app\admin\controller;

class Index extends BaseAdmin
{
    /**
     * 蚂蚁防红 - 首页
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index()
    {
        $ver = update_version($this->version,$this->website['secret']);
        $this->assign('ver',$ver['data']);
        return $this->render("后台首页",$this->logicFhdomain->getFhdomainStat());
    }

    public function reset_password(){

        $this->request->isPost() && $this->result($this->logicAdmin->changeAdminPwd($this->request->post()));

        $this->assign('info',$this->logicAdmin->getAdminInfo(['id' => 1]));
        return $this->render("修改密码");
    }
}
