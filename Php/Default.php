<?php
	$isGpc = get_magic_quotes_gpc();
	
	// check $str is set before GetString
	function GetString($str) {
		if (is_string($str)) {
			global $isGpc;
			if (!$isGpc)
				$str = addslashes(trim($str));
		}
		return $str;
	}
	
	// check $select is set before GetSelection
	function GetSelect($select) {
		$select = GetString($select);
		if ($select == "[ Select One ]")
			$select = NULL;
		
		return $select;
	}
	
	function EchoId($db, $table) {
		echo "Insert $table Id = $db->insert_id <br>";
	}
?>
