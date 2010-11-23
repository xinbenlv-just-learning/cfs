<?php
	require_once("../PhpLib/Default.php");
	
	function get_datainfo_from_db($db, $id) {
		$query = "select * from datainfo where id = $id";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		
		$datainfo = array();
		$datainfo["id"] = intval($row["id"]);
		$datainfo["language"] = GetOriginalString($row["language"]);
		$datainfo["collector"] = GetOriginalString($row["collector"]);
		$datainfo["reviewer"] = GetOriginalString($row["reviewer"]);
		$datainfo["status"] = GetOriginalString($row["status"]);
		$datainfo["comments"] = GetOriginalString($row["comments"]);
		
		return $datainfo;
	}
?>