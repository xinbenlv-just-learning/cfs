// JavaScript Document

const OrganizationFilepath = MetaDataDirPath + "Organization.json";

$(document).ready(function() {
	$.getJSON(OrganizationFilepath, function(data, textStatus) {
		$("td.OrgTypeList").createSelectOption(data.OrgTypeList, "OrgType");
		$("td.GeoList").createMultipleSelect(data.GeoList, "Geo");
		
		$("td.AreaList").createSelectOption(data.AreaList, "Area");
		$("td.AreaList option").click(function() {
			var subArea = $(this).text();
			$("td.SubAreaList").empty().createSelectOption(data.SubAreaList[subArea], "SubArea");
		});
		
		
		$("#submit").click(function() {
			return Validate();
		});
		
		$("#reset").click(function() {
			$("td.GeoList").empty().createMultipleSelect(data.GeoList, "Geo");
		});
	});
});

function Validate() {
	return true;
}
