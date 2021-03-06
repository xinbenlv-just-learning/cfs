<?php
	// this file contains functions that
	// makes translation between html variables and php variables
	require_once("../phpLib/Default.php");
	require_once("../phpLib/DataInfo_client_fns.php");
	
	// ensure to check $post_field is not empty
	function get_org_fields_from_form($post_fields, $name) {
		$fields = array();
		
		$count = count($post_fields);
		for ($i = 0; $i < $count; $i++) {
			$fields[$i][$name] = $post_fields[$i];
		}
		return $fields;
	}
	
	function get_org_geos_from_form($post) {
		if (isset($post["Geos"]))
			$geos = get_org_fields_from_form($post["Geos"], "geo");
		else
			$geos = array();
		
		return $geos;
	}
	
	function get_org_areas_from_form($post, $area_list, $subarea_list) {
		$areas = array();
		if (isset($post["Areas"]) && isset($post["Subareas"])) {
			$post_areas = $post["Areas"];
			$post_subareas = $post["Subareas"];
			$num_area = 0;
			foreach ($post_areas as $index_area => $value_area) {
				$area_item = &$areas[$num_area];
				$area = $area_item["area"] = $area_list[$index_area];
				$area_item["subareas"] = array();
				
				// for some area we do not select any subarea
				if (array_key_exists($index_area, $post_subareas)) {
					$num_subarea = 0;
					foreach ($post_subareas[$index_area] as $index_subarea => $value_subarea) {
						$area_subarea_list = $subarea_list->$area;
						$area_item["subareas"][$num_subarea++] = $area_subarea_list[$index_subarea];
					}
				}
				$num_area++;
			}
		}
		return $areas;
	}
	
	function get_org_assets_from_form($post) {
		$assets = array();
		
		if (isset($post["AssetsYears"]) && isset($post["AssetsAmounts"])) {
			$years = $post["AssetsYears"];
			$amounts = $post["AssetsAmounts"];
			
			$count = count($years);
			for ($i = 0; $i < $count; $i++) {
				if (!isEmpty(array($years[$i], $amounts[$i]))) {
					$assets[$i]["year"] = $years[$i];
					$assets[$i]["amount"] = $amounts[$i];
				}
			}
		}
		
		return $assets;
	}
	
	function get_org_giving_from_form($post) {
		$giving = array();
		
		if (isset($post["GivingYears"]) && isset($post["GivingWorlds"]) && isset($post["GivingChinas"])) {
			$years = $post["GivingYears"];
			$worlds = $post["GivingWorlds"];
			$chinas = $post["GivingChinas"];
			
			$count = count($years);
			for ($i = 0; $i < $count; $i++) {
				if (!isEmpty(array($years[$i], $worlds[$i], $chinas[$i]))) {
					$giving[$i]["year"] = $years[$i];
					$giving[$i]["world"] = $worlds[$i];
					$giving[$i]["china"] = $chinas[$i];
				}
			}
		}
		
		return $giving;
	}
	
	function get_org_contact_from_form($post, $type) {
		$contact = array();
		
		$contact["id"] = isset($post[$type."ContactId"]) ? intval($post[$type."ContactId"]) : NULL;
		$contact["person"] = isset($post[$type."ContactPerson"]) ? $post[$type."ContactPerson"] : NULL;
		$contact["address"] = isset($post[$type."ContactAddress"]) ? $post[$type."ContactAddress"] : NULL;
		$contact["telephone"] = isset($post[$type."ContactTelephone"]) ? $post[$type."ContactTelephone"] : NULL;
		$contact["fax"] = isset($post[$type."ContactFax"]) ? $post[$type."ContactFax"] : NULL;
		$contact["email"] = isset($post[$type."ContactEmail"]) ? $post[$type."ContactEmail"] : NULL;
		
		return $contact;
	}
	
	function get_org_from_form($get, $post) {
		$org_json = json_decode(file_get_contents(JSON_ORG_FILE));			// std class object
		
		$org = array();
		
		// default values are NULL, so we can use real default value in database
		// for organization
		// we can use $orgName = @$post["OrgName"]; and then check $isset($orgName) later
		$org["id"] = isset($get["id"]) ? intval($get["id"]) : NULL;
		$org["name"] = isset($post["OrgName"]) ? $post["OrgName"] : NULL;
		$org["websiteEn"] = isset($post["WebsiteEn"]) ? $post["WebsiteEn"] : NULL;
		$org["websiteCh"] = isset($post["WebsiteCh"]) ? $post["WebsiteCh"] : NULL;
		$org["type"] = isset($post["OrgType"]) ? FilterSelect($post["OrgType"]) : NULL;
		$org["geos"] = get_org_geos_from_form($post);
		$org["originalCountry"] = isset($post["OriginalCountry"]) ? $post["OriginalCountry"] : NULL;
		$org["granteeType"] = isset($post["GranteeType"]) ? FilterSelect($post["GranteeType"]) : NULL;
		$org["acceptPublic"] = isset($post["AcceptPublic"]);
		$org["areas"] = get_org_areas_from_form($post, $org_json->AreaList, $org_json->SubareaList);
		// for assets
		$org["assets"] = get_org_assets_from_form($post);
		
		// for giving
		$org["giving"] = get_org_giving_from_form($post);
		
		$org["numOffices"] = isset($post["NumOffices"]) ? $post["NumOffices"] : NULL;
		// for China office contact info
		$org["cnContact"] = get_org_contact_from_form($post, "Cn");
		
		// for HQ contact info
		$org["hqContact"] = get_org_contact_from_form($post, "Hq");
		
		// for data info
		$org["datainfo"] = get_datainfo_from_form($post);
		
		return $org;
	}
?>