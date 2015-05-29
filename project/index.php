<?php

	define('true-access', true);
	
	session_start();
	
	include_once('configuration.php');
	
	ob_start();
	
	//
	//If database hasn't been created
	//we redirect the user to the installation page
	//
	if(!file_exists(PATH_DATABASE)) {
		header('Location: installation.php');
	}
	
	function get_option_enabled($option) {
		switch($option) {
			case 'default':
				return 'default/controller.php';
				break;
			case 'course':
				return 'course/controller.php';
				break;
			case 'user':
				return 'user/controller.php';
				break;
			default:
				return false;
		}
	}
	
	function route() {
		
		$option = 'default';	//default option
		$view = 'default';		//default view
		
		if(!empty($_GET['option'])) {
			$option = $_GET['option'];
		}
		
		if(!empty($_GET['view'])) {
			$view = $_GET['view'];
		}
		
		if(!empty($_GET['id'])) {
			$_SESSION['id'] = $_GET['id'];
		}
		
		if($controller = get_option_enabled($option)) {
			include_once('components/'.$controller);
			controller_route($view);
		} else {
			die('404 - Controller Not Found');
		}
	}
	
	route();
	
	ob_end_flush();

?>