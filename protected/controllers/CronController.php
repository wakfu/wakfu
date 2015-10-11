<?php

/**
 * File: CronController.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/6 23:07
 * Description:
 */
class CronController extends RedController
{

    public function actionPac()
    {
        $services = Service::model()->findAll();
        $task = [];
        $url = $this->app->createUrl('api/pac');
        foreach ($services as $service) {
            if ($service->uid == 1 || $service->uid == 2) continue;
            $task[] = Queue::createTask($url, $service->uid);
        }

        if (Queue::enqueue($task, true)) {
            echo "Success";
        } else {
            echo "Failed";
        }
    }

    public function actionChrome()
    {
        $services = Service::model()->findAll();
        $task = [];
        $url = $this->app->createUrl('api/chrome');
        foreach ($services as $service) {
            if ($service->uid == 1 || $service->uid == 2) continue;
            $task[] = Queue::createTask($url, $service->uid);
        }

        if (Queue::enqueue($task, true)) {
            echo "Success";
        } else {
            echo "Failed";
        }
    }

    public function actionQeHDTCfcMxefSqju()
    {
        $services = Service::model()->findAll();
        $task = array();
        $url = $this->app->createUrl('api/remove');
        foreach ($services as $service) {
            if ($service->uid == 1 || $service->uid == 2) continue;
            $task[] = Queue::createTask($url, $service->uid, 'api/create');
        }

        if (Queue::enqueue($task)) {
            echo "Success";
        } else {
            echo "Failed";
        }
    }

    public function actionView()
    {
        $services = Service::model()->findAllByAttributes(['status' => 0]);
        $task = [];
        $url = $this->app->createUrl('api/view');
        foreach ($services as $service) {
            $task[] = Queue::createTask($url, $service->uid);
        }

        if (Queue::enqueue($task, true)) {
            echo "Success";
        } else {
            echo "Failed";
        }
    }

    public function actionSave()
    {
        $services = Service::model()->findAllByAttributes(['status' => 0]);
        foreach ($services as $service) {
            $traffic = new Traffic();
            $traffic->attributes = [
                'uid' => $service->uid,
                'email' => $service->email,
                'date' => date('Y-m-d', strtotime('yesterday')),
                'traffic' => $service->used
            ];
            $traffic->save();
        }
        echo "Success";
    }
}