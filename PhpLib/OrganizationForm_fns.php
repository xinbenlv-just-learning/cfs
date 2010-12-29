<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/DataInfo_fns.php");
	require_once("../PhpLib/Organization_server_fns.php");
	
	function display_form_header($actionPhp) {
echo <<< FORM_HEADER
	<form class="OrganizationForm" action="./$actionPhp" method="post">
FORM_HEADER;
	}
	
	function display_table_header() {
echo <<< TABLE_HEADER
		<table class="Organization">
			<thead>
				<tr>
					<th class="FieldName"> Field Name </th>
					<th class="Value"> Value </th>
					<th class="Comments"> Comments </th>
				</tr>
			</thead>
TABLE_HEADER;
	}
	
	function display_org_name($org_name) {
echo <<< ORG_NAME
		<tr>
			<td class="first"> Organization Name </td>
			<td class="first required">
				<input name="OrgName" value="$org_name" />
			</td>
			<td class="first"> Required </td>
		</tr>
ORG_NAME;
	}
	
	function display_websiteEn($websiteEn) {
echo <<< WEBSITEEN
		<tr>
			<td class="first"> English Website </td>
			<td class="first">
				<input name="WebsiteEn" value="$websiteEn" />
			</td>
			<td> </td>
		</tr>
WEBSITEEN;
	}
	
	function display_websiteCh($websiteCh) {
echo <<< WEBSITECH
		<tr>
			<td class="first"> Chinese Website </td>
			<td class="first">
				<input name="WebsiteCh" value="$websiteCh" />
			</td>
			<td> </td>
		</tr>
WEBSITECH;
	}
	
	function display_org_type($org_type, $org_type_list) {
		$org_type_list_html = create_select_option($org_type, $org_type_list, "OrgType");
		
echo <<< ORG_TYPE
		<tr>
			<td class="first"> Organization Type </td>
			<td class="first required OrgTypeList">
				$org_type_list_html
			</td>
			<td class="first"> Required </td>
		</tr>
ORG_TYPE;
	}
	
	function display_geos($geos, $geo_list) {
		$geo_array = array();
		for ($i = 0, $count = count($geos); $i < $count; $i++) {
			$geo_array[$i] = $geos[$i]["geo"];
		}
		$geo_list_html = create_multiple_select_option($geo_array, $geo_list, "Geos");
		
echo <<< GEOS
		<tr>
			<td class="first"> Geographics Focus in China </td>
			<td class="first GeoList">
				$geo_list_html
			</td>
			<td> </td>
		</tr>
GEOS;
	}
	
	function display_original_country($originalCountry) {
echo <<< ORIGINAL
		<tr>
			<td class="first"> Country of Orgin </td>
			<td class="first">
				<input name="OriginalCountry" value="$originalCountry" />
			</td>
			<td> </td>
		</tr>
ORIGINAL;
	}
	
	function display_grantee_type($granteeType, $granteeType_list) {
		$grantee_type_list_html = create_select_option($granteeType, $granteeType_list, "GranteeType");
		
echo <<< GRANTEE
		<tr>
			<td class="first"> Grantee Type </td>
			<td class="first GranteeTypeList">
				$grantee_type_list_html
			</td>
			<td> </td>
		</tr>
GRANTEE;
	}
	
	function display_accept_public($acceptPublic) {
		$accept_public_html = $acceptPublic ? "checked='checked'" : "";
		
echo <<< ACCEPT
		<tr>
			<td class="first"> Accept Grant Applications from Public </td>
			<td class="first">
				<input type="checkbox" name="AcceptPublic" $accept_public_html />
			</td>
			<td> </td>
		</tr>
ACCEPT;
	}
	
	function display_area_funding($area, $area_list) {
		$area_list_html = create_select_option($area, $area_list, "Area");
		
echo <<< AREA
		<tr>
			<td class="first"> Area of Funding </td>
			<td class="first required AreaList">
				$area_list_html
			</td>
			<td class="first"> Required </td>
		</tr>
AREA;
	}
	
	function display_subarea_funding($subareas, $subarea_list) {
		$subarea_array = array();
		for ($i = 0, $count = count($subareas); $i < $count; $i++) {
			$subarea_array[$i] = $subareas[$i]["subarea"];
		}
		$subarea_list_html = create_multiple_select_option($subarea_array, $subarea_list, "Subareas");
		
echo <<< SUBAREA
		<tr>
			<td class="first"> Sub-Area of Funding </td>
			<td class="first SubareaList">
				$subarea_list_html
			</td>
			<td> </td>
		</tr>
SUBAREA;
	}
	
	function display_total_assets($assets) {
		$assets_html = "";
		if ($assets != NULL && count($assets) > 0) {
			// when updating
			foreach ($assets as $assets_i) {
				$assets_html .= "<tr>
									<td>
										<input type='text' class='AssetsYearInput' value=$assets_i[year] name='AssetsYears[]' />
									</td>
									<td>
										<input type='text' class='AssetsAmountInput' value=$assets_i[amount] name='AssetsAmounts[]' />
									</td>
									<td>
										<input type='button' class='AssetsDeleteButton' value='Delete' />
									</td>
								</tr>";
			}
		}
		$assets_html .= "<tr>
							<td> <input type='text' class='AssetsYearInput' name='AssetsYears[]' /> </td>
							<td> <input type='text' class='AssetsAmountInput' name='AssetsAmounts[]' /> </td>
							<td> <input type='button' class='AssetsDeleteButton' value='Delete' /> </td>
						</tr>";
		
echo <<< ASSETS
		<tr>
			<td class="first"> Total Assets (USD) </td>
			<td class="first Assets">
				<span> <input type="button" class="AddAssets" value="Add" /> </span>
				<table class="Assets">
					<thead>
						<tr>
							<th class="AssetsYear"> Year </th>
							<th class="AssetsAmount"> Amount </th>
							<th class="AssetsAction"> Action </th>
						</tr>
					</thead>
					<tbody>
						$assets_html
					</tbody>
				</table>
			</td>
			<td> </td>
		</tr>
ASSETS;
	}
	
	function display_total_giving($giving) {
		$giving_html = "";
		if ($giving != NULL && count($giving) > 0) {
			// when updating
			foreach ($giving as $giving_i) {
				$giving_html .= "<tr>
									<td>
										<input type='text' class='GivingYearInput' value=$giving_i[year] name='GivingYears[]' />
									</td>
									<td>
										<input type='text' class='GivingWorldwideInput' value=$giving_i[world] name='GivingWorlds[]' />
									</td>
									<td>
										<input type='text' class='GivingInChinaInput' value=$giving_i[world] name='GivingChinas[]' />
									</td>
									<td>
										<input type='button' class='GivingDeleteButton' value='Delete' />
									</td>
								</tr>";
			}
		}
		
		$giving_html .= "<tr>
							<td> <input type='text' class='GivingYearInput' name='GivingYears[]' /> </td>
							<td> <input type='text' class='GivingWorldwideInput' name='GivingWorlds[]' /> </td>
							<td> <input type='text' class='GivingInChinaInput' name='GivingChinas[]' /> </td>
							<td> <input type='button' class='GivingDeleteButton' value='Delete' /> </td>
						</tr>";
		
echo <<< GIVING
		<tr>
			<td class="first"> Total Giving (USD) </td>
			<td class="first Giving">
				<span> <input type="button" class="AddGiving" value="Add" /> </span>
				<table class="Giving">
					<thead>
						<tr>
							<th class="GivingYear"> Year </th>
							<th class="GivingWorldwide"> Worldwide </th>
							<th class="GivingInChina"> InChina </th>
							<th class="GivingAction"> Action </th>
						</tr>
					</thead>
					<tbody>
						$giving_html
					</tbody>
				</table>
			</td>
			<td> </td>
		</tr>
GIVING;
	}
	
	function display_num_offices($numOffices) {
echo <<< OFFICES
		<tr>
			<td class="first"> Number of Offices in China </td>
			<td class="first">
				<input name="NumOffices" value="$numOffices" />
			</td>
			<td> </td>
		</tr>
OFFICES;
	}
	
	function display_contact($contact, $type) {		
		$person = $type."ContactPerson";
		$address = $type."ContactAddress";
		$telephone = $type."ContactTelephone";
		$fax = $type."ContactFax";
		$email = $type."ContactEmail";
		
		$name = ($type == "Cn") ? "China Office(s)" : "Head Quarter";
		
echo <<< CONTACT
		<tr>
			<td class="first" colspan="3"> $name Contact Info </td>
		</tr>
		
		<tr>
			<td class="firstIndent"> Contact Person </td>
			<td class="first">
				<input name="$person" value="$contact[name]" />
			</td>
			<td> </td>
		</tr>
		
		<tr>
			<td class="firstIndent"> Address </td>
			<td class="first">
				<input name="$address" value="$contact[address]" />
			</td>
			<td> </td>
		<tr>
		
		<tr>
			<td class="firstIndent"> Telephone </td>
			<td class="first">
				<input name="$telephone" value="$contact[telephone]" />
			</td>
			<td> </td>
		<tr>
		
		<tr>
			<td class="firstIndent"> Fax </td>
			<td class="first">
				<input name="$fax" value="$contact[fax]" />
			</td>
			<td> </td>
		<tr>
		
		<tr>
			<td class="firstIndent"> E-mail </td>
			<td class="first">
				<input name="$email" value="$contact[email]" />
			</td>
			<td> </td>
		<tr>
CONTACT;
	}
	
	function display_table_body($org, $org_json) {
		echo "<tbody>";
			display_org_name(isset($org["name"]) ? $org["name"] : NULL);
			display_websiteEn(isset($org["websiteEn"]) ? $org["websiteEn"] : NULL);
			display_websiteCh(isset($org["websiteCh"]) ? $org["websiteCh"] : NULL);
			display_org_type(isset($org["type"]) ? $org["type"] : NULL, $org_json->OrgTypeList);
			display_geos(isset($org["geos"]) ? $org["geos"] : array(), $org_json->GeoList);
			display_original_country(isset($org["originalCountry"]) ? $org["originalCountry"] : NULL);
			display_grantee_type(isset($org["granteeType"]) ? $org["granteeType"] : NULL, $org_json->GranteeTypeList);
			display_accept_public(isset($org["acceptPublic"]) ? $org["acceptPublic"] : true);
			display_area_funding(isset($org["area"]) ? $org["area"] : NULL, $org_json->AreaList);
			display_subarea_funding(isset($org["subareas"]) ? $org["subareas"] : array(),
									isset($org["area"]) ? $org_json->SubareaList->$org["area"] : array());
			display_total_assets(isset($org["assets"]) ? $org["assets"] : NULL);
			display_total_giving(isset($org["giving"]) ? $org["giving"] : NULL);
			display_num_offices(isset($org["numOffices"]) ? $org["numOffices"] : NULL);
			display_contact(isset($org["cnContact"]) ? $org["cnContact"] : NULL, "Cn");
			display_contact(isset($org["hqContact"]) ? $org["hqContact"] : NULL, "Hq");
			display_datainfo(isset($org["datainfo"]) ? $org["datainfo"] : NULL);
		echo "</tbody>";
	}
	
	function display_table_footer() {
echo <<< TABLE_FOOTER
		</table>
TABLE_FOOTER;
	}
	
	function display_form_footer() {
echo <<< FORM_FOOTER
		<input type="submit" name="submit" id="submit" value="Submit" />
		<input type="reset" name="reset" id="reset" value="Reset" />
	</form>
FORM_FOOTER;
	}
	
	function save_json_to_html($json_list, $id) {
		$json_list_html = json_encode($json_list);
		
echo <<< JSON
		<span id="$id" style="display:none;">
			$json_list_html
		</span>
JSON;
	}
	
	function set_hidden_ids_html($org) {
		$cnContact_id = isset($org["cnContact"]["id"]) ? $org["cnContact"]["id"] : NULL;
		$hqContact_id = isset($org["hqContact"]["id"]) ? $org["hqContact"]["id"] : NULL;
		$dataInfo_id = isset($org["datainfo"]["id"]) ? $org["datainfo"]["id"] : NULL;
		
echo <<< HIDDEN
		<input type="hidden" name="CnContactId" value="$cnContact_id" />
		<input type="hidden" name="HqContactId" value="$hqContact_id" />
		<input type="hidden" name="DataInfoId" value="$dataInfo_id" />
HIDDEN;
	}
	
	function display_org_form($actionPhp, $action = "add", $id = NULL) {
		switch ($action) {
			case "add":
			default:
					$org = array();
					$actionPhp .= "?action=add";
					break;
					
			case "update":
					if ($id != NULL) {
						$org = get_org_from_db_new_connect($id);
						$actionPhp .= "?action=update&id=$id";
					}
					else {
						$org = array();
						$actionPhp .= "?action=add";
					}
					break;
		}
		
		$org_json = json_decode(file_get_contents(JSON_ORG_FILE));			// std class object
		
		display_form_header($actionPhp);
		set_hidden_ids_html($org);
		display_table_header();
		display_table_body($org, $org_json);
		display_table_footer();
		display_form_footer();
		
		if ($action == "update")
			echo "<a href='./GrantForm.php?action=add&org_id=$org[id]'> Add a Grant </a>";
		
		save_json_to_html($org_json->SubareaList, "JsonSubareaList");
	}
?>