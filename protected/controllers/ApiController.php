<?php

/**
 * File: ApiController.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/5 10:05
 * Description:
 */
class ApiController extends RedController
{

    private $wakfu = null;

    public function init()
    {
        parent::init();

        $this->wakfu = new WakfuService();
    }

    public function actionReset()
    {
        $service = $this->getServiceByUid();
        $this->postAction($service->uid, 'api/close', 'api/remove');
    }

    public function actionClose()
    {
        $service = $this->getServiceByUid();
        if ($this->wakfu->close($service)) {
            if ($service->save()) {
                $this->postAction($service->uid, 'api/remove', 'api/create');
            } else {
                Yii::log("[" . $service->uid . "]API::CLOSE save failed", CLogger::LEVEL_INFO);
            }
        } else {
            Yii::log("[" . $service->uid . "]API::CLOSE failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionRemove()
    {
        $service = $this->getServiceByUid();
        $this->wakfu->remove($service);
        if ($service->save()) {
            $this->postAction($service->uid, 'api/create', 'api/pac');
        } else {
            Yii::log("[" . $service->uid . "]API::REMOVE save failed", CLogger::LEVEL_INFO);
        }
    }

    public function actionCreate()
    {
        $service = $this->getServiceByUid();
        if ($this->wakfu->create($service)) {
            if ($service->save()) {
                $this->postAction($service->uid, 'api/pac', 'api/open');
            } else {
                Yii::log("[" . $service->uid . "]API::CREATE save failed", CLogger::LEVEL_INFO);
            }
        } else {
            Yii::log("[" . $service->uid . "]API::CREATE failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionPac()
    {
        $service = $this->getServiceByUid();
        $pac = $this->wakfu->pac($service);
        if ($pac) {
            $url = $this->wakfu->savePac($service, $pac);
            if ($url) {
                if ($service->pac != $url) {
                    $service->pac = $url;
                    if ($service->save()) {
                        $task = Queue::createTask(Yii::app()->createUrl('api/chrome'), $service->uid);
                        Queue::enqueue($task);
                        $this->postAction($service->uid, 'api/open');
                    } else {
                        Yii::log("[" . $service->uid . "]API::PAC save failed", CLogger::LEVEL_INFO);
                    }
                }
            } else {
                Yii::log("[" . $service->uid . "]API::PAC write storage fail", CLogger::LEVEL_INFO);
            }
        } else {
            Yii::log("[" . $service->uid . "]API::PAC failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionChrome()
    {
        $service = $this->getServiceByUid();
        if (!$this->wakfu->createChromeBak($service)) {
            Yii::log("[" . $service->uid . "]API::CHROME create failed", CLogger::LEVEL_INFO);
        }
    }

    public function actionOpen()
    {
        $service = $this->getServiceByUid();
        if ($this->wakfu->open($service)) {
            if (!$service->save()) {
                Yii::log("[" . $service->uid . "]API::OPEN save failed", CLogger::LEVEL_INFO);
            }
        } else {
            Yii::log("[" . $service->uid . "]API::OPEN failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionView()
    {
        $service = $this->getServiceByUid();
        if ($this->wakfu->view($service)) {
            if (!$service->save()) {
                Yii::log("[" . $service->uid . "]API::VIEW save failed", CLogger::LEVEL_INFO);
            }
        } else {
            Yii::log("[" . $service->uid . "]API::VIEW failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionError()
    {
        $uid = $this->request->getPost('uid');
        Yii::log('queue error:' . $uid, CLogger::LEVEL_INFO);
    }

    private function getServiceByUid()
    {
        $accessKey = $this->request->getPost('accessKey', false);
        $secretKey = Yii::app()->params['secretKey'];
        if ($accessKey != $secretKey) {
            Yii::log("[" . $accessKey . "]API accessKey auth fail", CLogger::LEVEL_INFO);
            Yii::app()->end();
        }

        $uid = $this->request->getPost('uid');
        $service = Service::model()->findByPk($uid);
        if (empty($service)) {
            Yii::log("[" . $uid . "]API UID Not found", CLogger::LEVEL_INFO);
            Yii::app()->end();
        }
        return $service;
    }

    private function postAction($uid, $currentAction, $postAction = false)
    {
        $action = $this->request->getPost('postAction', false);
        if ($action == $currentAction) {
            $url = Yii::app()->createUrl($action);
            $task = Queue::createTask($url, $uid, $postAction);
            Queue::enqueue($task);
        }
    }
}