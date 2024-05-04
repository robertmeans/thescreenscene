<div id="youtube" class="searches bottom">
<form name="youtube" method="get" onSubmit="return submitYouTube();" target="_blank">

  <p>YouTube</p>
    <div class="srs">
    	<input id="sr_05" name="search_query" type="text"> <a data-role="srcr" data-id="sr_05"><i class="fas fa-backspace"></i></a><a data-role="srcb" data-id="sr_05" class="srcb static"><i class="far fa-copy fa-fw"></i></a>
    </div>
    <input type="hidden" id="h_sr_05">

    <div class="check-group">
    	<div class="chk-yt"></div>
    </div>

    <div class="go"><a class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>
</form> 
</div><!-- end YouTube -->