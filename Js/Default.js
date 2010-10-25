// JavaScript Document

const MetaDataDirPath = "./MetaData/";


$.fn.createSelectOption = function(list, name, isAddEmpty) {
	if (IsNullOrUndefined(list))
		return;
	
	isAddEmpty = (isAddEmpty != undefined) ? isAddEmpty : true;
	
	var selection = $("<select>").attr("name", name);
	if (isAddEmpty) {
		selection.append("<option>[ Select One ]</option>");
	}
	
	$(this).append(selection.createOptions(list));
}

$.fn.createMultipleSelect = function(list, name) {
	if (IsNullOrUndefined(list))
		return;
	
	var source = $('<select class="Source" multiple="multiple" size="10">').createOptions(list);
	var selected = $('<select class="Selected" multiple="multiple" size="10">').attr("name", name)
	
	var buttonAdd = $('<input type="button">').attr("value", ">");
	var buttonAddAll = $('<input type="button">').attr("value", ">>");
	var buttonRemove = $('<input type="button">').attr("value", "<");
	var buttonRemoveAll = $('<input type="button">').attr("value", "<<");
	var buttons = $("<div>").append(buttonAdd, buttonAddAll, buttonRemove, buttonRemoveAll);
	
	buttonAdd.click(function() {
		selected.append($("option:selected", source));
	});
	
	buttonAddAll.click(function() {
		selected.append($("option", source).attr("selected", "selected"));
	});
	
	buttonRemove.click(function() {
		source.append($("option:selected", selected));
	});
	
	buttonRemoveAll.click(function() {
		source.append($("option", selected).attr("selected", "selected"));
	});
	
	return $(this).addClass("Mutiple").append(source, buttons, selected);
}

$.fn.createOptions = function (list) {
	if (IsNullOrUndefined(list))
		return;
	
	var selection = $(this);
	$.each(list, function(index, element) {
		selection.append(
			$("<option>").append(element)
		);
	});
	return $(this);
}

function IsNullOrUndefined(obj) {
	return obj === null || obj === undefined;
}
