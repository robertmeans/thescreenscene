<?php error_reporting(0);
function ewd_copyright($startYear) {
  $currentYear = date('Y');
  if ($startYear < $currentYear) {
      $currentYear = date('y');
      // return "<i class=\"fas fa-peace\"></i> $startYear&ndash;$currentYear";
      return "<i class=\"far fa-heart\"></i> $startYear&ndash;$currentYear";
  } else {
      // return "<i class=\"fas fa-peace\"></i> $startYear";
      return "<i class=\"far fa-heart\"></i> $startYear";
  }
}
?>
    <?php
        function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => SECRETKEY,
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
        // Call the function post_captcha

/* MUTE FOR LOCAL TESTING ---------------------------------------------------------- */
        // $_POST['g-recaptcha-response'] = '';
        // $res = post_captcha($_POST['g-recaptcha-response']);

?>

<footer>

  <button id="toggle-contact-form"><i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i></button>

  <div id="email-bob">
    <p class="form-note">You look nice today. <i class="far fa-smile"></i></p>

    <form id="contactForm" onsubmit="submitFooter(); return false;">
    <ul>
      <li>
        <label class="text" for="name">Name</label>
        <input name="name" type="text" id="sendersname" required maxlength="60">
      </li>
      <li>
        <label class="text" for="email" required>Email</label>
        <input name="email" type="email" id="email" required maxlength="60">
      </li>
      <li>
        <label class="text" for="comments">Message</label>
        <textarea name="comments" id="comments" required maxlength="2000"></textarea>
      </li>
      <li>
        <div class="g-recaptcha" data-theme="dark" data-callback="recaptchaCallback" data-sitekey="6Lf6FzkaAAAAACc1FJorcyy4KxF_iFkEwXFBeArI"></div>
      </li>
      <li class="send-items">
        <button id="confirm" disabled>Check Captcha above to enable Send</button>
        <input id="send" type="submit" class="display" value="Send" disabled> <span id="status"></span>
      </li>
    </ul> 
    </form>

  </div>

  <p class="copyright"><?= ewd_copyright(2021); ?> &copy; <a class="eb" href="http://evergreenbob.com" target="_blank">Evergreen Bob</a></p> 
</footer>

<?php
switch ($footer_context) {
    case 'visitor'  :   ?><script src="scripts/scripts-visitor.js?<?php echo time(); ?>"></script><?php  break;
    default         :   ?><script src="scripts/scripts.js?<?php echo time(); ?>"></script><?php  break;
}
?>

<script src="http://localhost:35729/livereload.js"></script>

</body>
</html>
<?php
    db_disconnect($db);
?>