<?php $layout_context = "home-public";
 
require_once 'config/initialize.php'; 
require '_includes/head.php'; 
?>
<body onLoad="document.google.sr_01.focus();">
<noscript>
  <style type="text/css">
    .noscriptwrap {display:none;} .noscriptmsg { display:flex;width:100%;height:100vh;flex-direction:column;justify-content:center;align-items:center;color:#fff;padding:2em;font-size:16px;line-height:1.5em; }
  </style>
  <div class="noscriptmsg">
    <p>You don't have javascript enabled.</p>
    <p>Please come back when you have joined the 21st century.</p>
    <p>Seriously... how do you even?</p>
  </div>
</noscript>
<div class="noscriptwrap">

<?php preload_config($layout_context); ?>

<div id="table-page">
 	<div id="table-wrap">
  <?php require '_includes/search_stack_top.php'; ?>

<div class="tabs visitor">


<div id="landing" class="greet-login visitor1">

  <?php if (isset($_SESSION['pr'])) { 
    require 'reset_password.php';
   } else { ?>

		<form id="login-form" class="front-login" method="post">

    <div id="message"> 
      <ul id="msg-ul"></ul>
    </div>


<?php if (isset($_SESSION['new']) && $_SESSION['new'] == 'woot') { 
    /*  they're here with a token - new user */ ?>

      <div id="reset-success">
        <p>Welcome aboard, <?= $_SESSION['firstname']; ?>!</p>
      </div>

<?php 
      unset($_SESSION['new']); 
    } else if (isset($_SESSION['new']) && $_SESSION['new'] == 'toot') {
    /* new user with a partial token (they didn't copy the whole thing or it's corrupted) */ ?>

      <div id="reset-success" class="not">There's no token in the database that matches what you've provided. If you copied &amp; pasted the URL maybe you didn't grab the whole thing?</div>

<?php unset($_SESSION['new']); 
    } else { ?>

		  <div id="error-area">No account? <a class="log create-form">Join Here</a></div>

<?php } ?>

    <input type="hidden" name="login">
    <input type="text" class="text" name="firstname" value="<?= $firstname; ?>" placeholder="First Name or Email">
    <input type="password" id="password-home" class="text login-pswd" name="password" placeholder="Password">

    <div class="showpassword-wrap">  
        <div id="showLoginPass-home"><i class="far fa-eye"></i> Show Password</div>
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

<?php } ?>

</div>

<div id="visitor2" class="visitor2">
  <div class="v2wrap">
  	<h1>BrowserGadget</h1>
  	<p>Stop browsing the Internet like a cave baboon and upgrade to a Swiss Army homepage.</p>
  	<p id="watchvideo"><a class="static"><i class="fab fa-youtube"></i> <span class="u">Watch this quick video</span> for the what and how.</a></p>
  	<ul class="perks">
  		<li>Consolidate | Organize</li>
      <li>Store bookmarks</li>
  		<li>Share projects</li>
      <li>Hug strangers</li>
  	</ul>
    <div class="tooltip dm"><span class="tooltiptext">In case dark isn't your thing</span><p class="dm"><i class="fas fa-star dmf"></i> Foofoo color option inside <i class="fas fa-star dml"></i></p></div>
  </div>
</div>

</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>

  </div><!-- #table-wrap -->
</div><!-- #table-page -->

</div><!-- .noscriptwrap -->

<?php require '_includes/yt-intro-modal.php'; ?>

<?php $footer_context = "visitor"; ?>
<?php require '_includes/footer.php'; ?>