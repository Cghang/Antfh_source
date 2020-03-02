<?php
/**
 * 蚂蚁防红 - Check.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-15
 */


namespace app\index\validate;


use think\Validate;

class Check extends Validate
{

    protected $rule = [
        'type|检测类型' => 'in:1,2',//1 微信 2 qq
        'url|检测网址' => 'require|url'
    ];

}