<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Wxapi.php
 * Time: 12:53 PM
 */

namespace app\jump\logic;


use app\common\logic\BaseLogic;

class Wxapi extends BaseLogic
{
    public function ScanQrcode($message = '', $sub = false)
    {
        if ($sub) {
            $message = str_replace("qrscene_", "", $message);
        }
        if (strpos($message, 'login_') === 0) {
            $message = str_replace('login_', '', $message);
            return $message;
            } elseif (strpos($message, 'channel_') === 0) {
            $message = str_replace('channel_', '', $message);
            return $message;
            }else{
            return $message;
        }
    }
}