<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/GrantForm_fns.php");
	
	display_html_header("Input Grant Data",
		array("Default.css", "GrantForm.css")
	);
	
	try {
		$action = isset($_GET["action"]) ? $_GET["action"] : "add";
		$id = isset($_GET["id"]) ? $_GET["id"] : NULL;
		$org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : NULL;
		
		display_grant_form("ProcessGrant.php", $action, $id, $org_id);
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("jquery-1.4.3.min.js", "Default.js", "GrantForm.js"));
?>