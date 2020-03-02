<?php
/**
 * 蚂蚁防红 - Lddomain.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-15
 */


namespace app\common\logic;


use app\common\library\enum\CodeEnum;
use app\common\library\ShortCode;
use think\Db;

class Lddomain extends BaseLogic
{
//ALTER TABLE `ant_lddomain` ADD `fjx` INT(2) NOT NULL DEFAULT '0' COMMENT '泛解析' AFTER `visit`;
    /**
     * 蚂蚁防红 -
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $where
     * @param bool $field
     * @param string $oredr
     * @return mixed
     */
    public function getLddomainRand($where = ['status'=>1], $field = true,$order = 'rand()'){
        $data = $this->modelLddomain->getInfo($where,$field,$order);
        if ($data['fjx'] == 1){
            $url = parse_url_host($data['url']);
            $rand = ShortCode::encode(time())[rand(0,3)];
            $data['url'] = 'http://'.$rand.'.'.$url;
        }
        return $data;
    }
    public function getLddomainCount($where = []){
        return $this->modelLddomain->getCount($where);
    }
    public function setLddomainInc($where = []){
        return $this->modelLddomain->setIncOrDec($where,'setInc','visit',1);
    }
    public function getLddomainInfo($where = [] , $filed = true ,$order = 'create_time desc'){
        return $this->modelLddomain->getInfo($where,$filed,$order);
    }
    public function getLddomainList($where = [], $field = true, $order = 'create_time desc', $paginate = 15)
    {
        $this->modelLddomain->limit = !$paginate;
        return $this->modelLddomain->getList($where, $field, $order, $paginate);
    }
    public function lddomainAdd($data){//url imp
        //先获取一层跳转域名
        //TODO 添加数据
        Db::startTrans();
        try{
            //基本信息
            $check = $this->getLddomainInfo(['url'=>$data['url']]);
            if($check){
                return ['code' => CodeEnum::ERROR, 'msg' => '该落地域名已存在，请勿重复添加！'];
            }
            $data['fjx'] == 'true'?$data['fjx'] = 1:$data['fjx'] = 0;
            $this->modelLddomain->setInfo($data);
            action_log('跳转', '新增落地域名,域名:'. $data['url']);
            Db::commit();
            return ['code' => CodeEnum::SUCCESS, 'msg' => '添加落地域名成功'];
        }catch (\Exception $ex){
            Db::rollback();
            return ['code' => CodeEnum::ERROR, 'msg' =>config('app_debug') ? $ex->getMessage() : '未知错误'];
        }
    }

    public function setLddomainValue($where = [], $field = '', $value = '')
    {
        return $this->modelLddomain->setFieldValue($where, $field, $value);
    }
    public function LddomainDel($where = []){
        return $this->modelLddomain->deleteInfo($where) ? ['code' => CodeEnum::SUCCESS, 'msg' =>'删除该条落地域名成功']
            : ['code' => CodeEnum::ERROR, 'msg' => '删除该条落地域名失败，请联系管理员'];
    }
    public function settingSave($where,$data = []){
        foreach ($data as $name => $value)
        {
            $this->modelLddomain->updateInfo($where, [$name => $value]);
        }

        return ['code'=>CodeEnum::SUCCESS, 'msg'=>'设置保存成功'];
    }
}