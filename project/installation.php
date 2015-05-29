<?php

	/*
	* Test file
	*/
	
	define('true-access',true);
	include_once('installation/layout/common.php');
	include_once('installation/layout/installation.php');
	include_once('installation/database/common.php');
	include_once('installation/database/installation.php');
	include_once('installation/file/common.php');
	
	if(file_exists('content/database/database.txt')) {
		die('INSTALLATION ALREADY COMPLETED. GO TO "index.php"');
	}

	ob_start(); //buffering
	session_start();
	layoutTitleStart('Installation');
	layoutStyles('./content/css/layout.css');
	layoutTitleEnd();
	
	layoutH1('INSTALLATION');
	
	if(isset($_POST["startInstallation"])) {
		
		if (empty($_POST["host"]) || empty($_POST["username"]) || empty($_POST["database"])) {
		
			layoutP('ONE OR MORE PARAMETERS ARE MISSING!');
			layoutH2('Complete this form to create a database');
			installationForm();	//display installation form on screen
			
		} else  if (db_exists($_POST["host"], $_POST["username"], $_POST["password"], $_POST["database"])){
		
			layoutP('A DATABASE CALLED "'.$_POST["database"].'" ALREADY EXISTS! CHOOSE ANOTHER NAME');
			layoutH2('Complete this form to create a database');	
			installationForm();	//display installation form on screen
			
		} else {
		
			//Store database parameters in files for later use
			$pathHost = "./content/database/host.txt";
			newFile($pathHost, $_POST["host"]);
			
			$pathUsername = "./content/database/username.txt";
			newFile($pathUsername, $_POST["username"]);
			
			$pathPassword = "./content/database/password.txt";
			newFile($pathPassword, $_POST["password"]);
			
			$pathDatabase = "./content/database/database.txt";
			newFile($pathDatabase, $_POST["database"]);
			
			include_once('configuration.php');
			
			//create database and main tables
			//define_db_parameters($pathHost, $pathUsername, $pathPassword, $pathDatabase);
			create_database();
			list($dbc, $error) = connect_to_database();
			create_users_table($dbc);
			create_courses_table($dbc);
			create_sample_rows($dbc);
			
			layoutP('DATABASE "'.$_POST["database"].'" CREATED SUCCESFULLY');
			br();
			br();
			layoutH3_link('&lt;&lt;Launch Application&gt;&gt;', 'index.php');
		}
		
	} else {
		layoutH2('Complete this form to create a database');
	
		installationForm();	//display installation form on screen
	}
	
	
	
	layoutEnd();

	ob_end_flush();	//buffering
?>