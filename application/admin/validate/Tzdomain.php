<?php
/**
 * 蚂蚁防红 - Fhurl.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\admin\validate;


use think\Validate;

class Tzdomain extends Validate
{

    protected $rule = [
        'url|网址' => 'require|url',
        'imp|权重' => 'require|number',
        'fjx|泛解析' => 'require'
    ];
}