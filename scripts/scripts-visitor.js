setTimeout(function(){$("#success-wrap").fadeOut(750)},500),$(document).ready(function(){$(document).on("click","a[data-role=srcr]",function(){var a=$(this).data("id"),b=document.getElementById(a).value;if(/^ *$/.test(b)){var c=document.getElementById("h_"+a).value;document.getElementById(a).value=c,document.getElementById(a).focus()}else document.getElementById("h_"+a).value=b,document.getElementById(a).value="",document.getElementById(a).select()})}),$(document).ready(function(){$(document).on("click","a[data-role=srcb]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c);var d=$(this);$(this).html('<i class="fas fa-check fa-fw"></i>'),setTimeout(function(){d.html('<i class="far fa-copy fa-fw"></i>')},1e3)})});var ytvideo=document.getElementById("ytvideo"),watchvideo=document.getElementById("watchvideo"),shutterdown=document.getElementsByClassName("shutterdown")[0],vid=document.getElementById("foo").getAttribute("src");window.addEventListener("load",function(){watchvideo.onclick=function(){document.getElementById("foo").hasAttribute("src")?ytvideo.style.display="flex":(document.getElementById("foo").setAttribute("src",vid),ytvideo.style.display="flex")},shutterdown.onclick=function(){document.getElementById("foo").removeAttribute("src"),ytvideo.style.display="none"},window.onclick=function(a){a.target==ytvideo&&(document.getElementById("foo").removeAttribute("src"),ytvideo.style.display="none")}}),$("a.static").click(function(a){a.preventDefault()}),$(document).ready(function(){$(document).on("click",".create-form",function(){$("#landing").load("_insert-signup.php")}),$(document).on("click",".log-form",function(){$("#landing").load("_insert-login.php")}),$(document).on("click",".forgot-form",function(){$("#landing").load("_insert-forgotpass.php")})}),$('input[name="remember_me"]').change(function(){$(this).is(":checked")?($(".aa-rm-out").addClass("checkablue"),$(".aa-rm-in").addClass("checkaroo"),$(".rm-rm").addClass("hot")):($(".aa-rm-out").removeClass("checkablue"),$(".aa-rm-in").removeClass("checkaroo"),$(".rm-rm").removeClass("hot"))}),$("#showLoginPass-home").click(function(){var a=document.getElementById("password-home");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide password'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show password'),a.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide password'),a.type="text"),!1}),$("#login-form").keyup(function(a){13===a.keyCode&&$(".login-btn").click()}),$("#login-form").submit(function(a){a.preventDefault()}),$(document).ready(function(){var a=0;$(document).on("click",".login-btn",function(){var b=window.location.href;$("li").hasClass("no-count")?a+=0:a+=1,$.ajax({dataType:"JSON",url:"_form-processing.php",type:"POST",data:$("#login-form").serialize(),beforeSend:function(a){$("#message").removeClass("red blue orange green"),$("#error-area").removeClass("gone"),$("#buttons").html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>')},success:function(c){console.log(c),c&&("ok"==c.signal?b.indexOf("localhost")>-1?window.location.replace("http://localhost/browsergadget"):window.location.replace("https://browsergadget.com"):(0!=$("#reset-success").length&&$("#reset-success").addClass("unset"),$("#error-area").addClass("gone"),$("#message").addClass(c.class),"on"==c.count&&a>=3&&b.indexOf("localhost")>-1?$("#msg-ul").html(c.li+"<li>You've entered the wrong password "+a+' times now. Don\'t forget, you can always <a class="fp-link forgot-form">reset</a> it.</li>'):"on"==c.count&&a>=3&&b.indexOf("browsergadget.com")>-1?$("#msg-ul").html(c.li+"<li>You've entered the wrong password "+a+' times now. Don\'t forget, you can always <a class="fp-link forgot-form">reset</a> it.</li>'):$("#msg-ul").html(c.li),$("#buttons").html('<a class="submit login login-btn full-width">Try again</a>')))},error:function(a){$(".login-btn").html(a.msg)},complete:function(){}})})}),$(document).ready(function(){$("#email-bob").hide(),$("#toggle-contact-form").click(function(){return $(this).toggleClass("active").next().slideToggle(600),"close"===$.trim($(this).text())?$(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>'):$(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>'),!1})}),$(document).ready(function(){$(document).on("click","#emailBob",function(){$.ajax({dataType:"JSON",url:"_form-processing.php",type:"POST",data:$("#contactForm").serialize(),beforeSend:function(a){$("#msg").removeClass("show"),$("#emailBob-btn").html('<div class="sending-holup"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>')},success:function(a){a&&(console.log(a),"ok"==a.signal?($("#msg").removeClass("show"),$("#contactForm").html('<div class="success">Your message was sent successfully.</div><div id="emailBob-btn-insert"><div class="reset-contact">Reset</div></div>')):($("#msg").addClass("show"),$("#errorli").html(a.li),$("#emailBob-btn").html('<div id="emailBob">Send</div>')))},error:function(){$("#errorli").html("<li>There was an error between your IP and the server. Please try again later.</li>")},complete:function(){}})})}),$(document).ready(function(){$(document).on("click",".reset-contact",function(){$("#contactForm").load("contact-insert.php")})});