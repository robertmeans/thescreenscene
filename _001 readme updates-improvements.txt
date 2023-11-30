BrowserGadget updates
	
2. 	dropdown nav: type to search / auto filter

4. 	pretty up edit_project_details.php page

6. 	move all inline styles to scss







open to start where you left off on the laptop:
_custom.scss


index.php
share_project.php : 35
home_logged_in
home.php : 35

login-process.php -> move to _form-processing.php ? at least consolidate into 1 _login-processing... or mabe rename to 
	_processing-forms.php
	_processing-login.php
	
_form-processing.php
scripts/scripts-visitor.js : 135
scripts/scripts.js : 771
_errors.txt




http://localhost/browsergadget/index.php?token=2dd849e05ee048bf41de722557a6e96977a828305c08543d68126b0d723ea5d42d5d9418cd71820bcba44a532b9467b85b43




UPDATE project_user SET edit=0, share=0 WHERE id=100 AND (owner_id=1 OR shared_with=1) LIMIT 1