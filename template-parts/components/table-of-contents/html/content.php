<?php
$table_of_contents = $args['table_of_contents'] ?? [];
$title = $args['title'] ?? __('Table of contents:', 'SECRET-domain');
$current_url = $args['current_url'] ?? '';
$show_select = $args['show_select'] ?? true;
?>
<?php if ($table_of_contents) : ?>
  <div class="table-of-contents">
    <div class="grid">
      <div class="font-b1 text-gray mb-1 lg:text-gray-400 lg:mb-10">
        <?php echo esc_html($title); ?>
      </div>

      <?php if ($show_select) : ?>
        <div class="block lg:hidden">
          <select data-type="cat-select">
            <?php foreach ($table_of_contents as $item) { ?>
              <?php
              $title = $item['link']['title'] ?? '';
              $url = $item['link']['url'] ?? '';
              $selected_attr = $current_url == $url ? ' selected' : '';
              ?>
              <option value="<?php echo esc_url($url); ?>" <?php echo $selected_attr; ?>>
                <?php echo esc_html($title); ?>
              </option>
            <?php } ?>
          </select>
        </div>
      <?php endif; ?>

      <ul data-follows="navigation" class="hidden lg:grid lg:gap-6">
        <?php foreach ($table_of_contents as $item) :

          $title = $item['link']['title'] ?? '';
          $url = $item['link']['url'] ?? '';
          $link_class =
            'flex items-center gap-4 font-b1 text-gray transition group hover:text-blue-600 [&.active]:text-blue-600';
          if ($current_url == $url) {
            $link_class .= ' active';
          }
        ?>
          <li>
            <a class="<?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($url); ?>">
              <span class="shrink-0 flex items-center justify-center size-8 text-white bg-blue-600 border border-current rounded-full -ml-12 group-[.active]:ml-0 transition-all opacity-0 group-[.active]:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
              </span>
              <?php echo esc_html($title); ?>
            </a>
          </li>
        <?php
        endforeach; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>