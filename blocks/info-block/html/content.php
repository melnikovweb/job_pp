<?php
$acf_fields = $args['acf_fields'] ?? [];

$has_icon = $acf_fields['has_icon'] ?? false;
$icon = $acf_fields['icon'] ?? '';
$text = $acf_fields['text'] ?? '';
$button = $acf_fields['button'] ?? '';
$block_size = $acf_fields['block_size'] ?? '';
$block_color = $acf_fields['block_color'] ?? '';

$background_colors = [
  'light_yellow' => 'bg-yellow-100',
  'light_gray' => 'bg-gray-200',
  'dark_gray' => 'bg-gray-800'
];

$current_color = $background_colors[$block_color] ?? 'bg:yellow-100';
?>
<div class="block <?php echo esc_attr($block_size); ?> <?php echo $current_color; ?>">
  <?php if ($has_icon): ?>
    <figure class="block-icon">
      <?php echo wp_get_attachment_image($icon, [24, 24], true, ['class' => '']); ?>
    </figure>
  <?php endif; ?>

  <p class="block-text"><?php echo $text; ?></p>

  <?php if ($button): ?>
    <a href="<?php echo $button['url']; ?>" class="block-button"><?php echo $button['title']; ?></a>
  <?php endif; ?>
</div>
