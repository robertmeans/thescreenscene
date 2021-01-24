<div id="google" class="searches">

	<p>Google</p>
    <div class="srs"><input type="text" id="gsearch" name="q" value=""> <a onclick="reset_google();"><i class="fas fa-backspace"></i></a></div>
     
    <div class="check-group ssp">

    	<div class="chk-img">
	    	<input class="gchk" type="checkbox" id="googleImages" name="gchk">
	    	<label class="gchk-label ssp">Images</label>
    	</div>

		<div class="chk-map">
	    	<input class="gchk" type="checkbox" id="googleMaps" name="gchk">
	   	 	<label class="gchk-label ssp">Maps</label>
   	 	</div>

    </div><!-- .check-group -->

    <div class="go"><a href="#" class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>

</div><!-- end Google -->