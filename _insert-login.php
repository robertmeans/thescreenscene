<?php require_once 'config/initialize.php'; ?>

<?php if (isset($_SESSION['pr'])) { unset($_SESSION['pr']); } ?>

<form id="login-form" class="front-login" method="post">

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

  <div id="error-area">No account? <a class="log create-form">Join Here</a></div>

  <input type="hidden" name="login">
  <input type="text" class="text" name="firstname" value="<?= $firstname; ?>" placeholder="First Name or Email">
  <input type="password" id="password" class="text login-pswd" name="password" placeholder="Password">

  <div class="showpassword-wrap"> 
      <div id="showLoginPass"><i class="far fa-eye"></i> Show Password</div>
  </div>

  <input id="remember_me" type="checkbox" name="remember_me">
  <label for="remember_me" class="rm-checked"> 
    <div class="rm-wrap">
      <div class="aa-rm-out">
        <div class="aa-rm-in"></div>
      </div>
      <span class="rm-rm">Remember me</span>
    </div>
  </label>

  <div id="buttons" class="login">
    <a class="submit login login-btn full-width">Login</a>
  </div>

  <p class="btm-p"><a class="log lt create-form">Create account</a> | <a class="log rt forgot-form">Forgot password?</a></p>

</form>

<script src="scripts/scripts-inserts.js?<?php echo time(); ?>"></script>