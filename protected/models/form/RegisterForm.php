<?php
/**
 * File: RegisterForm.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 14/11/28 18:25
 * Description: 注册表单
 */
class RegisterForm extends CFormModel{
    public $username;
    public $password;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules(){
        $labels = $this->attributeLabels();
        return array(
            array('username', 'required','message' => '请输入'.$labels['username']),
            array('password', 'required','message' => '请输入'.$labels['password']),
            array('username', 'unique','message' => $labels['username'].'已存在'),
            array('username', 'email','message' => $labels['username'].'格式不正确'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message' => $labels['verifyCode'].'不正确'),
        );
    }

    public function unique($attrbutes, $params){
        if(User::model()->exists($attrbutes.'=:u', array('u' => $this->username))){
            $this->addError($attrbutes, $params['message']);
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels(){
        return array(
            'username' => '邮箱',
            'password' => '密码',
            'verifyCode' => '验证码'
        );
    }

    public function save(){
        $app = Yii::app();

        $transaction = $app->db->beginTransaction();
        try{
            if($this->validate() == false) throw new CDbException('参数出错',0, array());
            preg_match('/^(.*)@/', $this->username, $match);
            $user = new User();
            $user->attributes = array(
                'username' => $this->username,
                'realname' => isset($match[1])?$match[1]:'无',
                'nickname' => isset($match[1])?$match[1]:'无',
                'email' => $this->username,
                'password' => CPasswordHelper::hashPassword($this->password),
                'sign_up_time' => time(),
                'sign_up_ip' => Yii::app()->request->getUserHostAddress(),
                'approved' => 5,
                'state' => 0,
            );

            if($user->save() === false) throw new CDbException('注册用户失败',10,$user->getErrors());
            $user->uuid = $app->getSecurityManager()->generateUUID($user->id.$user->password);
            if($user->save() === false) throw new CDbException('注册用户失败',10,$user->getErrors());
            //写入service
            $service = new Service();
            $service->attributes = array(
                'uid' => $user->id,
                'email' => $user->username,
                'status' => 1,
                'traffic' => 0,
            );
            $service->save();

            $transaction->commit();

            $task = Queue::createTask(Yii::app()->createUrl('api/create'), $user->id);
            Queue::enqueue($task);

        }catch (CDbException $e){
            $transaction->rollback();
            $this->addErrors($e->errorInfo);
            return false;
        }

        $email = $app->getComponent('email');
        if(!empty($email)){
            $email->quickSend($this->username, '欢迎您注册夸父', "请妥善保管好您的登录密码：".$this->password);
        }

        return true;
    }
}