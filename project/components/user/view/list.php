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
		
		layoutH3_link($user['name']." ".$user['last_name']." ".$role, "index.php?option=user&view=enrollment&id=".$user['id']);
		layoutH4("Email: ".$user['email']);
	}

	function view($data) {
		layoutTitleStart($data['title']);
		layoutStyles('./content/css/layout.css');
		layoutTitleEnd();
		
		layoutH1($data['title']);
		layoutH3_sub($data['subtitle']);
		layoutH2_sub('Users List');
		
		$all_users = $data['users'];
		if(!empty($all_users)) {
			foreach($all_users as $user) {
				users_render($user);
			}
		}
		
		layoutEnd();
	}
	

?>