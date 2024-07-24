<?php
$acf_fields = $args['acf_fields'] ?? [];

$section_background_color = $acf_fields['section_background_color'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$content_left = $acf_fields['content_left'] ?? '';
$content_right = $acf_fields['content_right'] ?? '';
$extra_content = $acf_fields['extra_content'] ?? '';

$background_colors = [
  'light_yellow' => 'bg-yellow-100',
  'light_gray' => 'bg-gray-200',
  'dark_gray' => 'bg-gray-800'
];

$is_dark_theme = $section_background_color == 'dark_gray';
$title_color = $is_dark_theme ? 'text-yellow-100' : 'text-blue-600';
$text_color = $is_dark_theme ? 'text-white' : 'text-gray';

$current_color = $background_colors[$section_background_color] ?? 'bg:yellow-100';
?>

<div class="diagonal-content">
  <section class="grid <?php echo $current_color; ?> gap-y-6 py-8 md:gap-y-16 md:py-20 xl:py-24 xl:gap-y-20">
    <div class="grid-container gap-y-2 col-span-full lg:gap-y-10 xl:gap-y-14">
      <div class="grid grid-cols-subgrid col-span-full gap-y-4 md:gap-y-16 xl:gap-y-20">
        <?php echo "<$tag_type class='font-h1 $title_color col-span-full'>$heading</$tag_type>"; ?>

        <div class="font-h4 <?php echo $text_color; ?> col-span-full lg:col-end-[-2] 2xl:col-end-[-5]">
          <?php echo $content_left; ?>
        </div>
      </div>


      <div class="font-b1 <?php echo $text_color; ?> opacity-80 col-span-full lg:col-start-2 2xl:col-start-5">
        <?php echo $content_right; ?>
      </div>
    </div>

    <?php if ($extra_content): ?>

      <?php foreach ($extra_content as $layout):
        $layout_name = $layout['acf_fc_layout']; ?>
        <?php if ('marquee_images' === $layout_name): ?>
          <?php get_template_part($args['template_path'] . '/components/marquee-images/marquee-images', null, [
            'row_1' => $layout['row_1'],
            'row_2' => $layout['row_2']
          ]); ?>
        <?php endif; ?>

        <?php if ('5_images' === $layout_name): ?>
          <?php get_template_part($args['template_path'] . '/components/images-5/images-5', null, [
            'gallery' => $layout['gallery']
          ]); ?>
        <?php endif; ?>
        <?php if ('4_images' === $layout_name): ?>
        <?php get_template_part($args['template_path'] . '/components/images-4/images-4', null, [
          'gallery' => $layout['gallery']
        ]); ?>
      <?php endif; ?>
      <?php
      endforeach; ?>

    <?php endif; ?>
  </section>
</div>
