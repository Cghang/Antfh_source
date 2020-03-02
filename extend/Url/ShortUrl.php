<?php
/**
 * 蚂蚁防红 - ShortUrl.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */
namespace Url;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ShortUrl{
    public static function short($longurl,$api,$token) {
        switch ($api) {
            case 0://返回
                return $longurl;
                break;
            case 1://新浪
                return self::sinadwz($longurl,$token);
                break;
            case 2://百度
                return self::dwzcn($longurl,$token);
                break;
            case 3://搜狗
                return self::sogouurl($longurl,$token);
                break;
            case 4://微信
                return self::wurlcn($longurl,$token);
                break;
            default:
                return self::sinadwz($longurl,$token);//默认tcn
                break;
        }
    }
    public static function sinadwz($longurl,$token) {
        $url='http://api.antfh.net/api/dwz/tcn?longurl='.$longurl.'&token='.$token;
        try {
            $result = (new Client())->request('GET', $url)->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        $arr = json_decode($result, true);
        return isset($arr['shorturl'])?$arr['shorturl']:false;
    }
    public static function dwzcn($longurl,$token) {
        $url='http://api.antfh.net/api/dwz/tcn?longurl='.$longurl.'&token='.$token;
        try {
            $result = (new Client())->request('GET', $url)->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        $arr = json_decode($result, true);
        return isset($arr['shorturl'])?$arr['shorturl']:false;
    }
    public static function sogouurl($longurl,$token) {
        $url='http://api.antfh.net/api/dwz/urlcn?longurl='.$longurl.'&token='.$token;
        try {
            $result = (new Client())->request('GET', $url)->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        $arr = json_decode($result, true);
        return isset($arr['shorturl'])?$arr['shorturl']:false;
    }
    public static function wurlcn($longurl,$token) {
        $url='http://api.antfh.net/api/dwz/wurlcn?longurl='.$longurl.'&token='.$token;
        try {
            $result = (new Client())->request('GET', $url)->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        $arr = json_decode($result, true);
        return isset($arr['shorturl'])?$arr['shorturl']:false;
    }
}