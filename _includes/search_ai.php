<div id="bingorai">

  <div class="switcharoo">
    <i class="fas fa-exchange-alt"></i>
  </div>

  <div id="ai" class="searches">

    <div class="therest">
      <div class="perai ch">
        <a href="https://chatgpt.com/" target="_blank">
          <img src="_images/chatgpt-logo-white.webp"><span class="mg">ChatGPT</span>
        </a>
      </div>
      <div class="perai ge">
        <a href="https://gemini.google.com/" target="_blank">
          <img src="_images/gemini-logo-color.webp"><span class="mg">Gemini</span>
        </a>
      </div>
      <div class="perai gr">
        <a href="https://grok.com/" target="_blank">
          <img src="_images/grok-logo-white.webp"><span class="mg">Grok</span>
        </a>
      </div>
      <div class="perai pe">
        <a href="https://perplexity.ai/" target="_blank">
          <img src="_images/perplexity-logo-white.webp"><span class="mg">Perplexity</span>
        </a>
      </div>
    </div>
  </div>

  <div id="bing" class="searches">

    <div class="therest">
      <form name="bing" method="get" onSubmit="return submitBing();" target="_blank">
        <p>Bing</p>
        <div class="srs">
          <input type="text" id="sr_03" name="q" value="">
          <a data-role="srcr" data-id="sr_03"><i class="fas fa-backspace"></i></a>
          <a data-role="srcb" data-id="sr_03" class="srcb static"><i class="far fa-copy fa-fw"></i></a>
        </div>
        <input type="hidden" id="h_sr_03">
        <div class="check-group">
          <div class="chk-img">
            <input class="bchk" type="checkbox" id="bingImages" name="bchk">
            <label class="bchk-label">Images</label>
          </div>
          <div class="chk-map">
            <input class="bchk" type="checkbox" id="bingMaps" name="bchk">
            <label class="bchk-label">Maps</label>
          </div>
        </div>
        <div class="go">
          <a class="go-a static" onclick="$(this).closest('form').submit()">Go</a>
        </div>
      </form>
    </div>
  </div>
</div>
