<?php
	function display_index_list() {
echo <<< INDEX_LIST
		<img id="head" src="./Image/CFS_Logo.jpg" />
		<a href="./OrganizationForm.php?action=add"> Input New Organization Information </a>
		<br />
		<a href="#"> Input New Grant Information (Disabled Currently) </a>
		<br />
		<a href="./ListOrganization.php"> View All Organization Information </a>
		<br />
		<a href="./ListGrant.php"> View All Grant Information </a>
INDEX_LIST;
	}
?>