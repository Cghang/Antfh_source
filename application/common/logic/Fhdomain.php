<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Channel.php
 * Time: 12:55 PM
 */

namespace app\common\logic;

use app\common\library\enum\CodeEnum;
use app\common\library\ShortCode;
use think\Db;
use Url\ShortUrl;

class Fhdomain extends BaseLogic
{

    public function getFhdomainStat($where = []){
        $order = 'create_time desc';
        return [
            'red' => $this->modelFhdomain->getInfo($where,"count(id) as totalid,sum(visit) as visit_all,count(if(create_time>=".mktime(0,0,0,date('m'),date('d'),date('Y')).",true,null)) as new_today,count(if(status!=1 and create_time>=".mktime(0,0,0,date('m'),date('d'),date('Y')).",true,null)) as red_today", $order, $paginate = false),
            'all' => $this->modelFhdomain->getInfo([],"count(id) as id", $order, $paginate = false)
        ];
    }

    public function getFhdomainIndexStat($where = []){
        $order = 'create_time desc';
        return [
            'visit' => $this->modelFhdomain->getInfo($where,"COALESCE(sum(visit),0) as visit_all,count(if(update_time>=".mktime(0,0,0,date('m'),date('d'),date('Y')).",true,null)) as new_today", $order, $paginate = false),
            'all' => $this->modelFhdomain->getInfo([],"count(id) as id", $order, $paginate = false)
        ];
    }
    public function getFhdomainStatus($where = []){
        $order = 'create_time desc';
        return [
            'domain' => $this->modelFhdomain->getInfo($where,"count(id) as totalid,count(if(status=1,true,null)) as active,count(if(status=0,true,null)) as wx_red,count(if(status=3,true,null)) as qq_red,count(if(status=4,true,null)) as other_red", $order, $paginate = false)
        ];
    }

    public function fhdomainAdd($data){//longurl title
        //先获取一层跳转域名
        //TODO 添加数据
        Db::startTrans();
        try{
            //基本信息
            $check = $this->getFhdomainInfo(['longurl'=>$data['longurl']]);
            !isset($data['tzurl']) || $data['tzurl'] == 'all'?$tzdomain = $this->logicTzdomain->getTzdomainRand():$tzdomain = $this->logicTzdomain->getTzdomainInfo2(['id'=>$data['tzurl']]);//二级泛解析
            if(!$tzdomain){
                return ['code' => CodeEnum::ERROR, 'msg' => '请联系管理员添加跳转域名！'];
            }
            if ($check){//存在则重新生成
                $up = $this->fhdomainUpdate(['id'=>$check['id'],'tzurl'=>$tzdomain['id'],'type'=>$data['type']]);
                if ($up['code'] == 1){
                    $shorturl = $up['shorturl'];
                }else{
                    $shorturl = "此条生成错误，请联系管理员";
                }
                Db::commit();
                return ['code' => CodeEnum::SUCCESS, 'msg'=> '链接已重新生成','anturl' => $shorturl];
            }
            $website = $this->logicWebsite->getWebsiteInfo(['id'=>1]);
            $jump_short = ShortCode::encode($data['longurl'])[rand(0,3)];
            $tzurl = $tzdomain['url'].'/Url.html?ant='.$jump_short;
            $data['jump_short'] = $jump_short;
            $data['tid'] = $tzdomain['id'];
            $data['out_time'] = time() + $website['expired_time']*60*60*24;
           // print_r()
            $data['shorturl'] = ShortUrl::short($tzurl,$data['type'],$website['token']);
            $this->modelFhdomain->setInfo($data);
            //action_log('防红', '新增防红域名,所属UID:'. $data['uid']);
            Db::commit();
            return ['code' => CodeEnum::SUCCESS, 'msg' => '添加防红域名成功', 'anturl' => $data['shorturl']];
        }catch (\Exception $ex){
            Db::rollback();
            return ['code' => CodeEnum::ERROR, 'msg' =>config('app_debug') ? $ex->getMessage() : '未知错误'];
        }
    }

    public function fhdomainUpdate($data){
            //基本信息
            $check = $this->getFhdomainInfo(['id'=>$data['id']]);
            if(!$check){
                return ['code' => CodeEnum::ERROR, 'msg' => '该链接不存在，请先生成链接！'];
            }
            $tzdomain = $this->logicTzdomain->getTzdomainRand();
            if(!$tzdomain){
                return ['code' => CodeEnum::ERROR, 'msg' => '请联系管理员添加跳转域名！'];
            }
            //$jump_short = ShortCode::encode($data['longurl'])[rand(0,3)];
            $tzurl = $tzdomain['url'].'/Url.html?ant='.$check['jump_short'];
            //$data['jump_short'] = $jump_short;
            $data['tid'] = $tzdomain['id'];
            $website = $this->logicWebsite->getWebsiteInfo(['id'=>1]);
            $data['shorturl'] = ShortUrl::short($tzurl,$data['type'],$website['token']);
            $where['id'] = $data['id'];
            $this->modelFhdomain->setInfo($data,$where);
            //action_log('防红', '重新生成防红域名,ID:'. $data['id']);
            return ['code' => CodeEnum::SUCCESS, 'msg' => '重新生成防红域名成功', 'shorturl' => $data['shorturl']];
    }

    public function getFhdomainInfo($where = [] , $filed = true){
        return $this->modelFhdomain->getInfo($where,$filed);
    }
    public function getFhdomainList($where = [], $field = true, $order = 'create_time desc', $paginate = 15)
    {
        $this->modelFhdomain->limit = !$paginate;
        return $this->modelFhdomain->getList($where, $field, $order, $paginate);
    }
    public function getFhdomainCount($where = []){
        return $this->modelFhdomain->getCount($where);
    }
    public function setFhdomainInc($where = []){
        return $this->modelFhdomain->setIncOrDec($where,'setInc','visit',1);
    }
    public function setFhdomainValue($where = [], $field = '', $value = '')
    {
        return $this->modelFhdomain->setFieldValue($where, $field, $value);
    }
    public function FhdomainDel($where = []){
        return $this->modelFhdomain->deleteInfo($where) ? ['code' => CodeEnum::SUCCESS, 'msg' =>'删除该条防红链接成功']
            : ['code' => CodeEnum::ERROR, 'msg' => '删除该条防红链接失败，请联系管理员'];
    }
    public function settingSave($where,$data = []){
        foreach ($data as $name => $value)
        {
            $this->modelFhdomain->updateInfo($where, [$name => $value]);
        }

        return ['code'=>CodeEnum::SUCCESS, 'msg'=>'设置保存成功'];
    }
}