<?php $layout_context = "reset-password"; ?>
<?php require_once 'config/initialize.php'; ?>

<?php include '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>

<div id="landing">
	<form action="" method="post">
        <h1 class="text-center">Reset Your Password</h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
                
        <input type="password" id="showPassword" class="text" name="password" placeholder="Password">
        <input type="password" id="showConf" class="text" name="passwordConf" placeholder="Confirm password">

        <div class="showpassword-wrap"> 
            <div id="showSignupPass"><i class="far fa-eye"></i> Show Passwords</div>
        </div>

        <input type="submit" name="reset-password-btn" class="submit" value="Reset Password">
        
	</form>
    
</div>

</body>

<?php require '_includes/footer.php'; ?>