<?php

	/*
	* database functions for installation page
	*/
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	//
	//creates the courses table
	//
	function create_courses_table($connection) {
		$query = "CREATE TABLE IF NOT EXISTS courses (
		  id int(11) NOT NULL,
		  name varchar(100) NOT NULL,
		  description varchar(300) NOT NULL,
		  professor int(11) NOT NULL,
		  credit_hours int(11) NOT NULL,
		  PRIMARY KEY (id)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		if($connection) {
			mysqli_query($connection, $query);
		}
	}
	
	//
	//creates the users table
	//
	function create_users_table($connection) {
		$query = "CREATE TABLE IF NOT EXISTS users (
		  id int(11) NOT NULL,
		  username varchar(60) NOT NULL,
		  password varchar(60) NOT NULL,
		  name varchar(60) NOT NULL,
		  last_name varchar(60) NOT NULL,
		  admin tinyint(1) NOT NULL,
		  email varchar(100) NOT NULL,
		  courses varchar(60) NOT NULL,
		  PRIMARY KEY (id)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		if($connection) {
			mysqli_query($connection, $query);
		}		
	}
	
	//
	//creates sample rows in our database in order to
	//make the process more comfortable to the user
	//
	function create_sample_rows($connection) {
	
		$passwords = array('password1', 'password2', 'password3', 'password4', 'password5', 'password6', 'password7', 'password8');
		$safe_passwords = array();
		
		foreach($passwords as $key => $pw) {
			$safe_passwords[$key] = sha1($passwords[$key].SALT);
		}
	
		$query_courses = "INSERT INTO courses (id, name, description, professor, credit_hours) VALUES
			(1, 'Web Site App Development', 'Advanced development of web applicatons using different programming languages, for example PHP, HTML, SQL and Grails.', 1, 3),
			(2, 'Intelligent Device Applications', 'Design of different applications for smart devices (smartphones, tablets), using Android OS. Basic Java knowledge is required.', 7, 4),
			(3, 'Embedded Systems', 'Design of (from both HW and SW points of view) of embedded systems. Basic knowledge about microprocessors, electronics and C programming language is recomended.', 6, 3),
			(4, 'Rich Internet Applications', 'Advanced development of web applications from the client point of view. HTML and javascript will be used througout the course.', 1, 3),
			(5, 'Wireless Technology and Applications', 'This course will provide students with the knowledge of wireless communication technologies. The course will focus on the 3G and 4G wireless networks such as UMTS, LTE, and WiMAX.', 7, 2),
			(6, 'Windows Applications', 'Development of both Windows 8.1 and Windows Phone applications, using C# and XAML.', 4, 3);";
		
		$query_users = "INSERT INTO users (id, username, password, name, last_name, admin, email, courses) VALUES
			(1, 'jlamber4', '".$safe_passwords[0]."', 'Jason', 'Lambert', 1, 'jlamber4@hawk.iit.edu', '1,4'),
			(2, 'jmorenov', '".$safe_passwords[1]."', 'Javier', 'Moreno Valdecantos', 0, 'jmorenov@hawk.iit.edu', '1,2,3'),
			(3, 'beafus', '".$safe_passwords[2]."', 'Beatriz', 'Fuster González', 0, 'beafus@hawk.iit.edu', '1,3,5'),
			(4, 'mschray', '".$safe_passwords[3]."', 'Martin', 'Schray', 1, 'mschray@hotmail.com', '6'),
			(5, 'smatchesw', '".$safe_passwords[4]."', 'Safder', 'Matcheswala', 0, 'smatchesw@hawk.iit.edu', '2,4,5'),
			(6, 'jhajek', '".$safe_passwords[5]."', 'Jeremy', 'Hajek', 1, 'jhajek@hawk.iit.edu', '3'),
			(7, 'phuang', '".$safe_passwords[6]."', 'Peisong', 'Huang', 1 , 'phuang@hawk.iit.edu', '2,5'),
			(8, 'pmontojo', '".$safe_passwords[7]."', 'Paula', 'Montojo Torrente', 0, 'pmontojo@gmail.com', '5,6');";
		
		if($connection) {
			mysqli_query($connection, $query_courses);
			mysqli_query($connection, $query_users);
		}
	}
?>