$(document).ready(function() {
	$("#conversejs_bosh_url_input").on("change paste", function() {
		var boshUrl = $(this).val();

		$.ajax({
			url: OC.generateUrl("apps/conversejs/settings/admin"),
			type: "POST",
			data: { boshUrl },
			success: function(response) {
				if (response && response.data != null) {
					OC.Notification.showTemporary(response.message);
				} else {
					console.error(response);
					OC.Notification.showTemporary("Error");
				}
			}
		});
	});
});
