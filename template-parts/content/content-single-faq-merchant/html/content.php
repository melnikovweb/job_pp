<div class="content-single-faq-merchant">
  <div class="container pt-8 pb-4 md:pt-10 md:pb-8 xl:pt-12">
    <?php get_template_part('template-parts/components/breadcrumbs/breadcrumbs', null, $args); ?>
  </div>

  <div class="grid-container mt-4 mb-8 md:mt-0 md:mb-20 xl:mb-24">
    <div class="col-span-full xl:col-span-8 xl:col-start-3">
      <h1 class="font-h3 text-gray text-center mb-8 md:mb-16 xl:mb-20 2xl:mb-24"><?php the_title(); ?></h1>
      <div class="prose prose-secondary md:prose-md"><?php the_content(); ?></div>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/components/video/video'); ?>
