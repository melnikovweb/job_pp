<?php

if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'SECRET Layouts',
    'menu_title' => 'Layouts',
    'menu_slug' => 'SECRET-layouts',
    'capability' => 'edit_posts',
    'redirect' => false,
    'icon_url' => 'dashicons-layout'
  ]);

  acf_add_options_page([
    'page_title' => 'SECRET Settings',
    'menu_title' => 'Settings',
    'menu_slug' => 'SECRET-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ]);
}
