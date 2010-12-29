<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/ListOrganization_fns.php");
	
	ValidateUser();
	
	display_html_header("Organization List",
		array("Default.css", "ListOrganization.css")
	);
	
	try {
		echo "<body>";
			display_user();
			display_index_link();
			display_org_list_table();
		echo "</body>";
	}
	catch (Exception $ex) {
		echo $ex->getMessage();
	}
	
	display_html_footer(array("jquery-1.4.3.min.js", "ListOrganization.js"));
?>