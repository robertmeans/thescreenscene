$('input[name="remember_me"]').change(function(){$(this).is(":checked")?($(".aa-rm-out").addClass("checkablue"),$(".aa-rm-in").addClass("checkaroo"),$(".rm-rm").addClass("hot")):($(".aa-rm-out").removeClass("checkablue"),$(".aa-rm-in").removeClass("checkaroo"),$(".rm-rm").removeClass("hot"))}),$("#showLoginPass").click(function(){var s=document.getElementById("password");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide password'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show password'),s.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide password'),s.type="text"),!1}),$("#showSignupPass").click(function(){var s=document.getElementById("showPassword"),e=document.getElementById("showConf");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide passwords'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show passwords'),s.type="password",e.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide passwords'),s.type="text",e.type="text"),!1}),$("#signup-form").keyup(function(s){13===s.keyCode&&$(".signup-btn").click()}),$("#signup-form").submit(function(s){s.preventDefault()}),$(document).ready(function(){$(document).on("click",".signup-btn",function(){$.ajax({dataType:"JSON",url:"_form-processing.php",type:"POST",data:$("#signup-form").serialize(),beforeSend:function(s){$("#message").removeClass("red blue orange green"),$("#buttons").html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>')},success:function(s){console.log("a "+s),s&&(console.log("b "+s),"ok"==s.signal?$("#landing").load("_insert-signup-success.php"):($("#message").addClass(s.class),$("#msg-ul").html(s.li),$("#buttons").html('<a class="submit login signup-btn full-width">Try again</a>')))},error:function(s){console.log("c "+s),$("#toggle-signup-btn").html(s.msg)},complete:function(s){console.log("d "+s)}})})}),$("#login-form").keyup(function(s){13===s.keyCode&&$(".login-btn").click()}),$("#login-form").submit(function(s){s.preventDefault()}),$(document).ready(function(){var o=0;$(document).on("click",".login-btn",function(){var e=window.location.href;$("li").hasClass("no-count")?o+=0:o+=1,$.ajax({dataType:"JSON",url:"_form-processing.php",type:"POST",data:$("#login-form").serialize(),beforeSend:function(s){$("#message").removeClass("red blue orange green"),$("#error-area").removeClass("gone"),$("#buttons").html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>')},success:function(s){console.log(s),s&&("ok"==s.signal?-1<e.indexOf("localhost")?window.location.replace("http://localhost/browsergadget"):window.location.replace("https://browsergadget.com"):(0!=$("#reset-success").length&&$("#reset-success").addClass("unset"),$("#error-area").addClass("gone"),$("#message").addClass(s.class),"on"==s.count&&3<=o&&-1<e.indexOf("localhost")||"on"==s.count&&3<=o&&-1<e.indexOf("browsergadget.com")?$("#msg-ul").html(s.li+"<li>You've entered the wrong password "+o+' times now. Don\'t forget, you can always <a class="fp-link forgot-form">reset</a> it.</li>'):$("#msg-ul").html(s.li),$("#buttons").html('<a class="submit login login-btn full-width">Try again</a>')))},error:function(s){$(".login-btn").html(s.msg)},complete:function(){}})})}),$("#forgot-form").keyup(function(s){13===s.keyCode&&$(".forgot-btn").click()}),$("#forgot-form").submit(function(s){s.preventDefault()}),$(document).ready(function(){$(document).on("click",".forgot-btn",function(s){$.ajax({dataType:"JSON",url:"_form-processing.php",type:"POST",data:$("#forgot-form").serialize(),beforeSend:function(s){$("#pswd-recovery").removeClass("gone"),$("#message").removeClass("red blue orange green"),$("#buttons").html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>')},success:function(s){s&&("ok"==s.signal?$("#landing").load("_insert-forgotpass-success.php"):($("#pswd-recovery").addClass("gone"),$("#message").addClass(s.class),$("#msg-ul").html(s.li),$("#buttons").html('<a class="submit login forgot-btn full-width">Try again</a>')))},error:function(s){$("#forgot-btn").html(s.msg)},complete:function(){}})})}),$("#reset-form").keyup(function(s){13===s.keyCode&&$(".reset-btn").click()}),$("#reset-form").submit(function(s){s.preventDefault()}),$(document).ready(function(){$(document).on("click",".reset-btn",function(s){window.location.href;$.ajax({dataType:"JSON",url:"_form-processing.php",type:"POST",data:$("#reset-form").serialize(),beforeSend:function(s){$("#reset-error-area").removeClass("gone"),$("#message").removeClass("red blue orange green"),$("#buttons").html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>')},success:function(s){s&&("ok"==s.signal?$("#landing").load("_insert-reset-success.php"):($("#reset-error-area").addClass("gone"),$("#reset-error-area").removeClass("holup"),$("#message").addClass(s.class),$("#msg-ul").html(s.li),$("#buttons").html('<a class="submit login reset-btn full-width">Try again</a>')))},error:function(s){$(".reset-btn").html(s.msg)},complete:function(){}})})});