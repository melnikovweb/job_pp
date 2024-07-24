<?php
$accent_post = $args ?: [];
$thumbnail = $accent_post['thumbnail'] ?? '';
$post_url = $accent_post['url'] ?? '';
$title = $accent_post['title'] ?? '';
$excerpt = $accent_post['excerpt'] ?? '';
?>

<div class="accent-post">
  <?php $items_direction =
    "[grid-template-areas:'preview'_'content'] lg:[grid-template-areas:var(--accent-post-area,'preview_content')]"; ?>
  <div class="grid-container">
    <div class="<?php echo esc_attr(
                  $items_direction
                ); ?> grid-cols-1 grid gap-x-[--container-gutter] col-span-full bg-gray-800 rounded-xs overflow-hidden md:rounded-md lg:grid-cols-2 lg:rounded-lg">
      <?php if ($thumbnail) : ?>
        <a class="[grid-area:preview] block *:w-full *:size-full *:object-cover lg:-mx-[--container-gutter]" href="<?php echo esc_url(
                                                                                                                      $post_url
                                                                                                                    ); ?>">
          <?php echo wp_kses_post($thumbnail); ?>
        </a>
      <?php endif; ?>

      <div class="[grid-area:content] grid gap-4 p-4 content-between justify-items-start md:p-6 xl:p-8 2xl:px-20 2xl:py-12">
        <div class="grid gap-2 md:gap-4">
          <h2 class="font-h5 text-white">
            <a href="<?php echo esc_url($post_url); ?>">
              <?php echo esc_html($title); ?>
            </a>
          </h2>

          <div class="font-b1 text-white/60">
            <?php echo esc_html($excerpt); ?>
          </div>
        </div>


        <a class="button-arrow-xs button-outlined-white" href="<?php echo esc_url($post_url); ?>">
          <?php _e('Read more', 'SECRET-domain'); ?>
        </a>
      </div>
    </div>
  </div>
</div>