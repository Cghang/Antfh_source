<?php
/**
 * 蚂蚁防红 - Fhdomain.php
 *
 * @auth Dany <cgh@tom.com>
 *
 * Time:2019/9/5
 */


namespace app\admin\logic;


class Fhdomain extends \app\common\logic\Fhdomain
{
    /**
     * 蚂蚁防红 - 获取防红列表
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int $paginate
     * @return mixed
     */
    public function getFhdomainList($where = [], $field = true, $order = 'a.create_time desc', $paginate = 15)
    {
        $field = 'a.id,a.status,a.title,a.longurl,a.create_time,a.visit,a.shorturl,a.type,b.url';

        $this->modelFhdomain->modelalias = 'a';

        $join = [
            ['tzdomain b', ' b.id = a.tid'],
        ];

        $this->modelFhdomain->join = $join;

        return $this->modelFhdomain->getList($where, $field, $order, $paginate);
    }

    public function getFhdomainInfoJoin($where = [] , $filed = true){
        $filed = 'a.id,a.status,a.title,a.longurl,a.create_time,a.visit,a.shorturl,a.type,a.out_time,a.uid,b.out_time as userout_time';
        $this->modelFhdomain->modelalias = 'a';
        $join = [
            ['user b', ' b.uid = a.uid'],
        ];
        $this->modelFhdomain->join = $join;
        return $this->modelFhdomain->getInfo($where,$filed);
    }
    /**
     * 蚂蚁防红 - 获取总数
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param array $where
     * @return mixed
     */
    public function getFhdomainCount($where = []){
        $this->modelFhdomain->modelalias = 'a';
        return $this->modelFhdomain->getCount($where);
    }
}