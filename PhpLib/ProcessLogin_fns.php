<?php
	require_once("../PhpLib/Default.php");
	
	function Login($username, $password) {
		StartSession();
		$db = connect_db();
		$sha1 = sha1($password);
		$query = sprintf("SELECT * FROM user WHERE username = '%s' and password = '%s'", $username, $sha1);
		$result = $db->query($query);
		if ($isSuccess = ($result != NULL && $result->num_rows > 0))
			$_SESSION[VALID_USER] = $username;
		$db->close();
		
		return $isSuccess;
	}
	
	function Logout() {
		StartSession();
		if (isset($_SESSION[VALID_USER])) {
			unset($_SESSION[VALID_USER]);
			return true;
		}
		else
			return false;
	}
?>