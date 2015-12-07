<?php

class DiscographieController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$this->view->discographie = 'current-menu-item';

    	$errmsg = "";
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'fatine');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
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

    }


}