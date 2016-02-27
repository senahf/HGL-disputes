<?php
if (isset($_POST['submit'])) {
	if (isset($_POST['name'])) {
		if (!isset($_POST['battlefy'])) {$battlefy = tsun($_POST['name']);} else { $battlefy = tsun($_POST['battlefy']);}
		$name = tsun($_POST['name']);
		$issue = tsun($_POST['issue']);
		$priority = tsun($_POST['priority']);
		#$battlefy = tsun($_POST['battlefy']);
		$sql = "INSERT INTO `issues` ( `priority`, `name`, `issue`, `status`, `battlefy` ) VALUES ( '$priority', '$name', '$issue', '1', '$battlefy' )";
		$rs = $conn->query($sql);
		if ($rs === false) {
			echo "<script>Materialize.toast('Submission Failed.', 3000, 'rounded');</script>";
		} else {
			echo "<script>Materialize.toast('Submission Successful!', 3000, 'rounded');</script>";
		}
	} else {
		echo "<script>Materialize.toast('Please fill out all the fields.', 3000, 'rounded');</script>";
	}
}
?>
<h2 class="center">Submit a Dispute</h1>
<div class="row">
  <form class="col s12" id="dispute" action="?page=form" method="post">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input name="name" id="name" type="text" class="validate">
        <label for="name">Discord Name of Person Needing Help</label>
      </div>
      <div class="input-field col s6">
        <input name="battlefy" id="last_name" type="text" class="validate" >
        <label for="last_name">Battlefy Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">mode_edit</i>
        <input name="issue" id="issue" type="text" class="validate">
        <label for="issue">Brief Description of the Issue</label>
      </div>
    </div>
    <div class="row center">
      <h5>Priority Level</h5>
      Refer to the guide here: http://insertguidehere.com/
      <p class="center">
        <input name="priority" type="radio" id="1" value="1"/>
        <label for="1">1 - Basic Stuff</label>
      </p>
      <p class="center">
        <input name="priority" type="radio" id="2" value="2"/>
        <label for="2">2 - Pretty Big Stuff</label>
      </p>
      <p class="center">
        <input name="priority" type="radio" id="3" value="3"/>
        <label for="3">3 - Requires Attention</label>
      </p>
      <p class="center">
        <input name="priority" type="radio" id="4" value="4"/>
        <label for="4"><span class="red-text">4 - Requires Immediate Attention</span></label>
      </p>
    </div>
    <div class="row center">
      <button class="btn waves-effect waves-light" type="submit" name="submit" value="submit">Submit
      <i class="material-icons right">send</i>
      </button>
    </div>
  </form>
</div>