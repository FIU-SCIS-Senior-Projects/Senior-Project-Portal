<?php
require ('PasswordHash.php');
require_once 'vendor/autoload.php';
use OAuth_io\OAuth;
class SiteController extends Controller
{
         // Holds array of Google user data recieved after authentication
        private $result = array();
        // Google authentication status
        private $accAuthenticated = false;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
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
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
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
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
                        $email = $model->username;
                        $password = $model->password;
                        
                        $hasher = new PasswordHash();
                        
                        // Check if user exists with same email
                        $existingUser = User::model()->findByAttributes(array('email' => $email));
                        // If user found is an admin, check their password and log them in if correct
                        // password was provided. If user found is a default (FIU) user, log them in and
                        // authenticate them with Google. If no user is found, create a new account and
                        // authenticate them with Google.
                        if($existingUser != null && $existingUser->isAAdmin())
                        {
                            $identity = new UserIdentity($email, $password);
                            if(!$hasher->verifyPassword($existingUser->password, $password)) {
                                $identity->errorCode=UserIdentity::ERROR_PASSWORD_INVALID;
                            }
                            else {
                                $duration=$model->rememberMe ? 3600*24*30 : 0; // 30 days
                                Yii::app()->user->login($identity, $duration);
                                $this->redirect('/SeniorPortal/index.php/admin/admin');
                            }
                        } 
                        else if($existingUser != null && $existingUser->isADefaultUser())
                        { 
                            $existingUser->password = $hasher->encode($password);
                            $existingUser->save(false);
                            $duration=$model->rememberMe ? 3600*24*30 : 0; // 30 days
                            $identity = new UserIdentity($email, $password);
                            Yii::app()->user->login($identity, $duration);
                            $this->actionGoogleAuth();
                        }
                        else 
                        {                                   
                            $user = new User();   
                            $user->email = $email;
                            $user->usertype = 'default';
                            $user->password = $hasher->encode($password);
                            $user->save(false);
                            $duration=$model->rememberMe ? 3600*24*30 : 0; // 30 days
                            $identity = new UserIdentity($email, $password); 
                            Yii::app()->user->login($identity, $duration);   
                            $this->actionGoogleAuth();
                        }
                        if($model->validate()) // If no errors, redirect to index
                            $this->redirect('/SeniorPortal/index.php');
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        /*
         * Authenticates user with Google
         */
        public function actionGoogleAuth() {
        // Edit by Christopher Jones. Refer to the Google Developers Console
        // site https://console.developers.google.com/project. OAuth Daemon
        // handles all Google API work and can be accessed through http://vjf-dev.cis.fiu.edu:6284/login
        // Credentials for both accounts are provided in JobFair/useful accounts.txt
 
        // OAuth Daemon Control Flow
        // Begin authentication
        
        if(!$this->accAuthenticated)
        {
            $this->authAcc();
            return;
        }
        else if($this->accAuthenticated && empty($this->result))
        {
            // Error ocurred, no data was received
            $this->redirect('/SeniorPortal/index.php');
        }
        else if(!empty($this->result))
        {
            // Data received
            $user = $this->result;
            $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
        }
        else
        {
            // Something went wrong...
            $this->redirect('/SeniorPortal/index.php');
        }
        
        // After data is recieved, ensure that Google account email matches the email
        // provided on login form. If not, log the user out. If the user account is not currently
        // marked as "activated" then change this value in the database.
        if(Yii::app()->user->isGuest)
        {
            $this->redirect('/SeniorPortal/index.php/site/login');
        }
        else if(Yii::app()->user->name != $email)
        {
            $this->actionLogout();
        }
        else if(Yii::app()->user->name == $email && User::model()->getCurrentUser()->activated == null)
        {
            $currentUser = User::model()->findByAttributes(array('email' => Yii::app()->user->name));
            $currentUser->activated = 1;
            $currentUser->save(false);
        }
        
        $this->redirect('/SeniorPortal/index.php');
    }
    
    // Create oauth object, redirect user to Google for authentication,
    // redirect to API endpoint
    private function authAcc()
    {
        $oauth = new OAuth(null, false);
        $oauth->setOAuthdUrl('http://vjf-dev.cis.fiu.edu:6284', $base='/auth');
        $oauth->initialize('8boH6TCiWWz3GAUDAN6jXtZ1Hg4', '1VWCLveBtnwmIqhM_SJZvjxmjDs');
        $oauth->redirect('fiu', '/SeniorPortal/index.php/Site/GetResult');
    }

    // Handle request object if it exists and retrieve data,
    // attempt to register user's Google account
    public function actionGetResult()
    {
        $oauth = new OAuth(null, false);
        $oauth->setOAuthdUrl('http://vjf-dev.cis.fiu.edu:6284', $base='/auth');
        $oauth->initialize('8boH6TCiWWz3GAUDAN6jXtZ1Hg4', '1VWCLveBtnwmIqhM_SJZvjxmjDs');

        $google_requester = $oauth->auth('fiu', array(
           'redirect' => true
        ));
        $this->accAuthenticated = true;
        $google_result = $google_requester->me();
        $this->result = $google_result;
        
        $this->actionGoogleAuth();
    }
    
        
    /*
     * Displays the home page. Supplies model instance necessary for displaying
     * Senior Project sites from database.
     */    
    public function actionHome()
    {
        $model = new PortalSites('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PortalSites']))
            $model->attributes = $_GET['PortalSites'];

        $this->render('home', array('model' => $model));
    }
     
}