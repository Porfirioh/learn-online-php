<?php
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	function courses_render($course) {
		layoutH3_link("00".$course['id']." - ".$course['name'], "index.php?option=course&view=detail&id=".$course['id']);
		layoutH4($course['description']);
	}

	function view($data) {
		layoutTitleStart($data['title']);
		layoutStyles('./content/css/layout.css');
		layoutTitleEnd();
		
		layoutH1($data['title']);
		layoutH3_sub($data['subtitle']);
		layoutH2_sub('Courses List');
		
		$all_courses = $data['courses'];
		if(!empty($all_courses)) {
			foreach($all_courses as $course) {
				courses_render($course);
			}
		}
		
		layoutEnd();
	}
	
?>