<?php
/**
 * 蚂蚁防红 - ShortUrl.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\api\validate;

use think\Validate;

class Shorturl extends Validate
{
    protected $rule = [
        'longurl|原网址' => 'require|url',
        'type|缩址类型' => 'in:1,2,3,4',
        'jump|跳转类型' => 'in:0,1',
    ];

}