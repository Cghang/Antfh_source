<?php
/**
 * 蚂蚁防红 - Api.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-16
 */


namespace app\api\logic;


class Api extends BaseLogic
{
    /**
     * 蚂蚁防红 - 获取信息
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $where
     * @param bool $field
     * @return mixed
     */
    public function getApiInfo($where = [], $field = true)
    {
        return $this->modelApi->getInfo($where, $field);
    }

}