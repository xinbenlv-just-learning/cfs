<?php
	require_once("../PhpLib/Default.php");
	
	function display_login_form_header($actionPhp) {
echo <<< FORM_HEADER
		<form id="login" action="./$actionPhp" method="post">
FORM_HEADER;
	}
	
	function display_login_form_body() {
echo <<< FORM_BODY
			<table>
				<tbody>
					<tr>
						<td> Username: </td>
						<td> <input type="text" name="username" /> </td>
					</tr>
					
					<tr>
						<td> Password: </td>
						<td> <input type="password" name="password" /> </td>
					</tr>
				</tbody>
			</table>
FORM_BODY;
	}
	
	function display_login_form_footer() {
echo <<< FORM_FOOTER
			<input type="submit" id="submit" value="Submit" />
			<input type="reset" id="reset" value="Reset" />
		</form>
FORM_FOOTER;
	}
	
	function display_login_form($actionPhp) {
		display_login_form_header($actionPhp);
		display_login_form_body();
		display_login_form_footer();
	}
?>