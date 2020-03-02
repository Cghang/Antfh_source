<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name common.php
 * Time: 9:47 PM
 */

namespace app\common\controller;


use think\App;
use think\Controller;
use think\exception\HttpResponseException;
use think\helper\Time;
use think\Response;

class Common extends Controller
{

    /**
     * Common constructor.
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param App|null $app
     */
    public function __construct(App $app = null)
    {
        parent::__construct($app);
       // $this->txprotect();
        $this->website = $this->logicWebsite->getWebsiteInfo(['id'=>1]);//默认值
        $this->assign($this->website);
    }

    /**
     * 蚂蚁防红 - 数据返回
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param int $code
     * @param string $msg
     * @param string $data
     * @param string $type
     * @param array $header
     */
    final protected function result($code = 0, $msg = '', $data ='', $type = 'json', array $header = [])
    {
        $result = is_array($code) ? $code : $this->parseResultArray([$code, $msg, $data]);
        //$type     = $type ?: $this->getResponseType();
        $response = Response::create($result, $type)->header($header);

        throw new HttpResponseException($response);
    }

    /**
     * 蚂蚁防红 - 解析数组
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $data
     * @return array
     */
    final protected function parseResultArray($data = [])
    {
        return ['code' => $data[0], 'msg' => $data[1],'data' => $data[2]];
    }

    /**
     * 蚂蚁防红 - 解析查询请求日期
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return array
     */
    protected function parseRequestDate(){

        list($start,$end) = Time::month();
        return [
            'between',!empty($this->request->param('endtime'))
                ? [strtotime($this->request->param('starttime')), bcadd(strtotime($this->request->param('endtime')), 86400)]
                : [$start, $end]
        ];
    }

    /**
     * 获取逻辑层实例 魔术方法
     *
     * @param $logicName
     *
     * @author Dany <cgh@tom.com>
     *
     * @return \think\Model|\think\Validate
     */
    public function __get($logicName)
    {
        $layer = $this->getLayerPre($logicName);

        $model = sr($logicName, $layer);

        return VALIDATE_LAYER_NAME == $layer ? validate($model) : model($model, $layer);
    }

    /**
     * 获取层前缀
     *
     * @param $name
     *
     * @author Dany <cgh@tom.com>
     *
     * @return bool|mixed
     */
    public function getLayerPre($name)
    {

        $layer = false;

        $layer_array = [MODEL_LAYER_NAME, LOGIC_LAYER_NAME, VALIDATE_LAYER_NAME, SERVICE_LAYER_NAME];

        foreach ($layer_array as $v)
        {
            if (str_prefix($name, $v)) {

                $layer = $v;

                break;
            }
        }

        return $layer;
    }

    /**
     * Pjax - 访问判断
     *
     * @author Dany <cgh@tom.com>
     *
     * @param array $data
     *
     * @return mixed
     */
    public function render($title = '未知页面',$state = null,$tpl = null)
    {
        $this->view->config('tpl_cache', false);
        $this->pjax    = $this->request->isPjax();
        $this->pjax?config('default_ajax_return','html'):$this->view->engine->layout(true);
        $this->assign('website_title',$this->website['title']);
        $this->assign('title',$title);
        $return =  $state?$this->fetch($tpl,$state):$this->fetch($tpl);
        return $return;
    }

    /**
     * 蚂蚁防红 - 腾讯
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function txprotect(){
        $tx_ua = file_get_contents('../data/txspdier.ua');
        foreach(explode(PHP_EOL,$tx_ua) as $UaRes){
            if(strtolower($_SERVER['HTTP_USER_AGENT']) == strtolower($UaRes)){
                $this->TxSpdier('欢迎使用！');
            }
        }

        $tx_ipdb = file_get_contents('../data/txspdier.db');
        $request = request();
        $RemoteIp=bindec(decbin(ip2long($request->ip())));
        foreach(explode(PHP_EOL,$tx_ipdb) as $IpRes){
            //print_r($IpRes);
            //echo bindec(decbin(ip2long($IpRes)));
            if($RemoteIp == bindec(decbin(ip2long($IpRes))) && !is_array($IpRes))
            {
            echo bindec(decbin(ip2long($IpRes)));
                $this->TxSpdier('欢迎使用！');
            }
            $iprange	=	explode('-', (string)$IpRes);
            if (is_array($iprange)) {
                if($RemoteIp >= bindec(decbin(ip2long($iprange[0]))) && $RemoteIp <= bindec(decbin(ip2long($iprange[1])))) {
                    $this->TxSpdier('欢迎使用！');
                }
            }

        }
    }

    /**
     * 蚂蚁防红 - 蜘蛛爬虫
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param int $val
     */
    function TxSpdier($val = 0)
    {
        include ('../data/template/txprotect.html');
        exit();
    }
}
