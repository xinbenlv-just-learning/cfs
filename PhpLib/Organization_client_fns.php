<?php
	// this file contains functions that
	// make translation between html variables and php variables
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/DataInfo_client_fns.php");
	
	function get_org_geos_from_form($post) {
		$geos = array();
		
		if (isset($post["Geos"])) {
			$post_geos = $post["Geos"];
			$count = count($post_geos);
			for ($i = 0; $i < $count; $i++) {
				$geos[$i]["geo"] = $post_geos[$i];
			}
		}
		
		return $geos;
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
		
		$contact["id"] = isset($post[$type."ContactId"]) ? $post[$type."ContactId"] : NULL;
		$contact["person"] = isset($post[$type."ContactPerson"]) ? GetString($post[$type."ContactPerson"]) : NULL;
		$contact["address"] = isset($post[$type."ContactAddress"]) ? GetString($post[$type."ContactAddress"]) : NULL;
		$contact["telephone"] = isset($post[$type."ContactTelephone"]) ? GetString($post[$type."ContactTelephone"]) : NULL;
		$contact["fax"] = isset($post[$type."ContactFax"]) ? GetString($post[$type."ContactFax"]) : NULL;
		$contact["email"] = isset($post[$type."ContactEmail"]) ? GetString($post[$type."ContactEmail"]) : NULL;
		
		return $contact;
	}
	
	function get_org_from_form($get, $post) {
		$org = array();
		
		// default values are NULL, so we can use real default value in database
		// for organization
		// we can use $orgName = @$post["OrgName"]; and then check $isset($orgName) later
		$org["id"] = isset($get["id"]) ? $get["id"] : NULL;
		$org["name"] = isset($post["OrgName"]) ? GetString($post["OrgName"]) : NULL;
		$org["websiteEn"] = isset($post["WebsiteEn"]) ? GetString($post["WebsiteEn"]) : NULL;
		$org["websiteCh"] = isset($post["WebsiteCh"]) ? GetString($post["WebsiteCh"]) : NULL;
		$org["type"] = isset($post["OrgType"]) ? GetSelect($post["OrgType"]) : NULL;
		$org["geos"] = get_org_geos_from_form($post);
		$org["originalCountry"] = isset($post["OriginalCountry"]) ? GetString($post["OriginalCountry"]) : NULL;
		$org["granteeType"] = isset($post["GranteeType"]) ? GetSelect($post["GranteeType"]) : NULL;
		$org["acceptPublic"] = isset($post["AcceptPublic"]);
		$org["area"] = isset($post["Area"]) ? GetSelect($post["Area"]) : NULL;
		$org["subArea"] = isset($post["SubArea"]) ? GetSelect($post["SubArea"]) : NULL;
		// for assets
		$org["assets"] = get_org_assets_from_form($post);
		
		// for giving
		$org["giving"] = get_org_giving_from_form($post);
		
		$org["numOffices"] = isset($post["NumOffices"]) ? intval($post["NumOffices"]) : NULL;
		// for China office contact info
		$org["cnContact"] = get_org_contact_from_form($post, "Cn");
		
		// for HQ contact info
		$org["hqContact"] = get_org_contact_from_form($post, "Hq");
		
		// for data info
		$org["datainfo"] = get_datainfo_from_form($post);
		
		return $org;
	}
?>