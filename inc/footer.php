<!-- Footer -->
<footer class="page-footer blue-grey darken-1">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">HearthGamingLeague</h5>
        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Links</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      &copy; 2016 HearthGamingLeague
      <a class="grey-text text-lighten-4 right" href="http://hearthgamingleague.com/">HGL Website</a>
    </div>
  </div>
</footer>
<!--Import jQuery before materialize.js-->
<script>
$(document).ready(function(){
// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
$('.modal-trigger').leanModal();
refreshTable();
function refreshTable(){
$('#tableHolder').load('getTable.php', function(){
setTimeout(refreshTable, 5000);
});
}
});
</script>
<?php
if ($getpage == "form") {
	?>
<script>
var copyBtn = document.querySelector('#copy_btn');
copyBtn.addEventListener('click', function () {
var urlField = document.querySelector('#token_field');
// create a Range object
var range = document.createRange();
// set the Node to select the "range"
range.selectNode(urlField);
// add the Range to the set of window selections
window.getSelection().addRange(range);
// execute 'copy', can't 'cut' in this case
document.execCommand('copy');
}, false);
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php
}
?>
<!-- login -->
<div id="login" class="modal">
  <div class="modal-content">
    <div class="row center">
      <h6>This login is for Staff Members only.</h6>
      <form class="col s12">
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="icon_prefix" type="text" class="validate">
            <label for="icon_prefix">Username:</label>
          </div>
          <div class="input-field col s6">
            <i class="material-icons prefix">lock</i>
            <input id="icon_telephone" type="password" class="validate">
            <label for="icon_telephone">Password:</label>
          </div>
          <p class="center">
            <input name="remember" type="checkbox" class="filled-in" id="remember" checked="checked" />
            <label for="remember">Remember Me</label>
          </p>
          <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large red waves-effect waves-light">
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
    <li><a href="?page=form" class="btn-floating blue tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Add a Dispute!"><i class="material-icons">add</i></a></li>
  </ul>
</div>
</body>
</html>