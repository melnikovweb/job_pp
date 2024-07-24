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
  <section class="banner-with-image">
    <div class="grid-container">
      <div class="grid grid-cols-subgrid col-span-full gap-8">
        <div class="col-span-full flex justify-start md:col-span-4 lg:col-span-6 xl:col-span-7 2xl:col-span-8 pt-8 lg:pt-0">
          <div class="flex flex-col justify-center xl:max-w-[640px]">
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
        </div>
        <div class="col-span-full md:col-span-4 lg:col-span-6 xl:col-span-5 2xl:col-span-4 flex justify-end">
          <?php if ($video_mp4 || $video_webm): ?>
            <div class="w-full flex justify-center items-end relative overflow-hidden">
              <video class="w-full max-w-[288px] sm:max-w-[332px] md:max-w-full rounded-lg" autoplay muted loop playsinline>
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
    </div>
  </section>
<?php endif; ?>
