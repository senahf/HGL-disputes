<?php
/*
 * Title: HGL Dispute Center Config
 * Author: SenaRawr#1717
 */

error_reporting(0); // Comment for "Debug" mode

/* Variables */

$baseurl = 'http://127.0.0.1/';

/* Database Deets */
$host = 'localhost';
$db = 'hgl';
$user = 'root';
$pass = '';

/* Helper Functions */

function tsun($value) {
	// Sanitizes the data; prevents most common ways of attacking
	global $host, $db, $user, $pass;
	$value = urldecode($value);
	$con = mysqli_connect($host, $user, $pass, $db); // Object-oriented would be $con->real_escape_string()
	$sec = mysqli_real_escape_string($con, $value);
	return $sec;
}

function zzz($value) {
	global $baseurl;
	return file_get_contents($baseurl . 'inc/gen.php?p=z&z=' . $value); // dumb 1-way; is aite
}

function zzz2($value) {
	$pass = zzz($value);
	$pass = sha1($pass);
	$pass2 = md5($pass);
	$pass = substr($pass, 0, 5) . 'z' . substr($pass2, 0, 5) . 'x';
	return $pass;
}

function eye21($string, $integer) // truncate text
{
	$rawr = strlen($string);
	if ($rawr < $integer) {
		return $string;
	} else {
		return substr($string, 0, $integer);

	}
}

/* Initialize MySQL */

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
	die('Cannot connect to Database');
}
?>