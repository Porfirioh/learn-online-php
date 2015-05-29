<?php

	/*
	* Common file code
	*/
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	//
	//Creates a new file and puts data inside
	//
	//If the file exists, this method overwrites it
	//
	function newFile($path, $data = NULL) {
		if(isset($data)) {
			if(file_exists($path)) {
				file_put_contents($path, $data, LOCK_EX);
			} else {
				touch($path);
				file_put_contents($path, $data, LOCK_EX);				
			}
		} else {
			print "<p> NO DATA </p>";
		}
	}
?>