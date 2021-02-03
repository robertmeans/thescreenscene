<div id="google" class="searches">

	<form name="google" method="get" onSubmit="return submitGoogle();" target="_blank">

	<p>Google</p>
    <div class="srs"><input type="text" id="sr_01" name="q" value=""> <a id="gtog"><i class="fas fa-backspace"></i></a><a data-role="srcb" data-id="sr_01" class="srcb static"><i class="far fa-copy fa-fw"></i></a></div>
    <input type="hidden" id="ghold">
    <div class="check-group">

    	<div class="chk-img">
	    	<input class="gchk" type="checkbox" id="googleImages" name="gchk">
	    	<label class="gchk-label">Images</label>
    	</div>

		<div class="chk-map">
	    	<input class="gchk" type="checkbox" id="googleMaps" name="gchk">
	   	 	<label class="gchk-label">Maps</label>
   	 	</div>

    </div><!-- .check-group -->

    <div class="go"><a href="#" class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>

	</form>
</div><!-- end Google -->