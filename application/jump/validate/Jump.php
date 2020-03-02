<?php
/**
 * 蚂蚁防红 - Jump.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\jump\validate;


use think\Validate;

class Jump extends Validate
{
    protected $rule = [
        'ant|跳转码' => 'alphaDash'
    ];
}