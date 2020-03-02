<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name AutoPushWork.php
 * Time: 4:25 PM
 */

namespace app\common\service\work;

use think\queue\Job;
use Wxapi\Wxapi;

class AutoPushWork
{

    /**
     * fire方法是消息队列默认调用的方法
     * @param Job            $job      当前的任务对象
     * @param array|mixed    $data     发布任务时自定义的数据
     */
    public function fire(Job $job,$data)
    {
        // 有些消息在到达消费者时,可能已经不再需要执行了
        $isJobStillNeedToBeDone = $this->checkDatabaseToSeeIfJobNeedToBeDone($data);
        if(!$isJobStillNeedToBeDone){
            $job->delete();
            return;
        }

        $isJobDone = $this->doPushJob($data);

        if ($isJobDone) {
            // 如果任务执行成功， 记得删除任务
            $job->delete();
            print("<info>Hello Job has been done and deleted"."</info>\n");
        }else{
            if ($job->attempts() > 3) {
                //通过这个方法可以检查这个任务已经重试了几次了
                print("<warn>Hello Job has been retried more than 3 times!"."</warn>\n");

                $job->delete();

                // 也可以重新发布这个任务
                //print("<info>Hello Job will be availabe again after 2s."."</info>\n");
                //$job->release(2); //$delay为延迟时间，表示该任务延迟2秒后再执行
            }
        }
    }

    /**
     * 有些消息在到达消费者时,可能已经不再需要执行了
     * @param array|mixed    $data     发布任务时自定义的数据
     * @return boolean                 任务执行的结果
     */
    private function checkDatabaseToSeeIfJobNeedToBeDone($data){
        return true;
    }

    private function doPushJob($data) {
        #type login push reg
        $wxapi = new Wxapi();
        $var = [
            'first'=>['value'=>'服务信息推送！'],
            'keyword1'=>['value'=>'猪八戒'],
            'keyword2'=>['value'=>'设计）'],
            'keyword3'=>['value'=>date('Y-m-d H:i:s')],
            'remark'=>['value'=>'欢迎再次购买！'],
        ];
        $data = [
            'touser'        =>'oKF_PwteA-Q59lW60D9bl_xUEtg0',
            'template_id'   =>'7_LDIWrBeV4kLogUcUWgFOWrdQwzsbLK2Bv9Pzy-S3M',
            'url'           =>'https://www.baidu.com/',
            'data'          =>$var,
        ];
        $info = $wxapi->message_template_send($data);


        return true;
    }

}