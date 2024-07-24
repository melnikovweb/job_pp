<?php

add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{
  /**
   * Load blocks.
   * Requires all blocks found in the 'blocks' directory.
   */
  function loadBlocks(): void
  {
    $blocks = glob(dirname(__DIR__) . '/blocks/*', GLOB_ONLYDIR);
    foreach ($blocks as $block) {
      register_block_type($block);
    }
  }

  loadBlocks();
}
