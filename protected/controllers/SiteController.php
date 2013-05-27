<?php

class SiteController extends CController {
	/**
	 * Declares class-based actions.
	 */
	

	public function actions() {
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {	
		if ( isset(Yii::app()->user->username) ) {
			$this->render('calendar');
		} else {
			$this->render('auth');
		}
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];		

			$identity = new UserIdent($username, $password);

			if ( $identity->authenticate() ) {
				Yii::app()->user->login($identity, 3600*24*7);
				$this->redirect('/');
			} else {
				echo $identity->errorMessage;
				$this->redirect('/');
			}    		
		} else {
			$this->redirect('/');
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect('/');
	}

	/**
	 * Registr new user.
	 */
	public function actionRegistr() {
		if ( isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ) {
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$identity = new UserIdent($username, $password);			

			if ( $identity->registration($email) ) {
				Yii::app()->user->login($identity, 3600*24*7);
				$this->redirect('/');
			} else {
				echo $identity->errorMessage;
				$this->redirect('/');
			}    					
		} else {
			$this->redirect('/');
		}
	}


}