<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/OrganizationForm_fns.php");
	
	ValidateUser();
	
	display_html_header("Input Organization Data",
		array("Default.css", "OrganizationForm.css")
	);
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$id = isset($_GET["id"]) ? $_GET["id"] : NULL;
		
		echo "<body>";
			display_user();
			display_index_link();
			display_org_form("ProcessOrganization.php", $action, $id);
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("Default.js", "OrganizationForm.js"));
?>