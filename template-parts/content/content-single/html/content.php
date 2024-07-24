<?php
$table_of_contents = $args['acf_fields']['table_of_contents'] ?? [];
$read_time = $args['read_time'] ?? '';
$title = $args['title'] ?? '';
$thumbnail = $args['thumbnail'] ?? '';
$content = $args['content'] ?? '';
$date = $args['date'] ?? '';
?>

<div class="content-single" style="display:contents;">
  <div class="grid-container">
    <div class="col-span-full py-8 grid gap-4 xl:col-[2/-2] md:gap-8 2xl:gap-12 md:py-12">
      <?php get_template_part('template-parts/components/breadcrumbs/breadcrumbs'); ?>

      <div class="grid gap-4 xl:gap-6">
        <h1 class="font-h3 text-gray"><?php echo esc_html($title); ?></h1>

        <div class="*:w-full max-h-[1000px] rounded-xs overflow-hidden">
          <?php if ($thumbnail) : ?>
            <?php echo wp_kses_post($thumbnail); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="grid items-start grid-cols-subgrid col-span-full py-8 md:py-16 xl:py-20">
      <div class="lg:sticky top-22 left-0 col-span-full lg:col-span-3 xl:col-span-4 grid lg:gap-10 md:gap-6 gap-4 items-start content-start">
        <?php if ($table_of_contents) : ?>
          <?php get_template_part('template-parts/components/table-of-contents/table-of-contents', '', [
            'table_of_contents' => $table_of_contents
          ]); ?>
          <hr class="border-gray-200">
        <?php endif; ?>

        <div class="grid gap-4">
          <div class="grid gap-2 font-b1 text-gray">
            <div class="text-gray-400">
              <?php _e('Date of holding', 'SECRET-domain'); ?>
            </div>

            <div><?php echo esc_html($date); ?></div>
          </div>

          <?php if ($read_time) : ?>
            <div class="grid gap-2 font-b1 text-gray">
              <div class="text-gray-400">
                <?php _e('Read time', 'SECRET-domain'); ?>
              </div>

              <div><?php echo esc_html($read_time) . ' ' . __('min', 'SECRET-domain'); ?></div>
            </div>
          <?php endif; ?>
        </div>

        <div class="contents [&:not(:has(a))]:hidden">
          <hr class="border-gray-200">

          <div class="space-y-2 md:space-y-6 font-b1 text-gray">
            <div class="text-gray-400"><?php _e('Follow Us:', 'SECRET-domain'); ?></div>

            <?php get_template_part('template-parts/components/share/share'); ?>
          </div>
        </div>
      </div>

      <div class="col-span-full lg:col-[4/-1] xl:col-[5/-1] prose prose-secondary md:prose-md">
        <?php echo do_shortcode($content); ?>
      </div>
    </div>

    <div class="col-span-full">
      <?php get_template_part('template-parts/components/posts/posts'); ?>
    </div>
  </div>
</div>