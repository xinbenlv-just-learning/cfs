<?php
	require_once("../PhpLib/Default.php");
	
	function get_datainfo_from_form($post) {
		$datainfo = array();
		
		$datainfo["id"] = isset($post["DataInfoId"]) ? $post["DataInfoId"] : NULL;
		$datainfo["language"] = isset($post["Language"]) ? GetString($post["Language"]) : NULL;
		$datainfo["collector"] = isset($post["Collector"]) ? GetSelect($post["Collector"]) : NULL;
		$datainfo["reviewer"] = isset($post["Reviewer"]) ? GetSelect($post["Reviewer"]) : NULL;
		$datainfo["status"] = isset($post["Status"]) ? GetSelect($post["Status"]) : NULL;
		$datainfo["comments"] = isset($post["Comments"]) ? GetString($post["Comments"]) : NULL;
		
		return $datainfo;
	}
?>