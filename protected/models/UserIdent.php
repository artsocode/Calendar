<?php
//Class is responsible for the registration and authorization of a user
class UserIdent extends CUserIdentity {
	private $_id;	

	//authenticate - function that checks user `username` or `email` 
	//in database and returns true or false 
	public function authenticate() {

		$is_email = filter_var($this->username, FILTER_VALIDATE_EMAIL);
		if ($is_email === $this->username) { 
			$type = 'email';	
		} else { 
			$type = 'username'; 
		}

		if ($type == 'email') {
			$record = Users::model()->findByAttributes(array('email' => $this->username));
		} else {
			$record = Users::model()->findByAttributes(array('username' => $this->username));
		}
			
		if ( $record === null ) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} elseif ( $record->password !== crypt($this->password, $record->password) ) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $record->user_id;
			$this->setState('username', $record->username);
			$this->errorCode = self::ERROR_NONE;
		}
		
		return !$this->errorCode;
	}


	//registration - function checks user date in db 
	//If user does not exist registr one and return true
	//or throw exception.
	public function registration($email) {
		$record = Users::model()->findByAttributes(array('username' => $this->username));
		if ( $record === null ) {
			$addUser = new Users();		
			$addUser->username = $this->username;
			$addUser->email = $email;
			$password = crypt($this->password);
			$addUser->password = $password;
			$save_result = $addUser->save();
			if ($save_result) {
				$idInstalled = $this->setId();
				if ($idInstalled) {
					return true;
				}
			} else {
				return false;
			}
			
		} else {
			throw new Exception("Такой пользователь уже существует!", 1);			
		}
	} 

	//Set id to new users
	private function setId() {
		$record = Users::model()->findByAttributes(array('username' => $this->username));
		$this->_id = $record->user_id;			
		$this->setState('username', $this->username);
		$this->errorCode = self::ERROR_NONE;
		return true;
	}

	//Return user id
	public function getId() {
		return $this->_id;
	}		
}