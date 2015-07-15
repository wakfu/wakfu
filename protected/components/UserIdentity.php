<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends RedUserIdentity{
	const ERROR_NOT_LOGIN = 3;
	
	public $errorMessage = '未知错误';
	
	public function authenticate(){
		$user = User::model()->find('username=:u',array('u' => $this->username));
		if(empty($user)){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			$this->errorMessage = '邮箱不存在';
		}else{
			if($user->approved <= 0 || $user->state == 1){
				$this->errorCode = self::ERROR_NOT_LOGIN;
				$this->errorMessage = '登录邮箱已被锁定';
			}elseif(!CPasswordHelper::verifyPassword($this->password, $user->password)){
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
				$this->errorMessage = '密码错误,剩余尝试次数：'.($user->approved - 1);
                $user->approved -= 1;
                $user->update();
			}else{
				$this->errorCode = self::ERROR_NONE;
				$this->setPersistentStates(array_merge($user->getAttributes(),array(
					'last_login_time' => $user->last_login_time,
					'last_login_ip' => $user->last_login_ip,
					'sign_up_time' => $user->sign_up_time,
					'sign_up_ip' => $user->sign_up_ip,
				)));
				$this->afterLogin($user);
			}
		}
		return !$this->errorCode;
	}
	
	public function afterLogin($db){
		$db->attributes = array(
			'last_login_time' => time(),
			'last_login_ip' => Yii::app()->request->getUserHostAddress(),
            'approved' => 5
		);
		$db->update();
	}
}