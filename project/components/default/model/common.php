<?php

	/*
	* Common database code
	*/
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	//
	//creates a new database
	//
	function create_database() {
	
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
		
		if($connection) {
			mysqli_query($connection, 'CREATE DATABASE IF NOT EXISTS '.DB_NAME);
		} else {
			print_r(mysqli_connect_error());
		}
	}
	
	//
	//checks if a given database exists
	//
	function db_exists($host, $username, $password, $database) {
	
		$connection = mysqli_connect($host, $username, $password);
		
		if(mysqli_select_db($connection, $database)) {
			return true;	//database exists
		} else {
			return false;	//database doesn't exist
		}
		
	}
	
	//
	//connects to an existing database
	//
	function connect_to_database() {
		
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$error = "";
		
		if($dbc) {
			mysqli_set_charset($dbc, 'utf8');
		} else {
			$error = mysqli_connect_error();
		}
		
		return array($dbc, $error);
		
	}
	
	/*
	* LOGIN
	*/
	function users_checkLogin($username, $password) {
		list($dbc,$error) = connect_to_database();
		$success = false;
		if ($dbc) {
			$username_safe = mysqli_real_escape_string($dbc,$username);
			$password_safe = mysqli_real_escape_string($dbc,sha1($password.SALT));
		
			$query = "SELECT * FROM users WHERE username='$username_safe' AND password='$password_safe'";	
			$result = mysqli_query($dbc,$query);
			
			if ($result) {
				
				while($user = mysqli_fetch_array($result,MYSQLI_BOTH)) {
					$_SESSION['user'] = $user;
					$success = true;
				}
				
			} else {
				layoutP("WRONG USERNAME OR PASSWORD");
			}
		}
		return $success;
	}
?>