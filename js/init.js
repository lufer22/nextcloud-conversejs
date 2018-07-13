$(document).ready(function() {
	/** global vars */
	var _boshUrl = _jid = _pass = '';

	/** auto start */
	$.ajax({
		url: OC.generateUrl("/apps/conversejs/settings/admin"),
		type: "post",
		data: {},
		success: function(response) {
			if (response && response.data.boshUrl.length > 0) {
				_boshUrl = response.data.boshUrl
				init()
			} else {
				OC.Notification.show("Bosh url is not configured");
			}
		}
	});

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
			}

			// add auto login
			if (_jid.length>0 && _pass.length>0) {
				options = Object.assign(options, {
					auto_login: true,
					jid: _jid,
					password: _pass
				})
			}

			converse.initialize(options);
	}
	}

	/** events */
	$('#conversejs_user_form').submit(function (e) {
		_pass = $('#conversejs_user_form input[name="pass"]').val();
		_jid = $('#conversejs_user_form input[name="jid"]').val();

		init()

		e.preventDefault();
	})
});
