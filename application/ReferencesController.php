<?php

class ReferencesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->references = 'current-menu-item';

        $errmsg = "";
       	$mysqli = new mysqli('127.0.0.1', 'root', '', 'posts');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
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
			
			$references[$pid]['pid'] = $pid;
			$references[$pid]['title'] = $title;
			$references[$pid]['desc']  = $desc;
			$references[$pid]['cat']   = $cat;
			$references[$pid]['img'] = 'data:image/jpeg;base64,' .base64_encode($bytes);
    	}

    	$this->view->refs = $references;
	}

	public function detailAction()
	{
		$id = $this->getRequest()->getParam("id");

		$errmsg = "";
       	$mysqli = new mysqli('127.0.0.1', 'root', '', 'posts');
		if (!$mysqli ) {
		        $errmsg = "Cannot connect to database";
		        }
		$result = $mysqli->query("select * from pix where pid=" . $id . " limit 1");
		$reference = array();
		$row = $result->fetch_assoc();
		$pid = $row['pid'];
		$title = htmlspecialchars($row['title']);
		$desc = htmlspecialchars($row['description']);
		$cat  = htmlspecialchars($row['categ']);
		$bytes = $row['imagedata'];
		$img = '<img width="200px" src="data:image/jpeg;base64,' .base64_encode($bytes). '" />';
		
		$reference['title'] = $title;
		$reference['desc']  = $desc;
		$reference['cat']   = $cat;
		$reference['img'] = 'data:image/jpeg;base64,' .base64_encode($bytes);

    	$this->view->ref = $reference;



	}

}