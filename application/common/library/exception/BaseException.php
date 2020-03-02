<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name BaseException.php
 * Time: 3:16 PM
 */

namespace app\common\library\exception;

use think\Exception;

class BaseException extends Exception
{
    public $code = 400;
    public $msg = 'invalid parameters';
    public $errorCode = 999999;

    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code、msg和errorCode，且不应该是空值
     */
    public function __construct($params=[])
    {
        if(!is_array($params)){
            return;
        }
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }


    }
}
