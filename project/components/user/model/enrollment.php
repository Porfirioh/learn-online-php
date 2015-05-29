<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	//
	//returns an array of users given its ids
	//
	function users_getById($ids) {
		$users = array();
		list($dbc, $error) = connect_to_database();
		
		if($dbc) {
			$id_string = implode(",", $ids);
			$query = "SELECT * FROM users WHERE id IN (".$id_string.")";
			$result = mysqli_query($dbc, $query);
			
			if($result){
				while ($user = mysqli_fetch_array($result)) {
					$users[] = $user;
				}
			}
		}
		
		return $users;
	}

?>