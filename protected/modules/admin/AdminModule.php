<?php

class AdminModule extends RedWebModule
{
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport([
            'admin.models.*',
            'admin.models.form.*',
            'admin.components.*',
            'admin.components.filters.*',
        ]);
        Yii::app()->setComponents([
            'errorHandler' => [
                'errorAction' => 'admin/error/index',
            ],
            'user' => [
                'stateKeyPrefix' => 'red.admin'
            ],
        ]);
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            if ($controller->getId() != 'index' && $action->getId() != 'index') {
                $logging = new Logging();
                $app = Yii::app();
                $request = $app->getRequest();
                $user = $app->getUser();
                $logging->attributes = [
                    'user_id' => $user->getState('id', 0),
                    'username' => $user->getState('username', '匿名'),
                    'request' => $request->getRequestUrl(),
                    'param' => $request->getParamString(),
                    'type' => $request->getRequestType(),
                    'controller' => $controller->getId(),
                    'action' => $action->getId(),
                    'time' => time(),
                    'date' => date('Y-m-d'),
                    'ip' => $request->getUserHostAddress()
                ];
                $logging->save();
            }
            return true;
        } else
            return false;
    }
}
