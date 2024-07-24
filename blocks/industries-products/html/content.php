<?php
$acf_fields = $args['acf_fields'] ?? [];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$text = $acf_fields['text'] ?? '';
$button = $acf_fields['button'] ?? [];
$gallery = $acf_fields['gallery'] ?? [];
$advantages = $acf_fields['advantages'] ?? [];
?>

<section class="industries-products">
  <div class="grid-container">
    <div><?php echo esc_html($subheadings); ?></div>
    <?php
    $headline_classes = 'text-2xl md:text-4xl font-bold text-gray-900 mb-6';
    $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
    $headline_close_tag = '</' . esc_attr($tag_type) . '>';
    $headline = $headline_open_tag . esc_html($heading) . $headline_close_tag;

    echo $headline;
    ?>
    <p><?php echo esc_html($text); ?></p>
    <?php if ($button): ?>
      <a href="<?php echo esc_url($button['url']); ?>">
        <?php echo esc_html($button['title']); ?>
      </a>
    <?php endif; ?>
    <?php if ($gallery): ?>
      <?php foreach ($gallery as $image_id): ?>
        <?php echo wp_get_attachment_image($image_id, 'full'); ?>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($advantages): ?>
      <?php foreach ($advantages as $advantage): ?>
        <p><?php echo esc_html($advantage['text']); ?></p>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
