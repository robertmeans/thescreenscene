<div id="bing" class="searches">

    <p>Bing</p>
    <div class="srs"><input type="text" id="bsearch" name="q" value=""> <a onclick="reset_bing();"><i class="fas fa-backspace"></i></a></div>

    <div class="check-group ssp">

      	<div class="chk-img">
    	    	<input class="bchk" type="checkbox" id="bingImages" name="bchk">
    	    	<label class="bchk-label ssp">Images</label>
      	</div>

  		  <div class="chk-map">
    	    	<input class="bchk" type="checkbox" id="bingMaps" name="bchk">
    	   	 	<label class="bchk-label ssp">Maps</label>
     	 	</div>

    </div><!-- .check-group -->

    <div class="go"><a href="#" class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>

</div><!-- end Bing -->