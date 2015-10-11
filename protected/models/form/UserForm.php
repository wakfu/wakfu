<?php

/**
 * File: UserForm.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 14/11/27 23:52
 * Description: 用户表单
 */
class UserForm extends CFormModel
{
    public $oldPassword;
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
            ['oldPassword', 'required', 'message' => '请输入' . $labels['oldPassword']],
            ['password', 'required', 'message' => '请输入' . $labels['password']],
            ['confirm', 'required', 'message' => '请输入' . $labels['confirm']],
            ['oldPassword', 'confirm', 'message' => $labels['oldPassword'] . '验证错误'],
            ['confirm', 'verify', 'message' => '二次' . $labels['confirm'] . '错误'],
            ['oldPassword, password', 'safe'],
        ];
    }

    /**
     * 二次密码验证
     * @return bool
     */
    public function verify($attrbutes, $params)
    {
        $this->password = trim($this->password);
        if (empty($this->password)) {
            $this->addError($attrbutes, $params['message']);
        }
        if ($this->password != $this->confirm) {
            $this->addError($attrbutes, $params['message']);
        }
    }

    public function confirm($attrbutes, $params)
    {
        $user = User::model()->findByPk(Yii::app()->user->getId());
        if (!CPasswordHelper::verifyPassword($this->oldPassword, $user->password)) {
            $this->addError($attrbutes, $params['message']);
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => '旧密码',
            'password' => '新密码',
            'confirm' => '验证密码',
        ];
    }

    public function save()
    {
        $app = Yii::app();

        $transaction = $app->db->beginTransaction();
        try {
            if (!$this->validate()) throw new CDbException('参数出错', 0, []);

            $user = User::model()->findByPk(Yii::app()->user->getId());
            if (!$user) {
                throw new CDbException('参数出错', 1, []);
            }

            $user->attributes = array(
                'password' => CPasswordHelper::hashPassword($this->password)
            );

            if ($user->save() === false) {
                throw new CDbException('修改密码出错', 30, $user->getErrors());
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
