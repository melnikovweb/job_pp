<?php
$data = $args ?? [];
$title = $data['title'] ?? '';
$text = $data['text'] ?? '';
$accent_post = $data['accent_post'] ?? '';
$categories = $data['categories'] ?? [];

$first_post = false;
?>
<div class="archive-blog">
  <div class="grid py-8 gap-y-8 md:py-16 md:gap-y-16 xl:py-20 xl:gap-y-20">
    <div class="grid-container">
      <div class="grid gap-y-4 max-md:text-center items-center grid-cols-subgrid col-span-full">
        <h1 class="col-span-full font-h1 text-gray lg:col-span-3 xl:col-span-5">
          <?php echo wp_kses_post($title); ?>
        </h1>

        <?php if ($text) : ?>
          <div class="col-span-full font-b1 text-gray-800 lg:col-[4/-1] xl:col-[6/-1]">
            <?php echo esc_html($text); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if (is_home() && $accent_post) : ?>
      <?php $first_post = true; ?>

      <?php get_template_part('template-parts/components/accent-post/accent-post', '', $accent_post); ?>
    <?php endif; ?>

    <?php if ($categories) : ?>
      <div class="container flex flex-wrap gap-2 font-b3 md:gap-4 *:rounded-full *:p-2 *:border *:border-blue md:*:px-3">
        <?php $active_classes = !is_category() ? 'bg-blue text-white' : 'text-blue'; ?>

        <a href="<?php echo get_post_type_archive_link('post'); ?>" class="<?php echo esc_attr($active_classes); ?>">
          <?php _e('Show all', 'SECRET-domain'); ?>
        </a>

        <?php foreach ($categories as $category) : ?>
          <?php $active_classes = $category['is_active'] ? 'bg-blue text-white' : 'text-blue'; ?>

          <a href="<?php echo esc_url($category['url']); ?>" class="<?php echo esc_attr($active_classes); ?>">
            <?php echo esc_html($category['title']); ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="grid-container gap-y-12">
      <div class="grid grid-cols-subgrid col-span-full gap-y-8  lg:gap-y-12 lg:*:col-span-4 xl:[&:nth-child(5n-1)]:*:col-span-6 xl:[&:nth-child(5n)]:*:col-span-6" data-container="posts">
        <div class="col-span-full *:h-full">
          <?php get_template_part('template-parts/components/newsletter/newsletter'); ?>
        </div>

        <?php while (have_posts()) :
          the_post(); ?>
          <?php if ($first_post) {
            $first_post = false;
            continue;
          } ?>

          <div class="col-span-full *:h-full">
            <?php get_template_part('template-parts/components/post-item/post-item'); ?>
          </div>
        <?php
        endwhile; ?>
      </div>

      <button class="button-md button-primary-dark col-span-full md:place-self-center" data-count="<?php echo esc_attr(
                                                                                                      $args['total_posts']
                                                                                                    ); ?>" data-action="show-more"><?php _e('Show more', 'SECRET-domain'); ?></button>
    </div>
  </div>
</div>