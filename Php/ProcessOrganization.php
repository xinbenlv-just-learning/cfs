<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Process Organization </title>
	</head>

	<body>
		<?php
			include_once("./Default.php");
			
			$orgName = GetValue($_POST["OrgName"]);
			$websiteEn = GetValue($_POST["WebsiteEn"]);
			$websiteCh = GetValue($_POST["WebsiteCh"]);
			$orgTypeList = GetValue($_POST["OrgTypeList"]);
			@$geo = GetValue($_POST["Geo"]);
			$orginalCountry = GetValue($_POST["OrginalCountry"]);
			$area = GetValue($_POST["Area"]);
			@$subArea = GetValue($_POST["SubArea"]);
			$numOffices = GetValue($_POST["NumOffices"]);
			
			$language = GetValue($_POST["Language"]);
			$collector = GetValue($_POST["Collector"]);
			$reviewer = GetValue($_POST["Reviewer"]);
			$status = GetValue($_POST["Status"]);
			
			@$db = new mysqli("localhost", "chinafundseeker_admin", "admin", "chinafundseeker_database");
			if ($errno = mysqli_connect_errno()) {
				echo "Failed to connect to database. Error number is $errno. Please contact with me: ma86jian@gmail.com";
				exit;
			}
			
			$query = "insert into organization values (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("issssss", $null = NULL, $orgName, $websiteEn, $websiteCh, $orgTypeList, $geo, $orginalCountry, $area);
			$stmt->execute();
			$stmt->close();
			
			$db->close();
		?>
	</body>
</html>