<?php
$acf_fields = $args['acf_fields'] ?? [];
$theme = $acf_fields['theme'] ?? '';
$class_theme = $theme ?? 'is-gray';
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$button_1 = $acf_fields['button_1'] ?? '';
$button_2 = $acf_fields['button_2'] ?? '';
$flow = $acf_fields['flow'] ?? [];
?>

<section class="onboarding group/onboarding <?php echo 'is-' . esc_attr($class_theme); ?>">
  <div class="py-8 bg-gray-200 md:py-20 xl:py-24 group-[.is-dark]/onboarding:bg-gray-800 group-[.is-light]/onboarding:bg-white">
    <div class="grid-container">
      <div class="text-center col-span-full">
        <div class="font-b3 text-gray-400 mb-2 group-[.is-dark]/onboarding:text-yellow">
          <?php echo esc_html($subheadings); ?>
        </div>
        <?php
        $headline_classes = 'font-h1 text-gray group-[.is-dark]/onboarding:text-white';
        $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
        $headline_close_tag = '</' . esc_attr($tag_type) . '>';
        $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

        echo wp_kses_post($headline);
        ?>
        <div class="mt-6 flex justify-center gap-4 flex-col md:flex-row">
          <?php if ($button_1): ?>
            <?php $button_1_classes = 'button-arrow-md button-primary-blue place-self-center'; ?>
            <a href="<?php echo esc_url($button_1['url']); ?>" class="<?php echo esc_attr($button_1_classes); ?>">
              <?php echo esc_html($button_1['title']); ?>
            </a>
          <?php endif; ?>
          <?php if ($button_2): ?>
            <?php
            $button_2_theme_classes = [
              'light' => 'button-primary-dark',
              'dark' => 'button-outlined-white'
            ];
            $button_2_classes = 'button-md place-self-center ';
            $button_2_classes .= $button_2_theme_classes[$theme] ?? 'button-primary-dark';
            ?>
            <a href="<?php echo esc_url($button_2['url']); ?>" class="<?php echo esc_attr($button_2_classes); ?>">
              <?php echo esc_html($button_2['title']); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      <?php if ($flow): ?>
        <ul class="mt-8 grid gap-4 flex-col col-span-full md:gap-x-6 md:gap-y-8 md:grid-cols-2 md:mt-16 lg:gap-x-8 xl:grid-cols-4 xl:mt-20 2xl:gap-10">
          <?php $counter = 1; ?>
          <?php foreach ($flow as $item): ?>
            <?php
            $image_id = $item['image_id'] ?? '';
            $text = $item['text'] ?? '';
            $description = $item['description'] ?? '';
            ?>
            <li class="bg-white p-4 rounded-xs md:p-8 md:rounded-md xl:rounded-lg group-[.is-dark]/onboarding:bg-white/5 group-[.is-light]/onboarding:bg-gray-200">
              <div class="font-t2 text-gray group-[.is-dark]/onboarding:text-white">
                <?php echo '0' . esc_html($counter); ?>
              </div>
              <?php if ($image_id): ?>
                <div class="flex justify-center my-4 md:my-6 xl:my-8">
                  <?php echo wp_get_attachment_image($image_id, 'full', false, [
                    'class' => 'w-20 md:w-25'
                  ]); ?>
                </div>
              <?php endif; ?>
              <?php if ($text): ?>
                <div class="font-t2 text-gray group-[.is-dark]/onboarding:text-white">
                  <?php echo esc_html($text); ?>
                </div>
              <?php endif; ?>
              <?php if ($description): ?>
                <div class="font-b2 text-gray-800 mt-2 md:mt-4 group-[.is-dark]/onboarding:text-gray-200">
                  <?php echo esc_html($description); ?>
                </div>
              <?php endif; ?>
            </li>
            <?php $counter++; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>
