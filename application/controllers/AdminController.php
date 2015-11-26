<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

       	session_start();
	
		if(!isset($_SESSION['1511c2t0l1s5'])  ||  $_SESSION['1511c2t0l1s5'] != 1) {
			header("Location: login");
		} 

		$errmsg = "";
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'posts');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
		        }

		if (isset($_POST["completed"]) && $_POST["completed"] == 1) {
			$name = $_FILES['imagefile']['name'];
			//move_uploaded_file($name, $directory);
			$instr = fopen($_FILES['imagefile']['tmp_name'] ,"rb");
			$image = addslashes(fread($instr, filesize($_FILES['imagefile']['tmp_name'])));
		
			$mysqli->query('insert into pix (title, categ, description, imagedata) values ("' .$_POST['title']. '", "' .$_POST['cat']. '", "' .$_POST['desc']. '", "' .$image. '")');
		}


		$result = $mysqli->query("select * from pix order by pid desc");
		$references = array();
		while ($row = $result->fetch_assoc()) {
			$pid = $row['pid'];
			$title = htmlspecialchars($row['title']);
			$desc = htmlspecialchars($row['description']);
			$cat  = htmlspecialchars($row['categ']);
			$bytes = $row['imagedata'];
			$img = '<img width="200px" src="data:image/jpeg;base64,' .base64_encode($bytes). '" />';
			
			$references[$pid]['title'] = $title;
			$references[$pid]['desc']  = $desc;
			$references[$pid]['cat']   = $cat;
			$references[$pid]['img'] = 'data:image/jpeg;base64,' .base64_encode($bytes);

		}
	
		$this->view->refs = $references;
			
		

    }

    public function removeAction() {
       $errmsg = "";
       $mysqli = new mysqli('127.0.0.1', 'root', '', 'posts');
		if (!$mysqli ) {
	        $errmsg = "Cannot connect to database";
	    }

	    $pid = $_POST['pid'];

	    $mysqli->query('DELETE FROM pix where pid=' . $pid);


    	die();
    }

    public function logoutAction() {
     session_start();
     unset($_SESSION['1511c2t0l1s5']);
      header("Location: /projects/catalysisEvents/public/login"); 

      die();
    }
}