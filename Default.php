<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Untitled Document</title>
	</head>

	<body>
		<?php
			$isGpc = get_magic_quotes_gpc();
			
			function GetValue($data) {
				if (IsNullOrUndefined($data))
					$data = 0;
				
				global $isGpc;
				$data = trim($data);
				if (!$isGpc)
					$data = addslashes($data);
				
				return $data;
			}
			
			function IsNullOrUndefined($data) {
				return $data == NULL;
			}
			
			function CreateTd($td) {
				echo "<td>";
				echo $td;
				echo "</td>";
			}
		?>
	</body>
</html>