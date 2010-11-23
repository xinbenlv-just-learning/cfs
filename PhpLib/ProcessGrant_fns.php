<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Grant_server_fns.php");
	require_once("../PhpLib/ProcessDatainfo_fns.php");
	
	function insert_grant_recipients_in_db($db, &$recipients) {
		$query = sprintf("INSERT INTO grant_recipients VALUES (%d, '%s', %d, %d)",
						NULL,
						$recipients["name"],
						$recipients["year"],
						$recipients["giving"]
					);
		$db->query($query);
		$recipients["id"] = $db->insert_id;
		
		output($recipients);
	}
	
	function insert_grant_in_db($db, &$grant) {
		insert_grant_recipients_in_db($db, $grant["recipients"]);
		insert_datainfo_in_db($db, $grant["datainfo"]);
		
		$query = sprintf("INSERT INTO `grant` VALUES (%d, %d, '%s', '%s', '%s', '%s', %d, '%s', %d)",
						NULL,
						$grant["org_id"],
						$grant["program"],
						$grant["frequency"],
						$grant["app_guide"],
						$grant["app_deadline"],
						$grant["recipients"]["id"],
						$grant["sample"],
						$grant["datainfo"]["id"]
					);
		$db->query($query);
		$grant["id"] = $db->insert_id;
		
		return true;
	}
	
	function update_recipients_in_db($db, $recipients) {
		$query = sprintf("UPDATE recipients
						SET name = '%s', year = %d, total_giving = %d WHERE id = %d",
						$recipients["name"],
						$recipients["year"],
						$recipients["giving"],
						$recipients["id"]
					);
		$db->query($query);
	}
	
	function update_grant_in_db($db, $grant) {
		update_recipients_in_db($db, $grant["recipients"]);
		update_datainfo_in_db($db, $grant["datainfo"]);
		
		$query = sprintf("UPDATE `grant`
						SET grant_program = '%s',
							frequency_offer = '%s',
							application_guide = '%s',
							application_deadline = '%s',
							sample_proposals = '%s'
						WHERE id = %d",
						$grant["program"],
						$grant["frequency"],
						$grant["app_guide"],
						$grant["app_deadline"],
						$grant["sample"],
						$grant["id"]
					);
		$db->query($query);
		
		return true;
	}
	
	function delete_recipients_in_db($db, $recipients) {
		$query = "DELETE FROM grant_recipients WHERE id = $recipients[id]";
		$db->query($query);
	}
	
	function delete_grant_in_db($db, $grant) {
		delete_recipients_in_db($db, $grant["recipients"]);
		delete_datainfo_in_db($db, $grant["datainfo"]);
		
		$query = "DELETE FROM `grant` WHERE id = $grant[id]";
		$db->query($query);
		
		return true;
	}
	
	function process_grant(&$grant, $action = "add") {
		if ($EchoGrantTest = true)
			output($grant);
		
		$db = connect_db();
		switch ($action) {
			case "add":
			default:
				echo "<a href='./GrantForm.php?action=add&org_id=$grant[org_id]'> Add another New Grant </a>";
				if (insert_grant_in_db($db, $grant)) {
					echo "<p> Succeeded to Insert the Grant into Database. </p>";
					output($grant);
				} else {
					echo "<p> Failed to Insert the Grant into Database! </p>";
				}
				break;
			
			case "update":
				echo "<a href='./ListGrant.php'> Back to List Grant </a>";
				if (update_grant_in_db($db, $grant)) {
					echo "<p> Succeeded to Update the Grant in Database. </p>";
					output($grant);
				} else {
					echo "<p> Failed to Update the Grant in Database! </p>";
				}
				break;
			
			case "delete":
				echo "<a href='./ListGrant.php'> Back to List Grant </a>";
				$grant = get_grant_from_db($db, $grant["id"]);
				if (isset($grant["id"]) && delete_grant_in_db($db, $grant)) {
					echo "<p> Succeeded to Delete the Grant in Database. </p>";
					output($grant);
				} else {
					echo "<p> Failed to Delete the Grant in Database! </p>";
				}
				break;
		}
		$db->close();
	}
?>