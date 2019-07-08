<?php
// sanitise the data to remove the whitespace and unwanted charachters
function testUserInput($data) {
	$data = trim ($data);
	$data= stripslashes ($data);
	$data = htmlspecialchars ($data);
	return $data;
}
?>