<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	
	/*
	* LOGIN FORM
	*/	
	function login_form() {
	
		if (!isset($_SESSION['user'])) {
			print '<form action="index.php?option=default&view=login" method="POST">'.PHP_EOL;
			print '	<input name="username" type="text" placeholder="username"/>     '.PHP_EOL;
			print '	<input name="password" type="password" placeholder="password"/> '.PHP_EOL;
			print '	<input type="submit" value="Login"/>                            '.PHP_EOL;
			print '</form>                                                          '.PHP_EOL;
			
		} else {
			$role = "(Student)";
			
			if($_SESSION['user']['admin'] == true) {
				$role = "(Professor)";
			}
			layoutP('Welcome user: '.$_SESSION['user']['name'].' '.$_SESSION['user']['last_name'].' '.$role);
			print '<form action="index.php?option=default&view=logout" method="POST">'.PHP_EOL;
			print '	<input type="submit" value="Logout"/>                            '.PHP_EOL;
			print '</form>                                                           '.PHP_EOL;
		}
	}
	
	function view($data) {
		layoutTitleStart($data['title']);
		layoutStyles('./content/css/layout.css');
		layoutTitleEnd();
		
		layoutH1($data['title']);
		layoutH3_sub($data['subtitle']);
		layoutH2_sub('Home');
		
		login_form();
		
		if(isset($data['logged_user']) && $data['logged_user']['admin'] == true) {
			br();
			br();
			layoutH3_link('&lt;&lt;Customize Website&gt;&gt;', 'index.php?option=user&view=customize');
			br();
			br();
		}
		
		layoutH3_link('&lt;&lt;Courses List&gt;&gt;', 'index.php?option=course&view=list');
		layoutH3_link('&lt;&lt;Users List&gt;&gt;','index.php?option=user&view=list');
		
		layoutEnd();
	}

?>