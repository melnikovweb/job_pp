<?php
$fields = $args ?? [];
$acf_fields = $fields['acf_fields'] ?? [];

$content = $args['content'] ?? ($acf_fields['content'] ?? '');
$button = $args['button'] ?? ($acf_fields['button'] ?? null);
$theme = $args['theme'] ?? ($acf_fields['theme'] ?? 'yellow');

$theme_map = [
  'yellow' => '[--block-bg:theme(colors.yellow.100)] [--block-text:theme(colors.gray.DEFAULT)]',
  'gray' => '[--block-bg:theme(colors.gray.200)] [--block-text:theme(colors.gray.DEFAULT)]'
];

$button_theme_map = [
  'yellow' => 'button-md button-primary-dark',
  'gray' => 'button-md button-primary-dark'
];

$current_theme = $theme_map[$theme] ?? '';
$current_button_theme = $button_theme_map[$theme] ?? '';
?>

<div class="info-block" style="display:contents;">
  <div class="grid grid-cols-[auto,1fr] sm:grid-cols-[auto,1fr,auto] rounded-xs sm:rounded-sm bg-[--block-bg] p-4 sm:p-6 lg:p-10 gap-y-4 gap-x-2  <?php echo esc_attr(
    $current_theme
  ); ?>">
    <div class="text-[--block-text] font-b1 grid grid-cols-subgrid col-span-full sm:col-span-2">
      <svg class="size-6 lg:size-8 translate-y-[-.36em]" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.6665 15.9991C2.6665 8.64044 8.63984 2.66577 15.9998 2.66577C23.3732 2.66577 29.3332 8.64044 29.3332 15.9991C29.3332 23.3604 23.3732 29.3324 15.9998 29.3324C8.63984 29.3324 2.6665 23.3604 2.6665 15.9991ZM14.8268 10.9458C14.8268 10.3071 15.3602 9.77246 16.0002 9.77246C16.6402 9.77246 17.1602 10.3071 17.1602 10.9458V16.8391C17.1602 17.4805 16.6402 17.9991 16.0002 17.9991C15.3602 17.9991 14.8268 17.4805 14.8268 16.8391V10.9458ZM16.0132 22.2406C15.3598 22.2406 14.8398 21.7072 14.8398 21.0672C14.8398 20.4272 15.3598 19.9072 15.9998 19.9072C16.6532 19.9072 17.1732 20.4272 17.1732 21.0672C17.1732 21.7072 16.6532 22.2406 16.0132 22.2406Z" fill="currentcolor" />
      </svg>

      <div class="col-start-2">
        <?php echo wp_kses_post($content); ?>
      </div>
    </div>

    <?php if ($button): ?>
      <a href="<?php echo esc_url(
        $button['url']
      ); ?>" class="col-start-2 sm:col-start-3 sm:ml-2 justify-self-start <?php echo esc_attr(
  $current_button_theme
); ?>" target="<?php echo esc_attr($button['target'] ?? '__self'); ?>">
        <?php echo esc_html($button['title']); ?>
      </a>
    <?php endif; ?>
  </div>
</div>
