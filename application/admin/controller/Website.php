<?php
/**
 * 蚂蚁防红 - Website.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-18
 */


namespace app\admin\controller;


use app\common\library\enum\CodeEnum;
use PclZip;
use think\Db;
use think\Exception;
use think\facade\Request;

class Website extends BaseAdmin
{

    /**
     * 蚂蚁防红 - 网站配置
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function index(){
        return $this->render("网站配置");
    }

    /**
     * 蚂蚁防红 - 检测配置
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function apiset(){
        return $this->render("检测配置");
    }

    /**
     * 蚂蚁防红 - 模版管理
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function template(){
        return $this->render("模版管理");
    }

    /**
     * 蚂蚁系统 - 跳转管理
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function tzmodify(){
        return $this->render("跳转管理");
    }
    /**
     * 蚂蚁防红 - 检测更新
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function update(){
        $ver = update_version($this->version,$this->website['secret']);
        $this->assign('ver',$ver['data']);
        return $this->render("检测更新");
    }

    public function job(){
        return $this->render("防红检测",['domain'=>Request::domain()]);
    }

    /**
     * 蚂蚁防红 - 编写中
     *
     * @auth Dany <cgh@tom.com>
     *
     * @return false|string|\think\response\Json
     */
    public function startDownload()
    {
        //设置超时时间
        set_time_limit(0);
        //取消Session文件锁定
        session_write_close();
        $tmp_path = '../data/update/cache.zip';
        $ver = update_version($this->version,$this->website['secret']);
        //print_r($ver);exit;
        if ($ver['code'] != 1){
            $this->result(
                ['code'=>CodeEnum::ERROR,'msg'=>'暂未有更新项']
            );
        }
        $url = $ver['upfile'];
        $file_size = $ver['file_size'];
        try {
            //创建文件（如果不存在）
            touch($tmp_path);
            //打开远程文件
            if ($fp = fopen($url, 'rb')) {
                //打开本地文件
                if (!$download_fp = fopen($tmp_path, 'wb')) {
                    return json(['code'=>0,'msg'=>'文件打开失败']);
                }
                while (!feof($fp)) {
                    if (!file_exists($tmp_path)) {
                        // 如果临时文件被删除就取消下载
                        fclose($download_fp);
                        return json(['code'=>0,'msg'=>'文件下载已经取消']);
                    }
                    //读取远程文件内容
                    fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
                }
                fclose($download_fp);
                fclose($fp);
            } else {
                //远程文件打开失败
                return json(['code'=>0,'msg'=>'远程文件可能不存在']);
            }
        } catch (Exception $e) {
            //删除文件
            unlink($tmp_path);
            return json(['code'=>0,'msg'=>'下载文件失败']);
        }
        return json_encode(compact('tmp_path','file_size'));
    }

    /**
     * 蚂蚁防红 - 获取文件大小
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $tmp_path
     * @return false|string
     */
    public function getFilesizt($tmp_path){
        if (file_exists($tmp_path)) {
            return json_encode(['size' => filesize($tmp_path)]);
        } else {
            return json_encode(['size' => -1]);
        }
    }

    /**
     * 蚂蚁防红 - 开始更新
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function doUpdate(){
        $ver = update_version($this->version,$this->website['secret']);
        $update = $ver['data'];
        $msg = false;
        if($ver['code'] == 1){
            if(!empty($update['upsql'])){
                $msg.='<p><strong>开始执行更新数据库步骤</strong></p>';
                $sql = explode(';', $update['upsql']);
                $t=0;$e=0;
                for($i = 0; $i < count($sql); $i++) {
                    if (trim($sql[$i])=='')continue;
                    if(Db::execute($sql[$i]) !== false) {
                        ++$t;
                    } else {
                        ++$e;
                    }
                }
                    $msg.= '<p>数据库更新成功。SQL成功'.$t.'句/失败'.$e.'句</p>';
            }
            if(!empty($update['upfile'])){
                $msg.='<p><strong>开始执行更新文件步骤</strong></p>';
                    if(preg_match('!\.zip!i',$update['upfile'])){
                        $target='../data/update/cache.zip';
                        @file_put_contents($target, file_get_contents($update['upfile']));
                        $pcl = new PclZip($target);
                        //$pcl->zipname=$target;
                        $pcl->extract(PCLZIP_OPT_PATH, "../",PCLZIP_OPT_REPLACE_NEWER);
                    }else{
                        @file_put_contents($update['name'], file_get_contents($update['upfile']));
                    }
                    $msg.='<p>'.$update['ver'].' 已更新</p>';
            }
            if(!empty($update['unlink'])){
                $msg.='<p><strong>开始执行删除文件步骤</strong></p>';
                foreach($update['unlink'] as $v){
                    @unlink($v);
                    $msg.='<p>'.$v.' 已删除</p>';
                }
            }
            deldir("../runtime");
            $this->result(
                ['code'=>1,'msg'=>$msg]
            );
        }else{
            $this->result(
                ['code'=>0,'msg'=>'当前程序为最新版，无需更新']
        );
        }

    }

    /**
     * 蚂蚁防红 - 保存配置
     *
     * @auth Dany <cgh@tom.com>
     *
     */
    public function doWebset(){
        $para = Request::param();
        $this->result(
            $this->logicWebsite->settingSave($para)
        );
    }

    /**
     * 蚂蚁防红 - 接口保存
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param $appid
     * @param $appkey
     */
    public function doApiset($token){
        $this->result(
            $this->logicWebsite->settingSave(['token'=>$token])
        );
    }
}