<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name User.php
 * Time: 9:34 PM
 */

namespace app\common\logic;

use app\common\library\enum\CodeEnum;

class User extends BaseLogic
{

    /**
     * 获取用户列表
     *
     * @author Dany <cgh@tom.com>
     *
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int $paginate
     *
     * @return mixed
     */
    public function getUserList($where = [], $field = true, $order = 'create_time desc', $paginate = 15)
    {
        $this->modelUser->limit = !$paginate;
        return $this->modelUser->getList($where, $field, $order, $paginate);
    }

    /**
     * 获取用户总数
     *
     * @author Dany <cgh@tom.com>
     *
     * @param array $where
     *
     * @return mixed
     */
    public function getUserCount($where = []){
        return $this->modelUser->getCount($where);
    }

    public function getUserBillCount($where = []){
        return $this->modelUserBill->getCount($where);
    }

    /**
     * 获取用户信息
     *
     * @param array $where
     * @param bool $field
     *
     * @author Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function getUserInfo($where = [], $field = true)
    {
        return $this->modelUser->getInfo($where, $field);
    }

    public function getUserBillList($where = [] , $field = true, $order = 'create_time desc',$paginate = 0){
        $this->modelUserBill->limit = !$paginate;
        return $this->modelUserBill->getList($where, $field, $order,$paginate);
    }
    public function setUserValue($where = [], $field = '', $value = '')
    {
        return $this->modelUser->setFieldValue($where, $field, $value);
    }
    public function setUserMoneyDec($where = []){
        return $this->modelUser->setIncOrDec($where,'setDec','money',100);
    }
    public function settingSave($where,$data = []){
        foreach ($data as $name => $value)
        {
            $this->modelUser->updateInfo($where, [$name => $value]);
        }

        return ['code'=>CodeEnum::SUCCESS, 'msg'=>'设置保存成功'];
    }

}