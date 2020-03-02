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

class Checknotify extends Validate
{
    protected $rule = [
        'key|APPKEY' => 'require|alphaNum',
        'type|域名检测类型' => 'require|in:1,2',
        'dtype|域名类型' => 'require|in:1,2',
        'status|域名状态' => 'require|in:1,0',
        'id|域名id' => 'require|number'
    ];

}