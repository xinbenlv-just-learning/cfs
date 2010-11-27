<?php
	define("JSON_ORG_FILE", "./MetaData/Organization.json");
	define("JSON_DATAINFO_FILE", "./MetaData/DataInfo.json");
	define("JSON_GRANT_FILE", "./MetaData/Grant.json");

	define("DB_NAME", "chinafundseeker");
	define("DB_ADMIN", "cfs_admin");
	define("DB_PSWD", "bA55nw7H4xeDmvn2");
	
	define("SELECT_HINT", "[ Select One ]");
	
	define("VALID_USER", "valid_user");
	
	$isGpc = get_magic_quotes_gpc();
	
	// check $str is set before GetString
	function FilterString($str) {
		if (is_string($str)) {
			global $isGpc;
			if (!$isGpc)
				$str = addslashes(trim($str));
		}
		return $str;
	}
	
	function GetOriginalString($str) {
		if (is_string($str)) {
			global $isGpc;
			if (!$isGpc)
				$str = stripslashes(trim($str));
		}
		return $str;
	}
	
	// check $select is set before GetSelection
	function FilterSelect($select) {
		if ($select == SELECT_HINT)
			$select = NULL;
		
		return $select;
	}
	
	function EchoId($db, $table) {
		echo "Insert $table Id = $db->insert_id <br>";
	}
	
	function CreateTd($element) {
		echo "<td> $element </td>";
	}
	
	
	function display_html_header($title, $cssFiles = NULL) {
		$cssHtml = "";
		if (is_array($cssFiles)) {
			foreach ($cssFiles as $cssFile) {
				$cssHtml .= "<link rel='stylesheet' type='text/css' href='./Css/$cssFile' />";
			}
		}
		
echo <<< HEADER
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title> $title </title>
			$cssHtml
		</head>
HEADER;
	}
	
	function display_user() {
		StartSession();
		$username = isset($_SESSION[VALID_USER]) ? $_SESSION[VALID_USER] : "Guest";
echo <<< USER
		<div id="UserBar"> 
			<p> Hi, $username! </p>
			<a href="./ProcessLogin.php?action=logout"> Logout </a>
		</div>
USER;
	}
	
	function display_index_link() {
echo <<< INDEX_LINK
		<a href="./index.php"> Return to Main Page </a>
		<br>
INDEX_LINK;
	}
	
	function display_html_footer($jsFiles = NULL) {
		$jsHtml = "";
		if (is_array($jsFiles)) {
			foreach ($jsFiles as $jsFile) {
				$jsHtml .= "<script type='text/javascript' src='./Js/$jsFile'></script>";
			}
		}
		
echo <<< FOOTER
		$jsHtml
	</html>
FOOTER;
	}
	
	function connect_db() {
		@$db = new MySQLi("localhost", DB_ADMIN, DB_PSWD, DB_NAME);
		if (mysqli_connect_errno()) {
			throw new Exception("Error: Could not Connect to Database.");
		}
		return $db;
	}
	
	function create_select_option($selected, $option_list, $name, $is_add_empty = true) {
		$list_html = "<select name='$name'>";
		if ($is_add_empty)
			$list_html .= "<option> ".SELECT_HINT." </option>";
		if ($option_list != NULL && count($option_list) > 0) {
			foreach ($option_list as $option) {
				if ($option == $selected)
					$list_html .= "<option selected='selected'> $option </option>";
				else
					$list_html .= "<option> $option </option>";
			}
		}
		$list_html .= "</select>";
		return $list_html;
	}
	
	function create_multiple_select_option($selecteds, $option_list, $name) {
		$list_source_html = "<select class='Source' multiple='multiple' size='10'>";
		$list_selected_html = "<select class='Selected' multiple='multiple' size='10' name='".$name."[]'>";
		
		foreach ($option_list as $option) {
			if (in_array($option, $selecteds))
				$list_selected_html .= "<option> $option </option>";
			else
				$list_source_html .= "<option> $option </option>";
		}
		$list_source_html .= "</select>";
		$list_selected_html .= "</section>";
		
		$button_add_html = "<input type='button' class='AddButton' value='>' />";
		$button_add_all_html = "<input type='button' class='AddAllButton' value='>>' />";
		$button_remove_html = "<input type='button' class='RemoveButton' value='<' />";
		$button_remove_all_html = "<input type='button' class='RemoveAllButton' value='<<' />";
		
		$list_html = 	"<div class='Multiple'>
							$list_source_html
							<div>
								$button_add_html
								$button_add_all_html
								$button_remove_html
								$button_remove_all_html
							</div>
							$list_selected_html
						</div>";
		
		return $list_html;
	}
	
	function output($obj) {
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}
	
	function isEmpty($array) {
		foreach ($array as $element)
			if ($element != NULL)
				return false;
		
		return true;
	}
	
	// for user account management
	function RedirectHtml($displayMessage, $errorMessage = "Login First!", $target = "Login.php", $timeout = 3) {
		if ($errorMessage != NULL)
			$url = "./$target?error=$errorMessage";
		else
			$url = "./$target";
		
echo <<< REDIRECT
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Refresh" content="$timeout; url=$url" />
				<title> Jump to $target </title>
			</head>
			<body>
				$displayMessage
				<br>
				Jump to $target automatically in $timeout seconds
			</body>
		</html>
REDIRECT;
	}
	
	function ValidateUser($isShowError = true) {
		StartSession();
		if (!isset($_SESSION[VALID_USER])) {
			if ($isShowError)
				RedirectHtml("Invalid User", "Login First!", "Login.php");
			else
				RedirectHtml(NULL, NULL, "Login.php", 0);
			exit();
		}
	}
	
	function StartSession() {
		if (!session_id())
			session_start();
	}
?>
