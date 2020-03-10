<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use app\common\library\enum\CodeEnum;
use app\common\logic\Log as LogicLog;
use GuzzleHttp\Client;
use think\facade\Request;

/**
 * 检测管理用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_admin_login()
{
    $user = session('admin_auth');
    if (empty($user)) {
        return false;
    } else {
        return session('admin_auth_sign') == data_auth_sign($user) ? $user['id'] : false;
    }
}
/**
 * 字符串替换
 *
 * @param string $str
 * @param string $target
 * @param string $content
 *
 * @author Dany <cgh@tom.com>
 *
 * @return mixed
 */
function sr($str = '', $target = '', $content = '')
{

    return str_replace($target, $content, $str);
}

/**
 * 字符串前缀验证
 *
 * @param $str
 * @param $prefix
 *
 * @author Dany <cgh@tom.com>
 *
 * @return bool
 */
function str_prefix($str, $prefix)
{

    return strpos($str, $prefix) === 0 ? true : false;
}
function data_md5($str, $key = 'PushAnt')
{

    return '' === $str ? '' : md5(sha1($str) . $key);
}
function data_auth_sign($data)
{

    // 数据类型检测
    if (!is_array($data)) {

        $data = (array)$data;
    }

    // 排序
    ksort($data);

    // url编码并生成query字符串
    $code = http_build_query($data);

    // 生成签名
    $sign = sha1($code);

    return $sign;
}
function data_md5_key($str, $key = '')
{

    if (is_array($str)) {

        ksort($str);

        $data = http_build_query($str);

    } else {

        $data = (string) $str;
    }

    return empty($key) ? data_md5($data,config('secret.data_salt')) : data_md5($data, $key);
}
function is_user_login()
{
    $user = session('user_auth');
    if (empty($user)) {
        return false;
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : false;
    }
}
function get_sington_object($object_name = '', $class = null)
{
    (new think\Container)->exists($object_name) ?: \think\container::set($object_name, new $class());
    return \think\container::get($object_name);
}
function action_log($name = '', $describe = '')
{

    $logLogic = get_sington_object('logLogic', LogicLog::class);
    //print_r($logLogic);exit;
    $logLogic->logAdd($name, $describe);
}
function checkIfActive($module,$controller,$action) {
    $module_now = Request::module();
    $controller_now = Request::controller();
    $action_now = Request::action();
    //echo $module_now.$controller_now.$action_now;
    if ($module == $module_now && $controller == $controller_now && $action == $action_now){
        return 'active';
    }else
        return null;
}
function clear_admin_login_session()
{
    session('admin_info',      null);
    session('admin_auth',      null);
    session('admin_auth_sign', null);
    return true;
}
function clear_user_login_session()
{
    session('user_info',      null);
    session('user_auth',      null);
    session('user_auth_sign', null);
    return true;
}
function authcode($string, $operation = 'ENCODE', $key = 'pushant', $expiry = 0){

    if($operation == 'DECODE') {
        $string = str_replace('[cn]','+',$string);//a
        $string = str_replace('[push]','&',$string);//b
        $string = str_replace('[ant]','/',$string);//c
    }
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {

            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        $ustr = $keyc.str_replace('=', '', base64_encode($result));
        $ustr = str_replace('+','[cn]',$ustr);//a
        $ustr = str_replace('&','[push]',$ustr);//b
        $ustr = str_replace('/','[ant]',$ustr);//c
        return $ustr;
    }
}
function encrypt($string = "", $operation = "E", $key = 'pushant')
{
    $key=md5($key);
    $key_length=strlen($key);
    $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++)
    {
        $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++)
    {
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++)
    {
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D')
    {
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
        {
            return substr($result,8);
        }
        else
        {
            return'';
        }
    }
    else
    {
        return str_replace('=','',base64_encode($result));
    }
}
function arr2obj($arr) {
    if (gettype($arr) != 'array') {
        return false;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') {
            $arr[$k] = (object)arr2obj($v);
        }
    }
    return (object)$arr;
}

/**
 * 蚂蚁防红 - 后缀生成
 *
 * @auth Dany <cgh@tom.com>
 *
 * @param $input
 * @return array
 */
function jump_short($input) {
    $base32 = array (
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
        'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
        'y', 'z', '0', '1', '2', '3', '4', '5'
    );
    $hex = md5($input);
    $hexLen = strlen($hex);
    $subHexLen = $hexLen / 8;
    $output = array();
    for ($i = 0; $i < $subHexLen; $i++) {
        $subHex = substr ($hex, $i * 8, 8);
        $int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
        $out = '';

        for ($j = 0; $j < 6; $j++) {
            $val = 0x0000001F & $int;
            $out .= $base32[$val];
            $int = $int >> 5;
        }
        $output[] = $out;
    }
    return $output;
}

function update_version($version,$secret = 'antfh'){
    try {
        $Client = (new Client())->request('GET', config('api_antfh') . 'Ant_Free_Update?ver=' . $version)->getBody()->getContents();
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        return ['code'=>CodeEnum::ERROR,'msg'=>'检测更新API失败，请重试！','data'=>''];
    }
    //print_r($Client);exit;
    if ($Client){
        $data = json_decode($Client,true);
        return ['code'=>$data['code'],'msg'=>$data['msg'],'data'=>$data['data']];
    }else{
        return ['code'=>CodeEnum::ERROR,'msg'=>'检测更新API失败！','data'=>''];
    }
}

function deldir($dir) {
    //先删除目录下的文件：
    if(!is_dir($dir)){
        return false;
    }
    $dh=opendir($dir);
    while ($file=readdir($dh)) {
        if($file!="." && $file!="..") {
            $fullpath=$dir."/".$file;
            if(!is_dir($fullpath)) {
                @unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }

    closedir($dh);
    //删除当前文件夹：
    if(rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

function urltype($id){
    switch ($id){
        case 1:
            return '新浪缩址';
        case 2:
            return '百度缩址';
        case 3:
            return '腾讯缩址';
        case 4:
            return '微信缩址';
        default:
            return '未知方式';
    }
}


function parse_url_host($url){
    $arr = parse_url($url);//Array ( [scheme] => http [host] => www.baidu.com [path] => /index.php [query] => m=content&c=index&a=lists&catid=6&area=0&author=0&h=0®ion=0&s=1&page=1 )
    //print_r($arr);
    $host = false;
    if ($arr && isset($arr['scheme']) && isset($arr['host'])){
        $host = $arr['host'];
    }elseif(!isset($arr['scheme']) || !isset($arr['host']) && isset($arr['path'])){
        $host = parse_url('http://'.$arr['path']);
        if ($host){
            $host = $host['host'];
        }
    }
    return $host;
}


function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    //$max = strlen($strPol)-1;
    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,20)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }

    return $str;
}

/**
 * 蚂蚁防红 - escape
 *
 * @auth Dany <cgh@tom.com>
 *
 * @param $string
 * @param string $in_encoding
 * @param string $out_encoding
 * @return string
 */
function escape($string, $in_encoding = 'UTF-8',$out_encoding = 'UCS-2') {
    $return = '';
    if (function_exists('mb_get_info')) {
        for($x = 0; $x < mb_strlen ( $string, $in_encoding ); $x ++) {
            $str = mb_substr ( $string, $x, 1, $in_encoding );
            if (strlen ( $str ) > 1) { // 多字节字符
                $return .= '%u' . strtoupper ( bin2hex ( mb_convert_encoding ( $str, $out_encoding, $in_encoding ) ) );
            } else {
                $return .= '%' . strtoupper ( bin2hex ( $str ) );
            }
        }
    }
    return $return;
}

function fix_url($url, $def=false, $prefix=false) {
    $url = trim($url);
    if (empty($url)){
        return $def;
    }
    if ( count(explode('://',$url))>1 ){
        return $url;
    }else{
        return $prefix===false ? 'http://'.$url : $prefix.$url;
    }
}
function encode_type($type = 1,$html = '404 Not Found',$short = 'error'){
    switch ($type){
        case 1:
            $html = escape($html);
            $html = str_replace('%',' ',$html);
            $func = getRandChar(5);
            $funcin = preg_replace("/\\d+/",'', $short);
            return '<script>function '.$func.'('.$funcin.'){document.write((unescape('.$funcin.')));};'.$func.'("'.$html.'".replace(/ /g,"%"));</script>';
        case 2:
            $html = urlencode($html);
            $html = str_replace('+',' ',$html);
            $func = getRandChar(rand(5,8));
            $funcin = preg_replace("/\\d+/",'', $short);
            return '<script>function '.$func.'('.$funcin.'){document.write((decodeURIComponent('.$funcin.')));};'.$func.'("'.$html.'".replace(" ","+"));</script>';
        case 3:
            $html = base64_encode($html);
            $html = str_replace('+',' ',$html);
            $func = getRandChar(rand(5,8));
            $funcin = preg_replace("/\\d+/",'', $short);
            return '<script>function '.$func.'('.$funcin.'){document.write((window.atob('.$funcin.')));};'.$func.'("'.$html.'".replace(/ /g,"+"));</script>';
        case 4:
            $html = urlencode($html);
            $html = str_replace('+',' ',$html);
            $html = json_encode($html,true);
            $func = getRandChar(rand(5,8));
            $funcin = preg_replace("/\\d+/",'', $short);
            return '<script>function '.$func.'('.$funcin.'){document.write(decodeURIComponent(JSON.parse('.$funcin.')));};'.$func.'(\''.$html.'\');</script>';
        default:
            $html = escape($html);
            $html = str_replace('%',' ',$html);
            $func = getRandChar(5);
            $funcin = preg_replace("/\\d+/",'', $short);
            return '<script>function '.$func.'('.$funcin.'){document.write((unescape('.$funcin.')));};'.$func.'("'.$html.'".replace(/ /g,"%"));</script>';
    }

}
?>