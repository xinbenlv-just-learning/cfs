<?php
	$OrgTypeList = array(
					"Corporate Donor",
					"GONGO",
					"Government Agency",
					"Intergovernmental Organization",
					"Nonprofit and Nongovernmental Organization",
					"Private Foundation",
					"Public Foundation",
				);
				
	$GeoList = array(
					"TBD",
					"China in General",
					"East China",
					"North China",
					"Northeastern China",
					"Northwestern China",
					"South China",
					"Southeastern China",
					"Southwestern China",
					"West China",
					"Anhui",
					"Beijing",
					"Chongqing",
					"Fujian",
					"Gansu",
					"Guangdong",
					"Guizhou",
					"Hainan",
					"Hebei",
					"Heilongjiang",
					"Henan",
					"Hongkong",
					"Hubei",
					"Hunan",
					"Jiangsu",
					"Jiangxi",
					"Jilin",
					"Liaoning",
					"Macau",
					"Qinghai",
					"Shaanxi",
					"Shandong",
					"Shanghai",
					"Shanxi",
					"Sichuan",
					"Tianjin",
					"Yunnan",
					"Zhejiang",
					"Guangxi",
					"Inner Mongolia",
					"Ningxia Hui",
					"Xinjiang Uighur",
					"Taiwan",
					"Tibet",
				);
	$AreaList = array(
					"Arts",
					"Child and Youth",
					"Civil Society Development",
					"Culture",
					"Disaster Response and Recovery",
					"Education",
					"Environment",
					"Ethnic Minority Culture and Development",
					"Governance, Law and Rights",
					"Health",
					"LGBT Rights",
					"People with Disabilities",
					"Religion",
					"Rural Development",
					"Science and Technology",
					"Services for Older People",
					"Social Entrepreneurship",
					"Urban Community Welfare",
					"Volunteer Placement",
					"Women",
				);
				
	$SubAreaList = array(
					"Education" => array(
										"All Subareas",
										"Early Childhood Education",
										"Elementary and Secondary Education",
										"Higher Education",
										"Vocational Training",
										"Other",
									),
									
					"Environment" => array(
										"All Subareas",
										"Animals",
										"Climate",
										"Energy",
										"Natural Resources",
										"Other",
									),
									
					"Health" => array(
										"All Subareas",
										"Cancers",
										"HIV/AIDS",
										"Mental Health",
										"Reproductive Health",
										"Other",
									),
									
					"Child and Youth" => array(
										"Child Protection",
										"Disaster Relief",
										"Education",
										"Health and Nutrition",
										"Homes and Orphanages",
										"Community Development",
									),
				);
				
	$LanguageList = array(
					"Englist",
					"Chinese",
				);
				
	$NameList = array(
					"CHEN Tracy",
					"CHEN Shangshang",
					"JIANG Shujie",
					"MA Jian",
					"PENG Hanying",
					"PENG Naiying",
					"QU Yuan",
					"SHAN Huijun",
					"SHI Fan",
					"SONG Ziwei",
					"WANG Cheng",
					"WANG Juanjuan",
					"XU Xiner",
					"YUAN Haohan",
				);
				
	$StatusList = array(
					"Collecting",
					"To Be Reviewed",
					"Reviewing",
					"Reviewed",
					"Revising",
					"Complete",
				);
				
	
	function CreateSelectOptions($optionlist, $default = false, $mutiple = 0) {
		if ($mutiple > 0)
			echo "<select multiple='multiple' size='$mutiple'>";
		else
			echo "<select>";
		
		if (!$default)
			echo "<option></option>";
		foreach ($optionlist as $option)
			echo "<option>$option</option>";
		echo "</select>";
	}
?>
