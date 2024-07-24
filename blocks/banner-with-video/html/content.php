<?php
$acf_fields = $args['acf_fields'] ?? [];
$subheadings = $acf_fields['subheadings'] ?? '';
$heading = $acf_fields['heading'] ?? '';
$tag_type = $acf_fields['tag_types'] ?? 'h2';
$text = $acf_fields['text'] ?? '';
$button_1 = $acf_fields['button_1'] ?? '';
$button_2 = $acf_fields['button_2'] ?? '';
$image = $acf_fields['image'] ?? [];
$video_mp4 = $acf_fields['video_mp4'] ?? [];
$video_webm = $acf_fields['video_webm'] ?? [];
?>
<?php if ($acf_fields): ?>
  <section class="banner-with-video">
    <div class="flex container 2xl:gap-10 gap-8 justify-between flex-col lg:flex-row">
      <div class="flex flex-col justify-center lg:w-1/2 pt-8 lg:pt-0">
        <div class="font-b3 text-gray-400 pb-2"><?php echo esc_html($subheadings); ?></div>
        <?php echo '<' .
          esc_attr($tag_type) .
          ' class="font-h1 text-gray pb-4 md:pb-6">' .
          esc_html($heading) .
          '</' .
          esc_attr($tag_type) .
          '>'; ?>
        <div class="font-b1 text-blue pb-6"><?php echo esc_html($text); ?></div>
        <div class="flex flex-col md:flex-row gap-4">
          <?php if ($button_1): ?>
            <div class="flex">
              <a class="button-primary-blue button-arrow-md" href="<?php echo esc_url($button_1['url']); ?>">
                <?php echo esc_html($button_1['title']); ?>
              </a>
            </div>
          <?php endif; ?>
          <?php if ($button_2): ?>
            <div class="flex">
              <a class="button-md button-outlined-blue" href="<?php echo esc_url($button_2['url']); ?>">
                <?php echo esc_html($button_2['title']); ?>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="lg:w-1/2 flex justify-center">
        <?php if ($video_mp4 || $video_webm): ?>
          <div class="w-full relative overflow-hidden pointer-events-none">
            <video class="w-full" autoplay muted loop playsinline>
              <?php if ($video_mp4): ?>
                <source src="<?php echo esc_url($video_mp4); ?>" type='video/mp4; codecs="hvc1"'>
              <?php endif; ?>
              <?php if ($video_webm): ?>
                <source src="<?php echo esc_url($video_webm); ?>" type="video/webm">
              <?php endif; ?>
            </video>
          </div>
        <?php elseif ($image): ?>
          <?php echo wp_get_attachment_image($image, 'full', null, ['class' => 'object-contain']); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
