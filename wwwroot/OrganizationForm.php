<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/OrganizationForm_fns.php");
	
	display_html_header("Input Organization Data",
		array("Default.css", "OrganizationForm.css")
	);
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$id = isset($_GET["id"]) ? $_GET["id"] : NULL;
		
		display_org_form("ProcessOrganization.php", $action, $id);
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("jquery-1.4.3.min.js", "Default.js", "OrganizationForm.js"));
?>