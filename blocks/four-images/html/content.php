<?php

$acf_fields = $args['acf_fields'] ?? [];

$color_variants = [
  'text-blue-600' => 'text-blue-600',
  'text-gray' => 'text-gray'
];

$tag_type = $acf_fields['tag_type'] ?? 'h2';
$label = $acf_fields['label'] ?? '';
$link = $acf_fields['link'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$heading_color = $acf_fields['heading_color'] ?? '';
$text = $acf_fields['text'] ?? '';
$extra_content = $acf_fields['extra_content'] ?? '';

$curent_color = $color_variants[$heading_color['color']];
?>
<div class="four-images">
  <div class="grid-container gap-y-8 py-8 md:py-16 md:gap-y-16 xl:gap-y-20 xl:py-20">
    <div class="grid col-span-full gap-y-4 md:gap-y-6">
      <div class="grid col-span-full gap-y-4 md:gap-y-8">
        <div class="grid grid-cols-subgrid col-span-full text-center gap-y-2 md:gap-y-4">
          <div class="font-b3 text-gray-400 col-span-full">
            <?php echo $label; ?>
          </div>

          <?php echo "<$tag_type class='col-span-full font-h1 $curent_color'>$heading</$tag_type>"; ?>
        </div>

        <div class="col-span-full text-gray font-b1 text-center">
          <?php echo $text; ?>
        </div>
      </div>

      <?php if ($link):

        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>

        <a class="button-arrow-md button-primary-blue place-self-center col-span-full " href="<?php echo esc_url(
          $link_url
        ); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
        </a>
      <?php
      endif; ?>
      <?php if ($extra_content): ?>

        <?php foreach ($extra_content as $layout):
          $layout_name = $layout['acf_fc_layout']; ?>
          <?php if ('marquee_images' === $layout_name): ?>
          <?php get_template_part($args['template_path'] . '/components/marquee-images/marquee-images', null, [
            'row_1' => $layout['row_1'],
            'row_2' => $layout['row_2']
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
    </div>
  </div>
</div>
