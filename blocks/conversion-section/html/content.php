<?php
$acf_fields = $args['acf_fields'];
$items = $acf_fields['items'] ?? '';
?>

<section class="conversion-section">
  <div class="grid-container gap-y-6 md:gap-y-14 py-8 md:py-20">
    <?php if ($items): ?>

      <?php foreach ($items as $item): ?>
        <div class="flex md:flex-col gap-4 md:gap-6 col-span-full md:col-span-2 lg:col-span-4 gap-4">
          <div class="size-6 md:size-8 shrink-0"><?php echo wp_get_attachment_image($item['image'], [32, 32]); ?></div>
          <div class="flex flex-col gap-2">
            <div class="font-t2"><?php echo esc_html($item['heading']); ?></div>
            <div class="font-b1"><?php echo esc_html($item['description']); ?></div>
          </div>
        </div>
      <?php endforeach; ?>

    <?php endif; ?>
  </div>
</section>