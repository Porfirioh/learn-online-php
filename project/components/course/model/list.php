<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	//
	//returns an array with all courses from our database
	//
	function courses_getAll() {
		
		$courses = array();
		list($dbc,$error) = connect_to_database();
		
		if ($dbc) {
		
			$query = "SELECT courses.id, name, description, credit_hours FROM COURSES;";
			$result = mysqli_query($dbc,$query);
			
			if ($result) {
				while ($course = mysqli_fetch_array($result)) {
					$courses[] = $course;
				}
			}
		}
		return $courses;
	}

?>