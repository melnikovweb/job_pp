<?php
$acf_fields = $args['acf_fields'] ?? [];
$title = $acf_fields['title'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$subtitle = $acf_fields['subtitle'] ?? '';
$description = $acf_fields['description'] ?? '';
$posts = $args['posts'] ?? [];
$filters = $args['filters'] ?? [];
?>

<div class="payment-methods">
  <div class="grid-container py-20">
    <?php if ($filters) { ?>
      <div class="grid grid-cols-subgrid col-span-full my-6">
        <div class="col-span-4">
          <input type="text" name="search" placeholder="<?php _e('Search', 'SECRET-domain'); ?>">
        </div>
        <?php foreach ($filters as $filter) { ?>
          <?php
          $title = $filter['title'] ?? '';
          $taxonomy = $filter['taxonomy'] ?? '';
          $terms = $filter['terms'] ?? [];
          ?>
          <div class="col-span-2">
            <select data-filter-type="taxonomy" data-filteredby="<?php echo esc_attr(
                                                                    $taxonomy
                                                                  ); ?>" placeholder="<?php echo esc_attr($title); ?>">
              <?php foreach ($terms as $term) { ?>
                <?php
                $name = $term['name'] ?? '';
                $term_id = $term['term_id'] ?? '';
                ?>
                <option value="<?php echo esc_attr($term_id); ?>">
                  <?php echo esc_html($name); ?>
                </option>
              <?php } ?>
            </select>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <?php if ($posts) : ?>
      <div class="grid grid-cols-4 col-span-full">
        <?php foreach ($posts as $item) : ?>
          <?php
          $post_id = $item['post_id'] ?? '';
          $title = $item['post_title'] ?? '';
          $url = $item['url'] ?? '';
          $excerpt = $item['excerpt'] ?? '';
          $taxonomies = $item['taxonomies'] ?? [];
          ?>
          <a href="<?php echo esc_url($url); ?>" <?php foreach ($taxonomies as $name => $value) :
                                                    echo 'data-' . esc_attr($name) . '="' . esc_attr($value) . '" ';
                                                  endforeach; ?>>
            <span>
              <?php echo wp_get_attachment_image(get_post_thumbnail_id($post_id), [390, 166]); ?>
            </span>
            <?php echo esc_html($title); ?>
            <?php if (isset($taxonomies['payment-method-type'])) : ?>
              <span class="block"><?php echo esc_html($taxonomies['payment-method-type']); ?></span>
            <?php endif; ?>
            <?php if ($excerpt) : ?>
              <span class="block"><?php echo esc_html($excerpt); ?></span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>