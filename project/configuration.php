<?php

	/*
	* Configuration file
	*/
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	
	//
	//Database management
	//
	define('PATH_HOST', './content/database/host.txt');
	define('PATH_USER', './content/database/username.txt');
	define('PATH_PASSWORD', './content/database/password.txt');
	define('PATH_DATABASE', './content/database/database.txt');
	
	if(file_exists(PATH_HOST) && file_exists(PATH_USER) && file_exists(PATH_PASSWORD) && file_exists(PATH_DATABASE)) {
		define('DB_HOST', file_get_contents(PATH_HOST));
		define('DB_USER', file_get_contents(PATH_USER));
		define('DB_PASSWORD', file_get_contents(PATH_PASSWORD));
		define('DB_NAME', file_get_contents(PATH_DATABASE));
	}

	define('SALT', 'trololo');
	
	
	//
	//Website title and subtitle
	//
	define('PATH_TITLE', 'admin/settings/title.txt');
	define('PATH_SUBTITLE', 'admin/settings/subtitle.txt');
	
	if(file_exists(PATH_TITLE) && file_exists(PATH_SUBTITLE)) {
		$_SESSION['title'] = file_get_contents(PATH_TITLE);
		$_SESSION['subtitle'] = file_get_contents(PATH_SUBTITLE);
	}
	
?>