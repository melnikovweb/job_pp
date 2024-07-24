<?php

function create_footer_menu($item)
{
  $link = $item->url;
  $title = $item->title;
  $id = $item->ID;

  if (property_exists($item, 'child')) :
    $children = $item->child; ?>

    <div class="grid content-start grid-rows-[auto_0fr] transition-[grid-template-rows] has-[:checked]:grid-rows-[auto_1fr] lg:grid-rows-[auto_1fr]" data-footer-item-id="<?php echo $id; ?>">
      <label class="flex gap-4 items-center font-h5 text-yellow">
        <input type="checkbox" class="sr-only peer">

        <?php echo $title; ?>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 peer-checked:rotate-180 transition stroke-current lg:hidden">
          <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
      </label>

      <div class="space-y-4 lg:space-y-6 overflow-hidden before:h-4 before:block *:flex *:items-center *:gap-4 *:font-b2 *:text-gray-200">
        <?php foreach ($children as $child) {
          create_footer_menu($child);
        } ?>
      </div>
    </div>
  <?php
  else :

    $is_soon = get_field('is_soon', $id);
    $href_attr = $is_soon ? '' : "href=\"$link\"";
  ?>
    <a class="flex gap-4 items-center font-b2 text-yellow gap-4" data-footer-item-id="<?php echo $id; ?>" <?php echo $href_attr; ?>>
      <?php echo $title; ?>

      <?php if ($is_soon) : ?>
        <span class="font-b3 py-1 px-2 bg-yellow text-gray-800 rounded-full text-center">
          <?php echo 'soon'; ?>
        </span>
      <?php else : ?>
      <?php endif; ?>
    </a>
<?php
  endif;
} ?>

<div class="footer">
  <div class="bg-gray-800 rounded-t-md lg:rounded-t-[80px]">
    <div class="grid-container py-6 rounded-t-lg gap-y-8 md:py-10 lg:gap-y-12 lg:py-12">
      <div class="grid grid-cols-1 gap-6 col-span-full md:gap-10 lg:grid-cols-subgrid">
        <div class="flex justify-between col-span-full">
          <div class="text-white max-w-22 md:max-w-max">
            <?php echo wp_get_attachment_image($args['logo'], 'medium', false, ['alt' => 'SECRET footer logo']); ?>
          </div>

          <div class="flex gap-4 md:gap-6 items-center *:text-white/60 hover:*:text-white *:transition">
            <?php foreach ($args['socials'] as $social) : ?>
              <a href="<?php echo esc_url($social['url']); ?>" class="size-6" target="_blank">
                <?php echo wp_get_attachment_image($social['logo'], 'thumbnail', true, [
                  'class' => 'size-full object-contain'
                ]); ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="grid gap-y-4 md:gap-y-6 grid-cols-subgrid col-span-full">
          <a href="<?php echo esc_url(
                      $args['footer_block']['link']['url']
                    ); ?>" class="grid gap-6 border border-gray-600 rounded-xs md:rounded-lg p-4 cursor-pointer md:p-8 md:gap-10 lg:col-span-3 lg:content-between xl:col-span-5">
            <span class="block font-b1 text-gray-200 w-full">
              <?php echo esc_html($args['footer_block']['text']); ?>
            </span>

            <div>
              <span class="flex font-h2 justify-between gap-2 items-center w-full text-white">
                <?php echo esc_html($args['footer_block']['link']['title']); ?>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 md:size-10">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
              </span>
              <span class="block font-b3 text-white/60 w-full">
                <?php echo esc_html($args['footer_block']['merchant']); ?>
              </span>
            </div>
          </a>

          <?php
          $subscription_shortcode = get_field('subscription_shortcode', 'options');

          if ($subscription_shortcode) : ?>
            <div class="grid gap-6 border border-gray-600 rounded-xs md:rounded-lg p-4 md:p-8 md:gap-10 lg:col-span-5 xl:col-span-7">
              <div class='grid gap-2'>
                <div class="block font-b1 text-gray-200 w-full">
                  <?php _e('Stay updated', 'SECRET-domain'); ?>
                </div>

                <div class="text-gray-400 font-b2">
                  <?php _e(
                    "You'll receive occasional emails from SECRET. You always have the choice to unsubscribe from every email.",
                    'SECRET-domain'
                  ); ?>
                </div>
              </div>

              <?php echo do_shortcode($subscription_shortcode); ?>
            </div>
          <?php endif;
          ?>
        </div>
      </div>

      <div class="grid col-span-full gap-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-y-4 gap-x-6 xl:gap-x-8 2xl:gap-x-10">
          <div class="contents max-xl:md:content-start max-xl:md:gap-y-4">
            <?php if (isset($args['menu-1'])) : ?>
              <div class="grid gap-y-4 content-start">
                <?php foreach ($args['menu-1'] as $item) : ?>
                  <?php create_footer_menu($item); ?>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <?php if (isset($args['menu-2'])) : ?>
              <div class="grid gap-y-4 content-start">
                <?php foreach ($args['menu-2'] as $item) : ?>
                  <?php create_footer_menu($item); ?>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="contents max-xl:md:content-start max-xl:md:gap-y-4">
            <?php if (isset($args['menu-3'])) : ?>
              <div class="grid gap-y-4 content-start">
                <?php foreach ($args['menu-3'] as $item) : ?>
                  <?php create_footer_menu($item); ?>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <?php if (isset($args['menu-4'])) : ?>
              <div class="grid gap-y-4 content-start">
                <?php foreach ($args['menu-4'] as $item) : ?>
                  <?php create_footer_menu($item); ?>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="grid border-t border-gray-600 pt-4 text-gray-400 font-b3 col-span-full">
        <?php echo esc_html($args['copyrights']); ?>
      </div>
    </div>
  </div>
</div>