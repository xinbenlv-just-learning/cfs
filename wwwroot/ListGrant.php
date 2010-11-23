<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/ListGrant_fns.php");
	
	display_html_header("Grant List",
		array("Default.css", "ListGrant.css"));
	
	try {
		$org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : NULL;
		
		display_grants_table($org_id);
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer();
?>