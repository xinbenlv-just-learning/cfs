<?php
	require_once("../phpLib/Default.php");
	
	function get_datainfo_from_form($post) {
		$datainfo = array();
		
		$datainfo["id"] = isset($post["DataInfoId"]) ? $post["DataInfoId"] : NULL;
		$datainfo["language"] = isset($post["Language"]) ? $post["Language"] : NULL;
		$datainfo["collector"] = isset($post["Collector"]) ? FilterSelect($post["Collector"]) : NULL;
		$datainfo["reviewer"] = isset($post["Reviewer"]) ? FilterSelect($post["Reviewer"]) : NULL;
		$datainfo["status"] = isset($post["Status"]) ? FilterSelect($post["Status"]) : NULL;
		$datainfo["comments"] = isset($post["Comments"]) ? $post["Comments"] : NULL;
		
		return $datainfo;
	}
?>