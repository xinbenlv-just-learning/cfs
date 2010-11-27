<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Login_fns.php");
	
	display_html_header("Login", array("Default.css", "Login.css"));
	
	try {
		StartSession();
		echo "<body>";
			echo "<img id='head' src='./Image/CFS_Logo.jpg' />";
			display_login_form("ProcessLogin.php");
			
			$login_error_html = isset($_GET["error"]) ? "<p> ".$_GET["error"]." </p>" : NULL;
			echo $login_error_html;
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("jquery-1.4.3.min.js", "Default.js", "Login.js"));
?>