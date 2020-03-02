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
     * 蚂蚁防红 - 技术合作
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function com(){
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
     * 蚂蚁防红 - 帮助文档
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function help(){
        return $this->fetch();
    }

    /**
     * 蚂蚁防红 - DEMO
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function demo(){
        return $this->fetch();
    }

    /**
     * 蚂蚁防红 - 源码出售
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function sell(){
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
