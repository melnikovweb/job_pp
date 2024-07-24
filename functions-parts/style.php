<?php

/**
 * This file enqueue global styles for all pages
 */

add_action('wp_enqueue_scripts', 'SECRET_enqueue_style');
function SECRET_enqueue_style()
{
  wp_enqueue_style('core', get_template_directory_uri() . '/public/core/core.css');
  wp_enqueue_style('header', get_template_directory_uri() . '/public/template-parts/layouts/header/header.css');
  wp_enqueue_style('footer', get_template_directory_uri() . '/public/template-parts/layouts/footer/footer.css');
}

add_action('admin_enqueue_scripts', 'SECRET_enqueue_admin_style', 99);
function SECRET_enqueue_admin_style()
{
  $screen = get_current_screen();
  if ($screen->parent_base == 'edit') {
    wp_enqueue_style('core', get_template_directory_uri() . '/public/core/core.css');
  }
}
