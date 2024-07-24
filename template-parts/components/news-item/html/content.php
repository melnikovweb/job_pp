<?php extract($args); ?>
<div class="news-item">
  <div class="grid gap-4">
    <a class="*:w-full *:object-cover *:rounded-sm" href="<?php echo esc_url($post_link); ?>">
      <?php if ($args['thumbnail']) : ?>
        <?php echo wp_kses_post($thumbnail); ?>
      <?php else : ?>
        <img src="<?php echo get_template_directory_uri() .
                    '/assets/images/image-not-found.jpg'; ?>" alt="Image not found" width="824" height="289">
      <?php endif; ?>
    </a>

    <div class="grid gap-4">
      <div class="flex justify-between items-center">
        <div class="flex gap-1">
          <?php foreach ($args['categories'] as $category) : ?>
            <div class="font-b3 text-gray-600 border rounded-full border-gray-400 px-2 py-1">
              <?php echo esc_html($category['title']); ?>
            </div>
          <?php endforeach; ?>
        </div>

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

      <div class="text-gray-800 font-b1 col-span-full text-pretty">
        <?php echo esc_html($title); ?>
      </div>
    </div>
  </div>
</div>