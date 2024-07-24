<?php
function create_header_menu($item)
{
  $link = $item->url;
  $title = $item->title;
  $id = $item->ID;
  $parent_id = $item->menu_item_parent;
  $is_parent = $parent_id == 0;
  $parent_trigger_classes = $is_parent ? 'parent group/dropdown xl:cursor-pointer' : '';
  $parent_dropdown_classes = $is_parent
    ? 'parent grid-container w-full gap-y-6 xl:rounded-b-sm xl:absolute xl:p-12 xl:-mt-4 max-xl:px-0 xl:opacity-0 xl:shadow-xl xl:invisible xl:group-hover/dropdown:opacity-100 xl:group-hover/dropdown:visible'
    : '';
  $parent_link_classes = $is_parent
    ? 'parent transition max-xl:!font-t1 text-gray [&:where(a)]:hover:text-blue-600 xl:font-b2 xl:text-gray-600 xl:hover:text-gray group-hover/dropdown:text-gray xl:p-2'
    : 'child has-[~_.dropdown]:font-t2 transition-colors [&:where(a)]:hover:text-blue-600';

  $has_child_image = !$is_parent ?: get_field('is_imaged_items', $id);
  ?>
  <?php if (property_exists($item, 'child')):

    $children = $item->child;
    $trigger_max_xl_classes = $is_parent
      ? ' max-xl:content-start max-xl:grid max-xl:grid-rows-[auto_0fr] max-xl:has-[:checked]:grid-rows-[auto_1fr] transition-all'
      : ' max-xl:content-start';
    $parent_tag = $is_parent ? 'label' : 'a';
    $parent_href = $is_parent ? '' : "href=\"$link\"";
    ?>
    <div class="trigger [&:where(.parent>*)]:grid [&:where(.parent>*)]:gap-y-2 <?php echo $parent_trigger_classes .
      $trigger_max_xl_classes; ?>" data-id="<?php echo $id; ?>">
      <<?php echo $parent_tag; ?> <?php echo $parent_href; ?> class="<?php echo $parent_link_classes; ?> transition-colors [&:where(a)]:text-gray [&:where(a)]:hover:text-gray cursor-auto flex items-center gap-4 xl:gap-x-1">
        <?php echo $title; ?>

        <?php if ($is_parent): ?>
          <input type="checkbox" class="hidden peer">
        <?php endif; ?>

        <?php if ($is_parent): ?>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 xl:size-4 transition-transform xl:group-hover/dropdown:rotate-180 max-xl:peer-checked:rotate-180">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
          </svg>
        <?php endif; ?>
      </<?php echo $parent_tag; ?>>

      <div class="dropdown <?php echo $parent_dropdown_classes; ?> overflow-hidden grid-flow-col gap-6 transition-all top-full left-0 bg-white z-10 lg:gap-8 2xl:gap-10">
        <div class=" <?php echo $is_parent ? 'grid-container col-span-full max-xl:contents gay-y-6' : 'contents'; ?> ">
          <?php
          $parent_classes = $is_parent ? 'parent max-xl:pt-6 gap-y-6' : '';
          $sm_classes = ' submenu col-span-full grid content-start';
          $md_classes = ' md:items-start md:grid-cols-subgrid md:*:col-span-2';
          $lg_classes = ' lg:*:col-span-4';
          ?>
          <?php if ($has_child_image):
            $xl_classes = ' xl:*:col-span-6'; ?>
            <div class="<?php echo $parent_classes . $sm_classes . $md_classes . $lg_classes . $xl_classes; ?>">
              <?php foreach ($children as $child) {
                create_header_menu($child);
              } ?>
            </div>
          <?php
          else:
            $xl_classes = ' xl:col-span-6 xl:*:col-span-3'; ?>
            <div class="<?php echo $parent_classes . $sm_classes . $md_classes . $lg_classes . $xl_classes; ?>">
              <?php foreach ($children as $child) {
                create_header_menu($child);
              } ?>
            </div>
          <?php
          endif; ?>


          <?php if (!$has_child_image):

            $image = wp_get_attachment_image(get_field('parent_item_special_block_image', $id), 'full');
            $link = get_field('parent_item_special_block_link', $id);
            $breackpoints = get_field('parent_item_special_block_show_at', $id) ?? [];
            ?>
            <?php if ($image):

              $link_url = $link['url'] ?? '';
              $link_title = $link['title'] ?? '';
              $link_target = $link['target'] ?? '' ? $link['target'] : '_self';
              $cursor = $link_url ? 'cursor-pointer' : 'cursor-auto';

              $hide_at = array_filter(
                [
                  'sm' => 'max-md:hidden',
                  'md' => 'max-lg:md:hidden',
                  'lg' => 'max-xl:lg:hidden',
                  'xl' => 'max-2xl:xl:hidden',
                  '2xl' => '2xl:hidden'
                ],
                function ($key) use ($breackpoints) {
                  return !in_array($key, $breackpoints);
                },
                ARRAY_FILTER_USE_KEY
              );

              $hide_classes = join(' ', $hide_at);
              ?>
              <a class="<?php echo esc_attr(
                $hide_classes
              ); ?> group grid grid-cols-subgrid col-span-full text-gray xl:col-span-6 <?php echo esc_attr(
   $cursor
 ); ?>" <?php if ($link_url):
  echo 'href="' . esc_url($link_url) . '"';
endif; ?> <?php if ($link_target):
   echo 'target="' . esc_attr($link_target) . '"';
 endif; ?> data-menu="special">
                <span class="grid gap-4 col-span-full md:gap-6 lg:col-span-4 xl:col-span-full">
                  <span class="w-full h-[164px] overflow-hidden rounded-xs *:size-full *:object-cover md:h-[289px] md:rounded-sm">
                    <?php echo $image; ?>
                  </span>

                  <?php if ($link_title): ?>
                    <span class="flex items-center justify-between w-full font-b1 text-gray">
                      <?php echo esc_html($link_title); ?>

                      <span class="button-icon-md button-outlined-dark">
                        <svg class="size-4 md:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                      </span>
                    </span>
                  <?php endif; ?>
                </span>
              </a>
            <?php
            endif; ?>
          <?php
          endif; ?>
        </div>
      </div>
    </div>
  <?php
  else:

    $has_item_image = get_field('is_imaged_items', $parent_id);
    $is_soon = get_field('is_soon', $id);
    ?>
    <?php if ($has_item_image):
      $item_image = wp_get_attachment_image(get_field('item_image', $id), 'medium'); ?>
      <a class="group grid gap-4 transition-colors hover:text-blue-600 col-span-full text-gray md:gap-6 xl:col-span-6 " href="<?php echo esc_url(
        $link
      ); ?>">
        <figure class="w-full h-[164px] overflow-hidden rounded-xs *:size-full *:object-cover md:h-[289px] md:rounded-sm">
          <?php if ($item_image): ?>
            <?php echo $item_image; ?>
          <?php else: ?>
            <img src="<?php echo get_template_directory_uri() .
              '/assets/images/image-not-found.jpg'; ?>" alt="Image not found" width="824" height="289">
          <?php endif; ?>
        </figure>

        <span class="flex items-center justify-between w-full font-b1 text-gray transition-colors">
          <?php echo $title; ?>

          <span class="button-icon-md button-outlined-dark">
            <svg class="size-4 md:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
          </span>
        </span>
      </a>
    <?php
    elseif ($is_soon): ?>
      <div class="<?php echo $parent_link_classes; ?> flex gap-4 items-center font-b1 [&:not(.parent>*):where(.submenu>*)]:py-2 [&:not(.parent>*):where(.submenu>*)]:text-gray-600 [&:where(.parent.submenu>*)]:font-t2">
        <?php echo $title; ?>

        <div class="py-1 px-2 bg-yellow text-gray-600 rounded-full font-b3">
          <?php echo 'soon'; ?>
        </div>
      </div>
    <?php else: ?>
      <a class="<?php echo $parent_link_classes; ?> transition-colors hover:text-blue-600 font-b1 [&:not(.parent>*):where(.submenu>*)]:py-2 [&:not(.parent>*):where(.submenu>*)]:text-gray-600 [&:where(.parent.submenu>*)]:font-t2" href="<?php echo $link; ?>">
        <?php echo $title; ?>
      </a>
    <?php endif; ?>
  <?php
  endif; ?>
<?php
} ?>

<?php
$navigation = $args['nav'] ?? [];
$extra_links = $args['extra_links'] ?? [];
$logo = $args['logo'] ?? [];
$logo_light = $logo['for_light_header'] ?? '';
$logo_dark = $logo['for_dark_header'] ?? '';
$login_link = $extra_links[0]['link'] ?? [];
$sign_up_link = $extra_links[1]['link'] ?? [];
$login_target = $login_link['target'] ?: '_self';
$sign_up_target = $sign_up_link['target'] ?: '_self';
$header_height =
  ' [--header-height:theme(spacing.14)] h-[--header-height] md:[--header-height:theme(spacing.17)] xl:[--header-height:theme(spacing.19)]';
$header_position = ' sticky top-0 left-0 z-40';
?>
<div class="header" style="display: contents;">
  <div class="<?php echo esc_attr($header_height . $header_position); ?> flex items-center bg-white">
    <div class="container flex items-center justify-between">
      <input id="header-menu-toggle" type="checkbox" class="peer/menu hidden">

      <a href="<?php echo get_site_url(); ?>" class="flex h-9 *:h-full *:flex last:*:hidden">
        <span data-logo-theme="light">
          <?php echo wp_get_attachment_image($logo_light, 'large', false, ['class' => 'w-full object-contain']); ?>
        </span>

        <span data-logo-theme="dart">
          <?php echo wp_get_attachment_image($logo_dark); ?>
        </span>
      </a>

      <?php
      $menu_sm_classes = ' overflow-x-clip transition-all bg-white w-full left-0 top-full-0 top-full';
      $menu_xl_classes = ' xl:flex xl:w-auto xl:items-center';
      $menu_max_xl_classes =
        ' max-xl:absolute max-xl:w-full max-xl:shadow-xl max-xl:max-h-[calc(100dvh-70px)] max-xl:overflow-y-auto max-xl:rounded-b-sm max-xl:opacity-0 max-xl:invisible max-xl:peer-checked/menu:visible max-xl:peer-checked/menu:opacity-100';
      ?>

      <div class="<?php echo $menu_sm_classes . $menu_max_xl_classes . $menu_xl_classes; ?>">
        <div class="grid-container xl:contents">
          <div class="col-span-full max-xl:py-12 max-md:py-8 max-xl:grid max-xl:gap-8 xl:flex items-center gap-2 xl:px-4 xl:bg-gray-100 xl:rounded-full">
            <?php foreach ($navigation as $item) {
              create_header_menu($item);
            } ?>
          </div>

          <div class="col-span-full items-center gap-2 flex py-4 md:hidden border-t px-20 -mx-20 border-t-gray-200">
            <a class="button-xs button-primary-blue" href="<?php echo esc_url(
              $login_link['url']
            ); ?>" target="<?php echo esc_attr($login_target); ?>">
              <?php echo esc_html($login_link['title']); ?>
            </a>

            <a class="button-xs button-outlined-blue" href="<?php echo esc_url(
              $sign_up_link['url']
            ); ?>" target="<?php echo esc_attr($sign_up_target); ?>">
              <?php echo esc_html($sign_up_link['title']); ?>
            </a>
          </div>
        </div>
      </div>

      <div class="flex items-center gap-2">
        <div class="items-center gap-2 hidden md:flex">
          <a class="button-xs button-primary-blue" href="<?php echo esc_url(
            $login_link['url']
          ); ?>" target="<?php echo esc_attr($login_target); ?>">
            <?php echo esc_html($login_link['title']); ?>
          </a>

          <a class="button-xs button-outlined-blue" href="<?php echo esc_url(
            $sign_up_link['url']
          ); ?>" target="<?php echo esc_attr($sign_up_target); ?>">
            <?php echo esc_html($sign_up_link['title']); ?>
          </a>
        </div>

        <label for="header-menu-toggle" class="flex items-center justify-center size-9 rounded-full bg-gray-100 text-gray cursor-pointer xl:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </label>
      </div>
    </div>
  </div>
</div>
