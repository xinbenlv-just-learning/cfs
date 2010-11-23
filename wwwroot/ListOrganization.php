<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/ListOrganization_fns.php");
	
	display_html_header("Organization List",
		array("Default.css", "ListOrganization.css")
	);
	
	try {
		display_org_list_table();
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer();
?>