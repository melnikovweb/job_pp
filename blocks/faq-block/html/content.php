<?php
$fields = $args['acf_fields'] ?? [];
$title_level = $fields['tag_type'] ?? 'h2';
$label = $fields['label'] ?? '';
$title = $fields['title'] ?? '';
$sections = $fields['sections'] ?? [];
?>

<section class="faq-block">
  <div class="grid-container gap-y-6 py-8 md:py-20 xl:py-30 md:gap-y-8">
    <div class="col-span-full xl:col-span-4 grid gap-2 content-start">
      <div class="font-b3 text-blue-600"><?php echo esc_html($label); ?></div>

      <?php
      $headline_classes = 'font-h2 text-gray';
      $headline_open_tag = '<' . esc_attr($title_level) . ' class="' . esc_attr($headline_classes) . '">';
      $headline_close_tag = '</' . esc_attr($title_level) . '>';
      $headline = $headline_open_tag . esc_html($title) . $headline_close_tag;

      echo $headline;
      ?>
    </div>

    <?php if ($sections): ?>
      <div class="col-span-full grid gap-2 xl:col-span-8 xl:col-start-6">
        <?php foreach ($sections as $section):

          $summary = $section['summary'] ?? '';
          $content = $section['content'] ?? '';
          ?>
          <div class="grid group grid-rows-[auto,0fr] transition-all has-[:checked]:grid-rows-[auto,1fr] content-start py-4 px-2 md:p-4 xl:p-6 rounded-2xs md:rounded-xs xl:rounded-sm bg-gray-200">
            <label class="text-gray flex items-center gap-2 has-[:checked]:text-blue-600 cursor-pointer">
              <input type="checkbox" class="hidden">

              <div class="font-b1 text-current grow"><?php echo esc_html($summary); ?></div>


              <div class="size-6 grid">
                <svg class="size-full [grid-area:1/1] group-has-[:checked]:opacity-0 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25" fill="none">
                  <path class="stroke-current" d="M12 5.92969V17.9297M6 11.9297H18" stroke-width="1.5" stroke-linecap="round" />
                </svg>

                <svg class="opacity-0 size-full [grid-area:1/1] group-has-[:checked]:opacity-100 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25" fill="none">
                  <path class="fill-current" fill-rule="evenodd" clip-rule="evenodd" d="M6.53033 5.39936C6.23744 5.10646 5.76256 5.10646 5.46967 5.39936C5.17678 5.69225 5.17678 6.16712 5.46967 6.46002L10.9393 11.9297L5.46967 17.3994C5.17678 17.6923 5.17678 18.1671 5.46967 18.46C5.76256 18.7529 6.23744 18.7529 6.53033 18.46L12 12.9903L17.4697 18.46C17.7626 18.7529 18.2374 18.7529 18.5303 18.46C18.8232 18.1671 18.8232 17.6923 18.5303 17.3994L13.0607 11.9297L18.5303 6.46002C18.8232 6.16712 18.8232 5.69225 18.5303 5.39936C18.2374 5.10646 17.7626 5.10646 17.4697 5.39936L12 10.869L6.53033 5.39936Z" />
                </svg>
              </div>
            </label>

            <div class="overflow-hidden before:h-4 before:w-full before:block">
              <div class="prose">
                <?php echo wp_kses_post($content); ?>
              </div>
            </div>
          </div>
        <?php
        endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
