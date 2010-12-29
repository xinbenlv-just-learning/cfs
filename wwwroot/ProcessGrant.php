<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/Grant_client_fns.php");
	require_once("../phpLib/ProcessGrant_fns.php");
	
	ValidateUser();
	
	display_html_header("Process Grant Data", array("Default.css"));
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$grant = get_grant_from_form($_GET, $_POST);
		
		echo "<body>";
			display_user();
			display_index_link();
			process_grant($grant, $action);
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer();
?>