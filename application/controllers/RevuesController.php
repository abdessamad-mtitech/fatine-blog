<?php

class RevuesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$errmsg = "";
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'fatine');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
		        }

    	// GALLERY
		$result = $mysqli->query("select * from gallery where cat='Revues de presse' order by id desc");
		$gallery = array();
		while ($row = $result->fetch_assoc()) {
			$id       = $row['id'];
			$thumb    = $row['thumbnail'];
			$img      = $row['img'];
			$cat      = htmlspecialchars($row['cat']);

			$img   = 'data:image/jpeg;base64,' .base64_encode($img);
			$thumb = 'data:image/jpeg;base64,' .base64_encode($thumb);
			
			$gallery[$id]['id']     = $id;
			$gallery[$id]['thumb']  = $thumb;
			$gallery[$id]['img']    = $img;
			$gallery[$id]['cat']    = $cat;

		}
	
		$this->view->gallery = $gallery;
        
    }


}