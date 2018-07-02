$(document).ready(function() {
	$("#bosh_url").on('change input paste keyup', function(e) {
		var boshURL = $(e.currentTarget).val();

		OCP.AppConfig.setValue('conversejs', 'boshUrl', boshUrl)
	})
});
