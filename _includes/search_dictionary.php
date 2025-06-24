<div id="reference" class="searches mid">
<form name="reference" method="get" onSubmit="return OnSubmitFormSwap();" target="_blank">
  <p>Dictionary</p>
    <input type="hidden" name="dictionary" value="1" checked="checked" />
    <div class="srs">
        <input type="text" id="sr_04"> <a data-role="srcr" data-id="sr_04"><i class="fas fa-backspace"></i></a><a data-role="srcb" data-id="sr_04" class="srcb static"><i class="far fa-copy fa-fw"></i></a>
    </div>
    <input type="hidden" id="h_sr_04">
    
    <div class="check-group">
    	<div class="chk-ref refbkc">
		    <input class="refchk topchk" type="checkbox" name="thesauruserase">
		    <label for="thesaurus" class="refchk-label erase"><i class="fas fa-eraser"></i></label>
	    </div>
      <div class="chk-ref refcg">
        <input class="refchk" type="checkbox" name="thesaurus">
        <label for="thesaurus" class="refchk-label btmchk">Thesaurus</label>
      </div>
    </div><!-- .check-group -->

    <div class="go"><a class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>
</form>
</div><!-- #reference -->