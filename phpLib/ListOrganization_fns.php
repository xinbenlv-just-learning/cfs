<?php
	require_once("../phpLib/Organization_server_fns.php");
	
	function display_table_header() {
echo <<< TABLE_HEADER
		<table class="OrganizationTable">
			<caption> All Orgranizations </caption>
			<thead>
				<tr>
					<th colspan="3"> Manipulation </th>
					<th> Organization Id </th>
					<th> Organization Name </th>
					<th> Organization Type </th>
					<th> Collector </th>
					<th> Reviewer </th>
					<th> Status </th>
				</tr>
			</thead>
TABLE_HEADER;
	}
	
	function display_table_body($org_list) {
		echo "<tbody>";
		for ($i = 0, $count = count($org_list); $i < $count; $i++) {
			$org = &$org_list[$i];
			$datainfo = &$org["datainfo"];
			
echo <<< TABLE_BODY
				<tr>
					<td> <a href="./OrganizationForm.php?action=update&id=$org[id]"> Edit </a> </td>
					<td> <a href="./ListGrant.php?org_id=$org[id]"> Grants </a> </td>
					<td> <a class="actionDelete" href="./ProcessOrganization.php?action=delete&id=$org[id]"> Delete </a> </td>
					<td> $org[id] </td>
					<td> $org[name] </td>
					<td> $org[type] </td>
					<td> $datainfo[collector] </td>
					<td> $datainfo[reviewer] </td>
					<td> $datainfo[status] </td>
				</tr>
TABLE_BODY;
		}
		echo "</tbody>";
	}
	
	function display_table_footer($count) {
echo <<< TABLE_FOOTER
		</table>
		<a href="./OrganizationForm.php?action=add"> Add a New Organization </a>
		<p> There are $count Organizations. </p>
TABLE_FOOTER;
	}
	
	function display_org_list_table() {
		$org_list = get_orgs_from_db();
		
		if (($count = count($org_list)) == 0)
			echo "<p> There is No Organization Data yet! </p>";
		else {
			display_table_header();
			display_table_body($org_list);
			display_table_footer($count);
		}
	}
?>