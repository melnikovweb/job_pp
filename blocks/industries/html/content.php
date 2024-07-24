<?php

namespace SECRET\Blocks\industries\html;

$acf_fields = $args['acf_fields'] ?? [];
$label = $acf_fields['label'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$button_1 = $acf_fields['button_1'] ?? [];
$button_2 = $acf_fields['button_2'] ?? [];
$industries = $acf_fields['industries'] ?? [];
?>

<section class="industries">
  <div class="grid-container gap-y-8 py-8 md:py-20 md:gap-y-14 xl:gap-y-20">
    <div class="col-span-full grid gap-6 xl:col-span-8 xl:col-start-3">
      <div class="text-center grid gap-4">
        <div class="grid gap-2">
          <div class="font-b3 text-gray-400"><?php echo esc_html($label); ?></div>

          <?php
          $headline_classes = 'font-h1 text-gray';
          $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . $headline_classes . '">';
          $headline_close_tag = '</' . esc_attr($tag_type) . '>';
          $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

          echo wp_kses_post($headline);
          ?>
        </div>

        <p class="font-b1 text-gray-800"><?php echo esc_html($description); ?></p>
      </div>

      <div class="flex flex-col gap-4 items-center justify-center md:flex-row">
        <?php if ($button_1) : ?>
          <a class="button-arrow-md button-primary-blue" href="<?php echo esc_url($button_1['url']); ?>">
            <?php echo esc_html($button_1['title']); ?>
          </a>
        <?php endif; ?>

        <?php if ($button_2) : ?>
          <a class="button-md button-primary-dark" href="<?php echo esc_url($button_2['url']); ?>">
            <?php echo esc_html($button_2['title']); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($industries) : ?>
      <div class="col-span-full overflow-hidden flex flex-col gap-8 md:gap-14 xl:gap-20 md:-mx-[--container-margin]">
        <?php
        $MAX_ROWS = 2;

        for ($rows = $MAX_ROWS; $rows > 0; $rows--) :

          $animation_direction = $rows % 2 ? ' md:animate-marquee-reverse' : ' md:animate-marquee';
          $is_single_row = $rows === $MAX_ROWS ? '' : ' max-md:hidden';
        ?>
          <div class="<?php echo $animation_direction .
                        $is_single_row; ?> md:flex gap-[--marquee-gap] [--marquee-gap:theme(spacing.4)] md:[--marquee-gap:theme(spacing.5)] xl:[--marquee-gap:theme(spacing.8)]">
            <?php
            $MAX_EXTRA_ITEMS = 2;
            for ($extra_items = $MAX_EXTRA_ITEMS; $extra_items > 0; $extra_items--) :
              $is_extra_items =
                $extra_items !== $MAX_EXTRA_ITEMS
                ? ' max-md:hidden'
                : ' max-md:justify-center max-md:grid grid-cols-[repeat(2,theme(spacing.36))]'; ?>
              <div class="overflow-hidden flex gap-[--marquee-gap] shrink-0 <?php echo $is_extra_items; ?>">
                <?php foreach ($industries as $industry) : ?>
                  <?php
                  $is_clickable = $industry['is_clickable'] ?? false;
                  $icon = $industry['icon'] ?? '';
                  $background_image = $industry['image'] ?? '';
                  $link = $industry['link'] ?? [];
                  $url = $link['url'] ?? '#';
                  $title = $link['title'] ?? '';

                  $href = $is_clickable ? 'href="' . esc_url($url) . '"' : '';

                  $item_sizes = 'w-full h-29 md:w-58 md:h-60 xl:w-[340px] xl:h-[292px] 2xl:w-[432px] 2xl:h-[372px]';
                  $interactive_classes = $is_clickable
                    ? ' transition-all hover:[--shadow-color:theme(colors.black/.5)]'
                    : '';
                  ?>
                  <a class="<?php echo esc_attr(
                              $item_sizes . $interactive_classes
                            ); ?> [--shadow-color:theme(colors.black/.2)] flex flex-col p-2 md:p-3 xl:p-4 [box-shadow:inset_0_0_0_100vmax_var(--shadow-color)] rounded-xs relative lg:rounded-sm overflow-hidden bg-cover" style="background-image: url('<?php echo esc_url(
                                                                                                                                                                                                                                                  $background_image
                                                                                                                                                                                                                                                ); ?>');" <?php echo esc_attr($href); ?>>
                    <?php if ($icon) : ?>
                      <span class="overflow-hidden size-6 lg:size-10 2xl:size-14">
                        <?php echo wp_get_attachment_image($icon, 'full'); ?>
                      </span>
                    <?php endif; ?>

                    <span class="font-b1 text-white mt-auto">
                      <?php echo $title; ?>
                    </span>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php
            endfor;
            ?>
          </div>
        <?php
        endfor;
        ?>
      </div>
    <?php endif; ?>
  </div>
</section>