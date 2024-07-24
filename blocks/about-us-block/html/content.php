<?php
$acf_fields = $args['acf_fields'] ?? [];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$button_1 = $acf_fields['button_1'] ?? [];
$button_2 = $acf_fields['button_2'] ?? [];
$people = $args['people'] ?? [];
?>

<section class="about-us-block">
  <div class="grid-container py-8 sm:py-16 md:py-20 gap-y-8 sm:gap-y-16 md:gap-y-20 justify-items-center">
    <div class="text-center col-span-full gap-4">
      <div class="font-b3 text-gray-400 mb-2">
        <?php echo esc_html($subheadings); ?>
      </div>
      <?php if ($heading) : ?>
        <?php
        $headline_classes = 'font-h1 text-gray mb-4 xl:mb-6';
        $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
        $headline_close_tag = '</' . esc_attr($tag_type) . '>';
        $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

        echo wp_kses_post($headline);
        ?>
      <?php endif; ?>

      <div class="font-b1 text-blue mb-6">
        <?php echo wp_kses_post($description); ?>
      </div>
      <div class="flex justify-center gap-4 flex-row">
        <?php if ($button_1) : ?>
          <a href="<?php echo esc_url($button_1['url']); ?>" class="button-md button-primary-dark">
            <?php echo esc_html($button_1['title']); ?>
          </a>
        <?php endif; ?>
        <?php if ($button_2) : ?>
          <a href="<?php echo esc_url($button_2['url']); ?>" class="button-md button-outlined-dark">
            <?php echo esc_html($button_2['title']); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($people) : ?>
      <div class="grid col-span-full sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-x-6 md:gap-x-8 md:gap-y-6 2xl:gap-x-10">
        <?php foreach ($people as $index => $person) : ?>
          <div class="text-center person-block <?php echo $index >= 4 ? 'hidden' : ''; ?> md:block">
            <?php if ($person['image_id']) : ?>
              <?php echo wp_get_attachment_image($person['image_id'], 'full', false, [
                'class' => 'h-[370px] w-[288px] sm:h-auto sm:w-full object-cover rounded-xs md:rounded-md mb-4'
              ]); ?>
            <?php endif; ?>
            <?php if ($person['post_title']) : ?>
              <a href="<?php echo esc_url($person['linkedin_url']); ?>" class="font-b2 text-gray flex items-center justify-center">
                <?php echo esc_html($person['post_title']); ?>
                <svg class="ml-2 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" fill="currentColor">
                  <g clip-path="url(#clip0)">
                    <path d="M12.6798 0.374268H1.31787C0.7736 0.374268 0.333496 0.803955 0.333496 1.33521V12.7441C0.333496 13.2753 0.7736 13.7076 1.31787 13.7076H12.6798C13.2241 13.7076 13.6668 13.2753 13.6668 12.7467V1.33521C13.6668 0.803955 13.2241 0.374268 12.6798 0.374268ZM4.28922 11.7362H2.31006V5.37166H4.28922V11.7362ZM3.29964 4.50448C2.66423 4.50448 2.1512 3.99145 2.1512 3.35864C2.1512 2.72583 2.66423 2.21281 3.29964 2.21281C3.93245 2.21281 4.44547 2.72583 4.44547 3.35864C4.44547 3.98885 3.93245 4.50448 3.29964 4.50448ZM11.6955 11.7362H9.71891V8.6425C9.71891 7.90552 9.70589 6.955 8.69027 6.955C7.66162 6.955 7.50537 7.75968 7.50537 8.59041V11.7362H5.53141V5.37166H7.42725V6.24145H7.45329C7.71631 5.74145 8.36214 5.21281 9.32308 5.21281C11.3257 5.21281 11.6955 6.53052 11.6955 8.24406V11.7362V11.7362Z" fill="currentColor" />
                  </g>
                  <defs>
                    <clipPath id="clip0">
                      <rect width="13.3333" height="13.3333" fill="currentColor" transform="translate(0.333496 0.374268)" />
                    </clipPath>
                  </defs>
                </svg>
              </a>
            <?php endif; ?>
            <?php if ($person['description']) : ?>
              <p class="font-b2 text-gray-400 mt-2">
                <?php echo esc_html($person['description']); ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="grid col-span-full justify-center sm:block md:block lg:hidden">
        <button class="button-md button-primary-dark" data-action="show-more"><?php _e(
                                                                                'Show more',
                                                                                'SECRET-domain'
                                                                              ); ?></button>
      </div>
    <?php endif; ?>
  </div>
</section>