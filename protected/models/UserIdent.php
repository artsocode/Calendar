<?php
//Class is responsible for the registration and authorization of a user
class UserIdent extends CUserIdentity {
	private $_id;	

	//authenticate - function that checks user `username` or `email` 
	//in database and returns true or false 
	public function authenticate() {
		if ($type == 'email') {
			$record = Users::model()->findByAttributes(array('email' => $this->email));
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
			$addUser->save();
			$this->setState('username', $this->username);
			$this->errorCode = self::ERROR_NONE;
			return true;
		} else {
			throw new Exception("Такой пользователь уже существует!", 1);			
		}
	} 

	public function getId() {
		return $this->_id;
	}
}