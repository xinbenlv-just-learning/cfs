<?php
	require_once("../phpLib/Default.php");
	require_once("../phpLib/Grant_server_fns.php");
	require_once("../phpLib/ProcessDataInfo_fns.php");
	
	function insert_recipients_in_db($db, &$recipients) {
		$query = sprintf("INSERT INTO grant_recipients VALUES (%d, '%s', %d, %d)",
						NULL,
						FilterString($recipients["name"]),
						$recipients["year"],
						$recipients["giving"]
					);
		$success = $db->query($query);
		$recipients["id"] = $db->insert_id;
		return $success;
	}
	
	function insert_grant_in_db($db, &$grant) {
		$insert_recipients = insert_recipients_in_db($db, $grant["recipients"]);
		$insert_datainfo = insert_datainfo_in_db($db, $grant["datainfo"]);
		
		$query =	sprintf("INSERT INTO `grant` VALUES (%d, %d, '%s', '%s', '%s', '%s', %d, '%s', %d)",
								NULL,
								$grant["org_id"],
								FilterString($grant["program"]),
								FilterString($grant["frequency"]),
								FilterString($grant["app_guide"]),
								FilterString($grant["app_deadline"]),
								$grant["recipients"]["id"],
								FilterString($grant["sample"]),
								$grant["datainfo"]["id"]
					);
		$insert_grant = $db->query($query);
		$grant["id"] = $db->insert_id;
		
		return $insert_recipients && $insert_datainfo && $insert_grant;
	}
	
	function update_recipients_in_db($db, $recipients) {
		$query =	sprintf("UPDATE recipients
								SET name = '%s', year = %d, total_giving = %d WHERE id = %d",
								FilterString($recipients["name"]),
								$recipients["year"],
								$recipients["giving"],
								$recipients["id"]
					);
		return $db->query($query);
	}
	
	function update_grant_in_db($db, $grant) {
		$update_recipients = update_recipients_in_db($db, $grant["recipients"]);
		$update_datainfo = update_datainfo_in_db($db, $grant["datainfo"]);
		
		$query = sprintf("UPDATE `grant`
						SET grant_program = '%s',
							frequency_offer = '%s',
							application_guide = '%s',
							application_deadline = '%s',
							sample_proposals = '%s'
						WHERE id = %d",
						FilterString($grant["program"]),
						FilterString($grant["frequency"]),
						FilterString($grant["app_guide"]),
						FilterString($grant["app_deadline"]),
						FilterString($grant["sample"]),
						$grant["id"]
					);
		$update_grant = $db->query($query);
		
		return $update_recipients && $update_datainfo && $update_grant;
	}
	
	function delete_recipients_in_db($db, $recipients) {
		$query = "DELETE FROM grant_recipients WHERE id = $recipients[id]";
		return $db->query($query);
	}
	
	function delete_grant_in_db($db, $grant) {
		$delete_recipients = delete_recipients_in_db($db, $grant["recipients"]);
		$delete_datainfo = delete_datainfo_in_db($db, $grant["datainfo"]);
		
		$query = "DELETE FROM `grant` WHERE id = $grant[id]";
		$delete_grant = $db->query($query);
		
		return $delete_recipients && $delete_datainfo && $delete_grant;
	}
	
	function process_grant(&$grant, $action = "add") {
		if ($EchoGrantTest = false)
			output($grant);
		
		$db = connect_db();
		$db->autocommit(false);
		switch ($action) {
			case "add":
			default:
				echo "<a href='./GrantForm.php?action=add&org_id=$grant[org_id]'> Add another New Grant </a>";
				if (insert_grant_in_db($db, $grant)) {
					$db->commit();
					echo "<p> Succeeded to Insert the Grant into Database. </p>";
					output($grant);
				} else {
					$db->rollback();
					echo "<p> Failed to Insert the Grant into Database! </p>";
				}
				break;
			
			case "update":
				echo "<a href='./ListGrant.php'> Back to List Grant </a>";
				if (update_grant_in_db($db, $grant)) {
					$db->commit();
					echo "<p> Succeeded to Update the Grant in Database. </p>";
					output($grant);
				} else {
					$db->rollback();
					echo "<p> Failed to Update the Grant in Database! </p>";
				}
				break;
			
			case "delete":
				echo "<a href='./ListGrant.php'> Back to List Grant </a>";
				$grant = get_grant_from_db($db, $grant["id"]);
				if (isset($grant["id"]) && delete_grant_in_db($db, $grant)) {
					$db->commit();
					echo "<p> Succeeded to Delete the Grant in Database. </p>";
					output($grant);
				} else {
					$db->rollback();
					echo "<p> Failed to Delete the Grant in Database! </p>";
				}
				break;
		}
		$db->autocommit(true);
		$db->close();
	}
?>