<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Login </title>
		<link rel="stylesheet" type="text/css" href="./Css/Default.css" />
	</head>

	<body>
		<form id="login" action="./Php/ProcessLogin.php" method="post">
			<table>
				<tbody>
					<tr>
						<td> Name: </td>
						<td> <input /> </td>
					</tr>
					
					<tr>
						<td> Password: </td>
						<td> <input /> </td>
					</tr>
				</tbody>
			</table>
			
			<input type="submit" id="submit" value="Submit" />
			<input type="reset" id="reset" value="Reset" />
		</form>
	</body>
</html>