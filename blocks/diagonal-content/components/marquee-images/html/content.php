<div class="marquee-images" style="display: contents;">
  <div class="grid gap-2 overflow-hidden md:gap-6">
    <div class="flex gap-2 md:gap-8">
      <div class="animate-marquee flex gap-2 shrink-0 md:gap-8">
        <?php foreach ($args['row_1'] as $image_id): ?>
          <figure class="shrink-0 h-28 object-cover rounded-xs overflow-hidden m-0 md:h-[220px]">
            <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'h-full object-cover']); ?>
          </figure>
        <?php endforeach; ?>
      </div>

      <div class="animate-marquee flex gap-2 shrink-0 md:gap-8">
        <?php foreach ($args['row_1'] as $image_id): ?>
          <figure class="shrink-0 h-28 object-cover rounded-xs overflow-hidden m-0 md:h-[220px]" aria-hidden="true">
            <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'h-full object-cover']); ?>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="flex gap-2 md:gap-8">
      <div class="animate-marquee-reverse flex gap-2 shrink-0 md:gap-8">
        <?php foreach ($args['row_2'] as $image_id): ?>
          <figure class="shrink-0 h-28 object-cover rounded-xs overflow-hidden m-0 md:h-[220px]">
            <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'h-full object-cover']); ?>
          </figure>
        <?php endforeach; ?>
      </div>

      <div class="animate-marquee-reverse flex gap-2 shrink-0 md:gap-8">
        <?php foreach ($args['row_2'] as $image_id): ?>
          <figure class="shrink-0 h-28 object-cover rounded-xs overflow-hidden m-0 md:h-[220px]" aria-hidden="true">
            <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'h-full object-cover']); ?>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
