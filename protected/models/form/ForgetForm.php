<?php

/**
 * File: ForgetForm.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 14/11/28 18:25
 * Description: 注册表单
 */
class ForgetForm extends CFormModel
{
    public $username;
    public $password;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        $labels = $this->attributeLabels();
        return [
            ['username', 'required', 'message' => '请输入' . $labels['username']],
            ['password', 'required', 'message' => '请输入' . $labels['password']],
            ['username', 'unique', 'message' => $labels['username'] . '不存在'],
            ['username', 'email', 'message' => $labels['username'] . '格式不正确'],
            ['verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'message' => $labels['verifyCode'] . '不正确'],
        ];
    }

    public function unique($attrbutes, $params)
    {
        if (!User::model()->exists($attrbutes . '=:u', ['u' => $this->username])) {
            $this->addError($attrbutes, $params['message']);
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'username' => '邮箱',
            'password' => '密码',
            'verifyCode' => '验证码'
        ];
    }

    public function save()
    {
        $app = Yii::app();

        $transaction = $app->db->beginTransaction();
        try {
            if ($this->validate() == false) throw new CDbException('参数出错', 0, []);

            $user = User::model()->findByAttributes([
                'username' => $this->username,
            ]);
            if (empty($user)) throw new CDbException('不存在的用户', 10, $user->getErrors());

            $user->password = $this->password;
            if ($user->save() === false) throw new CDbException('找回密码失败', 10, $user->getErrors());

            $transaction->commit();
        } catch (CDbException $e) {
            $transaction->rollback();
            $this->addErrors($e->errorInfo);
            return false;
        }

        $email = $app->getComponent('email');
        if (!empty($email)) {
            $email->quickSend($this->username, '[夸父]找回密码', "请及时登录并修改您的登录密码：" . $this->password);
        }

        return true;
    }
}