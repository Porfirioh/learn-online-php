<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	include_once('model/common.php');
	include_once('model/list.php');
	include_once('model/enrollment.php');
	include_once('model/customize.php');
	include_once('view/common.php');
	
	function get_view_enabled($view) {
	
		switch($view) {
			case 'list':
				return 'execute_list';
				break;
			case 'enrollment':
				return 'execute_enrollment';
				break;
			case 'customize':
				return 'execute_customize';
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
		$data['users'] = users_getAll();
		view($data);
	}
	
	function execute_enrollment() {
		include_once('view/enrollment.php');
		$data = array();
		$data['title'] = $_SESSION['title'];
		$data['subtitle'] = $_SESSION['subtitle'];
		$user = users_getById(array($_SESSION['id']));
		$data['courses'] = courses_getById(users_getCourseIds($user[0]['id']));
		$data['user'] = $user[0];
		view($data);
	}
	
	function execute_customize() {
	
		//
		//To prevent access of non-admins or unregistered users
		//
		if(!isset($_SESSION['user'])) {
			die('ERROR - NO USER LOGGED IN');
		} else if($_SESSION['user']['admin'] == false) {
			die('ACCESS DENIED FOR NON-ADMINS');
		}
		
		include_once('view/customize.php');
		$data = array();
		
		if(isset($_POST['customize'])) {
		
			if(!empty($_POST['site_title']) && !empty($_POST['site_subtitle'])) {
				$data['title'] = $_POST['site_title'];
				$data['subtitle'] = $_POST['site_subtitle'];
				
			} else if (!empty($_POST['site_title'])){
				$data['title'] = $_POST['site_title'];
				$data['subtitle'] = $_SESSION['subtitle'];
			
			} else if(!empty($_POST['site_subtitle'])) {
				$data['title'] = $_SESSION['title'];
				$data['subtitle'] = $_POST['site_subtitle'];
				
			} else {
				$data['title'] = $_SESSION['title'];
				$data['subtitle'] = $_SESSION['subtitle'];
			}
			
		} else {
			$data['title'] = $_SESSION['title'];
			$data['subtitle'] = $_SESSION['subtitle'];
		}
		
		view($data);
	}

?>