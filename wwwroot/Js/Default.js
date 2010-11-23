// JavaScript Document

const SELECT_HINT = "[ Select One ]";


$.fn.createSelectOption = function(list, name, isAddEmpty) {
	var selection = $("<select>").attr("name", name);
	
	$(this).append(selection.createOptions(list, isAddEmpty));
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

$.fn.createOptions = function (list, isAddEmpty) {
	isAddEmpty = (isAddEmpty != undefined) ? isAddEmpty : true;
	
	var selection = $(this);
	if (isAddEmpty)
		selection.append($("<option>").append(SELECT_HINT));
	
	if (!IsNullOrUndefined(list)) {
		$.each(list, function(index, element) {
			selection.append(
				$("<option>").append(element)
			);
		});
	}
	
	return $(this);
}

function Validate() {
	var result = true;
	
	$("td.required").each(function(index, element) {
		var value = "";
		
		if ($("input", element).length != 0) {
			value = $("input", element).val();
		} else if ($("select", element).length != 0) {
			value = $("select", element).val();
			if (value == SELECT_HINT)
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

function IsNullOrUndefined(obj) {
	return obj === null || obj === undefined;
}
