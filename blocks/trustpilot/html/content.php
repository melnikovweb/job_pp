<?php
$acf_fields = $args['acf_fields'] ?? [];
$image_id = $acf_fields['image_id'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$text = $acf_fields['text'] ?? '';
$feedback = $acf_fields['feedback'] ?? [];
?>

<section class="trustpilot">
  <div class="container">
    <?php if ($image_id): ?>
        <?php echo wp_get_attachment_image($image_id, 'full'); ?>
    <?php endif; ?>
    <?php if ($heading): ?>
      <?php
      $headline_classes = 'font-h1 text-gray-900 text-center mb-6';
      $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
      $headline_close_tag = '</' . esc_attr($tag_type) . '>';
      $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

      echo wp_kses_post($headline);
      ?>
    <?php endif; ?>
    <?php if ($text): ?>
      <p class=""><?php echo esc_html($text); ?></p>
    <?php endif; ?>
    <?php if ($feedback): ?>
      <?php foreach ($feedback as $item): ?>
        <div class="flex">
          <?php
          $stars = intval($item['stars'] ?? 0);
          for ($i = 0; $i < 5; $i++): ?>
              <span class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                         fill="currentColor"
                                         class="<?php echo $i < $stars ? 'text-blue-600' : 'text-gray-600'; ?>">
                                      <path
                                          d="M11.1033 5.54563C11.4701 4.80247 12.5299 4.80247 12.8967 5.54563L14.5486 8.89209C14.6941 9.18694 14.9753 9.3914 15.3006 9.43896L18.9962 9.97912C19.8161 10.099 20.1429 11.1068 19.5493 11.685L16.8768 14.288C16.6409 14.5178 16.5333 14.8489 16.5889 15.1734L17.2194 18.8496C17.3595 19.6666 16.502 20.2896 15.7684 19.9038L12.4655 18.1668C12.1741 18.0135 11.8259 18.0135 11.5345 18.1668L8.23163 19.9038C7.498 20.2896 6.64045 19.6666 6.78057 18.8496L7.41109 15.1734C7.46675 14.8489 7.35908 14.5178 7.12321 14.288L4.45068 11.685C3.85709 11.1068 4.18387 10.099 5.00378 9.97912L8.69937 9.43896C9.02472 9.3914 9.30591 9.18694 9.45145 8.89209L11.1033 5.54563Z"/>
                                    </svg>
                                </span>
            <?php endfor;
          ?>
        </div>
        <p class="mb-2"><?php echo esc_html($item['text']); ?></p>
        <p class="text-gray-700"><?php echo esc_html($item['name']); ?></p>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
