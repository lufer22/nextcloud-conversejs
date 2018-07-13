<?php
script('conversejs', 'admin');
?>

<div class="section section-conversejs">
	<h2><?php p($l->t('Converse Js')); ?></h2>

		<label for="conversejs_bosh_url_input"
		><?php p($l->t('Bosh url')); ?></label>
		<br />
		<input type="text" id="conversejs_bosh_url_input" name="bosh_url" value="<?php p($_['boshUrl']); ?>">
	</div>
</div>
