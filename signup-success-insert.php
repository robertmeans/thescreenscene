<?php require_once 'config/initialize.php'; ?>

<div class="success-message">
  <div class="success-area">
    <p class="almost">Success! Almost there...</p>
    <p class="welcome">Welcome<?php if (isset($_SESSION['firstname'])) { echo ' ' . h($_SESSION['firstname']) . ','; } else { echo ','; } ?></p>

    <p class="riff">To help keep the riffraff out you need to verify your account. Check your email and click on the link verification that was sent to: 
      <span class="yo-email"><?= $_SESSION['email']; ?></span> 
    Can take a minute or 2...
    <a class="verified log-form">Close this dialog</a></p>

  </div>
</div>

<script src="scripts/scripts-inserts.js?<?php echo time(); ?>"></script>
