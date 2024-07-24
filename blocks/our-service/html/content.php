<?php
$acf_fields = $args['acf_fields'] ?? [];

$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$button_1 = $acf_fields['button_1'] ?? '';
$button_2 = $acf_fields['button_2'] ?? '';
$advantages_block = $acf_fields['advantages_block'] ?? '';
?>

<section class="our-service">
  <div class="bg-gray-800">
    <div class="grid-container gap-y-8 py-8 md:py-20 md:gap-y-20 xl:gap-y-24 xl:py-30">
      <div class="col-span-full grid gap-6 text-center">
        <div class="grid gap-2">
          <div class="text-yellow font-b3"><?php echo esc_html($subheadings); ?></div>

          <?php
          $headline_classes = 'font-h1 text-white';
          $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . $headline_classes . '">';
          $headline_close_tag = '</' . esc_attr($tag_type) . '>';
          $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

          echo $headline;
          ?>
        </div>

        <div class="font-b1 text-gray-200"><?php echo esc_html($description); ?></div>

        <?php if ($button_1 || $button_2) : ?>
          <div class="flex align-center justify-center gap-2">
            <?php if ($button_1) : ?>
              <a class="button-arrow-md button-primary-blue encoded-arrow-right" href="<?php echo esc_url(
                                                                                          $button_1['url']
                                                                                        ); ?>">
                <?php echo esc_html($button_1['title']); ?>
              </a>
            <?php endif; ?>

            <?php if ($button_2) : ?>
              <a class="button-md button-primary-dark" href="<?php echo esc_url($button_2['url']); ?>">
                <?php echo esc_html($button_2['title']); ?>
              </a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if ($advantages_block) : ?>
        <ul class="col-span-full grid grid-cols-subgrid gap-y-4 md:gap-y-6 lg:gap-y-8 2xl:gap-y-10">
          <?php foreach ($advantages_block as $advantage) : ?>
            <li class="col-span-full grid content-start bg-white group gap-4 overflow-hidden [&:nth-child(-n+2)]:bg-gray rounded-xs md:col-span-2 lg:col-span-4 md:rounded-md xl:col-span-6 xl:[&:nth-child(3)]:col-span-8 xl:[&:nth-child(4)]:col-span-4 xl:rounded-lg">
              <?php if ($advantage['image']) : ?>
                <div class="px-4 h-50 md:h-[260px] lg:h-[300px] xl:h-[380px] w-full *:size-full *:object-contain">
                  <?php echo wp_get_attachment_image($advantage['image'], 'full'); ?>
                </div>
              <?php endif; ?>

              <div class="grid px-4 pb-4 gap-4 md:px-6 md:pb-6 xl:px-10 xl:pb-10">
                <?php if ($advantage['name']) : ?>
                  <h3 class="text-gray font-h3 group-[:nth-child(-n+2)]:text-white">
                    <?php echo esc_html($advantage['name']); ?>

                    <?php if ($advantage['uncompleted']) : ?>
                      <?php _e('Soon', 'SECRET-domain'); ?>
                    <?php endif; ?>
                  </h3>
                <?php endif; ?>

                <?php if ($advantage['description']) : ?>
                  <p class="font-b2 text-gray-800 group-[:nth-child(-n+2)]:text-gray-200"><?php echo esc_html(
                                                                                            $advantage['description']
                                                                                          ); ?></p>
                <?php endif; ?>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>