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
        $mysqli = new mysqli('mediatuckafatine.mysql.db', 'mediatuckafatine', 'Fatine123', 'mediatuckafatine');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
		        }

		if (isset($_POST["completed"]) && $_POST["completed"] == 1) {

			switch ($_POST["type"]) {
				case 'music':
					$name = $_FILES['cover']['name'];
					$instr = fopen($_FILES['cover']['tmp_name'] ,"rb");
					$image = addslashes(fread($instr, filesize($_FILES['cover']['tmp_name'])));
				
					$mysqli->query('insert into music (cover, title, link) values ("' .$image. '", "' .$_POST['title']. '", "' .$_POST['soundcloud']. '")');
					break;
				case 'videos':
					$mysqli->query('insert into videos (link) values ("' .$_POST['youtube']. '")');
					break;
				case 'gallery':
					$name1 = $_FILES['img1']['name'];
					$instr1 = fopen($_FILES['img1']['tmp_name'] ,"rb");
					$image = addslashes(fread($instr1, filesize($_FILES['img1']['tmp_name'])));
					
					$name2 = $_FILES['img2']['name'];
					$instr2 = fopen($_FILES['img2']['tmp_name'] ,"rb");
					$thumb = addslashes(fread($instr2, filesize($_FILES['img2']['tmp_name'])));

					$mysqli->query('insert into gallery (img, thumbnail, cat) values ("' .$image. '", "' .$thumb. '", "' .$_POST['cat']. '")');
					break;
				case 'events':
					$name = $_FILES['img']['name'];
					$instr = fopen($_FILES['img']['tmp_name'] ,"rb");
					$image = addslashes(fread($instr, filesize($_FILES['img']['tmp_name'])));
					
					$mysqli->query('insert into events (img, title, description, date) values ("' .$image. '", "' .$_POST['title']. '", "' .$_POST['description']. '", "' .$_POST['date']. '")');
					break;
				default:
					# code...
					break;
			}

			
		}

		// MUSIC
		$result = $mysqli->query("select * from music order by id desc");
		$music = array();
		while ($row = $result->fetch_assoc()) {
			$id = $row['id'];
			$title       = htmlspecialchars($row['title']);
			$cover       = $row['cover'];
			$soundcloud  = htmlspecialchars($row['link']);

			$img = 'data:image/jpeg;base64,' .base64_encode($cover);
			
			$music[$id]['id']     = $id;
			$music[$id]['title']  = $title;
			$music[$id]['cover']  = $img;
			$music[$id]['link']   = $soundcloud;

		}
	
		$this->view->music = $music;

		// VIDEOS
		$result = $mysqli->query("select * from videos order by id desc");
		$videos = array();
		while ($row = $result->fetch_assoc()) {
			$id = $row['id'];
			$title       = htmlspecialchars($row['link']);

			$videos[$id]['id']     = $id;
			$videos[$id]['link']   = $title;

		}
	
		$this->view->videos = $videos;


		// GALLERY
		$result = $mysqli->query("select * from gallery order by id desc");
		$gallery = array();
		while ($row = $result->fetch_assoc()) {
			$id       = $row['id'];
			$img      = $row['img'];
			$cat      = htmlspecialchars($row['cat']);

			$img = 'data:image/jpeg;base64,' .base64_encode($img);
			
			$gallery[$id]['id']     = $id;
			$gallery[$id]['img']    = $img;
			$gallery[$id]['cat']    = $cat;

		}
	
		$this->view->gallery = $gallery;


		// EVENTS
		$result = $mysqli->query("select * from events order by id desc");
		$events = array();
		while ($row = $result->fetch_assoc()) {
			$id    = $row['id'];
			$title = htmlspecialchars($row['title']);
			$img   = $row['img'];
			$desc  = htmlspecialchars($row['description']);
			$date  = htmlspecialchars($row['date']);

			$img = 'data:image/jpeg;base64,' .base64_encode($img);
			
			$events[$id]['id']            = $id;
			$events[$id]['title']         = $title;
			$events[$id]['img']           = $img;
			$events[$id]['description']   = $desc;
			$events[$id]['date']          = $date;

		}
	
		$this->view->events = $events;

		
    }

    public function removeAction() {
       $errmsg = "";
       $mysqli = new mysqli('127.0.0.1', 'root', '', 'fatine');
		if (!$mysqli ) {
	        $errmsg = "Cannot connect to database";
	    }

	    $id  = $_POST['id'];
	    $type = $_POST['type'];

	    switch ($type) {
	    	case 'music':
	    		$mysqli->query("DELETE FROM music where id=" . $id);
	    		break;
	    	case 'videos':
	    		$mysqli->query("DELETE FROM videos where id=" . $id);
	    		break;
	    	case 'gallery':
	    		$mysqli->query("DELETE FROM gallery where id=" . $id);
	    		break;
	    	case 'events':
	    		$mysqli->query("DELETE FROM events where id=" . $id);
	    		break;
	    	default:
	    		
	    		break;
	    }
	    
    	die();
    }

    public function logoutAction() {
    	session_start();
    	unset($_SESSION['1511c2t0l1s5']);
      	header("Location: /projects/catalysisEvents/public/login"); 

      	die();
    }
}