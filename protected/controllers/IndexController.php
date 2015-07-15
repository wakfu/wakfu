<?php
/**
 * file:IndexController.php
 * author:Toruneko@outlook.com
 * date:2014-7-6
 * desc: 主站
 */
class IndexController extends RedController{

    public function getActions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'foreColor' => 0x3D3D3D,
                'height' => 34,
                'width' => 100,
                'testLimit' => 1,
                'padding' => 0,
                'offset' => 3,
                'minLength' => 4,
                'maxLength' => 6,
            ),
        );
    }

    public function actionIndex(){
        $this->layout = '/layouts/index';
        if(!Yii::app()->user->isGuest){
            $this->redirect($this->createUrl('index/dashboard'));
        }

        $model = new LoginForm();
        if(isset($_POST['LoginForm'])){
            $model->attributes = $_POST['LoginForm'];
            if($model->validate() && $model->login()){
                $this->redirect($this->createUrl('index/dashboard'));
            }
        }

        $this->render('index',array('model' => $model));
    }

    public function actionLogout(){
        $this->user->logout();
        $this->redirect($this->createUrl('index'));
    }

    public function actionRegister(){
        $this->layout = '/layouts/index';
        $model = new RegisterForm();

        if(($post = $this->request->getPost('RegisterForm', false)) != false){
            $model->attributes = $post;
            if($model->save()){
                $login = new LoginForm();
                $post['remember'] = 1;
                unset($post['verifyCode']);
                $login->attributes = $post;
                if($login->validate() && $login->login()){
                    $this->redirect($this->createUrl('index/dashboard'));
                }else{
                    $this->redirect($this->createUrl('index'));
                }
            }
        }

        $this->render('register',array('model' => $model));
    }

    public function actionDashboard(){
        $service = Service::model()->with('user')->findByPk($this->user->getId());

        if(($post = $this->request->getPost('Service', false)) != false){
            $service->rules = $post['rules'];
            if($service->save()){
                $task = Queue::createTask($this->createUrl('api/pac'),$service->uid);
                Queue::enqueue($task);
            }
        }

        $this->render('dashboard',array(
            'service' => $service,
        ));
    }

    public function getStatusDisplay($status){
        $display = array('正常','欠费','禁用','幸存');
        return $display[$status];
    }

    public function actionError(){
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest){
                echo $error['message'];
            }else{
                $this->render('error', $error);
            }
        }else{
            $this->render('error');
        }
    }

    public function allowGuest(){
        $actionId = $this->getAction()->getId();
        $arr = array('index','register','captcha','error');
        if(in_array($actionId, $arr)) return true;
        if(Yii::app()->user->isGuest){
            $this->redirect($this->createUrl('index'));
        }
    }
}