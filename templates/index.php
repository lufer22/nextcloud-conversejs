<?php
script('conversejs', 'converse.min');
script('conversejs', 'init');
style('conversejs', 'converse.min');
style('conversejs', 'index');
?>

<div id="app">
	<div id="app-navigation">
		<div id="app-settings">
			<div id="app-settings-header">
				<button class="settings-button" data-apps-slide-toggle="#app-settings-content">Account</button>
			</div>
			<div id="app-settings-content">

				<form id="conversejs_user_form">
					<label for="conversejs_jid">JID</label>
					<input id="conversejs_jid" type="text" name="jid" value="<?php p($_['jid']); ?>" />
					<label for="conversejs_password">Password</label>
					<input id="conversejs_password" type="password" name="pass" placeholder="<?php if (!empty($_['jid'])) { echo str_repeat('&#8226;', 10); } ?>" />
					<input type="submit" value="Submit" />
				</form>

			</div>
		</div>
	</div>
	<div id="app-content">
	</div>
</div>
