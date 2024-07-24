<?php

$tag_type = $args['tag_type'] ?? 'h2' ?: 'h2';
$heading = $args['heading'] ?? '' ?: '';
$label = $args['label'] ?? '' ?: '';
$buttons = $args['buttons'] ?? [] ?: [];
$video_mp4 = $args['video_mp4'] ?? '' ?: '';
$video_webm = $args['video_webm'] ?? '' ?: '';

if ($args): ?>
  <section class="video">
    <div class="container py-8 md:py-12">
      <div class="flex gap-2 flex-col justify-between bg-gray-800 rounded-lg xl:pt-14 md:pt-10 pt-4">
        <div class="px-4 md:px-10 xl:px-20">
          <?php echo "<$tag_type class='text-yellow font-h3 text-center md:pb-6 pb-4'>$heading</$tag_type>"; ?>

          <div class="text-center font-b2 text-gray-200 md:pb-8 pb-6"><?php echo esc_html($label); ?></div>

          <div class="flex flex-col md:flex-row gap-6 justify-center">
            <?php if ($buttons): ?>
              <?php foreach ($buttons as $item): ?>
                <?php
                $button = $item['button'] ?? [];
                $button_url = $button['url'] ?? '';
                $button_type = $item['type'] ?? '';
                $button_title = $button['title'] ?? '';
                ?>
                <?php if (isset($button)): ?>
                  <a href="<?php echo esc_url($button_url); ?>" class="button-md place-self-center <?php echo esc_attr(
  $button_type
); ?>"><?php echo esc_html($button_title); ?></a>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <?php if ($video_mp4 || $video_webm): ?>
          <div class="w-full">
            <video class="w-full rounded-lg" autoplay muted loop playsinline>
              <?php if ($video_mp4): ?>
                <source src="<?php echo esc_url($video_mp4); ?>" type='video/mp4; codecs="hvc1"'>
              <?php endif; ?>

              <?php if ($video_webm): ?>
                <source src="<?php echo esc_url($video_webm); ?>" type="video/webm">
              <?php endif; ?>
            </video>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif;
