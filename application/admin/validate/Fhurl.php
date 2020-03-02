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

class Fhurl extends Validate
{

    protected $rule = [
        'url|防红网址' => 'require|url',
        'title|网站标题' => 'require',
        'type|短链接类型' => 'in:1,2,3,4'
    ];
}