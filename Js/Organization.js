// JavaScript Document

const OrganizationFilePath = MetaDataDirPath + "Organization.json";

$(document).ready(function() {
	$.getJSON(OrganizationFilePath, function(data, textStatus) {
		$("td.OrgTypeList").createSelectOption(data.OrgTypeList, "OrgType");
		$("td.GranteeTypeList").createSelectOption(data.GranteeTypeList, "GranteeType");
		$("td.GeoList").createMultipleSelect(data.GeoList, "Geos");
		
		$("td.AreaList").createSelectOption(data.AreaList, "Area");
		$("td.AreaList option").click(function() {
			var subArea = $(this).text();
			$("td.SubAreaList").empty().createSelectOption(data.SubAreaList[subArea], "SubArea");
		});
		
		$("table.Assets").appendAssets();
		$("input.AddAssets").click(function() {
			$("table.Assets").appendAssets();
		});
		
		$("table.Giving").appendGiving();
		$("input.AddGiving").click(function() {
			$("table.Giving").appendGiving();
		});
		
		$("input#submit").click(function() {
			return Validate();
		});
		
		$("input#reset").click(function() {
			$("td.GeoList").empty().createMultipleSelect(data.GeoList, "Geo");
		});
	});
});

function Validate() {
	var result = true;
	
	$("td.required").each(function(index, element) {
		var value = "";
		
		if ($("input", element).length != 0) {
			value = $("input", element).val();
		} else if ($("select", element).length != 0) {
			value = $("select", element).val();
			if (value == "[ Select One ]")
				value = "";
		}
		
		if (value == "") {
			$(element).next().css("color", "red");
			result = false;
		} else
			$(element).next().css("color", "black");
	});
	
	return result;
}

var assets = 0;
$.fn.appendAssets = function() {
	var inputYear = "<input type='text' class='AssetsYearInput' name='AssetsYears[" + assets + "]' />";
	var inputAmount = "<input type='text' class='AssetsAmountInput' name='AssetsAmounts[" + assets + "]' />";
	var deleteAssets = "<input type='button' class='AssetsDeleteButton' value='Delete' />";
	var assetsTr = $("<tr>").append(MakeTd(inputYear), MakeTd(inputAmount),
						MakeTd($(deleteAssets).click(function() {
							$(assetsTr).remove();
						}))
					);
	assets++;
	
	$(this).append(assetsTr);
}

var giving = 0;
$.fn.appendGiving = function() {
	var inputYear = "<input type='text' class='GivingYearInput' name='GivingYears[" + giving + "]' />";
	var inputWorld = "<input type='text' class='GivingWorldwideInput' name='GivingWorlds[" + giving + "]' />";
	var inputChina = "<input type='text' class='GivingInChinaInput' name='GivingChinas[" + giving + "]' />";
	var deleteGiving = "<input type='button' class='GivingDeleteButton' value='Delete' />";
	var assetTr = $("<tr>").append(MakeTd(inputYear), MakeTd(inputWorld), MakeTd(inputChina),
						MakeTd($(deleteGiving).click(function() {
							$(assetTr).remove();
						}))
					);
	giving++;
	
	$(this).append(assetTr);	
}

function MakeTd(input) {
	return $("<td>").append(input);
}
