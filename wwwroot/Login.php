<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/Login_fns.php");
	
	display_html_header("Login", array("Default.css", "Login.css"));
	
	try {
		StartSession();
		echo "<body>";
			echo "<img id='head' src='./img/CFS_Logo.jpg' />";
			display_login_form("ProcessLogin.php");
			
			$login_error_html = isset($_GET["error"]) ? "<p> ".$_GET["error"]." </p>" : NULL;
			echo $login_error_html;
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("Default.js", "Login.js"));
?>