<div class="images-5">
  <div class="grid-container">
    <div class="grid grid-cols-10 gap-2 col-span-full *:col-span-3 [&:nth-child(5n)]:*:col-span-4 first:*:col-span-7 [&:nth-child(2)]:*:col-span-3 md:gap-4 lg:gap-5 xl:gap-8 2xl:col-start-2 2xl:col-end-[-2]">
      <?php foreach ($args['gallery'] as $image_id): ?>
        <figure class="h-[58px] m-0 rounded-xs overflow-hidden md:h-[230px] lg:h-[310px] xl:h-[396px] 2xl:h-[450px] md:rounded-md xl:rounded-lg">
          <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'h-full w-full object-cover']); ?>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</div>
