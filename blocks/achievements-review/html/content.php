<?php
$acf_fields = $args['acf_fields'] ?? [];
$achievements = $acf_fields['achievements'] ?? [];

$background_colors = [
  'blue' => 'bg-blue-600',
  'light_gray' => 'bg-gray-200',
  'dark_gray' => 'bg-gray-800'
];

if ($achievements && is_array($achievements)): ?>
  <section class="achievements-review">
    <div class="grid-container grid-cols-12 gap-2 py-8 md:py-16">
      <?php foreach ($achievements as $achievement):

        $selected_color = $achievement['color'] ?? '';
        $current_color = $background_colors[$selected_color] ?? 'bg-gray-200';
        $is_dark_theme = $selected_color === 'light_gray';
        $heading_color = $is_dark_theme ? 'text-blue' : 'text-white';
        $text_color = $is_dark_theme ? 'text-gray-600' : 'text-gray-200';

        $result = $achievement['result'];
        $symbol = $achievement['symbol'];
        $description = $achievement['description'];
        ?>
        <div class="<?php echo esc_attr(
          $current_color
        ); ?> col-span-6 lg:col-span-3 rounded-xs md:rounded-sm lg:rounded-md p-4 sm:p-6">
          <h2 class="<?php echo esc_attr($heading_color); ?> font-h1">
            <?php
            echo esc_html($result);
            if ($symbol):
              echo esc_html($symbol);
            endif;
            ?>
          </h2>
          <hr class="border-white/40 my-2">
          <p class="<?php echo esc_attr($text_color); ?> font-b2">
            <?php echo esc_html($description); ?>
          </p>
        </div>
      <?php
      endforeach; ?>
    </div>
  </section>
<?php endif; ?>
