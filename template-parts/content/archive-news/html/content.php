<?php
$data = $args ?? [];
$title = $data['title'] ?? '';
$text = $data['text'] ?? '';
$accent_post = $data['accent_post'] ?? '';
$categories = $data['categories'] ?? [];

$first_post = false;
?>
<div class="archive-news">
  <div class="grid py-8 md:py-16 xl:py-20 [--accent-post-area:'content_preview']">
    <div class="grid gap-y-8 md:gap-y-16 xl:gap-y-20">
      <div class="grid-container items-center gap-y-4 md:gap-y-8 text-center">
        <h1 class="col-span-full font-h1 text-gray">
          <?php echo wp_kses_post($title); ?>
        </h1>

        <?php if ($text) : ?>
          <div class="col-span-full font-b1 text-gray-800">
            <?php echo esc_html($text); ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if (is_post_type_archive('news') && $accent_post) : ?>
        <?php $first_post = true; ?>

        <?php get_template_part('template-parts/components/accent-post/accent-post', '', $accent_post); ?>
      <?php endif; ?>

      <?php if ($categories) : ?>
        <div class="container flex flex-wrap gap-2 font-b3 *:rounded-full *:p-2 *:border *:border-blue md:*:px-3 pb-8 md:pb-12">
          <?php $active_classes = is_post_type_archive('news') ? 'bg-blue text-white' : 'text-blue'; ?>

          <a href="<?php echo get_post_type_archive_link('news'); ?>" class="<?php echo esc_attr($active_classes); ?>">
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
    </div>

    <div class="grid-container">
      <div class="grid grid-cols-subgrid col-span-full gap-y-6 md:gap-y-8 lg:gap-y-12 lg:*:col-span-4 xl:[&:nth-child(5n-1)]:*:col-span-6 xl:[&:nth-child(5n)]:*:col-span-6" data-container="posts">
        <div class="col-span-full *:h-full lg:order-5">
          <?php get_template_part('template-parts/components/newsletter/newsletter'); ?>
        </div>

        <?php
        $i = 0;
        while (have_posts()) :

          the_post();
          if ($first_post) {
            $first_post = false;
            continue;
          }

          $item_classes = ['lg:order-1', 'xl:order-1'];
        ?>
          <div class="col-span-full *:h-full <?php echo $item_classes[$i] ?? 'order-10'; ?>">
            <?php get_template_part('template-parts/components/news-item/news-item'); ?>
          </div>
          <?php $i++; ?>
        <?php
        endwhile;
        ?>
      </div>
    </div>

    <div class="container flex justify-center mt-8 md:mt-12">
      <button class="button-md button-primary-dark" data-count="<?php echo esc_attr(
                                                                  $args['total_posts'] ?? 0
                                                                ); ?>" data-action="show-more"><?php _e('Show more', 'SECRET-domain'); ?></button>
    </div>
  </div>
</div>