<?php
	require_once("../PhpLib/DataInfo_client_fns.php");
	
	function get_recipient_from_form($post) {
		$recipients = array();
		
		$recipients["id"] = isset($post["RecipientsId"]) ? intval($post["RecipientsId"]) : NULL;
		$recipients["name"] = isset($post["RecipientsName"]) ? $post["RecipientsName"] : NULL;
		$recipients["year"] = isset($post["RecipientsYear"]) ? $post["RecipientsYear"] : NULL;
		$recipients["giving"] = isset($post["RecipientsGiving"]) ? $post["RecipientsGiving"] : NULL;
		
		return $recipients;
	}
	
	function get_grant_from_form($get, $post) {
		$grant = array();
		
		$grant["id"] = isset($get["id"]) ? intval($get["id"]) : NULL;
		$grant["program"] = isset($post["GrantProgram"]) ? $post["GrantProgram"] : NULL;
		$grant["org_id"] = isset($post["OrgId"]) ? intval($post["OrgId"]) : NULL;
		$grant["org_name"] = isset($post["OrgName"]) ? $post["OrgName"] : NULL;
		$grant["frequency"] = isset($post["Frequency"]) ? $post["Frequency"] : NULL;
		$grant["app_guide"] = isset($post["AppGuide"]) ? $post["AppGuide"] : NULL;
		$grant["app_deadline"] = isset($post["AppDeadline"]) ? $post["AppDeadline"] : NULL;
		$grant["recipients"] = get_recipient_from_form($post);
		$grant["sample"] = isset($post["Sample"]) ? $post["Sample"] : NULL;
		$grant["datainfo"] = get_datainfo_from_form($post);
		
		return $grant;
	}
?>