<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Process Organization </title>
	</head>

	<body>
		<?php
			include_once("./Default.php");
			
			// default values are NULL, so we can use real default value in database
			// for organization
			$orgName = isset($_POST["OrgName"]) ? GetString($_POST["OrgName"]) : NULL;
			$websiteEn = isset($_POST["WebsiteEn"]) ? GetString($_POST["WebsiteEn"]) : NULL;
			$websiteCh = isset($_POST["WebsiteCh"]) ? GetString($_POST["WebsiteCh"]) : NULL;
			$orgType = isset($_POST["OrgType"]) ? GetSelect($_POST["OrgType"]) : NULL;
			$geos = isset($_POST["Geos"]) ? $_POST["Geos"] : Array();
			$orginalCountry = isset($_POST["OrginalCountry"]) ? GetString($_POST["OrginalCountry"]) : NULL;
			$granteeType = isset($_POST["GranteeType"]) ? GetSelect($_POST["GranteeType"]) : NULL;
			$acceptPublic = isset($_POST["AcceptPublic"]);
			$area = isset($_POST["Area"]) ? GetSelect($_POST["Area"]) : NULL;
			$subArea = isset($_POST["SubArea"]) ? GetSelect($_POST["SubArea"]) : NULL;
			// for assets
			$assetsYears = isset($_POST["AssetsYears"]) ? $_POST["AssetsYears"] : Array();
			$assetsAmounts = isset($_POST["AssetsAmounts"]) ? $_POST["AssetsAmounts"] : Array();
			// for giving
			$givingYears = isset($_POST["GivingYears"]) ? $_POST["GivingYears"] : Array();
			$givingWorlds = isset($_POST["GivingWorlds"]) ? $_POST["GivingWorlds"] : Array();
			$givingChinas = isset($_POST["GivingChinas"]) ? $_POST["GivingChinas"] : Array();
			
			$numOffices = isset($_POST["NumOffices"]) ? intval($_POST["NumOffices"]) : NULL;
			// for China office contact info
			$cnContactPerson = isset($_POST["CnContactPerson"]) ? GetString($_POST["CnContactPerson"]) : NULL;
			$cnContactAddress = isset($_POST["CnContactAddress"]) ? GetString($_POST["CnContactAddress"]) : NULL;
			$cnContactTelephone = isset($_POST["CnContactTelephone"]) ? GetString($_POST["CnContactTelephone"]) : NULL;
			$cnContactFax = isset($_POST["CnContactFax"]) ? GetString($_POST["CnContactFax"]) : NULL;
			$cnContactEmail = isset($_POST["CnContactEmail"]) ? GetString($_POST["CnContactEmail"]) : NULL;
			// for HQ contact info
			$hqContactPerson = isset($_POST["HqContactPerson"]) ? GetString($_POST["HqContactPerson"]) : NULL;
			$hqContactAddress = isset($_POST["HqContactAddress"]) ? GetString($_POST["HqContactAddress"]) : NULL;
			$hqContactTelephone = isset($_POST["HqContactTelephone"]) ? GetString($_POST["HqContactTelephone"]) : NULL;
			$hqContactFax = isset($_POST["HqContactFax"]) ? GetString($_POST["HqContactFax"]) : NULL;
			$hqContactEmail = isset($_POST["HqContactEmail"]) ? GetString($_POST["HqContactEmail"]) : NULL;
			
			// for data info
			$language = isset($_POST["Language"]) ? GetString($_POST["Language"]) : NULL;
			$collector = isset($_POST["Collector"]) ? GetSelect($_POST["Collector"]) : NULL;
			$reviewer = isset($_POST["Reviewer"]) ? GetSelect($_POST["Reviewer"]) : NULL;
			$status = isset($_POST["Status"]) ? GetSelect($_POST["Status"]) : NULL;
			$comments = isset($_POST["Comments"]) ? GetString($_POST["Comments"]) : NULL;
			
			if ($EchoTest = true)
				include("./EchoOrganizationTest.php");
			
			// store it in database
			// insert organization as following step:
			// 1. Insert cncontact
			// 2. Insert hqcontact
			// 3. Insert datainfo
			// 4. Insert organization
			// 5. Insert organization_contact
			// 6. Insert organization_datainfo
			// 7. Insert geos
			// 8. Insert assets
			// 9. Insert giving
			@$db = new mysqli("localhost", "cfs_admin", "bA55nw7H4xeDmvn2", "chinafundseeker");
			if ($errno = mysqli_connect_errno()) {
				echo "Failed to connect to database. Error number is $errno. Please contact with me: ma86jian@gmail.com";
				exit;
			}
			
			// insert cncontact
			$query = "insert into contact values (?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("isssss",
				$null = NULL,
				$cnContactPerson,
				$cnContactAddress,
				$cnContactTelephone,
				$cnContactFax,
				$cnContactEmail
			);
			$stmt->execute();
			$cnContactId = $db->insert_id;
			if ($EchoTest)
				echo "Insert contact Id = $cnContactId <br>";
			
			// insert hqcontact
			$query = "insert into contact values (?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("isssss",
				$null = NULL,
				$hqContactPerson,
				$hqContactAddress,
				$hqContactTelephone,
				$hqContactFax,
				$hqContactEmail
			);
			$stmt->execute();
			$hqContactId = $db->insert_id;
			if ($EchoTest)
				echo "Insert contact Id = $hqContactId <br>";
			
			// insert datainfo
			$query = "insert into datainfo values (?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("isssss",
				$null = NULL,
				$language,
				$collector,
				$reviewer,
				$status,
				$comments
			);
			$stmt->execute();
			$datainfoId = $db->insert_id;
			if ($EchoTest)
				echo "Insert datainfo Id = $datainfoId <br>";
			
			// insert organization
			$query = "insert into organization values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("isssssisssiiii",
				$null = NULL,
				$orgName,
				$websiteEn,
				$websiteCh,
				$orgType,
				$orginalCountry,
				$granteeType,
				$acceptPublic,
				$area,
				$subArea,
				$numOffices,
				$cnContactId,
				$hqContactId,
				$datainfoId
			);
			$stmt->execute();
			$organizationId = $db->insert_id;
			if ($EchoTest)
				echo "Insert orgnization Id = $organizationId <br>";
			
			// insert organization_contact for cnContact
			$query = "insert into organization_contact values (?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("iii",
				$null = NULL,
				$organizationId,
				$cnContactId
			);
			$stmt->execute();
			$organizationContactId = $db->insert_id;
			if ($EchoTest)
				echo "Insert organization_contact Id = $organizationContactId <br>";
			
			// insert organization_contact for hqContact
			$query = "insert into organization_contact values (?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("iii",
				$null = NULL,
				$organizationId,
				$hqContactId
			);
			$stmt->execute();
			$organizationContactId = $db->insert_id;
			if ($EchoTest)
				echo "Insert organization_contact Id = $organizationContactId <br>";
			
			// insert organization_datainfo
			$query = "insert into organization_datainfo values (?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("iii",
				$null = NULL,
				$organizationId,
				$datainfoId
			);
			$stmt->execute();
			$organizationDatainfoId = $db->insert_id;
			if ($EchoTest)
				echo "Insert organization_datainfo Id = $organizationDatainfoId <br>";
			
			// insert organization_geos
			$query = "insert into organization_geos values (?, ?, ?)";
			$stmt = $db->prepare($query);
			for ($i = 0, $len = count($geos); $i < $len; $i++) {
				$stmt->bind_param("iis",
					$null = NULL,
					$organizationId,
					$geos[$i]
				);
				$stmt->execute();
				$organizationGeoId = $db->insert_id;
				if ($EchoTest)
					echo "Insert organization_geos Id = $organizationGeoId <br>";
			}
			
			// insert organization_assets
			$query = "insert into organization_assets values (?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			for ($i = 0, $len = count($assetsYears); $i < $len; $i++) {
				$stmt->bind_param("iiii",
					$null = NULL,
					$organizationId,
					$assetsYears[$i],
					$assetsAmounts[$i]
				);
				$stmt->execute();
				$organizationAssetsId = $db->insert_id;
				if ($EchoTest)
					echo "Insert organization_assets Id = $organizationAssetsId <br>";
			}
			
			// insert organization_giving
			$query = "insert into organization_giving values (?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			for ($i = 0, $len = count($givingYears); $i < $len; $i++) {
				$stmt->bind_param("iiiii",
					$null = NULL,
					$organizationId,
					$givingYears[$i],
					$givingWorlds[$i],
					$givingChinas[$i]
				);
				$stmt->execute();
				$organizationGivingId = $db->insert_id;
				if ($EchoTest)
					echo "Insert organization_giving Id = $organizationGivingId <br>";
			}	
			$stmt->close();
			
			$db->close();
		?>
	</body>
</html>