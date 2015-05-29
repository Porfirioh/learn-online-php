<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	include_once('model/common.php');
	include_once('model/list.php');
	include_once('model/detail.php');
	include_once('view/common.php');
	
	function get_view_enabled($view) {
	
		switch($view) {
			case 'list':
				return 'execute_list';
				break;
			case 'detail':
				return 'execute_detail';
				break;
			default:
				return false;
		}
	
	}
	
	function controller_route($view) {
	
		if($method = get_view_enabled($view)) {
			$method();
		} else {
			die('404 - View Not Found');
		}
	}
	
	function execute_list() {
		include_once('view/list.php');
		$data = array();
		$data['title'] = $_SESSION['title'];
		$data['subtitle'] = $_SESSION['subtitle'];
		$data['courses'] = courses_getAll();
		view($data);
	}
	
	function execute_detail() {
		include_once('view/detail.php');
		$data = array();
		$data['title'] = $_SESSION['title'];
		$data['subtitle'] = $_SESSION['subtitle'];
		$course = courses_getById(array($_SESSION['id']));
		$data['course'] = $course[0];
		
		if(isset($_SESSION['user'])) {
			$data['user'] = $_SESSION['user'];
		}
		
		view($data);
	}

?>