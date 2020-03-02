<?php
/**
 * 蚂蚁防红 - Jump.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\jump\logic;


use app\common\library\enum\CodeEnum;
use app\common\library\exception\ForbiddenException;
use app\common\library\exception\OuttimeException;
use app\common\logic\BaseLogic;
use app\common\logic\Website;
use think\Exception;

class Jump extends BaseLogic
{

    public function checkUser($fh){
            if ($fh['out_time'] < time()){
                throw new OuttimeException([
                    'msg' => "该条链接已到期，请充值或续费！",
                    'errorCode' => CodeEnum::ERROR
                ]);
            }
            return;
    }

    public function doJump($ant = '')
    {
        $validate = $this->validateJump->check(['ant'=>$ant]);
        if(!$validate){
            return ['code'=>CodeEnum::ERROR,'msg'=>$this->validateJump->getError()];
        }
        $list = $this->logicLddomain->getLddomainRand();
        if(!$list){return ['code'=>CodeEnum::ERROR,'msg'=>'请联系管理员添加落地域名！'];}
        $fhdomain = $this->logicFhdomain->getFhdomainInfo(['jump_short'=>$ant],'id,tid,out_time');
        if(!$fhdomain){return ['code'=>CodeEnum::ERROR,'msg'=>'跳转码不存在，请勿非法操作！'];}
        //$this->checkUser($fhdomain);
        //Todo 下个版本加入到期功能
        $this->logicTzdomain->setTzdomainInc(['id'=>$fhdomain['tid']]);//setinc
        $this->logicLddomain->setLddomainInc(['id'=>$list['id']]);
        return ['code'=>CodeEnum::SUCCESS,'msg'=>'获取落地页成功，正在跳转','jumpurl'=>$list['url'].'/Look.html?fid='.$ant.'_'.$fhdomain['id'].'&_wv=alert%28%27pcqq%27%29'];
    }

    public function doJumpend($fid = ''){
        $validate = $this->validateJump->check(['ant'=>$fid]);
        if(!$validate){
            return ['code'=>CodeEnum::ERROR,'msg'=>$this->validateJump->getError()];
        }
        $jump_url = explode('_',$fid);
        //if (!session('referrer') || session('referrer') !=  $jump_url['0'])//来源认证
        //{return ['code'=>CodeEnum::ERROR,'msg'=>'请勿非法操作！'];}
        $fhdomain = $this->logicFhdomain->getFhdomainInfo(['id'=>$jump_url['1']],'id,tid,jump_short,longurl,title');
        if(!$fhdomain || $fhdomain['jump_short'] != $jump_url['0']){return ['code'=>CodeEnum::ERROR,'msg'=>'跳转码不存在，请勿非法操作！'];}
        $this->logicFhdomain->setFhdomainInc(['id'=>$fhdomain['id']]);//
        return ['code'=>CodeEnum::SUCCESS,'msg'=>'跳转验证通过，开始匹配客户端','data'=>$fhdomain,'longurl'=>$fhdomain['longurl']];
    }

    public function doJumpClient($Client){
        $ClientUa = $Client['user-agent'];
        //1 ios wx、2 ios qq、3 android wx、4 android qq、5 其他电脑客户端
        if(strpos($ClientUa, 'iPhone') || strpos($ClientUa, 'iPad')){
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
            {
                return ['code'=>CodeEnum::SUCCESS,'msg'=>'匹配客户端为IOS 微信','client'=>1];
            }elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') !== false)
            {
                return ['code'=>CodeEnum::SUCCESS,'msg'=>'匹配客户端为IOS QQ','client'=>2];
            }else{
                return ['code'=>CodeEnum::SUCCESS,'msg'=>'其他IOS客户端','client'=>5];
            }
        }else if(strpos($ClientUa, 'Android')){
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
            {
                return ['code'=>CodeEnum::SUCCESS,'msg'=>'匹配客户端为安卓 微信','client'=>3];
            }elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') !== false)
            {
                return ['code'=>CodeEnum::SUCCESS,'msg'=>'匹配客户端为安卓 QQ','client'=>4];
            }else{
                return ['code'=>CodeEnum::SUCCESS,'msg'=>'其他安卓客户端','client'=>5];
            }
        }else{
            return ['code'=>CodeEnum::SUCCESS,'msg'=>'匹配客户端为其他电脑客户端','client'=>6];
        }
    }

    public function getJumpCilent($client,$is_jump){
        if ($is_jump == 0) {
            switch ($client) {
                case 1://ios微信
                    $fetch = 'screen/ios_wx';
                    break;
                case 2:
                    $fetch = 'screen/ios_qq';
                    break;
                case 3:
                    $fetch = 'screen/android_wx';
                    break;
                case 4:
                    $fetch = 'screen/android_qq';
                    break;
                case 5:
                    $fetch = null;
                    break;
                default:
                    $fetch = null;
            }
        }else{
            switch ($client) {
                case 1:
                    $fetch = 'jump/ios_wx';
                    break;
                case 2:
                    $fetch = 'jump/ios_qq';
                    break;
                case 3:
                    $fetch = 'jump/android_wx';
                    break;
                case 4:
                    $fetch = 'jump/android_qq';
                    break;
                case 5:
                    $fetch = null;
                    break;
                default:
                    $fetch = null;
            }
        }
        return ['fetch'=>$fetch,'client'=>$client];
    }

}