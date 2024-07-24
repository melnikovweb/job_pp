<?php
extract($args);
$title = $acf_fields['title'] ?? '';
$posts_colors = ['bg-yellow-100', 'bg-pink-100', 'bg-green-100', 'bg-blue-100'];
?>

<div class="vacancy">
  <div class="grid-container py-8 md:py-20 xl:py-24">
    <?php if ($filters) { ?>
      <div class="grid grid-cols-subgrid col-span-full xl:pb-20 md:pb-16 pb-8">
        <?php foreach ($filters as $filter) { ?>
          <div class="xl:col-span-5 md:col-span-4 col-span-2">
            <div class="text-gray font-b1 pb-1"><?php echo esc_html($filter['title']); ?></div>
            <select data-filter-type="taxonomy" data-filteredby="<?php echo esc_html($filter['taxonomy']); ?>" multiple>
              <?php foreach ($filter['terms'] as $term) { ?>
                <option value="<?php echo esc_attr($term['term_id']); ?>">
                  <?php echo esc_html($term['name']); ?>
                </option>
              <?php } ?>
            </select>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <div class="font-h1 mb-6 text-blue-600 md:mb-10 col-span-full"><?php echo esc_html($title); ?></div>

    <?php if ($posts) { ?>
      <div class="filter-content-container vacancy-item flex flex-col gap-y-4 col-span-full xl:grid xl:grid-cols-subgrid xl:col-span-full">
        <?php foreach ($posts as $item_step => $item) { ?>
          <?php
          $color_index = $item_step % count($posts_colors);
          $item['color'] = $posts_colors[$color_index];
          ?>
          <?php get_template_part('template-parts/components/vacancy-item/vacancy-item', null, $item); ?>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>
