<?php
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	function enroll_button($user, $course) {
		if(users_isEnrolled($user['id'], $course['id'])) {
			layoutH4('You are currently enrolled in this course');
			print '<form action="index.php?option=course&view=detail" method="POST">'.PHP_EOL;
			print '	<input name="drop" type="submit" value="Drop Course"/>          '.PHP_EOL;
			print '</form>                                                          '.PHP_EOL;
		} else {
			layoutH4('You are not enrolled in this course');
			print '<form action="index.php?option=course&view=detail" method="POST">'.PHP_EOL;
			print '	<input name="enroll" type="submit" value="Enroll"/>             '.PHP_EOL;
			print '</form>                                                          '.PHP_EOL;
		}
	}
	
	function courses_render($course) {
		
		layoutH3($course[1]);
		layoutH4("Course Number: 00".$course['id']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Credit hours: ".$course['credit_hours']);
		layoutP($course['description']);
		layoutP('Professor: '.$course[3].' '.$course[4]);
		
		if(isset($_SESSION['user'])) {
			enroll_button($_SESSION['user'], $course);
		}
	}

	function enroll_result($user, $course) {
		if(isset($_POST['enroll'])) {
			users_enroll($user['id'], $course['id']);
			layoutH4('ENROLLMENT SUCCESSFUL');
			
		} else if(isset($_POST['drop'])) {
			users_drop($user['id'], $course['id']);
			layoutH4('DROP SUCCESSFUL');
		}
	}
	
	function view($data) {
		layoutTitleStart($data['title']);
		layoutStyles('./content/css/layout.css');
		layoutTitleEnd();
		
		layoutH1($data['title']);
		layoutH3_sub($data['subtitle']);
		layoutH2_sub('Course Detail');
		
		if(isset($data['user'])) {
			enroll_result($data['user'], $data['course']);
		}
		courses_render($data['course']);
		
		br();
		br();
		
		layoutP_link('&lt;&lt;Home&gt;&gt;', 'index.php');
		layoutEnd();
	}
?>