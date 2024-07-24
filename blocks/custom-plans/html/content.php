<?php
$acf_fields = $args['acf_fields'] ?? [];
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$button = $acf_fields['button'] ?? [];
$image_id = $acf_fields['image_id'] ?? '';
$background_color = $acf_fields['background_color'] ?? 'bg-gray-200';

$background_colors = [
  'gray' => 'bg-gray-200',
  'white' => 'bg-white'
];

$current_background_color = $background_colors[$background_color] ?? 'bg-gray-200';
?>

<section class="custom-plans">
  <div class="<?php echo esc_attr($current_background_color); ?>">
    <div class="grid-container py-8 md:py-14 xl:py-20">
      <div class="col-span-full 2xl:col-start-2 2xl:col-span-10">
        <div class="text-center gap-4">
          <?php if ($heading): ?>
            <?php
            $headline_classes = 'font-h3 text-blue-600 mb-4';
            $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
            $headline_close_tag = '</' . esc_attr($tag_type) . '>';
            $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

            echo wp_kses_post($headline);
            ?>
          <?php endif; ?>

          <?php if ($description): ?>
            <div class="font-b2 text-gray-800 mb-6">
              <?php echo esc_html($description); ?>
            </div>
          <?php endif; ?>

          <?php if ($button): ?>
            <div class="col-span-full flex justify-center mb-4">
              <a class='button-primary-blue button-md' href="<?php echo esc_url($button['url']); ?>">
                <?php echo esc_html($button['title']); ?>
              </a>
            </div>
          <?php endif; ?>

          <?php if ($image_id): ?>
            <div class="flex justify-center">
              <?php echo wp_get_attachment_image($image_id, 'full', false, [
                'class' => 'h-15 w-[288px] md:size-auto'
              ]); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
