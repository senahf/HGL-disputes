<?php
/*
 * Title: dumb 1-way
 * Author: SenaRawr#1717
 */

error_reporting(0); /*
	 * Title: HGL Dispute Center Config
	 * Author: SenaRawr#1717
*/

$authorized = array("127.0.0.1"); // forget bruteforce

if (!in_array($_SERVER["REMOTE_ADDR"], $authorized)) {
	die('rawr');
}
if (!$_GET['p'] == "z") {
	die('rawr');
}
#exit;
if ($_GET['z']) {
	$pass = $_GET['z'];
	$pass = sha1($pass);
	$pass2 = md5($pass);
	$pass = substr($pass, 0, 5) . 'z' . substr($pass2, 0, 5) . 'x';
	$switch = substr($pass, 0, 1);

	switch ($switch) {
	case '1':
	case '6':
		echo 'Macklee-' . $pass;
		break;
	case '2':
	case '9':
		echo 'Abstract-' . $pass;
		break;
	case '3':
	case '7':
		echo 'Rawr-' . $pass;
		break;
	case '4':
		echo 'Ayy-' . $pass;
		break;
	case '5':
	case '8':
		echo 'Lmao-' . $pass;
		break;
	case 'A':
	case 'a':
		echo 'xDD-' . $pass;
		break;
	case 'B':
	case 'b':
		echo 'Winters-' . $pass;
		break;
	case 'C':
	case 'c':
		echo 'Jerom-' . $pass;
		break;
	default:
		echo 'HGL-' . $pass;
		break;
	}
}
?>