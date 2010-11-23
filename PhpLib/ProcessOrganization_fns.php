<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Organization_server_fns.php");
	require_once("../PhpLib/ProcessDataInfo_fns.php");
	
	function insert_contact_in_db($db, &$contact) {
		$query = "INSERT INTO contact VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		
		$stmt->bind_param("isssss",
			$null = NULL,
			$contact["person"],
			$contact["address"],
			$contact["telephone"],
			$contact["fax"],
			$contact["email"]
		);
		$stmt->execute();
		$stmt->close();
		
		return $contact["id"] = $db->insert_id;
	}
	
	function insert_organization_in_db($db, &$org) {
		$query = "INSERT INTO organization VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		
		$stmt->bind_param("isssssisssiiii",
			$null = NULL,
			$org["name"],
			$org["websiteEn"],
			$org["websiteCh"],
			$org["type"],
			$org["originalCountry"],
			$org["granteeType"],
			$org["acceptPublic"],
			$org["area"],
			$org["subArea"],
			$org["numOffices"],
			$org["cnContact"]["id"],
			$org["hqContact"]["id"],
			$org["datainfo"]["id"]
		);
		$stmt->execute();
		$stmt->close();
		
		return $org["id"] = $db->insert_id;
	}
	
	function insert_org_geos_in_db($db, $org_id, &$geos) {
		$query = "INSERT INTO organization_geos VALUES (?, ?, ?)";
		$stmt = $db->prepare($query);
		
		for ($i = 0, $len = count($geos); $i < $len; $i++) {
			$stmt->bind_param("iis",
				$null = NULL,
				$geos[$i]["org_id"] = $org_id,
				$geos[$i]["geo"]
			);
			$stmt->execute();
			$geos["id"] = $db->insert_id;
		}
		$stmt->close();
	}
	
	function insert_org_assets_in_db($db, $org_id, &$assets) {
		$query = "INSERT INTO organization_assets VALUES (?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		
		for ($i = 0, $len = count($assets); $i < $len; $i++) {
			$stmt->bind_param("iiii",
				$null = NULL,
				$assets[$i]["org_id"] = $org_id,
				$assets[$i]["year"],
				$assets[$i]["amount"]
			);
			$stmt->execute();
			$assets[$i]["id"] = $db->insert_id;
		}
		$stmt->close();
	}
	
	function insert_org_giving_in_db($db, $org_id, &$giving) {
		$query = "INSERT INTO organization_giving VALUES (?, ?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		
		for ($i = 0, $len = count($giving); $i < $len; $i++) {
			$stmt->bind_param("iiiii",
				$null = NULL,
				$giving[$i]["org_id"] = $org_id,
				$giving[$i]["year"],
				$giving[$i]["world"],
				$giving[$i]["china"]
			);
			$stmt->execute();
			$giving[$i]["id"] = $db->insert_id;
		}
		$stmt->close();
	}
	
	function insert_org_in_db($db, &$org) {
		// store it in database
		// INSERT organization as following steps:
		// 1. Insert cncontact
		// 2. Insert hqcontact
		// 3. Insert datainfo
		// 4. Insert organization
		// 5. Insert geos
		// 6. Insert assets
		// 7. Insert giving

		// todo: use transaction here
		insert_contact_in_db($db, $org["cnContact"]);
		insert_contact_in_db($db, $org["hqContact"]);
		insert_datainfo_in_db($db, $org["datainfo"]);
		insert_organization_in_db($db, $org);
		
		insert_org_geos_in_db($db, $org["id"], $org["geos"]);
		insert_org_assets_in_db($db, $org["id"], $org["assets"]);
		insert_org_giving_in_db($db, $org["id"], $org["giving"]);
		
		return true;
	}
	
	function update_contact_in_db($db, $contact) {
		$query =	"UPDATE contact SET
						person_name = '$contact[person]',
						address = '$contact[address]',
						telephone = '$contact[telephone]',
						fax = '$contact[fax]',
						email = '$contact[email]'
					WHERE id = $contact[id]";
		$db->query($query);
	}
	
	function update_organization_in_db($db, $org) {
		$cnContactId = $org["cnContact"]["id"];
		$hqContactId = $org["hqContact"]["id"];
		$datainfoId = $org["datainfo"]["id"];
		
		$query =	"UPDATE organization SET
						organization_name = '$org[name]',
						english_website = '$org[websiteEn]',
						chinese_website = '$org[websiteCh]',
						organization_type = '$org[type]',
						original_country = '$org[originalCountry]',
						grantee_type = '$org[granteeType]',
						accept_public = '$org[acceptPublic]',
						area_funding = '$org[area]',
						subarea_funding = '$org[subArea]',
						num_offices_china = '$org[numOffices]',
						china_contact_id = '$cnContactId',
						hq_contact_id = '$hqContactId',
						datainfo_id = '$datainfoId'
					WHERE id = $org[id]";
		$db->query($query);
	}
	
	function update_org_geos_in_db($db, $org_id, &$geos) {
		delete_org_geos_in_db($db, $org_id);
		insert_org_geos_in_db($db, $org_id, $geos);
	}
	
	function update_org_assets_in_db($db, $org_id, &$assets) {
		delete_org_assets_in_db($db, $org_id);
		insert_org_assets_in_db($db, $org_id, $assets);
	}
	
	function update_org_giving_in_db($db, $org_id, &$giving) {
		delete_org_giving_in_db($db, $org_id);
		insert_org_giving_in_db($db, $org_id, $giving);
	}
	
	function update_org_in_db($db, &$org) {
		update_contact_in_db($db, $org["cnContact"]);
		update_contact_in_db($db, $org["hqContact"]);
		update_datainfo_in_db($db, $org["datainfo"]);
		update_organization_in_db($db, $org);
		
		update_org_geos_in_db($db, $org["id"], $org["geos"]);
		update_org_assets_in_db($db, $org["id"], $org["assets"]);
		update_org_giving_in_db($db, $org["id"], $org["giving"]);
		
		return true;
	}
	
	function delete_contact_in_db($db, $contact) {
		$query = "DELETE FROM contact WHERE id = $contact[id]";
		$db->query($query);
	}
	
	function delete_organization_in_db($db, $org) {
		$query = "DELETE FROM organization WHERE id = $org[id]";
		$db->query($query);
	}
	
	function delete_org_geos_in_db($db, $org_id) {
		$query = "DELETE FROM organization_geos WHERE organization_id = $org_id";
		$db->query($query);
	}
	
	function delete_org_assets_in_db($db, $org_id) {
		$query = "DELETE FROM organization_assets WHERE organization_id = $org_id";
		$db->query($query);
	}
	
	function delete_org_giving_in_db($db, $org_id) {
		$query = "DELETE FROM organization_giving WHERE organization_id = $org_id";
		$db->query($query);
	}
	
	function delete_grants_in_db($db, $org_id) {
		$query = "DELETE FROM `grant` WHERE organization_id = $org_id";
		$db->query($query);
	}
	
	function delete_org_in_db($db, $org) {
		delete_contact_in_db($db, $org["cnContact"]);
		delete_contact_in_db($db, $org["hqContact"]);
		delete_datainfo_in_db($db, $org["datainfo"]);
		delete_organization_in_db($db, $org);
		
		delete_org_geos_in_db($db, $org["id"]);
		delete_org_assets_in_db($db, $org["id"]);
		delete_org_giving_in_db($db, $org["id"]);
		
		delete_grants_in_db($db, $org["id"]);
		
		return true;
	}
	
	function process_organization(&$org, $action) {
		if ($EchoOrgTest = false)
			output($org);
		
		$db = connect_db();
		switch ($action) {
			case "add":
			default:
				echo "<a href='./OrganizationForm.php?action=add'> Add another New Organization </a>";
				if (insert_org_in_db($db, $org)) {
					echo "<p> Succeeded to Insert the Organization into Database. </p>";
					output($org);
				} else {
					echo "<p> Failed to Insert the Organization into Database! </p>";
				}
				break;
			
			case "update":
				echo "<a href='./ListOrganization.php'> Back to List Organization </a>";
				if (update_org_in_db($db, $org)) {
					echo "<p> Succeeded to Update the Organization in Database. </p>";
					output($org);
				} else {
					echo "<p> Failed to Update the Organization in Database! </p>";
				}
				break;
			
			case "delete":
				echo "<a href='./ListOrganization.php'> Back to List Organization </a>";
				$org = get_org_from_db($db, $org["id"]);
				if (isset($org["id"]) && delete_org_in_db($db, $org)) {
					echo "<p> Succeeded to Delete the Organization in Database. </p>";
					output($org);
				} else {
					echo "<p> Failed to Delete the Organization in Database! </p>";
				}
				break;
		}
		$db->close();
	}
?>