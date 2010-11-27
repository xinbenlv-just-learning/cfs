<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Organization_client_fns.php");
	require_once("../PhpLib/ProcessOrganization_fns.php");
	
	ValidateUser();
	
	display_html_header("Process Organization Data", array("Default.css"));
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$org = get_org_from_form($_GET, $_POST);
		
		echo "<body>";
			display_user();
			display_index_link();
			process_organization($org, $action);
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer();
?>