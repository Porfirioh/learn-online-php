<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	include_once('model/common.php');
	include_once('view/common.php');
	
	function get_view_enabled($view) {
	
		switch($view) {
			case 'default':
				return 'execute_default';
				break;
			case 'login':
				return 'execute_login';
				break;
			case 'logout':
				return 'execute_logout';
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
	
	function execute_default() {
	
		include_once('view/default.php');
		
		$data = array();
		if(isset($_SESSION['user'])) {
			$data['logged_user'] = $_SESSION['user'];
		}
		$data['title'] = $_SESSION['title'];
		$data['subtitle'] = $_SESSION['subtitle'];
		view($data);
	}
	
	function execute_login() {
		$username;
		$password;
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
		}
		
		users_checkLogin($username, $password);
		execute_default();		
	}
	
	function execute_logout() {
		unset($_SESSION['user']);
		execute_default();
	}

?>