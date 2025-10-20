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
      <div class="chk-ref chkreftog subhov" data-action="label">
        <label>
          <input type="checkbox" class="refchkbox" id="dictionary" name="dictionary" />
          Dictionary
        </label>
      </div>
    </div>

    <div class="go ph">
      <a class="go-a static" onclick="$(this).closest('form').submit()">Go</a> <a class="pha">ph</a>
    </div>
  </form>
</div>
