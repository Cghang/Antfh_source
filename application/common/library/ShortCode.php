<?php
/**
 * 蚂蚁防红 - ShortCode.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019/9/1
 */


namespace app\common\library;


class ShortCode
{
    //字符表
    public static $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    public static function encode($url)
    {
        $key = 'antfhnet'; //加盐
        $urlhash = md5($key . $url);
        $len = strlen($urlhash);

        //将加密后的串分成4段，每段4字节，对每段进行计算，一共可以生成四组短连接
        for ($i = 0; $i < 4; $i++) {
            $urlhash_piece = substr($urlhash, $i * $len / 4, $len / 4);

            //将分段的位与0x3fffffff做位与，0x3fffffff表示二进制数的30个1，即30位以后的加密串都归零
            //此处需要用到hexdec()将16进制字符串转为10进制数值型，否则运算会不正常
            $hex = hexdec($urlhash_piece) & 0x3fffffff;

            //域名根据需求填写
            $short_url = "";

            //生成6位短网址
            for ($j = 0; $j < 6; $j++) {

                //将得到的值与0x0000003d,3d为61，即charset的坐标最大值
                $short_url .= self::$charset[$hex & 0x0000003d];

                //循环完以后将hex右移5位
                $hex = $hex >> 5;
            }

            $short_url_list[] = $short_url;
        }

        return $short_url_list;
    }

}