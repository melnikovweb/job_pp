<?php

/**
 * Admin styles.
 *
 */
function acf_admin_styles()
{
  echo '<style>
    .acf-block-preview {
      max-width: none !important;
    }
  </style>';
}
add_action('admin_head', 'acf_admin_styles');
