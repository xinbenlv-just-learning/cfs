<?php
	function insert_datainfo_in_db($db, &$datainfo) {
		$query = "INSERT INTO datainfo VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		
		$stmt->bind_param("isssss",
			$null = NULL,
			FilterString($datainfo["language"]),
			FilterString($datainfo["collector"]),
			FilterString($datainfo["reviewer"]),
			FilterString($datainfo["status"]),
			FilterString($datainfo["comments"])
		);
		$stmt->execute();
		$stmt->close();
		
		return $datainfo["id"] = $db->insert_id;
	}
	
	function update_datainfo_in_db($db, $datainfo) {
		$query =	sprintf("UPDATE datainfo SET
								language = '%s',
								collector = '%s',
								reviewer = '%s',
								status = '%s',
								comments = '%s'
							WHERE id = %d",
							FilterString($datainfo["language"]),
							FilterString($datainfo["collector"]),
							FilterString($datainfo["reviewer"]),
							FilterString($datainfo["status"]),
							FilterString($datainfo["comments"]),
							$datainfo["id"]
					);
		$db->query($query);
	}
	
	function delete_datainfo_in_db($db, $datainfo) {
		$query = "DELETE FROM datainfo WHERE id = $datainfo[id]";
		$db->query($query);
	}
?>