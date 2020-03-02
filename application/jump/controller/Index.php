<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Index.php
 * Time: 6:34 PM
 */

namespace app\jump\controller;

use app\common\controller\Common;
use app\common\library\enum\CodeEnum;
use app\common\library\ShortCode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use think\App;
use think\exception\DbException;
use think\facade\Request;
use think\Response;

class Index extends Common
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }

    public function index($ant = ''){
        $jump = $this->logicJump->doJump($ant);
        //session('referrer',$ant);
        $jump['code'] == 0?$this->result($jump):$this->redirect($jump['jumpurl']);
    }

    public function jump($s = ''){
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!==false){
            //header("HTTP/1.1 206 Partial Content");
//            header("Content-Disposition: attachment; filename=\"load.doc\"");
//            header("Content-Type: application/vnd.ms-word;charset=utf-8");
            // header('Content-Type: text/plain; charset=UTF-8');
            header('Content-Disposition: attachment;filename="30006804102.pdf"');
            header('Content-Type: application/dany');
            exit;
            //return Response::create("", 'json', 206, [], []);
        }
        $data = $this->logicFhdomain->getFhdomainInfo(['jump_short'=>$s]);
        if ($data){
            return $this->fetch('index/aaa',['data'=>$data]);
        }
    }

    public function screen($fid = ''){
        $UserInfo = Request::header();
        //var_dump($UserInfo);
        $mb = 'antfh';//TODO：先固定
        $jump = $this->logicJump->doJumpend($fid);
        $jump['code'] == 0?$this->result($jump):null;
        $getclient = $this->logicJump->doJumpClient($UserInfo);
        $client = $getclient['client'];//获取客户端
        $jump_type = $this->website['is_jump'];
        $temp = $this->logicJump->getJumpCilent($client,$jump_type);
        if(!in_array($client,[1,2,3,4,5]) && $this->website['is_webjump'] == 1){
            $this->redirect($this->website['jumpurl']);
        }
        if($temp['fetch'] == null){
            $this->redirect($jump['data']['longurl']);
        }
        //ALTER TABLE `ant_website` ADD `is_qqreport` INT(2) NOT NULL DEFAULT '0' COMMENT '0关闭 1开启' AFTER `is_wxjump`;
        //ALTER TABLE `ant_website` ADD `is_wxjump` INT(2) NOT NULL DEFAULT '0' COMMENT '安卓微信直接跳 0 关闭 1开启' AFTER `is_jump`;
        if ($jump_type == 1 && $this->website['is_wxjump'] == 1 && $temp['client'] == 3){
            $this->redirect('/Jump/s/'.$jump['data']['jump_short']);
        }
        //echo $jump_type.$this->website['is_wxjump'].$temp['client'];exit;
        $fetch = 'antmb/'.$mb.'/'.$temp['fetch'];
        $qqreport = $jump_type == 1?0:$this->website['is_qqreport'];
        $jsar = array(
            'longurl'		=>	$jump['data']['longurl']
        ,'qq_report'	=>	$qqreport
        ,'delay'		=>	0
        ,'aid'=> $jump['data']['jump_short']
        );
        $js = 'var antfh="www.antfh.net";';
        foreach($jsar as $key => $value) {
            $js .= 'var '.$key.' = "'.$value.'";';
        }
        $this->assign(['js'=>$js,'aid'=>$jump['data']['jump_short']]);
        $this->assign('jump',$jump['data']);
        $html = $this->fetch($fetch)->getContent();
        $html = escape($html);
        $html = str_replace('%',' ',$html);
        $func = getRandChar(5);
        return '<script>function '.$func.'('.$jump['data']['jump_short'].'){document.write((unescape('.$jump['data']['jump_short'].')));};'.$func.'("'.$html.'".replace(/ /g,"%"));</script>';
        //return $html;
    }


    public function dotzwx(){
        try {
            $this->setWxtzdomainlist();
            $wxdomainlist = cache('wx_tzdomainlist');//['longurl'=>'http://','status'=>1/0,'tid'=>1];
            if($wxdomainlist){
                $list = [];
                foreach ($wxdomainlist as $value){
                    $http = (new Client())->request('GET', config('api_antfh') . '/api/urlsec/wx?token=' . $this->website['token'] .  '&url=' . $value['longurl'])->getBody()->getContents();
                    $data = json_decode($http,true);
                    //print_r($data);
                    if ($data['code'] == 0){
                        $list[] = ['tid'=>$value['tid'],'status'=>$value['status']];//此处为跳转域名的列表
                    }
                    sleep(0.7);
                }
                foreach ($list as $value){
                    $this->logicFhdomain->setFhdomainValue(['tid'=>$value['tid']],'status',$value['status']==2?3:0);
                    $this->logicTzdomain->setTzdomainValue(['id'=>$value['tid']],'status',$value['status']==2?3:0);
                }
                //print_r($list);
                echo 'ok';
            }else{
                $this->setWxtzdomainlist();
                echo 'fail';
            }
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function dotzqq(){
        try {
            $this->setQqtzdomainlist();
            $qqdomainlist = cache('qq_tzdomainlist');//['longurl'=>'http://','status'=>1/0,'tid'=>1];
            if($qqdomainlist){
                $list = [];
                foreach ($qqdomainlist as $value){
                    $http = (new Client())->request('GET', config('api_antfh') . '/api/urlsec/qq?token=' . $this->website['token'] .  '&url=' . $value['longurl'])->getBody()->getContents();
                    $data = json_decode($http,true);
                    if ($data['code'] == 0){
                        $list[] = ['tid'=>$value['tid'],'status'=>$value['status']];//此处为跳转域名的列表
                    }
                    sleep(0.7);
                }
                foreach ($list as $value){
                    $this->logicFhdomain->setFhdomainValue(['tid'=>$value['tid']],'status',$value['status']==0?3:2);
                    $this->logicTzdomain->setTzdomainValue(['id'=>$value['tid']],'status',$value['status']==0?3:2);
                }
                echo 'ok';
            }else{
                $this->setQqtzdomainlist();
                echo 'fail';
            }
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }
    public function tzqqcron(){//此处建议1-3分钟
        // 避免超时报错
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->dotzqq();
    }
    public function tzwxcron(){//此处建议1-3分钟
        // 避免超时报错
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->dotzwx();
    }
    public function tznotifyqqcron(){//此处建议1-3分钟
        // 避免超时报错
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->donotifytzqq();
    }
    public function tznotifywxcron(){//此处建议1-3分钟
        // 避免超时报错
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->donotifytzwx();
    }
    public function doldwx(){
        $this->setWxlddomainlist();
        try {
            $wxdomainlist = cache('wx_lddomainlist');//['longurl'=>'http://','status'=>1/0,'tid'=>1];
            if($wxdomainlist){
                $list = [];
                foreach ($wxdomainlist as $value){
                    $http = (new Client())->request('GET', config('api_antfh') . '/api/urlsec/wx?token=' . $this->website['token'] .  '&url=' . $value['longurl'])->getBody()->getContents();
                    $data = json_decode($http,true);
                    //print_r($data);
                    if ($data['code'] == 0){
                        $list[] = ['tid'=>$value['tid'],'status'=>$value['status']];//此处为跳转域名的列表
                    }
                    sleep(0.7);
                }
                foreach ($list as $value){
                    $this->logicLddomain->setLddomainValue(['id'=>$value['tid']],'status',$value['status']==2?3:0);
                    //$this->setWxdomainlist();
                }
               // print_r($list);
                echo 'ok';
            }else{
                $this->setWxlddomainlist();
                echo 'fail';
            }
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function doldqq(){
        try {
            $this->setQqlddomainlist();
            $qqdomainlist = cache('qq_lddomainlist');//['longurl'=>'http://','status'=>1/0,'tid'=>1];
            if($qqdomainlist){
                $list = [];
                foreach ($qqdomainlist as $value){
                    $http = (new Client())->request('GET', config('api_antfh') . '/api/urlsec/qq?token=' . $this->website['token'] .  '&url=' . $value['longurl'])->getBody()->getContents();
                    $data = json_decode($http,true);
                    if ($data['code'] == 0){
                        $list[] = ['tid'=>$value['tid'],'status'=>$value['status']];//此处为跳转域名的列表
                    }
                    sleep(0.7);
                }
                foreach ($list as $value){
                    $this->logicLddomain->setLddomainValue(['id'=>$value['tid']],'status',$value['status']==0?3:2);
                   // $this->setQqdomainlist();
                }
                echo 'ok';
            }else{
                $this->setQqlddomainlist();
                echo 'fail';
            }
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }
    public function ldqqcron(){//此处建议1-3分钟
        // 避免超时报错
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->doldqq();
    }
    public function ldwxcron(){//此处建议1-3分钟
        // 避免超时报错
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->doldwx();
    }
    public function cron_tzset(){//此处建议10分钟
        $this->setWxTzdomainlist();
        echo '<br>';
        $this->setQqTzdomainlist();
    }
//getFhdomainList($where,true, 'create_time desc',$this->request->param('pageSize'))
    public function setWxTzdomainlist(){
        $wx = $this->logicTzdomain->getTzdomainList(['status'=>[["=",1],["=",2] ,"OR"]],'url,status,id,fjx','create_time desc',false);//
        $list = [];
        foreach ($wx as $value){
            if ($value['fjx'] == 1){
                $url = parse_url_host($value['url']);
                $rand = ShortCode::encode(time())[rand(0,3)];
                $value['url'] = 'http://ant.'.$url;
            }
            $list[] = ['tid'=>$value['id'],'longurl'=>$value['url'],'status'=>$value['status']];
        }
        cache('wx_tzdomainlist',$list);
        echo 'ok<br/>';
        //print_r($list);
    }

    public function setQqTzdomainlist(){
        $wx = $this->logicTzdomain->getTzdomainList(['status'=>[["=",1],["=",0] ,"OR"]],'url,status,id,fjx','create_time desc',false);
        $list = [];
        foreach ($wx as $value){
            if ($value['fjx'] == 1){
                $url = parse_url_host($value['url']);
                $rand = ShortCode::encode(time())[rand(0,3)];
                $value['url'] = 'http://ant.'.$url;
            }
            $list[] = ['tid'=>$value['id'],'longurl'=>$value['url'],'status'=>$value['status']];
        }
        cache('qq_tzdomainlist',$list);
        echo 'ok<br/>';
        //print_r($list);
    }
    public function cron_ldset(){//此处建议10分钟
        $this->setWxLddomainlist();
        echo '<br>';
        $this->setQqLddomainlist();
    }
//getFhdomainList($where,true, 'create_time desc',$this->request->param('pageSize'))
    public function setWxLddomainlist(){
        $wx = $this->logicLddomain->getLddomainList(['status'=>[["=",1],["=",2] ,"OR"]],'url,status,id,fjx','create_time desc',false);//
        $list = [];
        foreach ($wx as $value){
            if ($value['fjx'] == 1){
                $url = parse_url_host($value['url']);
                $rand = ShortCode::encode(time())[rand(0,3)];
                $value['url'] = 'http://ant.'.$url;
            }
            $list[] = ['tid'=>$value['id'],'longurl'=>$value['url'],'status'=>$value['status']];
        }
        cache('wx_lddomainlist',$list);
        echo 'ok<br/>';
        //print_r($list);
    }

    public function setQqLddomainlist(){
        $wx = $this->logicLddomain->getLddomainList(['status'=>[["=",1],["=",0] ,"OR"]],'url,status,id,fjx','create_time desc',false);
        $list = [];
        foreach ($wx as $value){
            if ($value['fjx'] == 1){
                $url = parse_url_host($value['url']);
                $rand = ShortCode::encode(time())[rand(0,3)];
                $value['url'] = 'http://ant.'.$url;
            }
            $list[] = ['tid'=>$value['id'],'longurl'=>$value['url'],'status'=>$value['status']];
        }
        cache('qq_lddomainlist',$list);
        echo 'ok<br/>';
        //print_r($list);
    }
}