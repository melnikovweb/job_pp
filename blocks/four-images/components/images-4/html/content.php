<div class="images-4 overflow-hidden">
  <div class="grid-container gap-y-8 py-8 md:py-16 md:gap-y-16 xl:gap-y-20 xl:py-20">
    <div class="grid grid-cols-subgrid col-span-full gap-y-4 md:gap-y-6">
      <div class="flex max-md:gap-4 animate-marquee md:animate-none md:grid md:grid-cols-subgrid md:col-span-full">
        <div class="flex max-md:gap-4 md:grid md:grid-cols-subgrid md:col-span-full 2xl:col-[3/-3]">
          <?php foreach ($args['gallery'] as $image_id): ?>
            <figure
                class="w-[183px] m-0 rounded-xs overflow-hidden md:w-full md:col-span-1 md:odd:mt-16 md:even:mb-16 lg:col-span-2 xl:col-span-3 xl:odd:mt-24 xl:even:mb-24 2xl:col-span-2  *:size-full *:object-cover ">
              <?php echo wp_get_attachment_image($image_id, [306, 447]); ?>
            </figure>
          <?php endforeach; ?>
        </div>

        <div class="flex gap-4 md:hidden">
          <?php foreach ($args['gallery'] as $image_id): ?>
            <figure class="w-[183px] m-0 rounded-xs overflow-hidden" aria-hidden="true">
              <?php echo wp_get_attachment_image($image_id, [306, 447]); ?>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
