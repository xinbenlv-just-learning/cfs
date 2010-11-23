// JavaScript Document

const GrantFilePath = MetaDataDirPath + "Grant.json";

$(document).ready(function() {
	$.getJSON(GrantFilePath, function(data, textStatus) {
		$("td.FrequencyList").createSelectOption(data.FrequencyList, "Frequency");
	});
});
