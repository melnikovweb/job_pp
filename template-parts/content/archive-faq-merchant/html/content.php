<?php
$current_url = $args['current_url'] ?? '';
$table_of_contents = $args['table_of_contents'] ?? [];
?>
<div class="archive-faq-merchant">
  <div class="py-8 md:pt-10 md:pb-20 xl:pt-12 xl:pb-24">
    <div class="grid gap-[--faq-header-gap] [--faq-header-gap:theme(spacing.4)] md:[--faq-header-gap:theme(spacing.10)]">
      <?php if (is_singular('faq-merchant')) : ?>
        <div class="container">
          <?php get_template_part('template-parts/components/breadcrumbs/breadcrumbs', null, $args); ?>
        </div>
      <?php endif; ?>

      <?php get_template_part('template-parts/layouts/header-faq/header-faq', null, $args); ?>
    </div>

    <div class="grid-container pt-8 md:pt-16 xl:pt-20 2xl:pt-24">
      <div class="grid items-start grid-cols-subgrid col-span-full">
        <div class="lg:sticky top-22 left-0 items-start content-start category-sidebar col-span-2 md:col-span-4 lg:col-span-3 xl:col-span-4 mb-8 md:mb-10 lg:mb-0">
          <?php get_template_part('template-parts/components/table-of-contents/table-of-contents', '', [
            'table_of_contents' => $table_of_contents,
            'title' => __('FAQ - Merchants:', 'SECRET-domain'),
            'current_url' => $current_url
          ]); ?>
        </div>

        <?php if (have_posts()) : ?>
          <ul class="block col-span-2 md:col-span-4 lg:col-span-5 xl:col-span-8">
            <?php while (have_posts()) :
              the_post(); ?>
              <li class="*:[&~&]:pt-4 *:pb-4 md:*:[&~&]:pt-10 md:*:pb-6 border-b border-gray-400 relative">
                <a class="font-b1 flex items-center gap-4 transition group hover:text-blue-600 [&.active]:text-blue-600 text-gray" href="<?php echo get_permalink(); ?>">
                  <span class="flex shrink-0 items-center justify-center size-8 text-white bg-blue-600 border border-current rounded-full -ml-12 group-hover:ml-0 transition-all opacity-0 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                  </span>

                  <?php echo get_the_title(); ?>
                </a>
              </li>
            <?php
            endwhile; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/components/video/video'); ?>