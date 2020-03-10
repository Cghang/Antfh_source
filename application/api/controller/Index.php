<?php
/**
 * 蚂蚁防红 - index.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\api\controller;

use app\common\controller\Common;
use app\common\library\enum\CodeEnum;

class index extends Common
{
    /**
     * 蚂蚁防红 - API
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $uid
     * @param string $chkurl
     * @param string $token
     * @param int $type
     * @return array
     */

    /**
     * 蚂蚁防红 - 生成短网址
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $uid
     * @param string $longurl
     * @param int $type
     * @param string $token
     * @param string $title
     * @return array
     */
    public function shorturl($longurl = '', $type = 1, $jump = 0){
        $longurl = fix_url($longurl);
        $validate = $this->validateShorturl->check(compact('longurl','type','jump'));
        //var_dump($this->validateShorturl->getError());
        if (!$validate){
            $this->result(['code' => CodeEnum::ERROR,'msg' => $this->validateShorturl->getError()]);
        }
        $this->logicCheck->checkDomain($longurl);
        $this->result(
            $this->logicFhdomain->fhdomainAdd(['longurl'=>$longurl,'type'=>$type,'jump'=>$jump])
        );
    }

    /**
     * 蚂蚁系统 - 回调状态
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $id
     * @param $dtype
     * @param $type
     * @param $key
     * @param $status
     */
    public function notify($id,$dtype,$type,$key,$status){//type 1 微信 2qq dtype 1 跳转 2落地
        $validate = $this->validateChecknotify->check(compact('id','key','dtype','type','status'));
        if (!$validate){$this->result(['code' => CodeEnum::ERROR,'msg' => $this->validateChecknotify->getError()]);}
        if($dtype == 1)//跳转域名
        {
            $tzdomain = $this->logicTzdomain->getTzdomainInfo(['id'=>$id]);
            if (!$tzdomain){$this->result(['code' => CodeEnum::ERROR,'msg' => "不存该记录，请重试！"]);}
            if ($status == 0){
                $update = $type == 1?$this->logicTzdomain->setTzdomainValue(['id'=>$id],'status',$tzdomain['status']==2?3:0):$this->logicTzdomain->setTzdomainValue(['id'=>$id],'status',$tzdomain['status']==0?3:2);
                if ($update){$this->result(['code' => CodeEnum::SUCCESS,'msg' => "更新域名状态成功！"]);}
            }
            $this->result(['code' => CodeEnum::SUCCESS,'msg' => "无操作记录！"]);
        }elseif($dtype == 2){//落地域名
            $lddomain = $this->logicLddomain->getLddomainInfo(['id'=>$id]);
            if (!$lddomain){$this->result(['code' => CodeEnum::ERROR,'msg' => "不存该记录，请重试！"]);}
            if ($status == 0){
                $update = $type == 1?$this->logicLddomain->setLddomainValue(['id'=>$id],'status',$lddomain['status']==2?3:0):$this->logicLddomain->setLddomainValue(['id'=>$id],'status',$lddomain['status']==0?3:2);
                if ($update){$this->result(['code' => CodeEnum::SUCCESS,'msg' => "更新域名状态成功！"]);}
            }
            $this->result(['code' => CodeEnum::SUCCESS,'msg' => "无操作记录！"]);
        }
        $this->result(['code' => CodeEnum::SUCCESS,'msg' => "无操作记录！"]);
    }

}