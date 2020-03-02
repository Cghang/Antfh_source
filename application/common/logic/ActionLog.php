<?php
/**
 * 蚂蚁防红 - ActionLog.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019-08-17
 */


namespace app\common\logic;


class ActionLog extends BaseLogic
{
    /**
     * 蚂蚁防红 - 行为列表
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int $paginate
     * @return mixed
     */
    public function getActionLogList($where = [], $field = true, $order = 'create_time desc', $paginate = 15)
    {
        $this->modelActionLog->limit = !$paginate;
        return $this->modelActionLog->getList($where, $field, $order, $paginate);
    }

    /**
     * 蚂蚁防红 - 统计
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $where
     * @return mixed
     */
    public function getActionLogCount($where = []){
        return $this->modelActionLog->getCount($where);
    }
}