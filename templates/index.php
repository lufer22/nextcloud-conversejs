<?php
script('conversejs', 'converse.min');
// script('conversejs', 'init');
style('conversejs', 'inverse.min');




?>
<h1>hi</h1>
<p><?php p($_['boshUrl']) ?></p>
<script>
(function ($, converse) {
  $(document).ready(function () {
    converse.initialize({
      bosh_service_url: '<?php p($_['boshUrl']) ?>',
      show_controlbox_by_default: true
    });
  });
});
</script>
