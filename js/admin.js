$(document).ready(function() {
	$("#bosh_url").on('change paste', function() {
		var boshUrl = $(this).val();
		console.log(boshUrl);
		OCP.AppConfig.setValue('conversejs', 'boshUrl', boshUrl)
	})
});
