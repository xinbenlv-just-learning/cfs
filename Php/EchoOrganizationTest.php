<?php
	echo "OrgName = $orgName <br>";
	echo "WebsiteEn = $websiteEn <br>";
	echo "WebsiteCh = $websiteCh <br>";
	echo "OrgType = $orgType <br>";
	// echo for geo (multiple choices)
	$len = count($geos);
	for ($i = 0; $i < $len; $i++) {
		echo "Geo = $geos[$i] <br>";
	}
	
	echo "OriginalCountry = $orginalCountry <br>";
	echo "GranteeType = $granteeType <br>";
	echo "AcceptPublic = $acceptPublic <br>";
	echo "Area = $area <br>";
	echo "SubArea = $subArea <br>";
	
	// echo for assets
	$len = count($assetsYears);
	for ($i = 0; $i < $len; $i++) {
		echo "AssetsYear = $assetsYears[$i] : AssetsAmount = $assetsAmounts[$i] <br>";
	}
	
	// echo for giving
	$len = count($givingYears);
	for ($i = 0; $i < $len; $i++) {
		echo "GivingYear = $givingYears[$i] : GivingWorld = $givingWorlds[$i] : GivingChina = $givingChinas[$i] <br>";
	}
	
	echo "NumOffices = $numOffices <br>";
	
	// echo for China office contact info
	echo "CnContactPerson = $cnContactPerson <br>";
	echo "CnContactAddress = $cnContactAddress <br>";
	echo "CnContactTelephone = $cnContactTelephone <br>";
	echo "CnContactFax = $cnContactFax <br>";
	echo "CnContactEmail = $cnContactEmail <br>";
	
	// echo for HQ contact info
	echo "HqContactPerson = $hqContactPerson <br>";
	echo "HqContactAddress = $hqContactAddress <br>";
	echo "HqContactTelephone = $hqContactTelephone <br>";
	echo "HqContactFax = $hqContactFax <br>";
	echo "HqContactEmail = $hqContactEmail <br>";
	
	// echo for datainfo
	echo "Language = $language <br>";
	echo "Collector = $collector <br>";
	echo "Reviewer = $reviewer <br>";
	echo "Status = $status <br>";
	echo "Comments = $comments <br>";
?>