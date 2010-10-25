// JavaScript Document

var DataInfoFilepath = MetaDataDirPath + "DataInfo.json";

$(document).ready(function() {
	$.getJSON(DataInfoFilepath, function(data, textStatus) {
		$("td.LanguageList").createSelectOption(data.LanguageList, false);
		$("td.NameList").createSelectOption(data.NameList);
		$("td.StatusList").createSelectOption(data.StatusList);
	});
});
