<?php $fields = $args['fields'] ?? []; ?>

<section class="content-single-event">
  <div class="grid-container py-8 gap-y-4 md:py-16 md:gap-y-6 xl:py-20 xl:gap-y-20">
    <div class="col-span-4 lg:col-span-2 lg:content-between">
      <?php if ($fields['image']) {
        echo wp_get_attachment_image($fields['image'], [250, 144]);
      } ?>
    </div>

    <div class="grid gap-4 col-span-4 lg:col-span-5 xl:col-span-10">
      <h1 class="font-h3 text-gray col-span-full"><?php the_title(); ?></h1>

      <div class="grid grid-cols-1 md:grid-cols-4 md:gap-y-4 md:gap-x-6 gap-2 lg:gap-10 lg:grid-cols-12">
        <?php if ($fields['start_date'] & $fields['end_date']) : ?>
          <div class="grid md:col-span-2 lg:col-span-3 gap-2 self-start">
            <div class="text-gray-600 font-b1"><?php _e('When:', 'SECRET-domain'); ?></div>
            <div class="text-gray font-b1"><?php echo esc_html(
                                              $fields['start_date'] . '-' . $fields['end_date']
                                            ); ?></div>
          </div>
        <?php endif; ?>

        <?php if ($fields['where']) : ?>
          <div class="grid md:col-span-2 lg:col-span-3 gap-2 self-start">
            <div class="text-gray-600 font-b1"><?php _e('Where:', 'SECRET-domain'); ?></div>
            <div class="text-gray font-b1"><?php echo esc_html($fields['where']); ?></div>
          </div>
        <?php endif; ?>

        <?php if ($fields['site']) : ?>
          <div class="grid md:col-span-2 lg:col-span-3 gap-2 self-start">
            <div class="text-gray-600 font-b1"><?php _e('Site:', 'SECRET-domain'); ?></div>
            <a class="text-blue-600 font-b1" href="<?php echo $fields['site']['url']; ?>" target="_blank"><?php echo esc_html($fields['site']['title']); ?></a>
          </div>
        <?php endif; ?>

        <?php if ($fields['our_stand']) : ?>
          <div class="grid md:col-span-2 lg:col-span-3 gap-2 self-start">
            <div class="text-gray-600 font-b1"><?php _e('Our stand:', 'SECRET-domain'); ?></div>
            <div class="text-gray font-b1"><?php echo esc_html($fields['our_stand']); ?></div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php the_content(); ?>

  <div class="grid-container">
    <div class="col-span-full">
      <?php get_template_part('template-parts/components/posts/posts'); ?>
    </div>
  </div>
</section>