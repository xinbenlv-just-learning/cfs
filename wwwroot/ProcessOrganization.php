<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Organization_client_fns.php");
	require_once("../PhpLib/ProcessOrganization_fns.php");
	
	display_html_header("Process Organization Data", array("Default.css"));
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$org = get_org_from_form($_GET, $_POST);
		
		process_organization($org, $action);
	}
	catch (Exception $ex) {
	}
	
	display_html_footer();
?>