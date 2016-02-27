<?php
require_once 'inc/autoload.php';
// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = '6LcWYhgTAAAAAD0F1dx9_a7YtKa2ScXYpUmutUTj';
$secret = '6LcWYhgTAAAAAAFy7x_4wzjCg8k6WAiHOJqxUOec';

$pending = false;
if (isset($_POST['submit']) && isset($_POST['g-recaptcha-response'])) {
	if (isset($_POST['name'])) {
		$recaptcha = new \ReCaptcha\ReCaptcha($secret);
		$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
		if ($resp->isSuccess()):
			if ($_POST['battlefy'] == "") {
				$battlefy = tsun($_POST['name']);} else { $battlefy = tsun($_POST['battlefy']);}
//Small Dictionary
			if ($_POST['issue'] == 1) {
				$issue = "It has been 10 minutes and my opponent is not here. I have also typed in Battlefy chat.";
				$priority = 1;}
			if ($_POST['issue'] == 2) {
				$issue = "My opponent disconnected from the match and I have screenshots to prove so.";
				$prioriity = 2;}
			if ($_POST['issue'] == 3) {
				$issue = "My opponent disconnected and I have not heard from him/her for at least 5 minutes now.";
				$priority = 3;}
			if ($_POST['issue'] == 4) {
				$issue = "My opponent disconnected and came back, what do we do from here?";
				$prioriity = 3;}
			if ($_POST['issue'] == 5) {
				$issue = "My opponent canceled the challenge and I have a screenshot to prove it.";
				$priority = 3;}
			if ($_POST['issue'] == 6) {
				$issue = "My opponent played a class he didn't choose in Battlefy and I have a screenshot.";
				$priority = 3;}
			if ($_POST['issue'] == 7) {
				$issue = "My opponent has more than one deck of each unique class.";
				$priority = 2;}
			if ($_POST['issue'] == 8) {
				$issue = "My opponent is refusing to giving me a screenshot of his deck selection screen.";
				$priority = 2;}
			if ($_POST['issue'] == 9) {
				$issue = "My opponent reported a false score.";
				$priority = 3;}
			if ($_POST['issue'] == 10) {
				$issue = "We didn't even play yet and my opponent reported that he won.";
				$priority = 4;}
			if ($_POST['issue'] == 11) {
				$issue = "Battlefy advanced my opponent even though I won.";
				$priority = 4;}
			if ($_POST['issue'] == 12) {
				$issue = "My opponent is being very toxic (showing low sportsmanship).";
				$priority = 1;}
			if ($_POST['issue'] == 13) {
				$issue = "[Other] None of the above apply to me.";
				$priority = 2;}
			$name = tsun($_POST['name']);
#$battlefy = tsun($_POST['battlefy']);
			$gentoken = zzz2(uniqid(rand(), true));
			$sql = "INSERT INTO `issues` ( `priority`, `name`, `issue`, `status`, `battlefy`, `token` ) VALUES ( '$priority', '$name', '$issue', '1', '$battlefy', '$gentoken' )";
			$rs = $conn->query($sql);
			if ($rs === false) {
				echo "<script>Materialize.toast('Submission Failed.', 3000, 'rounded');</script>";
			} else {
				echo "<script>Materialize.toast('Submission pending!', 3000, 'rounded');</script>";
				$pending = true;
			} else :
			echo "<script>Materialize.toast('Please do the Captcha correctly.', 3000, 'rounded');</script>";
		endif;
	} else {
		echo "<script>Materialize.toast('Please fill out all the fields.', 3000, 'rounded');</script>";
	}
}
if ($pending || $_GET['testing']) {
	?>
<h2 class="center">One Last Step!</h1>
<div class="row">
  <div class="col s12">
    <div class="card blue darken-1">
      <div class="card-content white-text center flow-text">
        <span class="card-title center">Verify Pending...</span>
        <p>We need verification of who you are. To make things easier for our staff team
        ,        <br /> Please type the following in the chat:</p>
        <h2> <code class="white-text black" id="token_field">!verify <?php echo $gentoken; ?></code> </h2>
        <a id="copy_btn" class="waves-effect waves-teal btn-flat white-text">Click to Copy</a>
      </div>
    </div>
  </div>
</div>
</h2>
<?php
} else {
	?>
<h2 class="center">Submit a Dispute</h1>
<div class="row">
  <form class="col s12" id="dispute" action="?page=form" method="post">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input name="name" id="name" type="text" class="validate">
        <label for="name">Discord Name</label>
      </div>
      <div class="input-field col s6">
        <input name="battlefy" id="last_name" type="text" class="validate" >
        <label for="last_name">Battlefy Name (will use Discord name if left empty)</label>
      </div>
    </div>
    <row class="center">
    <h5>Brief Description of the problem</h5>
    <h6>Choose the option that BEST presents your problem. Please keep in mind that we need you to have proof.</h6>
    <select name="issue" class="browser-default center">
      <optgroup label="Presence">
        <option value="1">It has been 10 minutes and my opponent is not here. I have also typed in Battlefy chat.</option>
        <option value="2">My opponent disconnected from the match and I have screenshots to prove so.</option>
        <option value="3">My opponent disconnected and I have not heard from him/her for at least 5 minutes now.</option>
        <option value="4">My opponent disconnected and came back, what do we do from here?</option>
        <option value="5">My opponent canceled the challenge and I have a screenshot to prove it.</option>
      </optgroup>
      <optgroup label="Match Issues">
        <option value="6">My opponent played a class he didn't choose in Battlefy and I have a screenshot.</option>
        <option value="7">My opponent has more than one deck of each unique class.</option>
        <option value="8">My opponent is refusing to giving me a screenshot of his deck selection screen.</option>
      </optgroup>
      <optgroup label="Score Reporting Issues">
        <option value="9">My opponent reported a false score.</option>
        <option value="10">We didn't even play yet and my opponent reported that he won.</option>
        <option value="11">Battlefy advanced my opponent even though I won.</option>
      </optgroup>
      <optgroup label="Misc.">
        <option value="12">My opponent is being very toxic (showing low sportsmanship).</option>
        <option value="13">[Other] None of the above apply to me. </option>
      </optgroup>
    </select>
    </row>
    <div align="center" class="g-recaptcha" data-sitekey="6LcWYhgTAAAAAD0F1dx9_a7YtKa2ScXYpUmutUTj"></div>
    <div class="row center">
      <div class="input-field col s12">
        <button class="btn waves-effect waves-light" type="submit" name="submit" value="submit">Submit
        <i class="material-icons right">send</i>
        </button>
      </div>
    </div>
  </form>
</div>
<?php
}
?>