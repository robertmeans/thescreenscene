<?php require_once 'config/initialize.php'; ?>

<form id="forgot-form" method="post">

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

  <div id="pswd-recovery">
      <p class="forgot-pswd">Enter the email address used to create your account and I will help you reset your password.</p>
  </div>

  <input type="hidden" name="forgotpass">
  <input type="email" class="text" name="forgotemail" placeholder="Enter your email">

  <div id="buttons" class="login">
    <a class="submit login forgot-btn full-width">Password Recovery</a>
  </div>

  <p class="btm-p try-again">Think you remembered it? <a class="log log-form">Try again</a></p>
</form>

<script src="scripts/scripts-inserts.js?<?php echo time(); ?>"></script>
