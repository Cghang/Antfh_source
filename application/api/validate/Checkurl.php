<?php
/**
 * 蚂蚁防红 - Checkurl.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-17
 */


namespace app\api\validate;


use think\Validate;

class Checkurl extends Validate
{
    protected $rule = [
        'token|Token' => 'require|alphaNum',
        'chkurl|检测网址' => 'require|url',
        'uid|Uid' => 'require|number'
    ];

}