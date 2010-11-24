<?php
	// this file contains php functions that
	// make translations between php variables and MySql variables
	// relating to organization
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Organization_server_fns.php");
	require_once("../PhpLib/DataInfo_server_fns.php");
	
	function get_grant_recipient_from_db($db, $recipients_id) {
		$query = "SELECT * FROM grant_recipients WHERE id = $recipients_id";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		
		$recipients = array();
		$recipients["id"] = intval($row["id"]);
		$recipients["name"] = GetOriginalString($row["name"]);
		$recipients["year"] = $row["year"];
		$recipients["giving"] = $row["total_giving"];
		
		return $recipients;
	}
	
	function get_grant_by_row($db, $row) {
		$grant = array();
		
		if ($row != NULL) {
			$grant["id"] = $row["id"];
			$grant["org_id"] = GetOriginalString($row["organization_id"]);
			$grant["org_name"] = get_org_name_from_db($db, $grant["org_id"]);
			$grant["program"] = GetOriginalString($row["grant_program"]);
			$grant["frequency"] = GetOriginalString($row["frequency_offer"]);
			$grant["app_guide"] = GetOriginalString($row["application_guide"]);
			$grant["app_deadline"] = GetOriginalString($row["application_deadline"]);
			$grant["recipients"] = get_grant_recipient_from_db($db, $row["grant_recipients_id"]);
			$grant["sample"] = GetOriginalString($row["sample_proposals"]);
			$grant["datainfo"] = get_datainfo_from_db($db, $row["datainfo_id"]);
		}
		
		return $grant;
	}
	
	function get_grant_from_db_new_connect($id) {
		$db = connect_db();
		$grant = get_grant_from_db($db, $id);
		$db->close();
		
		return $grant;
	}
	
	function get_grant_from_db($db, $id) {
		$query = "SELECT * FROM `grant` WHERE id = $id";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		
		return get_grant_by_row($db, $row);
	}
	
	function get_grants_from_db($org_id = NULL) {
		$db = connect_db();
		
		if ($org_id == NULL)
			$query = "SELECT * FROM `grant`";
		else
			$query = "SELECT * FROM `grant` WHERE organization_id = $org_id";
		$result = $db->query($query);
		
		$grants = array();
		if ($result != NULL) {
			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				$grants[$i] = get_grant_by_row($db, $row);
			}
		}
		
		$db->close();
		return $grants;
	}
?>