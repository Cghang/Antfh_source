<?php
/**
 * Created by PhpStorm.
 * User: CGHang
 * Date: 2019/1/11
 * Time: 18:16
 */
namespace app\admin\controller;
use app\common\library\enum\CodeEnum;
use think\helper\Time;

class Log extends BaseAdmin{
    /**
     * 蚂蚁防红 - 管理行为日志
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index(){
        list($starttime, $endtime) = Time::month();
        $this->assign(['starttime'=>date('Y-m-d H:i:s',$starttime),'endtime'=>date('Y-m-d H:i:s',$endtime)]);
        return $this->render("行为日志列表");
    }

    /**
     * 蚂蚁防红 - 获取管理日志
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function getList(){

        $where = [];
        //组合搜索
        !empty($this->request->param('uid')) && $where['uid']
            = ['eq', $this->request->param('uid')];

        !empty($this->request->param('module')) && $where['module']
            = ['like', '%'.$this->request->param('module').'%'];

        //时间搜索  时间戳搜素
        $where['create_time'] = $this->parseRequestDate();

        $data = $this->logicLog->getLogList($where, true, 'create_time desc', $this->request->param('page'));

        $count = $this->logicLog->getLogCount($where);

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
     * 蚂蚁防红 - 删除日志
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param int $id
     */
    public function logDel($id = 0)
    {
        $this->result($this->logicLog->logDel(['id' => $id]));
    }

    /**
     * 蚂蚁防红 - 清空日志
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function logClean()
    {
        $this->result($this->logicLog->logDel(['status' => '1']));
    }

}