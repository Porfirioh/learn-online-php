<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	//
	//true if the given course exists in our database
	//
	function courses_exists($id) {
		list($dbc,$error) = connect_to_database();
		
		if ($dbc) {
		
			$query = "SELECT * FROM courses WHERE id = ".$id.";";
			$result = mysqli_query($dbc,$query);
			
			if ($result) {
				if(mysqli_num_rows($result) > 0) return true;
			}
		}
		return false;
	}
	
	//
	//returns an array of courses given its ids
	//
	function courses_getById($ids) {
		$courses = array();
		list($dbc, $error) = connect_to_database();
		
		if($dbc) {
			$id_string = implode(",", $ids);
			$query = "SELECT courses.id, courses.name, courses.description, users.name, users.last_name, courses.credit_hours 
						FROM courses INNER JOIN users ON courses.professor=users.id 
						WHERE courses.id IN (".$id_string.")";
			$result = mysqli_query($dbc, $query);
			
			if($result){
				while ($course = mysqli_fetch_array($result)) {
					$courses[] = $course;
				}
			}
		}
		
		return $courses;
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
	//returns true if the given user is enrolled in the given course
	//
	function users_isEnrolled($user_id, $course_id) {
	
		$isEnrolled = false;
		
		if(users_exists($user_id) && courses_exists($course_id)) {
		
			$courseIds = users_getCourseIds($user_id);
			foreach($courseIds as $course) {
				if($course_id == intval($course)) {
					$isEnrolled = true;
				}
			}
		}
		
		return $isEnrolled;
	}
	
	//
	//enrolls a user in the given course
	//
	function users_enroll($user_id, $course_id) {
	
		if(users_isEnrolled($user_id, $course_id)) {
			return false;
		} else {
			
			list($dbc, $error) = connect_to_database();

			if($dbc && users_exists($user_id) && courses_exists($course_id)) {
			
				$courseIds = users_getCourseIds($user_id);
				array_push($courseIds, $course_id);
				asort($courseIds);
				
				$newCourses = implode(",", $courseIds);
				$query = 'UPDATE users SET courses = "'.$newCourses.'" WHERE id = '.$user_id.';';
				
				$result = mysqli_query($dbc, $query);
				if($result) {
					return true;
				} else {
					return false;
				}
			}
		}
	}
	
	//
	//makes a user drop from a given course
	//
	function users_drop($user_id, $course_id) {
	
		if(users_isEnrolled($user_id, $course_id)) {
		
			list($dbc, $error) = connect_to_database();

			if($dbc) {
			
				$courseIds = users_getCourseIds($user_id);
				foreach($courseIds as $key => $course) {
					if(isset($courseIds[$key]) && $courseIds[$key] == $course_id) {
						unset($courseIds[$key]);
						$courseIds = array_values($courseIds);
					}
				}
				
				$newCourses = implode(",", $courseIds);
				$query = 'UPDATE users SET courses = "'.$newCourses.'" WHERE id = '.$user_id.';';
				
				$result = mysqli_query($dbc, $query);
				if($result) {
					return true;
				} else {
					return false;
				}
			}
			
		} else {
			return false;			
		}
	}
	
?>