<?php
	require_once("../PhpLib/Default.php");
	require_once("../PhpLib/Organization_server_fns.php");
	require_once("../PhpLib/Grant_server_fns.php");
	require_once("../PhpLib/DataInfo_fns.php");
	
	function display_form_header($actionPhp) {
echo <<< FORM_HEADER
	<form id="GrantForm" action="./$actionPhp" method="post">
FORM_HEADER;
	}
	
	function display_table_header() {
echo <<< TABLE_HEADER
		<table>
			<thead>
				<tr>
					<th> Field Name </th>
					<th> Value </th>
					<th> Comments </th>
				</tr>
			</thead>
TABLE_HEADER;
	}
	
	function display_org_name($org_id, $org_name) {
echo <<< ORG_NAME
		<tr>
			<td> Organization Name </td>
			<td>
				<a href="./OrganizationForm.php?action=update&id=$org_id"> $org_name </a>
			</td>
			<td> </td>
		</tr>
ORG_NAME;
	}
	
	function display_grant_program($program) {
echo <<< GRANT_NAME
		<tr>
			<td> Grant Program </td>
			<td class="required">
				<input name="GrantProgram" value="$program" />
			</td>
			<td> Required </td>
		</tr>
GRANT_NAME;
	}
	
	function display_frequency($frequency, $frequency_list) {
		$frequeny_list_html = create_select_option($frequency, $frequency_list, "Frequency");
		
echo <<< FREQUENCY
		<tr>
			<td> Frequency of Offer </td>
			<td class="FrequencyList">
				$frequeny_list_html
			</td>
			<td> </td>
		</tr>
FREQUENCY;
	}
	
	function display_app_guide($app_guide) {
echo <<< APP_GUIDE
		<tr>
			<td> Application Guide </td>
			<td>
				<input name="AppGuide" value="$app_guide" />
			</td>
			<td> </td>
		</tr>
APP_GUIDE;
	}
	
	function display_app_deadline($app_deadline) {
echo <<< APP_DEADLINE
		<tr>
			<td> Application Deadline </td>
			<td>
				<input name="AppDeadline" value="$app_deadline" />
			</td>
			<td> </td>
		</tr>
APP_DEADLINE;
	}
	
	function display_recipients($recipients) {
echo <<< RECIPIENTS
		<tr>
			<td colspan="3"> Grant Recipients </td>
		</tr>
		<tr>
			<td> Name </td>
			<td>
				<input name="RecipientsName" value="$recipients[name]" />
			</td>
			<td> </td>
		</tr>
		<tr>
			<td> Year </td>
			<td>
				<input name="RecipientsYear" value="$recipients[year]" />
			</td>
			<td> </td>
		</tr>
		<tr>
			<td> Total Giving </td>
			<td>
				<input name="RecipientsGiving" value="$recipients[giving]" />
			</td>
			<td> </td>
		</tr>
RECIPIENTS;
	}
	
	function display_sample($sample) {
echo <<< SAMPLE_PROPOSALS
		<tr>
			<td> Sample Proposals </td>
			<td>
				<input name="Sample" />
			</td>
			<td> </td>
		</tr>
SAMPLE_PROPOSALS;
	}
	
	function display_table_body($grant, $grant_json) {
		echo "<tbody>";
			display_org_name(isset($grant["org_id"]) ? $grant["org_id"] : NULL, isset($grant["org_name"]) ? $grant["org_name"] : NULL);
			display_grant_program(isset($grant["program"]) ? $grant["program"] : NULL);
			display_frequency(isset($grant["frequency"]) ? $grant["frequency"] : NULL, $grant_json->FrequencyList);
			display_app_guide(isset($grant["app_guide"]) ? $grant["app_guide"] : NULL);
			display_app_deadline(isset($grant["app_deadline"]) ? $grant["app_deadline"] : NULL);
			display_recipients(isset($grant["recipients"]) ? $grant["recipients"] : NULL);
			display_sample(isset($grant["sample"]) ? $grant["sample"] : NULL);
			display_datainfo(isset($grant["datainfo"]) ? $grant["datainfo"] : NULL);
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
	
	function set_hidden_ids_html($grant) {
		$org_id = isset($grant["org_id"]) ? $grant["org_id"] : NULL;
		$recipients_id = isset($grant["recipients_id"]) ? $grant["recipients_id"] : NULL;
		$datainfo_id = isset($grant["datainfo_id"]) ? $grant["datainfo_id"] : NULL;
		
echo <<< HIDDEN
		<input type="hidden" name="OrgId" value="$org_id" />
		<input type="hidden" name="RecipientsId" value="$recipients_id" />
		<input type="hidden" name="DataInfoId" value="$datainfo_id" />
HIDDEN;
	}
	
	function display_grant_form($actionPhp, $action = "add", $id = NULL, $org_id = NULL) {
		switch ($action) {
			case "add":
			default:
					if ($org_id == NULL)
						throw new Exception("Please Specify an Organization!");
					
					$grant = array("org_id" => $org_id, "org_name" => get_org_name_from_db_new_connect($org_id));
					$actionPhp .= "?action=add";
					break;
					
			case "update":
					if ($id == NULL)
						throw new Exception("Please Specify a Grant!");
					
					$grant = get_grant_from_db_new_connect($id);
					
					if (!isset($grant["id"]))
						throw new Exception("Can not Find the Specified Grant!");
					
					$actionPhp .= "?action=update&id=$id";
					break;
		}
		
		$grant_json = json_decode(file_get_contents(JSON_GRANT_FILE));			// std class object
		display_form_header($actionPhp);
		set_hidden_ids_html($grant);
		display_table_header();
		display_table_body($grant, $grant_json);
		display_table_footer();
		
		display_form_footer();
	}
?>