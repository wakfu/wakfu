<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends RedUserIdentity
{
    const ERROR_NOT_LOGIN = 3;

    public $errorMessage = '未知错误';

    public function authenticate()
    {
        $user = User::model()->with('service')->find('username=:u', ['u' => $this->username]);
        $verifyPassword = false;
        if (empty($user)) {
            $state = 1;
        } else {
            $verifyPassword = CPasswordHelper::verifyPassword($this->password, $user->password);
            $state = $verifyPassword ? 0 : 1;
        }
        $result = Fraudmetrix::login($this->username, $state);
        if ($result['success'] == true && $result['final_decision'] == 'Reject') {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
            $this->errorMessage = '未知错误';
        } else {
            if (empty($user)) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
                $this->errorMessage = '用户邮箱不存在';
            } else {
                if ($user->state == 1) {
                    $this->errorCode = self::ERROR_NOT_LOGIN;
                    $this->errorMessage = '登录账号已被锁定';
                } elseif (!$verifyPassword) {
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                    $this->errorMessage = '用户密码错误';
                } else {
                    $server = Setting::model()->get('wakfu', 'server');
                    $this->errorCode = self::ERROR_NONE;
                    $this->setPersistentStates(array_merge($user->getAttributes(), [
                        'last_login_time' => $user->last_login_time,
                        'last_login_ip' => $user->last_login_ip,
                        'sign_up_time' => $user->sign_up_time,
                        'sign_up_ip' => $user->sign_up_ip,
                        'server' => $server[$user->service->server],
                        'port' => $user->service->port
                    ]));
                    $this->afterLogin($user);
                }
            }
        }
        return !$this->errorCode;
    }

    public function afterLogin($db)
    {
        $db->attributes = [
            'last_login_time' => time(),
            'last_login_ip' => Yii::app()->request->getUserHostAddress(),
        ];
        $db->update();
    }
}