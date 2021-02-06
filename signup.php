<?php $layout_context = "signup"; ?>

<?php require_once 'config/initialize.php'; ?>
<?php include '_includes/head.php'; ?>

<body onLoad="document.signup.firstname.focus();">
<?php // require '_includes/nav.php'; ?>
	
<div id="landing">
	<form name="signup" action="" method="post">
        <h1 class="text-center">Join here</h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

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

        <!-- <button type="submit" name="signup-btn">Sign Up</button> -->
		<input type="submit" name="submit" class="submit" value="Sign up">
        <p class="btm-p">Already a member? <a class="log" href="login.php">Sign in</a></p>
	</form>
    
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>