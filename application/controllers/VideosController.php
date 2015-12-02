<?php

class VideosController extends Zend_Controller_Action
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
    }


}