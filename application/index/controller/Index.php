<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Index.php
 * Time: 8:27 PM
 */

namespace app\index\controller;

use app\common\library\enum\CodeEnum;
use think\App;
use think\Db;
use think\facade\Request;
use Url\ShortUrl;

class Index extends \app\common\controller\Common
{

    /**
     * Index constructor.
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param App|null $app
     */
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $host = Request::host();
        if (strpos($this->website['weburl'],$host) === false){
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            echo '404 Not Found';
            exit;
        }
    }

    /**
     * 蚂蚁防红 - 首页
     *
     * @author Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->logicFhdomain->getFhdomainIndexStat([]);
        $this->assign('data',$data);
        return $this->fetch();
    }


    /**
     * 蚂蚁防红 - Api接口
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function api(){
        return $this->fetch();
    }

    public function geetest(){
        return $this->fetch();
    }

    /**
     * 蚂蚁防红 - 首页检测
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param string $type
     * @param string $url
     * @return array
     */
    public function webcheck($type = '',$url = ''){
        $validate = $this->validateCheck->check(compact('type','url'));
        if (!$validate) {
            return [ 'code' => CodeEnum::ERROR, 'msg' => $this->validateCheck->getError()];
        }
        $data = Request::param(); //传入请求数据
        if(!geetest_check($data)){
            return [ 'code' => CodeEnum::ERROR, 'msg' => '人机交互身份验证失败,请刷新页面！'];
        }
        $this->result(
            $this->logicCheck->chkdomain($url,$type,$this->website)
        );
    }
}
