// JavaScript Document

var OrganizationFilepath = MetaDataDirPath + "Organization.json";

$(document).ready(function() {
	$.getJSON(OrganizationFilepath, function(data, textStatus) {
		$("td.OrgTypeList").createSelectOption(data.OrgTypeList);
		$("td.GeoList").createMultipleSelect(data.GeoList);
		
		$("td.AreaList").createSelectOption(data.AreaList);
		$("td.AreaList option").click(function() {
			var subArea = $(this).text();
			$("td.SubAreaList").empty().createSelectOption(data.SubAreaList[subArea]);
		});
	});
});
