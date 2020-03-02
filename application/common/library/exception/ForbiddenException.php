<?php

namespace app\common\library\exception;

/**
 * token验证失败时抛出此异常
 */
class ForbiddenException extends BaseException
{
    public $code = 200;
    public $msg = 'Unauthorized access';
    public $errorCode = 100001;
}