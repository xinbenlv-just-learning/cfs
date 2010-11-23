<?php
	function insert_datainfo_in_db($db, &$datainfo) {
		$query = "INSERT INTO datainfo VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		
		$stmt->bind_param("isssss",
			$null = NULL,
			$datainfo["language"],
			$datainfo["collector"],
			$datainfo["reviewer"],
			$datainfo["status"],
			$datainfo["comments"]
		);
		$stmt->execute();
		$stmt->close();
		
		return $datainfo["id"] = $db->insert_id;
	}
	
	function update_datainfo_in_db($db, $datainfo) {
		$query =	"UPDATE datainfo SET
						language = '$datainfo[language]',
						collector = '$datainfo[collector]',
						reviewer = '$datainfo[reviewer]',
						status = '$datainfo[status]',
						comments = '$datainfo[comments]'
					WHERE id = $datainfo[id]";
		$db->query($query);
	}
	
	function delete_datainfo_in_db($db, $datainfo) {
		$query = "DELETE FROM datainfo WHERE id = $datainfo[id]";
		$db->query($query);
	}
?>