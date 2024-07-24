<?php

declare(strict_types=1);

namespace SECRET\Blocks;

if (isset($block['data']['preview_image_help'])) {
  echo '<img src="' .
    get_template_directory_uri() .
    $block['data']['preview_image_help'] .
    '" style="width:100%; height:auto;">';
} else {
  new AcfElement(__FILE__);
}
