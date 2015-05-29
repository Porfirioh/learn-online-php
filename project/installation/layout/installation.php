<?php

	/*
	* Layout elements for installation page
	*/
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	//
	//installation form displayed
	//
	function installationForm() {
		print '<form action="" method="POST">                                                     '.PHP_EOL;
		print '<br> Host: <input name="host" type="text" placeholder="Host"/><br>                 '.PHP_EOL;
		print '<br> Username: <input name="username" type="text" placeholder="Username"/><br>     '.PHP_EOL;
		print '<br> Password: <input name="password" type="password" placeholder="Password"/><br> '.PHP_EOL;
		print '<br> Database name: <input name="database" type="text" placeholder="Database"/><br>'.PHP_EOL;
		print '<input name="startInstallation" type="submit" value="Next"/>                       '.PHP_EOL;
		print '</form>																			  '.PHP_EOL;
	}
	
?>