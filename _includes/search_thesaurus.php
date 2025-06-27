<!--
let's start over. below is all the code in hopes this will make more sense. what I am trying to accomplish is when someone clicks on the div with class 'eraserref' it will clear contents of the input '#sr_04', put the cursor in that field, toggle 'checked' on input '.refchkbox', and toggle class 'selected' to both divs with class 'chkreftog'. if someone clicks the div with class 'eraselabel' it will do all the above except clear contents of the input '#sr_04' field. it will just put the cursor at the end of any contents that might already be in the 'sr_04' field.
-->

<div id="reference" class="searches mid">
  <form name="reference" method="get" onSubmit="return OnSubmitForm();" target="_blank">
    <p>Thesaurus</p>

    <input type="hidden" name="thesaurus" value="1" />

    <div class="srs">
      <input type="text" id="sr_04" />
      <a data-role="srcr" data-id="sr_04"><i class="fas fa-backspace"></i></a>
      <a data-role="srcb" data-id="sr_04" class="srcb static"><i class="far fa-copy fa-fw"></i></a>
    </div>

    <input type="hidden" id="h_sr_04" />

    <div class="check-group">
      <!-- Eraser Button -->
      <div class="chk-ref chkreftog eraserref" data-action="clear">
        <i class="fas fa-eraser"></i>
      </div>

      <!-- Checkbox and Label -->
      <div class="chk-ref chkreftog" data-action="label">
        <label>
          <input type="checkbox" class="refchkbox" id="dictionary" name="dictionary" />
          Dictionary
        </label>
      </div>
    </div>

    <div class="go">
      <a class="go-a static" onclick="$(this).closest('form').submit()">Go</a>
    </div>
  </form>
</div>
