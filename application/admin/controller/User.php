<?php
/**
 * Created by PhpStorm.
 * User: CGHang
 * Date: 2019/1/11
 * Time: 14:06
 */
namespace app\admin\controller;
use app\common\library\enum\CodeEnum;
use think\facade\Request;

class User extends BaseAdmin{

    /**
     * 商户管理 - 商户列表
     *
     * @author Dany <cgh@tom.com>
     *
     * @return mixed
     */
    function index(){
        return $this->render("用户列表");
    }

    /**
     * 商户管理 - 添加商户
     *
     * @author Dany <cgh@tom.com>
     *
     * @return mixed
     */
    function adduser(){
        return $this->render("添加用户");
    }

    /**
     * 蚂蚁防红 - 修改商户
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $uid
     * @return mixed
     */
    function modify($uid){
        $userinfo = $this->logicUser->getUserInfo(['uid'=>$uid]);
        return $this->render("修改商户",['userinfo'=>$userinfo]);
    }

    /**
     * 蚂蚁防红 - 修改商户
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function doModify(){
        $para = Request::param();
        $para['out_time'] = strtotime($para['out_time']);
        isset($para['password'])?$para['password'] = md5($para['password']):NULL;
        $where = ['uid'=>$para['uid']];
        $this->result(
            $this->logicUser->settingSave($where,$para)
        );
    }

    /**
     * 蚂蚁防红 - 获取列表
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    function getList(){
        $where = [];
        //组合搜索
        !empty($this->request->param('mrtVal')) && $where['uid|account|qq|username|phone']
            = ['eq', $this->request->param('mrtVal')];
        $data = $this->logicUser->getUserList($where,true, 'create_time desc',$this->request->param('pageSize'));

        $count = $this->logicUser->getUserCount($where);

        $this->result($data && $count != 0 ?
            [
                'code' => CodeEnum::SUCCESS,
                'msg'=> '',
                'count'=>$count,
                'data'=>$data
            ] : [
                'code' => CodeEnum::ERROR,
                'msg'=> '暂无数据',
                'count'=>$count,
                'data'=>$data
            ]
        );
    }
}