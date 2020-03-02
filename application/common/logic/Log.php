<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Log.php
 * Time: 7:33 PM
 */

namespace app\common\logic;


use app\common\library\enum\CodeEnum;

class Log extends BaseLogic
{
    public function logAdd($action = '', $describe = '')
    {
        $request = request();
        $module = $request->module();

        if ($module == 'admin'){
            $uid = session('admin_info')['id'];
        }else if ($module == 'index'){
            $uid = empty(session('user_info'))?'999999':session('user_info')['uid'];
        }else if ($module == 'weixin'){
            $uid = "999998"; //微信操作专属uid
        }

        $data['uid']       = $uid;
        $data['module']    = $module;
        $data['ip']        = $request->ip();
        $data['url']       = $request->url();
        $data['action']    = $action;
        $data['describe']  = $describe;

        $res = $this->modelActionLog->setInfo($data);

        return $res || !empty($res) ? ['code' => CodeEnum::SUCCESS, 'msg' =>'日志添加成功', '']
            : ['code' => CodeEnum::ERROR, 'msg' => '加入操作日志失败'];
    }

    public function getLogCount($where = []){
        return $this->modelActionLog->getCount($where);
    }

    public function getLogList($where = [] , $field = true, $order = 'create_time desc',$paginate = 0){
        $this->modelActionLog->limit = !$paginate;
        return $this->modelActionLog->getList($where, $field, $order,$paginate);
    }
    public function logDel($where = [])
    {
        return $this->modelActionLog->deleteInfo($where) ? ['code' => CodeEnum::SUCCESS, 'msg' =>'日志删除成功', '']
            : ['code' => CodeEnum::ERROR, 'msg' => '删除操作日志失败'];
    }
}