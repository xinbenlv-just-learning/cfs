// JavaScript Document

$(document).ready(function() {
	RegisterMultiple();
	
	var jsonSubareaList = $.parseJSON($("span#JsonSubareaList").text());
	$("td.AreaList select").change(function() {
		var area = $("option:selected", this).text().trim();
		$("td.SubareaList").empty().createMultipleSelect(jsonSubareaList[area], "Subareas");
	});
	
	$("input.AddAssets").click(function() {
		$("table.Assets").appendAssets();
	});
	
	$("input.AddGiving").click(function() {
		$("table.Giving").appendGiving();
	});
	
	$("input#submit").click(function() {
		// when posting, every option in selected must be selected
		$(".Multiple select.Selected option").attr("selected", "selected");
		
		return Validate();
	});
});

function RegisterMultiple() {
	$("div.Multiple").each(function(indexSelect, elementSelect) {
		var sourceSelect = $("select.Source", this);
		var selectedSelect = $("select.Selected", this);
		
		$(".AddButton", this).click(function() {
			$("option:selected", sourceSelect).each(function(index, element) {
				selectedSelect.append(element);
			});
		});
		
		$(".AddAllButton", this).click(function() {
			selectedSelect.append($("option", sourceSelect).attr("selected", "selected"));
		});
		
		$(".RemoveButton", this).click(function() {
			$("option:selected", selectedSelect).each(function(index, element) {
				sourceSelect.append(element);
			});
		});
		
		$(".RemoveAllButton", this).click(function() {
			sourceSelect.append($("option", selectedSelect).attr("selected", "selected"));
		});
	});
}

$.fn.appendAssets = function() {
	var inputYear = "<input type='text' class='AssetsYearInput' name='AssetsYears[]' />";
	var inputAmount = "<input type='text' class='AssetsAmountInput' name='AssetsAmounts[]' />";
	var deleteAssets = "<input type='button' class='AssetsDeleteButton' value='Delete' />";
	var assetsTr = $("<tr>").append(
						MakeTd(inputYear),
						MakeTd(inputAmount),
						MakeTd($(deleteAssets).click(function() {
							$(assetsTr).remove();
						}))
					);
	
	$(this).append(assetsTr);
}

$.fn.appendGiving = function() {
	var inputYear = "<input type='text' class='GivingYearInput' name='GivingYears[]' />";
	var inputWorld = "<input type='text' class='GivingWorldwideInput' name='GivingWorlds[]' />";
	var inputChina = "<input type='text' class='GivingInChinaInput' name='GivingChinas[]' />";
	var deleteGiving = "<input type='button' class='GivingDeleteButton' value='Delete' />";
	var assetTr = $("<tr>").append(
						MakeTd(inputYear),
						MakeTd(inputWorld),
						MakeTd(inputChina),
						MakeTd($(deleteGiving).click(function() {
							$(assetTr).remove();
						}))
					);
	
	$(this).append(assetTr);	
}

function MakeTd(input) {
	return $("<td>").append(input);
}
