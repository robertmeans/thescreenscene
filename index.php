<?php 
$layout_context = "index";

require_once 'config/initialize.php';


if (isset($_GET['token'])) {
	$token = $_GET['token'];
	verifyUser($token);
}

if (isset($_GET['password-token'])) {
	$passwordToken = $_GET['password-token'];
	resetPassword($passwordToken);
}

if (!isset($_SESSION['verified']) || isset($_SESSION['new'])) {
	require 'home.php';
	exit;
}

if ((isset($_SESSION['verified']) && $_SESSION['verified'] != "0") || isset($_SESSION['got-kicked-out'])) {
	require 'home_logged_in.php';
	exit;
}

include '_includes/head.php'; ?>
<body>
	
<div id="landing">
	<div id="landing-content">
<?php show_session_variables(); ?>
		<div class="alert alert-warning">
			<?php /* if (isset($_SESSION['verified'])) { echo 'How is this?'; } */ ?>
			<p>Oops! Something glitched. Or, more likely, there's a semicolon out of place somewhere in the gazillion lines of code of this website.</p>
      <p>Either way, you're seeing a very unique "catchall". Congratulations?</p>
		</div>
	 	<a class="verified" href="logout.php">Reset your session</a>

	</div><!-- #landing-content -->
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>