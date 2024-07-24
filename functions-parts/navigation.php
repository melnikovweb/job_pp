<?php

add_theme_support('menus');
if (function_exists('register_nav_menus')) {
  add_action('init', 'SECRET_register_navigation');

  function SECRET_register_navigation()
  {
    register_nav_menus([
      'header-menu' => __('Header Menu'),
      'footer-col-1-menu' => __('Footer col 1 menu'),
      'footer-col-2-menu' => __('Footer col 2 menu'),
      'footer-col-3-menu' => __('Footer col 3 menu'),
      'footer-col-4-menu' => __('Footer col 4 menu')
    ]);
  }
}
