<?php
extract($args); ?>
<div class="content-404">
  <div class="bg-gray lg:pb-[80px] lg:mb-[-80px] md:pb-[48px] md:mb-[-48px] pb-[40px] mb-[-40px]">
    <div class="container py-20 xl:py-30">
      <?php if ($title_404): ?>
        <h1 class="text-white font-h1 text-center pb-6">
          <?php echo esc_html($title_404); ?>
        </h1>
      <?php endif; ?>

      <?php if ($button_name_404): ?>
        <div class="flex justify-center mb-10 md:mb-16 xl:mb-20">
          <a class="button-md button-primary-white w-fit" href="<?php echo home_url(); ?>">
            <?php echo esc_html($button_name_404); ?>
          </a>
        </div>
      <?php endif; ?>

      <?php if ($video_mp4_404 || $video_webm_404): ?>
        <div class="flex justify-center">
          <video class="w-full rounded-lg max-w-[288px] md:max-w-[672px] lg:max-w-[664px] xl:max-w-[864px] 2xl:max-w-[1106px] pointer-events-none" autoplay muted loop playsinline <?php if (
            $image_404
          ) {
            echo 'poster="' . esc_url($image_404) . '"';
          } ?>>
            <?php if ($video_mp4_404): ?>
              <source src="<?php echo esc_url($video_mp4_404); ?>" type='video/mp4; codecs="hvc1"'>
            <?php endif; ?>
            <?php if ($video_webm_404): ?>
              <source src="<?php echo esc_url($video_webm_404); ?>" type="video/webm">
            <?php endif; ?>
          </video>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
