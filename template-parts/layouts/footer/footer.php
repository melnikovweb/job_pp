<?php

namespace SECRET\Layouts;

use SECRET\Includes\Element;
use SECRET\Includes\Utilities;

$theme_locations = get_nav_menu_locations();
if (isset($theme_locations['footer-col-1-menu'])) {
  $menu_obj = get_term($theme_locations['footer-col-1-menu'], 'nav_menu');
  $menu_items = wp_get_nav_menu_items($menu_obj->term_id, ['order' => 'DESC']);
  $args['menu-1'] = Utilities::build_nav_tree($menu_items);
}

if (isset($theme_locations['footer-col-2-menu'])) {
  $menu_obj = get_term($theme_locations['footer-col-2-menu'], 'nav_menu');
  $menu_items = wp_get_nav_menu_items($menu_obj->term_id, ['order' => 'DESC']);
  $args['menu-2'] = Utilities::build_nav_tree($menu_items);
}

if (isset($theme_locations['footer-col-3-menu'])) {
  $menu_obj = get_term($theme_locations['footer-col-3-menu'], 'nav_menu');
  $menu_items = wp_get_nav_menu_items($menu_obj->term_id, ['order' => 'DESC']);
  $args['menu-3'] = Utilities::build_nav_tree($menu_items);
}

if (isset($theme_locations['footer-col-4-menu'])) {
  $menu_obj = get_term($theme_locations['footer-col-4-menu'], 'nav_menu');
  $menu_items = wp_get_nav_menu_items($menu_obj->term_id, ['order' => 'DESC']);
  $args['menu-4'] = Utilities::build_nav_tree($menu_items);
}

// TODO add default values to all variables
$args['logo'] = get_field('footer_logo', 'options');
$args['footer_block']['text'] = get_field('footer_block_text', 'options') ?: '';
$args['footer_block']['merchant'] = get_field('footer_block_merchant', 'options') ?: '';
$args['footer_block']['link'] = get_field('footer_block_link', 'options') ?: '';
$args['socials'] = get_field('footer_socials', 'options') ?: [];
$args['copyrights'] = get_field('copyrights', 'options');

new Element(__FILE__, $args);
