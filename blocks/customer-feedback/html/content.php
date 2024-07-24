<?php
$acf_fields = $args['acf_fields'] ?? [];
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$tabs = $acf_fields['tabs'] ?? [];
$testimonials = $acf_fields['testimonials'] ?? [];
?>

<section class="customer-feedback">
  <div>
    <?php if ($heading): ?>
      <?php
      $headline_classes = 'font-h1';
      $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
      $headline_close_tag = '</' . esc_attr($tag_type) . '>';
      $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

      echo wp_kses_post($headline);
      ?>
    <?php endif; ?>

    <?php if ($tabs): ?>
      <div>
        <?php foreach ($tabs as $tab): ?>
          <button><?php echo esc_html($tab['tab_name']); ?></button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($testimonials): ?>
      <div>
        <?php foreach ($testimonials as $testimonial): ?>
          <?php
          $background_image_id = $testimonial['background_image'] ?? '';
          $feedback = $testimonial['feedback'] ?? '';
          $customer_name = $testimonial['customer_name'] ?? '';
          $position = $testimonial['position'] ?? '';
          $button = $testimonial['button'] ?? [];
          ?>
          <div>
            <?php if ($background_image_id): ?>
              <div>
                <?php echo wp_get_attachment_image($background_image_id, 'full', false); ?>
                <div>
                  <?php if ($feedback): ?>
                    <p><?php echo esc_html($feedback); ?></p>
                  <?php endif; ?>
                  <?php if ($customer_name || $position): ?>
                    <p><?php echo esc_html($customer_name); ?></p>
                    <p><?php echo esc_html($position); ?></p>
                  <?php endif; ?>
                  <?php if ($button['url']): ?>
                    <a href="<?php echo esc_url($button['url']); ?>"><?php echo esc_html($button['title']); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
