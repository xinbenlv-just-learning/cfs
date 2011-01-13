<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/ListGrant_fns.php");
	
	ValidateUser();
	
	display_html_header("Grant List",
		array("Default.css", "ListGrant.css"));
	
	try {
		$org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : NULL;
		
		echo "<body>";
			display_user();
			display_index_link();
			display_grants_table($org_id);
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("ListGrant.js"));
?>