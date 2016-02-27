<?php
/*
 * Title: HGL Dispute Center Index
 * Author: SenaRawr#1717
 */
include_once 'inc/config.php'; // Initialize Configs
$page = tsun(@$_GET['page']);
switch ($page) {
case "resolved":
	$pagename = "Resolved Disputes";
	$getpage = "resolved";
	break;
case "form":
	$pagename = "Submit Dispute";
	$getpage = "form";
	break;
case "index":
case "active":
case null:
	$pagename = "Active Disputes";
	$getpage = "active";
	break;
}
include_once 'inc/head.php';
include_once 'pages/' . tsun($getpage) . '.php';
include_once 'inc/footer.php';
?>