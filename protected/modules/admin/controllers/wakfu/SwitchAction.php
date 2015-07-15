<?php
/**
 * File: SwitchAction.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/3 11:36
 * Description: 
 */
class SwitchAction extends RedAction{

    public function run(){
        $uid = $this->request->getQuery('id', 0);
        $service = Service::model()->findByPk($uid);
        if(!empty($service)){
            if(in_array($service->status, array(1,2))){ // 不可用状态
                $task = Queue::createTask($this->app->createUrl('api/open'), $uid);
            }else{
                $task = Queue::createTask($this->app->createUrl('api/close'), $uid);
            }
            if(Queue::enqueue($task)){
                $this->response(200, ':) success');
            }else{
                $this->response(200, ':( failure');
            }
        }else{
            $this->response(404, 'Not Found');
        }
    }
}