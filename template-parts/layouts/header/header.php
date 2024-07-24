<?php

namespace SECRET\Layouts;

use SECRET\Includes\Element;
use SECRET\Includes\Utilities;

$theme_locations = get_nav_menu_locations();
if (isset($theme_locations['header-menu'])) {
  $menu_obj = get_term($theme_locations['header-menu'], 'nav_menu');

  if ($menu_obj && !is_wp_error($menu_obj)) {
    $menu_items = wp_get_nav_menu_items($menu_obj->term_id, ['order' => 'DESC']);
    $args['nav'] = Utilities::build_nav_tree($menu_items);
    $args['logo']['for_light_header'] = get_field('logo_for_light_header', 'nav_menu_' . $menu_obj->term_id);
    $args['logo']['for_dark_header'] = get_field('logo_for_dark_header', 'nav_menu_' . $menu_obj->term_id);

    $args['extra_links'] = get_field('extra_links', 'nav_menu_' . $menu_obj->term_id);

    new Element(__FILE__, $args);
  }
}
