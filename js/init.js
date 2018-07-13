$(document).ready(function() {
	/** global vars */
	var _boshUrl = "";
	var _jid = "";
	var _pass = "";

	/** auto start */
	$.ajax({
		url: OC.generateUrl("/apps/conversejs/settings/personal"),
		type: "post",
		data: {},
		success: function(response) {
			console.log("message: ", response.message);
			if (response && response.data.boshUrl.length > 0) {
				_boshUrl = response.data.boshUrl;
				_jid = response.data.jid;
				_pass = response.data.pass;

				init();
			} else {
				OC.Notification.show("Bosh url is not configured");
			}
		}
	});

	/** functions */

	/** ConverseJs run
	 * The parameters are replaced by the global vars line 2
	 * @param string _boshUrl
	 * @param string _jid
	 * @param string _pass
	 */
	function init() {
		if (_boshUrl.length > 0) {
			var options = {
				bosh_service_url: _boshUrl,
				show_controlbox_by_default: true
			};

			// add auto login
			if (_jid.length > 0 && _pass.length > 0) {
				options = Object.assign(options, {
					auto_login: true,
					jid: _jid,
					password: _pass
				});
			}

			converse.initialize(options);
		}
	}

	/** events */
	$("#conversejs_user_form").submit(function(e) {
		_pass = $('#conversejs_user_form input[name="pass"]').val();
		_jid = $('#conversejs_user_form input[name="jid"]').val();

		$.ajax({
			url: OC.generateUrl("/apps/conversejs/settings/personal"),
			type: "post",
			data: {
				jid: _jid,
				pass: _pass
			},
			success: function(response) {
				if (response && response.message) {
					init();
				}
			}
		});

		e.preventDefault();
	});
});
