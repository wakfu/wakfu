<?php
/**
 * File: CronController.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/6 23:07
 * Description: 
 */
class CronController extends RedController{

    public function actionPac(){
        $services = Service::model()->findAll();
        $task = array();
        $url = $this->app->createUrl('api/pac');
        foreach($services as $service){
            $task[] = Queue::createTask($url, $service->uid);
        }

        if(Queue::enqueue($task, true)){
            echo "Success";
        }else{
            echo "Failed";
        }
    }
//
//    public function actionCreate(){
//        $services = Service::model()->findAll();
//        $task = array();
//        $url = $this->app->createUrl('api/create');
//        foreach($services as $service){
//            $task[] = Queue::createTask($url, $service->uid);
//        }
//
//        if(Queue::enqueue($task)){
//            echo "Success";
//        }else{
//            echo "Failed";
//        }
//    }

    public function actionView(){
        $services = Service::model()->findAll();
        $task = array();
        $url = $this->app->createUrl('api/view');
        foreach($services as $service){
            $task[] = Queue::createTask($url, $service->uid);
        }

        if(Queue::enqueue($task, true)){
            echo "Success";
        }else{
            echo "Failed";
        }
    }
}