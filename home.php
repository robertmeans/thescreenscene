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

<div class="preload">
<!-- <p>centered content on page</p> -->
</div>

<?php // require '_includes/nav.php'; ?>

<div id="table-page">
 	<div id="table-wrap">
  <?php require '_includes/search_stack_top.php'; ?>

<div class="tabs visitor">


<div id="landing" class="greet-login visitor1">




  <?php if (isset($_SESSION['pr-lemmein'])) { ?>

    <form id="reset-form" class="front-login" method="post">

    <div id="reset-alert">
      <ul id="reset-errors"></ul>
    </div>

    <div id="reset-error-area"><?= $_SESSION['firstname']; ?>, Let's set your new password.</div>

    <input type="hidden" name="reset">
    <input type="password" id="showPassword" class="text" name="password" placeholder="New password">
    <input type="password" id="showConf" class="text" name="passwordConf" placeholder="Confirm password">

    <div class="showpassword-wrap"> 
        <div id="showSignupPass"><i class="far fa-eye"></i> Show Passwords</div>
    </div>


    <!-- <input type="submit" name="reset-password-btn" class="submit" value="Reset Password"> -->

    <div id="toggle-reset-btn">
      <div id="reset-btn"><span class="login-txt"><img src="_images/resetpass.png"></span></div>
    </div>

    

    </form>

  <?php } else { ?>

		<form id="login-form" class="front-login" method="post">

    <div id="login-alert">
      <ul id="errors"></ul>
    </div>

		<div id="error-area">No account? <a class="log create-form">Join Here</a></div>

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

    <div id="toggle-btn">
      <div id="login-btn"><span class="login-txt"><img src="_images/login.png"></span></div>
    </div>

    <p class="btm-p"><a class="log lt create-form">Create account</a> | <a class="log rt forgot-form">Forgot password?</a></p>

		</form>

  <?php } ?>



</div>


<div id="visitor2" class="visitor2">
  <div class="v2wrap">
  	<h1>BrowserGadget</h1>
  	<p>Stop browsing the Internet like a cave baboon and upgrade to a Swiss Army homepage.</p>
  	<p id="watchvideo"><a href="#/" class="static"><i class="fab fa-youtube"></i> <span class="u">Watch this quick video</span> for the what and how.</a></p>
  	<ul>
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

<div id="ytvideo" class="yt-modal">

<div class="yt-modal-content">
  <div class="yt-modal-header">
    <span class="yt-close shutterdown" onclick="stopVideo(this.getAttribute('vdoId'))" vdoId ="yvideo"><i class="fas fa-times-circle"></i></span>
    <h2>BrowserGadget | Better Browsing Awaits</h2>
  </div>

  <div class="yt-modal-wrap">
      <div class="yt-modal-body">

      <iframe id="foo" class="yvideo" width="100%" max-width="820" height="462" src="https://www.youtube.com/embed/yTVijw7oZT8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div><!-- .yt-modal-body -->

  </div><!-- .yt-modal-wrap -->
  <div class="yt-modal-footer">
    <h3>&nbsp;</h3>
  </div>

</div><!-- .yt-modal-content -->
</div><?php // #yt-modal ?>

<?php $footer_context = "visitor"; ?>
<?php require '_includes/footer.php'; ?>