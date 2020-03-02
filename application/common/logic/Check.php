<?php
/**
 * 蚂蚁防红 - Check.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\common\logic;


use app\common\library\enum\CodeEnum;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use think\facade\Cache;
use think\facade\Log;

class Check extends BaseLogic
{

    /**
     * 蚂蚁防红 - Api次数限制
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $key
     * @param int $num
     * @return bool|false|int
     */
    public function checkDomain($domain){//
        return true;
    }

    /**
     * 蚂蚁防红 - 查询域名
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $chkurl
     * @param $type
     * @param $website
     * @return array|mixed
     */
    public function chkdomain($chkurl,$type,$website){
        try {
            $Client = (new Client())->request('GET', config('api_antfh') . '/Check?appid='.$website['appid'].'&appkey='.$website['appkey'].'&type='.$type.'&url='.$chkurl)->getBody()->getContents();
            return json_decode($Client,true);
        } catch (GuzzleException $e) {
            return ['code'=>CodeEnum::EXPITION,'msg'=>$e->getMessage()];
        }

    }
}