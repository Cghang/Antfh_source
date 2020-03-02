<?php
/**
 * 蚂蚁防红 - OuttimeException.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019/9/8
 */


namespace app\common\library\exception;


class OuttimeException extends BaseException
{
    public $code = 200;
    public $msg = 'out time';
    public $errorCode = 100001;
}