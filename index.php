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

if (!isset($_SESSION['verified'])) {
	require 'home.php';
	exit;
}

if (((isset($_SESSION['verified']) && ($_SESSION['verified'] != "0")) && (!$_SESSION['message']))) {
	require 'home_logged_in.php';
	exit;
}

?>

<?php include '_includes/head.php'; ?>

<body>
<?php // require '_includes/nav.php'; ?>
	
<div id="landing">

	<div id="landing-content">

		<?php if(isset($_SESSION['message'])): ?>
		<div class="alert <?= $_SESSION['alert-class']; ?>">
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
				unset($_SESSION['alert-class']); 
			?>
		</div><!-- .alert -->
		<?php endif; ?>

		<h1 class="welcome">Welcome<?php if (isset($_SESSION['firstname'])) { echo ' ' . h($_SESSION['firstname']) . ','; } else { echo ','; } ?></h1>

		<?php if(!$_SESSION['verified']): ?>
			<div class="alert alert-warning">
				<p>To help keep the riffraff out you need to verify your account. Check your email and click on the link verification that was sent to: <span class="yo-email"><?= $_SESSION['email']; ?></span></p>
				<p>If you think you are seeing this message in error...</p>
				<a class="verified" href="login.php">try to log in</a>
			</div>
		<?php endif; ?>

		<?php if($_SESSION['verified']): ?>
		 	<a class="verified" href="/">Let me in already!</a>
		 <?php endif; ?>

	</div><!-- #landing-content -->
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>