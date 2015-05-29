<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	//
	//gets all users in our table
	//
	function users_getAll() {
		
		$users = array();
		list($dbc,$error) = connect_to_database();
		
		if ($dbc) {
		
			$query = "SELECT * FROM USERS;";
			$result = mysqli_query($dbc,$query);
			
			if ($result) {
			
				while ($user = mysqli_fetch_array($result)) {
					$users[] = $user;
				}
			}
		}
		return $users;
	}

?>