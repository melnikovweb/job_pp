<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/Utilities.php';

use SECRET\Includes\Utilities;

class AjaxLoadItems
{
  public function __construct()
  {
    throw new Exception('AjaxLoadItems instance can not be created');
  }

  public static function load_items()
  {
    if (false === Utilities::verify_nonce($_POST['nonce'])) {
      wp_send_json_error('Incorrect nounce');
    }

    if (!isset($_POST['type'])) {
      wp_send_json_error('post type was not exsisted');
    }

    if (!isset($_POST['template-part'])) {
      wp_send_json_error('Template part was not exsisted');
    }

    $template_part = 'template-parts/components/' . $_POST['template-part'];

    if (!locate_template($template_part . '.php')) {
      wp_send_json_error('Tempalte part file was not exsisted');
    }

    $args = self::prepare_query_args($_POST);
    $query = new WP_Query($args);

    $content = AjaxLoadItems::get_content($query, $template_part);

    wp_send_json_success($content);
  }

  public static function prepare_query_args(array $request): array
  {
    $args['post_type'] = sanitize_text_field($request['type']);
    $args['posts_per_page'] = isset($request['per_page']) ? sanitize_text_field($request['per_page']) : -1;
    $args['offset'] = isset($request['offset']) ? sanitize_text_field($request['offset']) : 0;

    if (isset($request['meta'])) {
      $meta = json_decode(stripslashes($request['meta']), true);

      if (is_array($meta) && count($meta)) {
        $args['meta_query'] = AjaxLoadItems::prepare_meta_query($meta);
      }
    }

    if (isset($request['categories'])) {
      $categories = json_decode(stripslashes($request['categories']), true);

      if (is_array($categories) && count($categories)) {
        $args['tax_query'] = AjaxLoadItems::prepare_tax_query($categories);
      }
    }

    return $args;
  }

  public static function prepare_tax_query(array $categories): array
  {
    $tax_query = array_map(
      function ($key, $category) {
        return [
          'taxonomy' => sanitize_text_field($key),
          'field' => 'slug',
          'terms' => $category
        ];
      },
      array_keys($categories),
      $categories
    );

    if (count($tax_query) > 1) {
      $tax_query['relation'] = 'AND';
    }
    return $tax_query;
  }

  public static function prepare_meta_query(array $meta): array
  {
    $meta_query = array_map(function ($meta) {
      return [
        'key' => sanitize_text_field($meta['key']),
        'value' => sanitize_text_field($meta['value']),
        'compare' => $meta['compare'],
        'type' => sanitize_text_field($meta['type'])
      ];
    }, $meta);

    if (count($meta_query) > 1) {
      $meta_query['relation'] = 'AND';
    }
    return $meta_query;
  }

  public static function get_content($query, $template_part): array
  {
    $content = [];

    while ($query->have_posts()) :
      $query->the_post();

      ob_start();
      get_template_part($template_part);
      $content[] = ob_get_contents();
      ob_end_clean();
    endwhile;
    wp_reset_query();
    return $content;
  }
}

add_action('wp_ajax_load_items', 'AjaxLoadItems::load_items');
add_action('wp_ajax_nopriv_load_items', 'AjaxLoadItems::load_items');
