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
?><?php
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
?><footer>

  <button id="toggle-contact-form"><i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i></button>

  <div id="email-bob">
    <p class="form-note">You look nice today. <i class="far fa-smile"></i></p>

    <form id="contactForm" method="post">
    <input type="hidden" name="contactbob">
    <ul>
      <li>
        <label class="text" for="name">Name</label>
        <input name="name" type="text" id="sendersname" maxlength="60">
      </li>
      <li>
        <label class="text" for="email" required>Email</label>
        <input name="email" type="email" id="email" maxlength="60">
      </li>
      <li>
        <label class="text" for="comments">Message</label>
        <textarea name="comments" id="comments" maxlength="2000"></textarea>
      </li>
      <li>
        <div id="msg">
          <ul id="errorli"></ul>
        </div>
      </li>
      <div id="emailBob-btn">
        <div id="emailBob">Send</div>
      </div>
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

<?php if (WWW_ROOT == 'http://localhost/browsergadget') { ?>
<script src="http://localhost:35729/livereload.js"></script>
<?php } ?>

</body>
</html>
<?php
    db_disconnect($db);
?>