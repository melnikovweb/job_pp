<?php
extract($args);
$table_of_contents = $args['acf_fields']['table_of_contents'] ?? [];
?>

<div class="content-single-glossary" style="display:contents;">
  <div class="grid-container ">
    <div class="col-span-full py-8 grid gap-6 md:gap-8 md:py-10 xl:pt-12 2xl:gap-12">
      <?php get_template_part('template-parts/components/breadcrumbs/breadcrumbs'); ?>

      <div class="grid gap-4 xl:gap-6  text-center">
        <h1 class="font-h1"><?php echo the_title(); ?></h1>
      </div>
    </div>

    <div class="grid items-start grid-cols-subgrid col-span-full py-8 md:pt-10 md:pb-20 xl:pb-24">
      <?php if ($table_of_contents): ?>
        <div class="hidden col-span-4 lg:sticky top-22 left-0 lg:grid gap-10 items-start content-start mb-4">
            <?php get_template_part('template-parts/components/table-of-contents/table-of-contents', '', [
              'table_of_contents' => $table_of_contents,
              'show_select' => false
            ]); ?>
        </div>
      <?php endif; ?>

      <?php $col_class = $table_of_contents ? 'lg:col-[5/-1]' : ''; ?>
      <div class="<?php echo esc_attr($col_class); ?> col-span-full prose prose-secondary md:prose-md">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
