<?php $layout_context = "login-page";

require_once 'config/initialize.php';

include '_includes/head.php'; 
?>

<body onLoad="document.login.firstname.focus();">
<?php require '_includes/nav.php'; ?>

<div id="landing">
    <form name="login" action="" method="post">
        <h1 class="text-center">Login</h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php // if(isset($rememberme_error)) { echo $rememberme_error; } ?>
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['message'])): ?>
        <div class="alert <?= $_SESSION['alert-class']; ?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['alert-class']); 
            ?>
        </div><!-- .alert -->
        <?php endif; ?>

        <!-- 
        <input type="text" class="text" name="email" value="<?php //if(isset($email)) { echo h($email); } ?>" placeholder="Email address">
        -->

        <input type="text" id="firstname" class="text" name="firstname" value="<?= $firstname; ?>" placeholder="First Name or Email">
        <input type="password" id="password" class="text login-pswd" name="password" placeholder="Password">

        <div class="showpassword-wrap"> 
            <div id="showLoginPass"><i class="far fa-eye"></i> Show Password</div>
        </div>

        <input type="checkbox" name="remember_me" id="remember_me">
        <label for="remember_me" class="rm-checked"> 
            <div class="rm-wrap">
                <div class="aa-rm-out">
                    <div class="aa-rm-in"></div>
                </div>
                <span class="rm-rm">Remember me</span>
            </div>
       </label>

        <input type="submit" name="login" class="submit" value="Login">

        <p class="btm-p">No account? <a class="log" href="signup.php">Create one</a></p>
        <!-- <p class="btm-p">Not a member? <a class="log" href="signup.php">Sign up</a></p> -->
        <div style="font-size:0.8em; text-align:center; color:#fff;">
            <a style="color:#fff;" href="<?= WWW_ROOT ?>">Home</a> | <a style="color:#fff;" href="forgot_password.php">Forgot your Password?</a></div>
    </form>
    
</div><!-- #landing -->

</body>

<?php require '_includes/footer.php'; ?>