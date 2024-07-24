<div class="event-item">
  <div class="grid gap-y-4">
    <a class="rounded-xs md:rounded-md overflow-hidden" href="<?php echo esc_url($args['permalink']); ?>">
      <?php echo get_the_post_thumbnail($args['ID'], [524, 352], ['class' => 'size-full object-cover']); ?>
    </a>

    <div class="grid gap-4">
      <div class="flex justify-between items-center">
        <div class="flex gap-1">
          <?php if ($args['categories']) : ?>
            <?php foreach ($args['categories'] as $category) : ?>
              <div class="font-b3 text-gray-800 border rounded-full border-gray-400 px-2 py-1">
                <?php echo esc_html($category->name); ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <div class="font-b3 text-gray-800">
          <?php echo esc_html($args['date']); ?>
        </div>
      </div>

      <div class="text-gray-800 font-b1 col-span-full">
        <?php echo esc_html($args['title']); ?>
      </div>

      <a class="button-md button-primary-dark w-fit" href="<?php echo esc_url($args['permalink']); ?>">
        <?php _e('Find out more', 'SECRET-domain'); ?>
      </a>
    </div>
  </div>
</div>