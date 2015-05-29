<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	function users_render($user) {
		$role = "(Student)";
		
		if($user['admin'] == true) {
			$role = "(Professor)";
		}
		
		layoutH3("User: ".$user['name']." ".$user['last_name']." ".$role);
		layoutP("Email: ".$user['email']);
	}
	
	function courses_render($course) {
		layoutH4_link("00".$course['id']." - ".$course['name'], "index.php?option=course&view=detail&id=".$course['id']);
		layoutP($course['description']);
	}

	function view($data) {
		layoutTitleStart($data['title']);
		layoutStyles('./content/css/layout.css');
		layoutTitleEnd();
		
		layoutH1($data['title']);
		layoutH3_sub($data['subtitle']);
		layoutH2_sub('Enrolled Courses');
		users_render($data['user']);
		
		layoutH3("Courses enrolled: ");
		$all_courses = $data['courses'];
		if(!empty($all_courses)) {
			foreach($all_courses as $course) {
				courses_render($course);
			}
		}
		
		br();
		br();
		
		layoutP_link('&lt;&lt;Home&gt;&gt;', 'index.php');
		
		layoutEnd();
	}

?>