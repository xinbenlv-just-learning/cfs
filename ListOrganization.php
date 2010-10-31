<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Organization List </title>
		<link rel="stylesheet" type="text/css" href="./Css/default.css" />
		<link rel="stylesheet" type="text/css" href="./Css/ListOrganization.css" />
	</head>

	<body>
		<a href="./index.php"> Return to Main Page </a>
		<br />
		
		<?php
			include_once("./Default.php");
			
			@$db = new MySQLi("localhost", "chinafundseeker_admin", "admin", "chinafundseeker_database");
			if (mysqli_connect_errno()) {
				echo "Error: Could not connect to database. Please contact: ma86jian@gmail.com";
				exit;
			}
			
			$query = "select * from organization";
			$result = $db->query($query);
			
			if ($result == NULL) {
				echo "<p> There is no organization data. </p>";
			} else {
				echo "<table id='OrganizationTable'>";
				echo "<caption> All Orgranizations </caption>";
echo <<<THEAD
				<thead>
					<tr>
						<th> Manipulation </th>
						<th> Organization Id </th>
						<th> Organization Name </th>
						<th> Organization Type </th>
						<th> Area </th>
						<th> Collector </th>
						<th> Reviewer </th>
						<th> Status </th>
					</tr>
				</thead>
THEAD;
				echo "<tbody>";
				for ($i = 0; $i < $result->num_rows; $i++) {
					$row = $result->fetch_assoc();
					
					echo "<tr>";
					echo "<td> Edit Delete Add_Grant </td>";
					CreateTd($row["id"]);
					CreateTd($row["organization_name"]);
					CreateTd($row["organization_type"]);
					CreateTd($row["area_funding"]);
					
					// find datainfo
					$query = "select * from datainfo where id=".$row["datainfo_id"];
					$datainfo_result = $db->query($query);
					$datainfo = $datainfo_result->fetch_assoc();
					CreateTd($datainfo["collector"]);
					CreateTd($datainfo["reviewer"]);
					CreateTd($datainfo["status"]);
					echo "</tr>";
				}
				
				echo "</tbody>";
				echo "</table>";
				echo "<p> There are $result->num_rows Organizations. </p>";
			}		
			$db->close();
		?>
		
		<a href="./InputOrganization.html"> Input a new one </a>
	</body>
</html>