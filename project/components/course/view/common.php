<?php

	/*
	* Common layout elements that all our pages will have
	*/
	
	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	//
	// start of the page and title
	//
	function layoutTitleStart($title = NULL) {

		print '<!DOCTYPE html>       '.PHP_EOL;
		print '<html>                '.PHP_EOL;
		print '<head>                '.PHP_EOL;
		print '<meta charset="utf-8">'.PHP_EOL;
		
		if(isset($title)) {
			print '<title> '.$title.' </title>'.PHP_EOL;
		}
	}
	
	//
	// function to set the style of the page with a reference to a css file
	//
	function layoutStyles($stylesPath = NULL){
		if(isset($stylesPath)){
			print '<link rel="stylesheet" href="'.$stylesPath.'" type="text/css">  '.PHP_EOL;
		}
	}
	
	//
	// end of the title
	//
	function layoutTitleEnd(){	
		print '</head>                 '.PHP_EOL;
		print '<body>                  '.PHP_EOL;
	}
	
	
	//
	// main header shared by all the pages of our website
	//
	function layoutH1($header1 = NULL) {
		if(isset($header1)) {
			print '<h1> '.$header1.' </h1>'.PHP_EOL;
		}
	}


	//
	// second header that displays the name of the page
	//
	function layoutH2($header2 = NULL) {
		if(isset($header2)) {
			print '<h2> '.$header2.' </h2>'.PHP_EOL;
		}
	}
	
	function layoutH2_sub($header2 = NULL) {
		if(isset($header2)) {
			print '<h2 class="sub"> '.$header2.' </h2>'.PHP_EOL;
		}
	}
	
	function layoutH3($header3 = NULL) {
		if(isset($header3)) {
			print'<h3> '.$header3.' </h3>'.PHP_EOL;
		}
	}
	
	function layoutH3_sub($header3 = NULL) {
		if(isset($header3)) {
			print '<h3 class="sub"> '.$header3.' </h3>'.PHP_EOL;
		}
	}
	
	//
	//header with link [MODIFY]
	//
	function layoutH3_link($header3 = NULL, $link) {
		if(isset($header3)) {
			print '<h3><a href="'.$link.'"> '.$header3.' </a></h3>'.PHP_EOL;
		}
	}
	
	function layoutH4($header4 = NULL) {
		if(isset($header4)) {
			print'<h4> '.$header4.' </h4>'.PHP_EOL;
		}
	}
	
	//
	//header with link [MODIFY]
	//
	function layoutH4_link($header4 = NULL, $link) {
		if(isset($header4)) {
			print '<h4><a href="'.$link.'"> '.$header4.' </a></h4>'.PHP_EOL;
		}
	}
	
	//
	//paragraph
	//
	function layoutP($content = NULL) {
		if(isset($content)) {
			print '<p>'.$content.'</p>'.PHP_EOL;
		}
	}
	
	//
	//paragraph with link [MODIFY]
	//
	function layoutP_link($content = NULL, $link) {
		if(isset($content)) {
			print '<p><a href="'.$link.'"> '.$content.' </a></p>'.PHP_EOL;
		}
	}
	
	//
	//line break
	//
	function br() {
		print '<br>'.PHP_EOL;
	}
	
	//
	//End of the web page
	//
	function layoutEnd() {
		print "</body>                 ".PHP_EOL;
		print "</html>                 ".PHP_EOL;
	}
	
	
	/*
	* LOGIN FORM
	*/
	
	function users_loggedIn() {
		return (isset($_SESSION['user']));
	}
	
	function login_form() {
		if (!users_loggedIn()) {
			print '<form action="index.php?option=course&view=login" method="POST">'.PHP_EOL;
			print '	<input name="username" type="text" placeholder="username"/>    '.PHP_EOL;
			print '	<input name="password" type="password" placeholder="password"/>'.PHP_EOL;
			print '	<input type="submit" value="Login"/>                           '.PHP_EOL;
			print '</form>                                                         '.PHP_EOL;
		} else {
			layoutP("Welcome user!");
			print '<form action="index.php?option=store&view=logout" method="post">'.PHP_EOL;
			print '	<input type="submit" value="Logout"/>                          '.PHP_EOL;
			print '</form>                                                         '.PHP_EOL;
		}
	}

?>