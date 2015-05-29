<?php

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	function customize_form() {
		print '<form action="index.php?option=user&view=customize" method="POST" enctype="multipart/form-data">'.PHP_EOL;
		print '	<br>Change Site Name: <input name="site_title" type="text" placeholder="Site Name"/><br>       '.PHP_EOL;
		print '	<br>Change Subtitle: <input name="site_subtitle" type="text" placeholder="Subtitle"/><br>      '.PHP_EOL;
		print '	<br><input name="customize" type="submit" value="Customize"/><br>                              '.PHP_EOL;
		print '</form>                                                                                         '.PHP_EOL;
	}
	
	function customize_result() {
		if(isset($_POST['customize'])) {
			if(empty($_POST['site_title']) && empty($_POST['site_subtitle'])) {
				layoutH4("NO CHANGES WERE MADE");
				
			} else if (!empty($_POST['site_title']) && empty($_POST['site_subtitle'])) { //store site title
				newFile(PATH_TITLE, $_POST['site_title']);
				layoutH4("SITE NAME CHANGED SUCCESFULLY");
				
			} else if (!empty($_POST['site_subtitle']) && empty($_POST['site_title'])) { //store site subtitle
				newFile(PATH_SUBTITLE, $_POST['site_subtitle']);
				layoutH4("SUBTITLE CHANGED SUCCESFULLY");
				
			} else { //store site title and subtitle
				newFile(PATH_TITLE, $_POST['site_title']);
				newFile(PATH_SUBTITLE, $_POST['site_subtitle']);
				layoutH4("SITE NAME AND SUBTITLE CHANGED SUCCESFULLY");
			}
		} else {
			//do nothing if the form was not submitted
		}
	}
	
	function view($data) {
		layoutTitleStart($data['title']);
		layoutStyles('./content/css/layout.css');
		layoutTitleEnd();
		
		layoutH1($data['title']);
		layoutH3_sub($data['subtitle']);
		layoutH2_sub('Customize Website');
		
		customize_result();
		layoutH3('Choose a new site name and subtitle here');
		customize_form();
		
		layoutP_link('&lt;&lt;Back&gt;&gt;', 'index.php');
		layoutEnd();
	}
?>