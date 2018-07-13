<?php
script('conversejs', 'converse.min');
script('conversejs', 'init');
style('conversejs', 'converse.min');
?>
<form id="conversejs_user_form">
	<section>
		<label>JID</label>
		<br />
		<input type="text" name="jid" value="<?php p($_['jid']); ?>" />
	</section>
	<section>
		<label>Password</label>
		<br/>
		<input type="password" name="pass" placeholder="<?php echo str_repeat('&#8226;', 10); ?>" />
	</section>
	<section>
		<input type="submit" value="Submit" />
	</section>
</form>
