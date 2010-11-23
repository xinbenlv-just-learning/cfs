<?php
	// this file contains php functions that
	// make translations between php variables and MySql variables
	// relating to organization
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/DataInfo_server_fns.php");
	
	function get_org_geos_from_db($db, $org_id) {
		$query = "select * from organization_geos where organization_id = $org_id";
		$result = $db->query($query);
		
		$geos = array();
		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			
			$geos[$i] = array();
			$geos[$i]["id"] = intval($row["id"]);
			$geos[$i]["org_id"] = intval($row["organization_id"]);
			$geos[$i]["geo"] = GetOriginalString($row["geographics_china"]);
		}
		
		return $geos;
	}
	
	function get_org_assets_from_db($db, $org_id) {
		$query = "select * from organization_assets where organization_id = $org_id";
		$result = $db->query($query);
		
		$assets = array();
		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			
			$assets[$i] = array();
			$assets[$i]["id"] = intval($row["id"]);
			$assets[$i]["org_id"] = intval($row["organization_id"]);
			$assets[$i]["year"] = intval($row["year"]);
			$assets[$i]["amount"] = intval($row["amount"]);
		}
		
		return $assets;
	}
	
	function get_org_giving_from_db($db, $org_id) {
		$query = "select * from organization_giving where organization_id = $org_id";
		$result = $db->query($query);
		
		$giving = array();
		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			
			$giving[$i] = array();
			$giving[$i]["id"] = intval($row["id"]);
			$giving[$i]["org_id"] = $row["organization_id"];
			$giving[$i]["year"] = $row["year"];
			$giving[$i]["world"] = $row["worldwide"];
			$giving[$i]["china"] = $row["in_china"];
		}
		
		return $giving;
	}
	
	function get_contact_from_db($db, $id) {
		$query = "select * from contact where id = $id";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		
		$contact = array();
		$contact["id"] = intval($row["id"]);
		$contact["name"] = GetOriginalString($row["person_name"]);
		$contact["address"] = GetOriginalString($row["address"]);
		$contact["telephone"] = GetOriginalString($row["telephone"]);
		$contact["fax"] = GetOriginalString($row["fax"]);
		$contact["email"] = GetOriginalString($row["email"]);
		
		return $contact;
	}
	
	function get_org_by_row($db, $row) {
		$org = array();
		
		if ($row != NULL) {
			$org["id"] = intval($row["id"]);
			$org["name"] = GetOriginalString($row["organization_name"]);
			$org["websiteEn"] = GetOriginalString($row["english_website"]);
			$org["websiteCh"] = GetOriginalString($row["chinese_website"]);
			$org["type"] = GetOriginalString($row["organization_type"]);
			
			$org["geos"] = get_org_geos_from_db($db, $org["id"]);
			
			$org["originalCountry"] = GetOriginalString($row["original_country"]);
			$org["granteeType"] = GetOriginalString($row["grantee_type"]);
			$org["acceptPublic"] = $row["accept_public"];
			$org["area"] = GetOriginalString($row["area_funding"]);
			$org["subArea"] = GetOriginalString($row["subarea_funding"]);
			
			$org["assets"] = get_org_assets_from_db($db, $row["id"]);
			$org["giving"] = get_org_giving_from_db($db, $row["id"]);
			
			$org["numOffices"] = intval($row["num_offices_china"]);
			
			$org["cnContact"] = get_contact_from_db($db, $row["china_contact_id"]);
			$org["hqContact"] = get_contact_from_db($db, $row["hq_contact_id"]);
			
			$org["datainfo"] = get_datainfo_from_db($db, $row["datainfo_id"]);
		}
		
		return $org;
	}
	
	function get_org_name_from_db($db, $id) {
		$query = "select organization_name from organization where id = $id";
		$result = $db->query($query);
		
		if ($result != NULL) {
			$row = $result->fetch_assoc();
			return GetOriginalString($row["organization_name"]);
		} else
			throw new Exception("Can not Find Specified Organization!");
	}
	
	function get_org_from_db_new_connect($id) {
		$db = connect_db();
		$org = get_org_from_db($db, $id);
		$db->close();
		
		return $org;
	}
	
	function get_org_from_db($db, $id) {
		$query = "select * from organization where id = $id";
		$result = $db->query($query);
		
		if ($result != NULL) {
			$row = $result->fetch_assoc();
			return get_org_by_row($db, $row);
		} else
			return array();
	}
	
	function get_orgs_from_db() {
		$db = connect_db();
		$query = "select * from organization";
		$result = $db->query($query);
		
		$orgs = array();
		if ($result != NULL) {
			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				$orgs[$i] = get_org_by_row($db, $row);
			}
		}
		
		$db->close();
		return $orgs;
	}
?>