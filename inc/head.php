<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <title><?php echo $pagename; ?> - HGL</title>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <!-- Nav -->
    <div class="navbar-fixed">
      <nav class="blue-grey darken-1">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo center">HGL Dispute Center</a>
          <ul class="left hide-on-med-and-down">
            <li><a href="http://hearthgamingleague.com/">HGL Home</a></li>
            <li<?php if ($getpage == "active") {echo ' class="active"';}
?>><a href="?page=active">Disputes</a></li>
              <li<?php if ($getpage == "resolved") {echo ' class="active"';}
?>><a href="?page=resolved">Resolved Disputes</a></li>
              </ul>
              <ul class="right hide-on-med-and-down">
                <li><a href="?page=form">Add Dispute</a></li>
                <li><a class="modal-trigger" href="#login">Staff Login</a></li>
              </ul>
            </div>
          </nav>
        </div>
        <br>
        <?php
$open = 'SELECT * FROM `issues` WHERE `status` = 1 AND `verified` = 1';
$inprogress = 'SELECT * FROM `issues` WHERE `status` = 2';
$resolved = 'SELECT * FROM `issues` WHERE `status` = 3';
$rs = $conn->query($open);
$rs2 = $conn->query($inprogress);
$rs3 = $conn->query($resolved);
if ($rs === false) {
} else {
	$open = $rs->num_rows;
}
if ($rs2 === false) {
} else {
	$inprogress = $rs2->num_rows;
}
if ($rs3 === false) {
} else {
	$resolved = $rs3->num_rows;
}
?>
        <!-- Info Bars -->
        <div class="row">
          <div class="col s12 m6 l3">
            <div class="card red darken-1">
              <div class="card-content white-text" style="text-align: center;">
                <span class="card-title"><i class="mdi-action-announcement"></i><strong><?php echo $open; ?></strong><br>Open Disputes</span>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <div class="card blue darken-1">
              <div class="card-content white-text" style="text-align: center;">
                <span class="card-title"><i class="mdi-editor-insert-emoticon"></i><strong><?php echo $inprogress; ?></strong><br>Disputes in Progress</span>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <div class="card teal darken-1">
              <div class="card-content white-text" style="text-align: center;">
                <span class="card-title"><i class="mdi-action-done"></i><strong><?php echo $resolved; ?></strong><br>Resolved Disputes</span>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text" style="text-align: center;">
                <span class="card-title"><i class="mdi-social-group-add"></i><strong>100</strong><br>Page Views</span>
              </div>
            </div>
          </div>