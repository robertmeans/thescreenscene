<?php require_once 'config/initialize.php'; ?>

<form id="signup-form" method="post">

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

  <input type="hidden" name="signup">
  <div class="name">
    <input type="text" id="firstname" class="text" name="firstname" value="<?= h($firstname); ?>" placeholder="First name">
    <input type="text" class="text" name="lastname" value="<?= h($lastname); ?>" placeholder="Last name">
  </div>

  <input type="email" class="text" name="email" value="<?= h($email); ?>" placeholder="Email address" required>

  <input type="password" id="showPassword" class="text" name="password" placeholder="Password">
  <input type="password" id="showConf" class="text" name="passwordConf" placeholder="Confirm password">

  <div class="showpassword-wrap"> 
      <div id="showSignupPass"><i class="far fa-eye"></i> Show Passwords</div>
  </div>

  <div id="buttons" class="login">
    <a class="submit login signup-btn full-width">Signup</a>
  </div>

  <p class="btm-p">Already a member? <a class="log log-form">Sign in</a></p>
</form>

<script src="scripts/scripts-inserts.js?<?php echo time(); ?>"></script>
