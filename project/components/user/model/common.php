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
	
	//
	//true if the given user exists in our database
	//
	function users_exists($id) {
		list($dbc,$error) = connect_to_database();
		
		if ($dbc) {
		
			$query = "SELECT * FROM users WHERE id = ".$id.";";
			$result = mysqli_query($dbc,$query);
			
			if ($result) {
				if(mysqli_num_rows($result) > 0) return true;
			}
		}
		return false;
	}
	
	//
	//gets all courses from a given user
	//
	function users_getCourseIds($user_id) {
		
		$courseIds = array();
		
		list($dbc, $error) = connect_to_database();

		if($dbc && users_exists($user_id)) {
			
			$query = "SELECT courses FROM users WHERE id = ".$user_id;
			$result = mysqli_query($dbc, $query);
			
			if($result) {
				$ids_array = mysqli_fetch_array($result);
				$courseIds = explode(",", $ids_array['courses']);
			}
			
		}
		
		return $courseIds;
	}
	
	//
	//returns an array of courses given its ids
	//
	function courses_getById($ids) {
		$courses = array();
		list($dbc, $error) = connect_to_database();
		
		if($dbc) {
			$id_string = implode(",", $ids);
			$query = "SELECT * FROM courses WHERE id IN (".$id_string.")";
			$result = mysqli_query($dbc, $query);
			
			if($result){
				while ($course = mysqli_fetch_array($result)) {
					$courses[] = $course;
				}
			}
		}
		
		return $courses;
	}
?>