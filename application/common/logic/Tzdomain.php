<?php
/**
 * 蚂蚁防红 - Tzdoamin.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\common\logic;


use app\common\library\enum\CodeEnum;
use app\common\library\ShortCode;
use think\Db;
use Url\ShortUrl;

class Tzdomain extends BaseLogic
{

    public function getTzdomainRand($where= ['status'=>1],$field = true){
        $data = $this->modelTzdomain->getInfo($where, $field ,'rand()');
        if ($data['fjx'] == 1){
            $url = parse_url_host($data['url']);
            $rand = ShortCode::encode(time())[rand(0,3)];
            $data['url'] = 'http://'.$rand.'.'.$url;
        }
        return $data;
    }

    public function getTzdomainCount($where = []){
        return $this->modelTzdomain->getCount($where);
    }
    public function getTzdomainInfo($where = [] , $filed = true){
        return $this->modelTzdomain->getInfo($where,$filed);
    }
    public function getTzdomainInfo2($where = [] , $filed = true){
        $data = $this->modelTzdomain->getInfo($where,$filed);
        if ($data['fjx'] == 1){
            $url = parse_url_host($data['url']);
            $rand = ShortCode::encode(time())[rand(0,3)];
            $data['url'] = 'http://'.$rand.'.'.$url;
        }
        return $data;
    }
    public function setTzdomainInc($where = []){
        return $this->modelTzdomain->setIncOrDec($where,'setInc','visit',1);
    }
    public function getTzdomainList($where = [], $field = true, $order = 'create_time desc', $paginate = 15)
    {
        $this->modelTzdomain->limit = !$paginate;
        return $this->modelTzdomain->getList($where, $field, $order, $paginate);
    }

    public function setTzdomainValue($where = [], $field = '', $value = '')
    {
        return $this->modelTzdomain->setFieldValue($where, $field, $value);
    }
    public function tzdomainAdd($data){//url imp
        //先获取一层跳转域名
        //TODO 添加数据
        Db::startTrans();
        try{
            //基本信息
            $check = $this->getTzdomainInfo(['url'=>$data['url']]);
            if($check){
                return ['code' => CodeEnum::ERROR, 'msg' => '该跳转域名已存在，请勿重复添加！'];
            }
            $data['fjx'] == 'true'?$data['fjx'] = 1:$data['fjx'] = 0;
            $this->modelTzdomain->setInfo($data);
            action_log('跳转', '新增跳转域名,域名:'. $data['url']);
            Db::commit();
            return ['code' => CodeEnum::SUCCESS, 'msg' => '添加跳转域名成功'];
        }catch (\Exception $ex){
            Db::rollback();
            return ['code' => CodeEnum::ERROR, 'msg' =>config('app_debug') ? $ex->getMessage() : '未知错误'];
        }
    }



    public function TzdomainDel($where = []){
        return $this->modelTzdomain->deleteInfo($where) ? ['code' => CodeEnum::SUCCESS, 'msg' =>'删除该条跳转域名成功']
            : ['code' => CodeEnum::ERROR, 'msg' => '删除该条跳转域名失败，请联系管理员'];
    }
    public function settingSave($where,$data = []){
        foreach ($data as $name => $value)
        {
            $this->modelTzdomain->updateInfo($where, [$name => $value]);
        }

        return ['code'=>CodeEnum::SUCCESS, 'msg'=>'设置保存成功'];
    }
}