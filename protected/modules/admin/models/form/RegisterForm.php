<?php

/**
 * File: RegisterForm.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 14/11/28 18:25
 * Description: 注册表单
 */
class RegisterForm extends CFormModel
{
    public $username;
    public $realname;
    public $nickname;
    public $email;
    public $password;
    public $confirm;

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
            ['username', 'unique', 'message' => $labels['username'] . '已存在'],
            ['realname', 'required', 'message' => '请输入' . $labels['realname']],
            ['nickname', 'required', 'message' => '请输入' . $labels['nickname']],
            ['email', 'required', 'message' => '请输入' . $labels['email']],
            ['password', 'required', 'message' => '请输入' . $labels['password']],
            ['confirm', 'required', 'message' => '请输入' . $labels['confirm']],
            ['confirm', 'verify', 'message' => '二次' . $labels['password'] . '错误'],
        ];
    }

    public function unique($attrbutes, $params)
    {
        if (User::model()->exists($attrbutes . '=:u', ['u' => $this->username])) {
            $this->addError($attrbutes, $params['message']);
        }
    }

    /**
     * 二次密码验证
     * @return bool
     */
    public function verify()
    {
        $this->password = trim($this->password);
        return $this->password == $this->confirm;
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'realname' => '姓名',
            'nickname' => '昵称',
            'email' => '邮箱',
            'password' => '密码',
            'confirm' => '验证密码',
            'state' => '禁用',
        ];
    }

    public function save()
    {
        $app = Yii::app();

        $transaction = $app->db->beginTransaction();
        try {
            if ($this->validate() == false) throw new CDbException('参数出错', 0, []);
            $password = CPasswordHelper::hashPassword($this->password);
            $result = Fraudmetrix::register($this->username, $this->username, $password);
            if ($result['success'] == true && $result['final_decision'] == 'Reject') {
                throw new CDbException('注册用户失败', 100, []);
            }

            $user = new User();
            $user->attributes = [
                'username' => $this->username,
                'realname' => $this->realname,
                'nickname' => $this->nickname,
                'email' => $this->email,
                'password' => $password,
                'sign_up_time' => time(),
                'sign_up_ip' => Yii::app()->request->getUserHostAddress(),
                'approved' => 5,
                'state' => 0,
            ];

            if ($user->save() === false) throw new CDbException('注册用户失败', 10, $user->getErrors());
            $user->uuid = $app->getSecurityManager()->generateUUID($user->id . $user->password);
            if ($user->save() === false) throw new CDbException('注册用户失败', 10, $user->getErrors());
            //写入service
            $service = new Service();
            $service->attributes = [
                'uid' => $user->id,
                'email' => $user->email,
                'status' => 1,
                'traffic' => 100 * 100,
            ];
            if ($service->save()) {
                Queue::apiCreate($user->id);
            }

            $transaction->commit();
        } catch (CDbException $e) {
            $transaction->rollback();
            $this->addErrors($e->errorInfo);
            return false;
        }

        return true;
    }
}