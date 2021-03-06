<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/GrantForm_fns.php");
	
	ValidateUser();
	
	display_html_header("Input Grant Data",
		array("Default.css", "GrantForm.css")
	);
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$id = isset($_GET["id"]) ? $_GET["id"] : NULL;
		$org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : NULL;
		
		echo "<body>";
			display_user();
			display_index_link();
			display_grant_form("ProcessGrant.php", $action, $id, $org_id);
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("Default.js", "GrantForm.js"));
?>