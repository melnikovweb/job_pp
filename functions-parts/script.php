<?php

use SECRET\Includes\Utilities;

require_once dirname(__DIR__) . '/includes/Utilities.php';

add_action('wp_enqueue_scripts', 'SECRET_enqueueScripts');
function SECRET_enqueueScripts()
{
}

function shapeSpace_print_scripts()
{
?>

  <script>
    var WP = {
      nonce: "<?php echo Utilities::get_nonce(); ?>",
      ajaxUrl: "<?php echo admin_url('admin-ajax.php'); ?>"
    }
  </script>

<?php
}
add_action('wp_print_scripts', 'shapeSpace_print_scripts');
