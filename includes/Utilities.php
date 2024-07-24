<?php

declare(strict_types=1);

namespace SECRET\Includes;

abstract class Utilities
{
  public static function build_nav_tree(array &$elements, $parentId = 0)
  {
    $branch = [];
    foreach ($elements as &$element) {
      if ($element->menu_item_parent == $parentId) {
        $children = self::build_nav_tree($elements, $element->ID);
        if ($children) {
          $element->child = $children;
        }
        $element->has_children = 1;

        $branch[$element->ID] = $element;
        unset($element);
      }
    }
    return $branch;
  }

  public static function verify_nonce(string $nonce): int|bool
  {
    return \wp_verify_nonce($nonce, 'SECRET_site_nonce');
  }

  public static function get_nonce()
  {
    return \wp_create_nonce('SECRET_site_nonce');
  }
}
