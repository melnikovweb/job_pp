<?php

$acf_fields = $args['acf_fields'] ?? [];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_types'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$button_1 = $acf_fields['button_1'] ?? '';
$button_2 = $acf_fields['button_2'] ?? '';
$products = $acf_fields['products'] ?? [];
$advantages_block = $acf_fields['advantages_block'] ?? [];

if ($acf_fields): ?>
  <section class="our-products">
    <div class="bg-gray-200 py-8 md:py-20 xl:py-30">
      <div class="container">
        <div class="lg:max-w-[864px]">
          <div class="font-b3 text-blue-600 pb-2"><?php echo esc_html($subheadings); ?></div>
          <?php echo '<' .
            esc_attr($tag_type) .
            ' class="font-h1 text-gray pb-6">' .
            esc_html($heading) .
            '</' .
            esc_attr($tag_type) .
            '>'; ?>
          <p class="font-b1 text-gray-800 pb-6"><?php echo esc_html($description); ?></p>
          <div class="flex flex-col md:flex-row gap-4">
            <?php if ($button_1): ?>
              <div class="flex">
                <a class="button-primary-blue button-arrow-md" href="<?php echo esc_url($button_1['url']); ?>">
                  <?php echo esc_html($button_1['title']); ?>
                </a>
              </div>
            <?php endif; ?>
            <?php if ($button_2): ?>
              <div class="flex">
                <a class="button-md button-primary-dark" href="<?php echo esc_url($button_2['url']); ?>">
                  <?php echo esc_html($button_2['title']); ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php if ($products): ?>
          <div class="grid grid-cols-12 2xl:gap-10 lg:gap-8 gap-6 py-8 md:py-20 xl:py-24">
            <?php
            $background_colors = [
              'white' => 'bg-white',
              'dark_gray' => 'bg-gray-800'
            ];
            $text_colors = [
              'white' => 'text-gray-800',
              'dark_gray' => 'text-white'
            ];
            $dots_colors = [
              'white' => 'bg-blue-600',
              'dark_gray' => 'bg-yellow-100'
            ];
            foreach ($products as $product):

              $background_color = $background_colors[$product['color']] ?? 'bg-white';
              $text_color = $text_colors[$product['color']] ?? 'text-gray-800';
              $dots_color = $dots_colors[$product['color']] ?? 'bg-blue-600';
              ?>

              <div class="flex justify-between flex-col col-span-12 md:col-span-6 rounded-xs md:rounded-sm lg:rounded-md pt-4 px-4 md:pt-6 md:px-6 xl:pt-10 xl:px-10 <?php echo esc_attr(
                $background_color
              ); ?>">
                <div>
                  <div class="font-h3 pb-4 <?php echo esc_attr($text_color); ?>">
                    <?php echo esc_html($product['name']); ?>
                  </div>

                  <div class="pb-6 md:pb-9 lg:pb-14 xl:pb-12 overflow-hidden">
                    <div class="flex items-center gap-2">
                      <?php $product_description = $product['description'] ?? []; ?>
                      <?php for ($rows = 1; $rows <= 3; $rows++): ?>
                        <div class="flex items-center shrink-0 gap-2 animate-fast-marquee">
                          <?php foreach ($product_description as $description): ?>
                            <p class="font-b1 text-nowrap  <?php echo esc_attr($text_color); ?>">
                              <?php echo esc_html($description['description_name']); ?>
                            </p>
                            <div class="size-1 shrink-0 rounded-full last:hidden <?php echo esc_attr(
                              $dots_color
                            ); ?>"></div>
                          <?php endforeach; ?>
                        </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                </div>

                <?php if ($product['image']): ?>
                  <?php echo wp_get_attachment_image($product['image'], 'full', null, [
                    'class' => 'self-center max-w-55 lg:max-w-[272px] xl:max-w-[404px]'
                  ]); ?>
                <?php endif; ?>
              </div>
            <?php
            endforeach;
            ?>
          </div>
        <?php endif; ?>
        <?php if ($advantages_block): ?>
          <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 lg:gap-y-12 2xl:gap-10">
            <?php foreach ($advantages_block as $advantage): ?>
              <li class="flex items-start col-span-1 gap-6">
                <div class="flex justify-center items-center rounded-full min-w-10 min-h-10 bg-gray-800 text-white font-b1"><?php echo esc_html(
                  $advantage['number']
                ); ?></div>
                <p class="text-gray-800 font-b1"><?php echo esc_html($advantage['text']); ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

      </div>
    </div>
  </section>
<?php endif;
