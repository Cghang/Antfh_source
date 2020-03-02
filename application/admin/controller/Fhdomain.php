<?php


namespace app\admin\controller;

use app\common\library\enum\CodeEnum;
use app\common\library\enum\OrderStatusEnum;
use think\facade\Request;
use think\facade\Validate;
use think\helper\Time;

class Fhdomain extends BaseAdmin
{

    /**
     * 蚂蚁防红 -防红链接
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index(){
        list($starttime, $endtime) = Time::year();
        $this->assign(['starttime'=>date('Y-m-d',$starttime),'endtime'=>date('Y-m-d',$endtime)]);
        return $this->render("防红链接");
    }

    /**
     * 订单管理 - 查询接口
     *
     * @author Dany <cgh@tom.com>
     *
     */

    public function getFhdomainList(){//type time page pageSize
        $where['a.status'] = $this->request->param('status') == 'all'?[["=",0],["=",1],["=",2],["=",3] ,"OR"]:$this->request->param('status');
        //状态
        $this->request->param('type')==0?null:$where['a.type'] = $this->request->param('type');
        //组合搜索
        !empty($this->request->param('ordVal')) && $where['a.title|a.longurl|a.shorturl']
            = ['like', '%'.$this->request->param('ordVal').'%'];
        //时间搜索  时间戳搜素
        $where['a.create_time'] = $this->parseRequestDate();

        $data = $this->logicFhdomain->getFhdomainList($where,true, 'a.create_time desc',$this->request->param('pageSize'));

        $count = $this->logicFhdomain->getFhdomainCount($where);

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

    /**
     * 蚂蚁防红 - 添加防红
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function addFhdomain(){
        $list = $this->logicTzdomain->getTzdomainList(['status'=>1],'id,url', 'create_time desc',10);
        //print_r($list);exit;
        return $this->render('添加防红',['list'=>$list]);
    }

    /**
     * 蚂蚁防红 - 添加接口
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $url
     * @param string $title
     * @param int $type
     * @return array
     */
    public function addfhurl($url = '', $title = '', $type = 1 ,$tzurl = "all"){
        $validate = $this->validateFhurl->check(compact('url','title'));
        if(!$validate){
            return ['code'=>CodeEnum::ERROR,'msg'=>$this->validateFhurl->getError()];
        }
        $this->result(
            $this->logicFhdomain->fhdomainAdd(['longurl'=>$url,'title'=>$title,'type'=>$type,'out_time'=>strtotime("+1 month"),'uid'=>0,'tzurl'=>$tzurl])
        );
    }

    /**
     * 蚂蚁防红 - 删除防红
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $id
     * @return array
     */
    public function delFhdomain($id = ''){
        $validate = Validate::regex($id,'\d+');
        if (!$validate){
            return ['code'=>CodeEnum::ERROR,'msg'=>'传入Id必须为整数，请勿非法操作'];
        }
        $this->result($data = $this->logicFhdomain->FhdomainDel(['id'=>$id]));
    }

    /**
     * 蚂蚁防红 - 修改防红链接
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $uid
     * @return mixed
     */
    function modify($id){
        $domain = $this->logicFhdomain->getFhdomainInfo(['id'=>$id]);
        //print_r($domain);exit;
        return $this->render("修改防红链接",['domain'=>$domain]);
    }

    /**
     * 蚂蚁防红 - 修改链接
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    //ALTER TABLE `ant_fhdomain` ADD `out_time` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '过期时间' AFTER `status`; 更新
    public function doModify(){
        $para = Request::param();
        $para['out_time'] = isset($para['out_time'])?strtotime($para['out_time']):null;
        $where = ['id'=>$para['id']];
        $this->result(
            $this->logicFhdomain->settingSave($where,$para)
        );
    }


    public function upfhurl($longurl = '', $title = '', $type = 1,$id = null){
//        $validate = $this->validateFhurl->check(compact('longurl','title'));
//        if(!$validate){
//            return ['code'=>CodeEnum::ERROR,'msg'=>$this->validateFhurl->getError()];
//        }
        $this->result(
            $this->logicFhdomain->fhdomainUpdate(['longurl'=>$longurl,'title'=>$title,'type'=>$type,'id'=>$id])
        );
    }
}
