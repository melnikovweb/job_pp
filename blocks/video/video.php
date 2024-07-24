<?php

declare(strict_types=1);

namespace SECRET\Blocks;

use SECRET\Includes\AcfElement;

if (isset($block['data']['preview_image_help'])) {
  echo '<img src="' .
    get_template_directory_uri() .
    $block['data']['preview_image_help'] .
    '" style="width:100%; height:auto;">';
} else {
  $args['video_block'] = get_field('video_block', 'options') ?: [];

  new AcfElement(__FILE__, $args);
}
