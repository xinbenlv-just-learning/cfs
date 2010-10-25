// JavaScript Document

const DataInfoFilepath = MetaDataDirPath + "DataInfo.json";

$(document).ready(function() {
	$.getJSON(DataInfoFilepath, function(data, textStatus) {
		$("td.LanguageList").createSelectOption(data.LanguageList, "Language", false);
		$("td.NameList").createSelectOption(data.NameList, "Name");
		$("td.Collector select").attr("name", "Collector");
		$("td.Reviewer select").attr("name", "Reviewer");
		$("td.StatusList").createSelectOption(data.StatusList, "Status");
	});
});
