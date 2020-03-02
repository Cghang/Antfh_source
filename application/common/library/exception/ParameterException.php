<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name ParameterException.php
 * Time: 3:17 PM
 */

namespace app\common\library\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $errorCode = 100000;
    public $msg = "invalid parameters";
}