<?php

class EventController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->event = 'current-menu-item';

        $errmsg = "";
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'fatine');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
		        }

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

}