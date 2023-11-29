    <input type="hidden" name="contactbob">
    <ul>
      <li>
        <label class="text" for="name">Name</label>
        <input name="name" type="text" id="sendersname" maxlength="60">
      </li>
      <li>
        <label class="text" for="email" required>Email</label>
        <input name="email" type="email" id="email" maxlength="60">
      </li>
      <li>
        <label class="text" for="comments">Message</label>
         <textarea name="comments" id="comments" maxlength="2000"></textarea>
      </li>
      <li>
        <div id="msg">
          <ul id="errorli"></ul>
        </div>
      </li>
      <div id="emailBob-btn">
        <div id="emailBob">Send</div>
      </div>
    </ul>