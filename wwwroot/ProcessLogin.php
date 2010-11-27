<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/ProcessLogin_fns.php");
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "login";
		
		switch ($action) {
			case "login":
			default:
				$username = isset($_POST["username"]) ? $_POST["username"] : NULL;
				$password = isset($_POST["password"]) ? $_POST["password"] : NULL;
				
				if (Login($username, $password)) {
					// login successfully
					RedirectHtml("Login Successfully!", NULL, "index.php");
				} else {
					// failed to login
					StartSession();
					session_write_close();
					
					RedirectHtml("Failed to Login!", "Wrong Username or Password!", "Login.php");
				}
				break;
			
			case "logout":
				if (Logout())
					RedirectHtml("Logout Successfully!", NULL, "Login.php");
				else
					RedirectHtml("Failed to Logout!", "Login First!", "Login.php");
		}
		
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
?>