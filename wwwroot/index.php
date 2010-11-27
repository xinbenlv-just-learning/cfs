<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/index_fns.php");
	
	ValidateUser();
	
	display_html_header("Main Page", array("Default.css", "Index.css"));
	echo "<body>";
		display_user();
		display_index_list();
	echo "</body>";
	display_html_footer();
?>