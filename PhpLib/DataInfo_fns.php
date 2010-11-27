<?php
	require_once("../PhpLib/Default.php");
	
	function display_language($language, $language_list) {
		$language_list_html = create_select_option($language, $language_list, "Language", false);
		
echo <<< LANGUAGE
		<tr>
			<td class="first"> Language </td>
			<td class="first LanguageList">
				$language_list_html
			</td>
			<td> </td>
		</tr>
LANGUAGE;
	}
	
	function display_collector($collector, $collector_list) {
		$collector_list_html = create_select_option($collector, $collector_list, "Collector");
		
echo <<< COLLECTOR
		<tr>
			<td class="first"> Collector </td>
			<td class="first required NameList Collector">
				$collector_list_html
			</td>
			<td class="first"> Required </td>
		</tr>
COLLECTOR;
	}
	
	function display_reviewer($reviewer, $reviewer_list) {
		$reviewer_list_html = create_select_option($reviewer, $reviewer_list, "Reviewer");
		
echo <<< REVIEWER
		<tr>
			<td class="first"> Reviewer </td>
			<td class="first NameList Reviewer">
				$reviewer_list_html
			</td>
			<td> </td>
		</tr>
REVIEWER;
	}
	
	function display_status($status, $status_list) {
		$status_list_html = create_select_option($status, $status_list, "Status");
		
echo <<< STATUS
		<tr>
			<td class="first"> Status </td>
			<td class="first required StatusList">
				$status_list_html
			</td>
			<td class="first"> Required </td>
		</tr>
STATUS;
	}
	
	function display_comments($comments) {
echo <<< DATAINFO
		<tr>
			<td class="first"> Comments </td>
			<td class="first">
				<textarea name="Comments" rows="5">$comments</textarea>
			</td>
			<td> </td>
		</tr>
DATAINFO;
	}
	
	function display_datainfo($datainfo) {
		$datainfo_json = json_decode(file_get_contents(JSON_DATAINFO_FILE));
		
		display_language($datainfo["language"], $datainfo_json->LanguageList);
		display_collector($datainfo["collector"], $datainfo_json->NameList);
		display_reviewer($datainfo["reviewer"], $datainfo_json->NameList);
		display_status($datainfo["status"], $datainfo_json->StatusList);
		display_comments($datainfo["comments"]);		
	}
?>