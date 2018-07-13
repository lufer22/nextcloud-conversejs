$(document).ready(function() {
	$.ajax({
		url: OC.generateUrl("/apps/conversejs/settings/admin"),
		type: "post",
		data: {},
		success: function(response) {
			if (response && response.data.boshUrl.length > 0) {
				converse.initialize({
					bosh_service_url: response.data.boshUrl,
					show_controlbox_by_default: true
				});
			} else {
				OC.Notification.show("Bosh url is not configured");
			}
		}
	});
});
