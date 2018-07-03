var foo = 0
console.log(foo); foo++;
// (function ($, converse, OCP) {
  console.log(foo); foo++;
  $(document).ready(function () {
    console.log(foo); foo++;
    // var boshUrl = OCP.AppConfig.getValue('conversejs', 'bosh_url');
    var boshUrl = 'https:conversejs.org/http-bind/';
    converse.initialize({
      bosh_service_url: boshUrl,
      jid: "lil5@disroot.org",
      show_controlbox_by_default: true
    });
  });
// })(jQuery, converse, OCP);
