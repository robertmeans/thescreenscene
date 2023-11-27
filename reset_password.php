<?php $layout_context = "reset-password"; ?>

<?php if ($_SESSION['pr'] == 'showmepr') { 
  // they have a password reset token and it checks out  ?>
  <form id="reset-form" class="front-login" method="post">

    <div id="message"> 
      <ul id="msg-ul"></ul>
    </div>

    <div id="reset-error-area">
      <?= $_SESSION['firstname']; ?>, Let's set your new password.
    </div>

    <input type="hidden" name="reset">
    <input type="password" id="showPassword" class="text" name="password" placeholder="New password">
    <input type="password" id="showConf" class="text" name="passwordConf" placeholder="Confirm password">

    <div class="showpassword-wrap"> 
      <div id="showSignupPass-insert"><i class="far fa-eye"></i> Show Passwords</div>
    </div>

    <div id="buttons" class="login">
      <a class="submit login reset-btn full-width">Password Recovery</a>
    </div>

    <p class="btm-p try-again">Think you remembered it? <a class="log log-form">Try again</a></p>
  </form>

  <script src="scripts/scripts-inserts.js?<?php echo time(); ?>"></script>

  <?php } else { 
    // they have a password token but it's no bueno  ?>

  <div class="success-message">
    <div class="success-area">
      <p class="nope">There's no token in the database that matches what you've provided. If you copied &amp; pasted the URL maybe you didn't grab the whole thing?</p>

      <a class="verified log-form">Close this dialog</a></p>

    </div>
  </div>

    <?php unset($_SESSION['pr']);  } ?>