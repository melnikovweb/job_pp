<?php
$items = $args['items'] ?? [];
$title = get_field('glossary_title', 'options');
$text = get_field('glossary_text', 'options');
?>

<div class="header-glossary">
  <section class="grid-container gap-y-6 md:gap-y-10 py-8 md:pt-16 xl:pt-20 xl:pb-10">
    <div class="grid col-span-full grid-cols-subgrid gap-y-4 md:gap-y-6 xl:col-span-8 xl:col-start-3">
      <?php if ($title) : ?>
        <h1 class="font-h1 text-gray text-center col-span-full">
          <?php echo esc_html($title); ?>
        </h1>
      <?php endif; ?>

      <?php if ($text) : ?>
        <div class="text-center text-gray-800 font-b1 col-span-full">
          <?php echo esc_html($text); ?>
        </div>
      <?php endif; ?>

      <label class="relative border rounded-full border-gray-800 flex items-center col-span-full gap-2 py-1 h-10 px-4 md:gap-4 md:h-11 md:px-6 lg:col-start-2 lg:col-end-[-2] xl:h-12">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>

        <input class="border-none focus:[box-shadow:none] w-full p-0 text-gray-600 font-b1" type="search" placeholder="<?php _e(
                                                                                                                          'Search',
                                                                                                                          'SECRET-domain'
                                                                                                                        ); ?>" data-id="search">

        <span class="absolute hidden w-full left-0 top-full px-2 py-1 overflow-hidden translate-y-2 border bg-white border-gray-800 rounded-xs" data-id="search-queries-container">
          <span class="flex flex-col overflow-hidden w-full overflow-y-auto max-h-[200px] *:font-b1 *:text-gray *:py-3 *:px-4 *:transition hover:*:bg-gray-100" data-id="search-queries-list" role="list"></span>
        </span>
      </label>
    </div>

    <?php if ($items) : ?>
      <nav class="col-span-full text-gray flex flex-wrap *:flex *:justify-center *:items-center gap-2 *:size-8 *:font-h4 *:rounded-full md:*:size-10 xl:*:size-12 2xl:justify-between">
        <?php foreach ($items as $item) :

          $active_classes = $item['is_active'] ? 'text-blue-600 bg-gray-100' : '';
          $active_href = $item['is_active'] ? get_post_type_archive_link('glossary') : $item['permalink'];
        ?>
          <a class="<?php echo esc_attr($active_classes); ?>" href="<?php echo esc_url($active_href); ?>">
            <?php echo esc_html($item['title']); ?>
          </a>
        <?php
        endforeach; ?>
      </nav>
    <?php endif; ?>
  </section>
</div>