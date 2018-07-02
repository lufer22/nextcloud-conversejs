<?php
script('conversejs', 'converse.min');
style('conversejs', 'converse.min');

?>
<script>
function () {
  function init() {
    converse.initialize({
      bosh_service_url: 'https://conversejs.org/http-bind/', // Please use this connection manager only for testing purposes
      show_controlbox_by_default: true
    });
  }

  window.addEventListener ?
  window.addEventListener("load",init,false) :
  window.attachEvent && window.attachEvent("onload",init);

}();



</script>
