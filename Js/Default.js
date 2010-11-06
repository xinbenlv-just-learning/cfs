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
	var selected = $('<select class="Selected" multiple="multiple" size="10">');
	
	var buttonAdd = $('<input type="button">').attr("value", ">");
	var buttonAddAll = $('<input type="button">').attr("value", ">>");
	var buttonRemove = $('<input type="button">').attr("value", "<");
	var buttonRemoveAll = $('<input type="button">').attr("value", "<<");
	var buttons = $("<div>").append(buttonAdd, buttonAddAll, buttonRemove, buttonRemoveAll);
	
	buttonAdd.click(function() {
		var add = $("option:selected", source);
		
		add.each(function(index, element) {
			selected.append(
				element,
				$("<input type='hidden' name='" + name + "[]' value='" + element.text + "'>")
			);
		});
	});
	
	buttonAddAll.click(function() {
		$("option", source).attr("selected", "selected");
		buttonAdd.click();
	});
	
	buttonRemove.click(function() {
		var remove = $("option:selected", selected);
		
		remove.each(function(index, element) {
			$(element).next().remove();
			source.append(element);
		});
	});
	
	buttonRemoveAll.click(function() {
		$("option", selected).attr("selected", "selected");
		buttonRemove.click();
	});
	
	return $(this).append(
		$("<div class='Multiple'>").append(source, buttons, selected)
	);
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
