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

	//define('SALT', 'word');

	//
	//gets database parameters defined by the user
	//
	function get_db_parameters($pathHost, $pathUsername, $pathPassword, $pathDatabase) {
		$hostName = NULL;
		$userName = NULL;
		$passName = NULL;
		$databaseName = NULL;
		if(file_exists($pathHost) && file_exists($pathUsername) && file_exists($pathPassword) && file_exists($pathDatabase)) {
			$hostName = file_get_contents($pathHost);
			$userName = file_get_contents($pathUsername);
			$passName = file_get_contents($pathPassword);
			$databaseName = file_get_contents($pathDatabase);
		}
		
		return array($hostName, $userName, $passName, $databaseName);
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
	
	//
	//creates a new table
	//
	function create_table($connection, $table_name) {
		$query = 'CREATE TABLE '.$table_name;
		mysqli_query($connection, $query);
	}
	
?>