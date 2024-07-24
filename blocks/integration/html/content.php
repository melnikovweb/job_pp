<?php

$acf_fields = $args['acf_fields'] ?? [];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_types'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$button_1 = $acf_fields['button_1'] ?? '';
$button_2 = $acf_fields['button_2'] ?? '';
$integration_methods = $acf_fields['integration_methods'] ?? [];

if ($acf_fields): ?>
  <section class="integration">
    <div class="bg-gray-800">
      <div class="grid-container gap-y-8 xl:gap-y-0 py-8 md:py-20 xl:py-30">
        <div class="col-span-12 xl:col-span-5 flex flex-col justify-center">
          <div class="font-b3 text-yellow pb-2"><?php echo esc_html($subheadings); ?></div>
          <?php echo '<' .
            esc_attr($tag_type) .
            ' class="font-h1 text-white pb-4 md:pb-6">' .
            esc_html($heading) .
            '</' .
            esc_attr($tag_type) .
            '>'; ?>
          <p class="font-b1 text-white/[.80] pb-6"><?php echo esc_html($description); ?></p>
          <div class="flex flex-col md:flex-row gap-4">
            <?php if ($button_1): ?>
              <div class="flex">
                <a class="button-primary-white button-md" href="<?php echo esc_url(
                  $button_1['url'] ?? ''
                ); ?>" target="<?php echo esc_attr($button_1['target'] ?: '_self'); ?>">
                  <?php echo esc_html($button_1['title'] ?? ''); ?>
                </a>
              </div>
            <?php endif; ?>

            <?php if ($button_2): ?>
              <div class="flex">
                <a class="button-primary-white button-md" href="<?php echo esc_url($button_2['url']); ?>">
                  <?php echo esc_html($button_2['title']); ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-span-12 xl:col-span-7">
          <?php if ($integration_methods): ?>
            <ul class="grid grid-cols-2 gap-4 md:gap-6 gap-y-6">
              <?php foreach ($integration_methods as $method): ?>
                <li class="bg-white/[.02] gap-4 group rounded-xs md:rounded-md flex flex-col md:flex-row items-center [&:nth-child(1)]:items-start justify-between p-4 md:p-8 [&:nth-child(1)]:col-span-2 col-span-1">
                  <div class="flex md:flex-col items-center md:items-start gap-2 md:gap-0 group-[&:nth-child(1)]:md:max-w-[201px] group-[&:nth-child(1)]:xl:max-w-[264px]">
                    <?php if ($method['name']): ?>
                      <div class="text-gray-100 font-h4 group-[&:nth-child(1)]:items-start"><?php echo esc_html(
                        $method['name']
                      ); ?></div>
                    <?php endif; ?>
                    <?php if ($method['description']): ?>
                      <div class="text-white/[.60] font-b1"><?php echo esc_html($method['description']); ?></div>
                    <?php endif; ?>
                  </div>
                  <?php if ($method['image']): ?>
                    <div class="flex">
                      <?php echo wp_get_attachment_image($method['image'], 'full', false, [
                        'class' => 'w-17 md:w-30 group-[&:nth-child(1)]:w-full'
                      ]); ?>
                    </div>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif;
