<?php
/**
 * 蚂蚁防红 - Tzdomain.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-18
 */


namespace app\admin\controller;


use app\common\library\enum\CodeEnum;
use think\facade\Request;
use think\facade\Validate;
use think\helper\Time;

class Tzdomain extends BaseAdmin
{
    /**
     * 蚂蚁防红 - 跳转域名
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index(){

        list($starttime, $endtime) = Time::year();
        $this->assign(['starttime'=>date('Y-m-d',$starttime),'endtime'=>date('Y-m-d',$endtime)]);
        return $this->render('跳转域名管理');
    }

    /**
     * 蚂蚁防红 - 跳转列表
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function getTzdomainList(){//type time page pageSize
        $where['status'] = $this->request->param('status') == 'all'?[["=",0],["=",1],["=",2],["=",3] ,"OR"]:$this->request->param('status');
        //状态
        $this->request->param('type')==0?null:$where['type'] = $this->request->param('type');
        //组合搜索
        !empty($this->request->param('ordVal')) && $where['title|longurl|shorturl']
            = ['like', '%'.$this->request->param('ordVal').'%'];
        //时间搜索  时间戳搜素
        $where['create_time'] = $this->parseRequestDate();

        $data = $this->logicTzdomain->getTzdomainList($where,true, 'create_time desc',$this->request->param('pageSize'));

        $count = $this->logicTzdomain->getTzdomainCount($where);

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
     * 蚂蚁防红 - 删除跳转
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $id
     * @return array
     */
    public function delTzdomain($id = ''){
        $validate = Validate::regex($id,'\d+');
        if (!$validate){
            return ['code'=>CodeEnum::ERROR,'msg'=>'传入Id必须为整数，请勿非法操作'];
        }
        $this->result($data = $this->logicTzdomain->TzdomainDel(['id'=>$id]));
    }

    /**
     * 蚂蚁防红 - 添加域名
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function addtzdomain(){
        return $this->render('添加域名');
    }

    /**
     * 蚂蚁防红 - 添加域名
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $url
     * @param $imp
     */
    public function doaddTzdomain($url,$imp,$fjx = 0){
        $validate = $this->validateTzdomain->check(compact('url','imp','fjx'));
        if (!$validate){
            $this->result(['code'=>CodeEnum::ERROR,"msg"=>$this->validateTzdomain->getError()]);
        }
            $this->result(
                $this->logicTzdomain->tzdomainAdd(['url'=>$url,'imp'=>$imp,'fjx'=>$fjx])
            );
    }


    /**
     * 蚂蚁防红 - 修改跳转链接
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $id
     * @return mixed
     */
    function modify($id){
        $domain = $this->logicTzdomain->getTzdomainInfo(['id'=>$id]);
        return $this->render("修改跳转链接",['domain'=>$domain]);
    }

    /**
     * 蚂蚁防红 - 修改链接
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function doModify(){
        $para = Request::param();
        //$para['out_time'] = strtotime($para['out_time']);
        $where = ['id'=>$para['id']];
        $para['fjx'] == 'true'?$para['fjx'] = 1:$para['fjx'] = 0;
        $this->result(
            $this->logicTzdomain->settingSave($where,$para)
        );
    }

    public function doChkurl($id){
        $domain = $this->logicTzdomain->getTzdomainInfo(['id'=>$id]);
        $domain = parse_url_host($domain['url']);
        $number = count(explode('.',$domain));
        $domain = $number > 2?'http://'.$domain:'http://ant.'.$domain;
        $this->result(
            $this->logicCheck->chkdomain($domain,1,$this->website)
        );
    }
}