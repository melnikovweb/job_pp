<?php
$acf_fields = $args['acf_fields'];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$description = $acf_fields['description'] ?? '';
$info = $acf_fields['info'] ?? '';
$text = $acf_fields['text'] ?? '';
$form = $acf_fields['form'] ?? '';
?>

<section class="start-block">
  <h2><?php echo esc_html($subheadings); ?></h2>
  <?php echo '<' .
    esc_attr($tag_type['tag-type']) .
    '>' .
    esc_html($heading) .
    '</' .
    esc_attr($tag_type['tag-type']) .
    '>'; ?>
  <p><?php echo esc_html($description); ?></p>
  <?php if ($info): ?>
    <ul>
      <?php foreach ($info as $item): ?>
        <li>
          <?php if ($item['icon']): ?>
            <?php echo wp_get_attachment_image($item['icon'], 'full'); ?>
          <?php endif; ?>
          <?php if ($item['name']): ?>
            <h3><?php echo esc_html($item['name']); ?></h3>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <?php if ($text): ?>
    <p><?php echo esc_html($text); ?></p>
  <?php endif; ?>
  <?php if ($form): ?>
    <?php echo do_shortcode($form); ?>
  <?php endif; ?>
</section>
