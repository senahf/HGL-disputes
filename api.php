<?php
error_reporting(0); // Comment for debug mode

if ($_GET['rawr'] !== 'rawr') {
	die('bye felicia');
}
/* TWITTER POLLING *don't think I'll be using it*
require_once('TwitterAPIExchange.php');
$settings = array(
'oauth_access_token' => "",
'oauth_access_token_secret' => "",
'consumer_key' => "",
'consumer_secret' => ""
);*/

// HGL Admin Chat ID: 104316392756498432
// HGL-fd128zf7b75x \\
include_once 'inc/config.php'; // Use of helper functions and such
// Global Variables
$uid = tsun($_GET['uid']); // Discord User ID
$cid = tsun($_GET['cid']); // Discord Chat ID
$admin = 'false';
$mod = 'false';
$cmd = tsun($_GET['cmd']);
$acmd = tsun($_GET['acmd']);
$sql = "SELECT * FROM `staff` WHERE `uid` = {$uid}";
$rs = $conn->query($sql);
$row = $rs->fetch_array(MYSQLI_ASSOC);
$name = $row['name'];
// Auth
$sql = "SELECT * FROM `staff` WHERE `uid` = {$uid} AND `admin` > 0";
$rs = $conn->query($sql);
if ($rs === 'false') {
	$mod = 'false';
	$admin = 'false';
} else {
	$row = $rs->fetch_array(MYSQLI_ASSOC);
	if ($row['admin'] == 2) {
		$mod = 'false';
		$admin = 'true';
	} elseif ($row['admin'] == 3) {
		$mod = 'true';
		$admin = 'false';
	}
}
if ($_GET['acmd'] && $admin == 'true') {
	switch ($acmd) {
	case 'handle': // Handle Case
		$id = $_GET['id'];
		$sql = "UPDATE `issues` SET `status`='2', `admin`='{$name}' WHERE `id`={$id}";
		if ($conn->query($sql) === false) {
			echo 'HGL-fd128zf7b75x';
		} else {
			echo 'HGL-fb360z5211ex';
		}
		break;
	case 'close':
		$id = $_GET['id'];
		$sql = "UPDATE `issues` SET `status`='3', `admin`='{$name}' WHERE `id`={$id}";
		if ($conn->query($sql) === false) {
			echo 'HGL-fd128zf7b75x';
		} else {
			echo 'HGL-fb360z5211ex';
		}
		break;
	case 'reopen':
		$id = $_GET['id'];
		$sql = "UPDATE `issues` SET `status`='2', `admin`='{$name}' WHERE `id`={$id}";
		if ($conn->query($sql) === false) {
			echo 'HGL-fd128zf7b75x';
		} else {
			echo 'HGL-fb360z5211ex';
		}
		break;
	}
} elseif ($_GET['cmd']) {
	switch ($cmd) {
	case 'rss':
		$sql = "SELECT * FROM `issues` WHERE `notified` = 0 AND `verified` > 0";
		$rs = $conn->query($sql);
		if ($rs->num_rows == '0') {
			echo 'HGL-fd128zf7b75x';
		} else {
			$row = $rs->fetch_array(MYSQLI_ASSOC);
			echo $row['name'];
		}
		break;
	case 'rss2':
		$user = tsun($_GET['user']);
		$sql = "SELECT * FROM `issues` WHERE `notified` = 0 AND `verified` > 0 AND `name` = '{$user}'";
		$rs = $conn->query($sql);
		if ($rs->num_rows == '0') {
			echo 'HGL-fd128zf7b75x';
		} else {
			$row = $rs->fetch_array(MYSQLI_ASSOC);
			$idz = $row['id'];
			$time = strtotime($row['date']);
			$time = date("m/d/y g:i A", $time);
			echo '**Dispute #' . $row['id'] . " Priority " . $row['priority'] . "** \r\n" . 'Discord Name: ' . $row['name'] . "\r\nBrief Description: `" . $row['issue'] . "`\r\nTime: " . $time . " PST\r\nBattlefy Name: " . $row['battlefy'];
			$conn->query("UPDATE `issues` SET `notified` = '1' WHERE `id`={$idz}");
		}
		break;
	case 'dname':
		$id = tsun($_GET['id']);
		$sql = "SELECT * FROM `issues` WHERE `id` = '{$id}'";
		$rs = $conn->query($sql);
		$row = $rs->fetch_array(MYSQLI_ASSOC);
		echo $row['name'];
		break;
	case 'auth':
		if ($mod || $admin) {
			echo 'HGL-fb360z5211ex';
		} else {
			echo 'HGL-fd128zf7b75x';
		}
		break;
	case 'verify':
		$uname = tsun($_GET['name']);
		$token = tsun($_GET['token']);
		$sql = "SELECT * FROM `issues` WHERE `token` = '{$token}'";
		$rs = $conn->query($sql);
		$row = $rs->fetch_array(MYSQLI_ASSOC);
		if ($row['verified'] > 0) {
			echo "Your token has already been verified. Please check to see if the dispute has been published and if it hasn't, then resubmit a new form.";
		}
		$sql = "SELECT * FROM `issues` WHERE `token` = '{$token}' AND `verified` = '0'";
		$rs = $conn->query($sql);
		if ($rs === false) {
			echo "Your token doesn't exist. Please try resubmitting the form \r\n http://hlg.payn.us/";
		} else {
			$row = $rs->fetch_array(MYSQLI_ASSOC);
			if ($row['name'] == $uname) {
				echo "HGL-fb360z5211ex";
				$conn->query("UPDATE `issues` SET `verified` = '1' WHERE `token`='{$token}'");
			} else {
				echo "Your name and token don't match! Try resubmitting the form with your exact Discord name.";
				$conn->query("UPDATE `issues` SET `verified` = '2' WHERE `token`='{$token}'");
			}
		}
		break;
	}
}
?>