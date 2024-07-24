<?php
$acf_fields = $args['acf_fields'] ?? [];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$items = $acf_fields['items'] ?? [];
$content = $acf_fields['content'] ?? '';
$contact_form_shortcode = $acf_fields['contact_form_shortcode'] ?? '';
?>

<section class="contact-form-section">
  <div class="py-8 md:py-20 xl:py-30">
    <div class="grid-container">
      <div class="col-span-full<?php echo $contact_form_shortcode
        ? ' lg:col-span-4 xl:col-span-6'
        : ' col-span-f full'; ?>">
        <?php if ($subheadings): ?>
          <div class="font-b3 text-blue-600 mb-2"><?php echo esc_html($subheadings); ?></div>
        <?php endif; ?>
        <?php
        $headline_classes = 'font-h2 mb-4 text-gray';
        $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
        $headline_close_tag = '</' . esc_attr($tag_type) . '>';
        $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

        echo wp_kses_post($headline);
        ?>
        <?php if ($description): ?>
          <div class="font-b1 text-gray-800"><?php echo wp_kses_post($description); ?></div>
        <?php endif; ?>

        <?php if ($items): ?>
          <div class="flex flex-col gap-4 md:gap-6 my-8 md:my-10 lg:my-16 xl:my-20">
            <?php foreach ($items as $item): ?>
              <?php
              $image_id = $item['image_id'] ?? '';
              $text = $item['text'] ?? '';
              ?>
              <div class="flex flex-col gap-2 md:items-center md:flex-row md:gap-6">
                <?php if ($image_id): ?>
                  <div class="flex shrink-0">
                    <?php echo wp_get_attachment_image($image_id, 'full', false, [
                      'class' => 'size-6 md:size-12'
                    ]); ?>
                  </div>
                <?php endif; ?>
                <?php if ($text): ?>
                  <div class="font-b1 w-full"><?php echo esc_html($text); ?></div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php if ($content): ?>
          <div class="font-h5 text-gray-800 mb-8 lg:mb-0"><?php echo wp_kses_post($content); ?></div>
        <?php endif; ?>
      </div>
      <?php if ($contact_form_shortcode): ?>
        <div class="col-span-full lg:col-span-4 xl:col-span-6">
          <?php get_template_part('template-parts/components/contact-form/contact-form', '', [
            'contact_form_shortcode' => $contact_form_shortcode
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>