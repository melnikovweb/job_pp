<?php
$acf_fields = $args['acf_fields'] ?? [];

$tag_type = $acf_fields['tag_type'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$items = $acf_fields['items'] ?? '';
?>

<div class="history">
  <section class="grid gap-y-6 py-8 md:gap-y-16 md:py-20 xl:py-24 xl:gap-y-20 bg-gray-200">
    <div class="grid-container">
      <?php echo '<' .
        esc_attr($tag_type) .
        ' class="text-gray font-h1 col-span-full mb-8 md:mb-20">' .
        esc_html($heading) .
        '</' .
        esc_attr($tag_type) .
        '>'; ?>
      <div class="grid grid-cols-subgrid col-span-full gap-y-6">
        <?php foreach ($items as $item) : ?>
          <div class="flex flex-col items-start lg:grid grid-cols-12 col-span-full lg:col-end-[-2] 2xl:col-end-[-4] md:text-lg lg:text-xl xl:text-2xl justify-between">
            <div class="flex flex-row items-center col-span-4 mb-6">
              <div class="text-blue-800 font-h4">
                <?php echo esc_html($item['year']); ?>
              </div>
              <?php if ($item['uncompleted']) : ?>
                <div class="bg-yellow px-2 py-1 font-b3 ml-4 h-fit rounded-sm">
                  <?php _e('soon', 'SECRET-domain'); ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="font-b1 col-span-8 space-y-4 text-gray-800">
              <?php echo wp_kses_post($item['label']); ?>
            </div>
          </div>
          <hr class="h-[2px] bg-white w-full col-span-full">
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</div>