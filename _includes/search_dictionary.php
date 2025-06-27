<div id="reference" class="searches mid">
<form name="reference" method="get" onSubmit="return OnSubmitFormSwap();" target="_blank">
  <p>Dictionary</p>
    <input type="hidden" name="dictionary" value="1" checked="checked" />
    <div class="srs">
        <input type="text" id="sr_04" /> 
        <a data-role="srcr" data-id="sr_04"><i class="fas fa-backspace"></i></a>
        <a data-role="srcb" data-id="sr_04" class="srcb static"><i class="far fa-copy fa-fw"></i></a>
    </div>

    <input type="hidden" id="h_sr_04">
    
    <div class="check-group">
      <!-- Eraser Button -->
      <div class="chk-ref chkreftog eraserref" data-action="clear">
        <i class="fas fa-eraser"></i>
      </div>

      <!-- Checkbox and Label -->
    	<div class="chk-ref chkreftog" data-action="label">
        <label>
		      <input type="checkbox" class="refchkbox"  name="thesaurus" id="thesaurus">Thesaurus
        </label>

	    </div>
    </div><!-- .check-group -->
    <div class="go"><a class="go-a static" onclick="$(this).closest('form').submit()">Go</a></div>
</form>
</div><!-- #reference -->