<div id="bing" class="searches">

    <form name="bing" method="get" onSubmit="return submitBing();" target="_blank">

    <p>Bing</p>
    <div class="srs"><input type="text" id="bsearch" name="q" value=""> <a onclick="reset_bing();"><i class="fas fa-backspace"></i></a></div>

    <div class="check-group">

      	<div class="chk-img">
    	    	<input class="bchk" type="checkbox" id="bingImages" name="bchk">
    	    	<label class="bchk-label">Images</label>
      	</div>

  		  <div class="chk-map">
    	    	<input class="bchk" type="checkbox" id="bingMaps" name="bchk">
    	   	 	<label class="bchk-label">Maps</label>
     	 	</div>

    </div><!-- .check-group -->

    <div class="go"><a href="#" class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>

</form>
</div><!-- end Bing -->