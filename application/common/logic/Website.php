<?php


namespace app\common\logic;


use app\common\library\enum\CodeEnum;

class Website extends BaseLogic
{

    /**
     * 蚂蚁防红 - 获取网站信息
     *
     * @param array $where
     * @param bool $field
     *
     * @author Dany <cgh@tom.com>
     *
     * @return mixed
     */
    public function getWebsiteInfo($where = [], $field = true)
    {
        return json_decode($this->modelWebsite->getInfo($where, $field),true);
    }

    public function settingSave($data = []){
        foreach ($data as $name => $value)
        {
            $where = array('id' => 1);

            $this->modelWebsite->updateInfo($where, [$name => $value]);
        }

        return ['code'=>CodeEnum::SUCCESS, 'msg'=>'设置保存成功'];
    }

}