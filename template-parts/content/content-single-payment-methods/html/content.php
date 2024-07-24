<?php
$subheading = $args['subheading'] ?? '';
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$image = $args['image'] ?? '';
$items = $args['items'] ?? '';
?>

<section class="content-single-payment-methods">
  <div class="container pt-8 pb-4 md:pt-10 md:pb-8 xl:pt-12">
    <?php get_template_part('template-parts/components/breadcrumbs/breadcrumbs'); ?>
  </div>

  <div class="grid-container gap-y-6 pb-8 md:pb-12">
    <div class="col-span-full lg:col-span-4 xl:col-span-7">
      <div class="font-b3 text-gray-400 pb-2"><?php echo esc_html($subheading); ?></div>
      <h1 class="font-h1 text-gray pb-4 md:pb-6"><?php echo esc_html($title); ?></h1>
      <div class="font-b1 text-gray-800"><?php echo wp_kses_post($description); ?></div>
    </div>
    <div class="col-span-full lg:col-span-4 xl:col-span-5">
      <div class="shrink-0"><?php echo wp_get_attachment_image($image, 'full'); ?></div>
    </div>
  </div>

  <div class="grid-container py-8 gap-y-6 md:py-12">
    <?php if ($items): ?>
      <?php foreach ($items as $item): ?>
        <div class="flex md:flex-col gap-4 md:gap-6 col-span-full md:col-span-1 lg:col-span-2 xl:col-span-3">
          <div class="size-6 md:size-8 shrink-0"><?php echo wp_get_attachment_image($item['image'], [32, 32]); ?></div>
          <div class="flex flex-col gap-2">
            <div class="font-b1 text-gray-800"><?php echo esc_html($item['text']); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <?php the_content(); ?>

  <div class="grid-container">
    <div class="col-span-full">
      <?php get_template_part('template-parts/components/posts/posts'); ?>
    </div>
  </div>
</section>