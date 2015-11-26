<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	session_start();

    	if(isset($_SESSION['1511c2t0l1s5']) &&  $_SESSION['1511c2t0l1s5'] == 1) {
			header("Location: admin");
		}       	
        
        if(isset($_POST['completed']) && $_POST['completed'] == 1) {
		
			//print_r($_POST);die();
			
			$user = "mehdi";
			$pass = "123456";
			
			if($_POST['user'] == $user && $_POST['pass'] == $pass) {
				$_SESSION['1511c2t0l1s5'] = 1;
				header("Location: admin");
			} else {
				$this->view->loginfailed = "Utilisateur ou mot de passe incorrect";
			}
		}


    }



}