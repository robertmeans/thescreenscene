<?php require_once 'config/initialize.php'; ?>

<form id="forgot-form" method="post">

  <div id="forgot-alert">
    <ul id="forgot-errors"></ul>
  </div>

  <div id="pswd-recovery">
      <p class="forgot-pswd">Enter the email address used to create your account and I will help you reset your password.</p>
  </div>

  <input type="hidden" name="forgotpass">
  <input type="email" class="text" name="forgotemail" placeholder="Enter your email">
          
  <div id="toggle-forgot-btn">
    <div id="forgot-btn"><span class="login-txt"><img src="_images/forgotpass.png"></span></div>
  </div>

  <p class="btm-p try-again">Think you remembered it? <a class="log log-form">Try again</a></p>
</form>

<script src="scripts/scripts-inserts.js?<?php echo time(); ?>"></script>
