<?php
	require_once("../phpLib/Grant_server_fns.php");
	
	function display_table_header() {
echo <<< TABLE_HEADER
		<table id="GrantTable">
			<caption> All Grants </caption>
			<thead>
				<tr>
					<th> Manipulation </th>
					<th> Organization </th>
					<th> Grant Program </th>
					<th> Application Deadline </th>
					<th> Collector </th>
					<th> Reviewer </th>
					<th> Status </th>
				</tr>
			</thead>
TABLE_HEADER;
	}
	
	function display_table_body($grant_list) {
		echo "<tbody>";
		for ($i = 0, $count = count($grant_list); $i < $count; $i++) {
			$grant = &$grant_list[$i];
			$datainfo = &$grant["datainfo"];
			
echo <<< TABLE_BODY
			<tr>
				<td>
					<a href="./GrantForm.php?action=update&id=$grant[id]" > Edit </a>
					<a class="actionDelete" href="./ProcessGrant.php?action=delete&id=$grant[id]" > Delete </a>
				</td>
				<td> $grant[org_name] </td>
				<td> $grant[program] </td>
				<td> $grant[app_deadline] </td>
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
		<p> There are $count Grants. </p>
TABLE_FOOTER;
	}
	
	function display_grants_table($org_id = NULL) {
		$grant_list = get_grants_from_db($org_id);
		
		if (($count = count($grant_list)) == 0) {
			echo "<p> There is No Grant Data yet! </p>";
		} else {
			display_table_header();
			display_table_body($grant_list);
			display_table_footer($count);
		}
		
		if ($org_id != NULL)
			echo "<a href='./GrantForm.php?action=add&org_id=$org_id'> Add a New Grant </a>";
	}
?>