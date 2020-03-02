<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Api.php
 * Time: 8:16 PM
 */

namespace app\common\logic;


class Api extends BaseLogic
{

    public function getApiInfo($where = [], $field = true)
    {
        return $this->modelApi->getInfo($where, $field);
    }

}