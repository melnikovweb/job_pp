<?php extract($args); ?>

<div class="post-item">
  <div class="grid gap-4">
    <a href="<?php echo esc_url(
                $post_link
              ); ?>" class="flex overflow-hidden rounded-xs md:rounded-md lg:rounded-sm *:size-full *:object-cover">
      <?php if ($thumbnail) : ?>
        <?php echo wp_kses_post($thumbnail); ?>
      <?php else : ?>
        <img src="<?php echo get_template_directory_uri() .
                    '/assets/images/image-not-found.jpg'; ?>" alt="Image not found" width="824" height="289">
      <?php endif; ?>
    </a>

    <div class="grid gap-2 md:gap-4 lg:gap-6 row-start-2">
      <div class="flex items-center justify-between">
        <?php if ($categories) : ?>
          <div class="py-1 px-2 font-b3 text-gray-600 bg-yellow rounded-full">
            <?php foreach ($categories as $category) : ?>
              <a href="<?php echo esc_url($category['url']); ?>"><?php echo esc_html($category['title']); ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="flex items-center gap-2 font-b3 text-gray-400">
          <?php echo get_the_date(); ?>

          <?php if ($read_time) : ?>
            <svg class="size-1" viewBox="0 0 4 4" fill="none">
              <circle cx="2" cy="2" r="2" stroke fill="currentColor" />
            </svg>

            <?php echo esc_html($read_time) . ' ' . __('min read', 'SECRET-domain'); ?>
          <?php endif; ?>
        </div>
      </div>

      <h2 class="font-b1 text-gray">
        <a href="<?php echo esc_url($post_link); ?>">
          <?php echo esc_html($title); ?>
        </a>
      </h2>
    </div>
  </div>
</div>