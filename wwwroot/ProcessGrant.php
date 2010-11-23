<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Grant_client_fns.php");
	require_once("../PhpLib/ProcessGrant_fns.php");
	
	display_html_header("Process Grant Data", array("Default.css"));
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$grant = get_grant_from_form($_GET, $_POST);
		
		process_grant($grant, $action);
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer();
?>