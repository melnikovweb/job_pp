<?php
extract($args);
if ($tabs): ?>
  <section class="posts" data-tabs>
    <div class="py-4 md:py-10">
      <div class="md:py-10">
        <div class="flex flex-col lg:flex-row pb-4 md:pb-10 md:mb-4 xl:mb-10">
          <?php if ($title): ?>
            <h2 class="font-h1 text-gray mb-4 md:mb-6 lg:mb-0"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>
          <div class="lg:ml-auto flex items-center gap-2 overflow-x-auto lg:overflow-x-hidden no-scroll">
            <?php
            $i = 0;
            foreach ($tabs as $key => $tab):
              $i++;
              if (isset($tab['title']) && !empty($tab['title']) && isset($tab['posts'])): ?>
                <div class="font-b1 py-2 px-4 transition rounded-full hover:bg-yellow cursor-pointer <?php echo $i === 1
                  ? 'bg-yellow'
                  : 'bg-gray-200'; ?>" data-tab-button="<?php echo $key; ?>"><?php echo esc_html(
  $tab['title']
); ?></div>
            <?php endif;
            endforeach;
            ?>
          </div>
        </div>
        <?php if ($tabs): ?>
          <div>
            <?php
            $i = 0;
            foreach ($tabs as $key => $tab):
              $i++; ?>
              <?php if (isset($tab['posts'])): ?>
                <div data-tab="<?php echo $key; ?>" data-tab-state="<?php echo $i === 1
  ? 'open'
  : 'close'; ?>" <?php echo $i === 1 ? '' : 'style="display:none"'; ?>>
                  <div class="swiper" data-slider-3>
                    <div class="swiper-wrapper pb-6">
                      <?php foreach ($tab['posts'] as $item): ?>
                        <div class="swiper-slide">
                          <?php get_template_part('template-parts/components/post-item/post-item', '', $item); ?>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="flex justify-end">
                      <div class="button-icon-md button-outlined-blue cursor-pointer mr-6" data-slider-arrow="prev">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M15 6.19141L9 12.1914L15 18.1914" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                      </div>
                      <div class="button-icon-md button-outlined-blue cursor-pointer" data-slider-arrow="next">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M8.46967 5.66108C8.76256 5.36818 9.23744 5.36818 9.53033 5.66108L15.5303 11.6611C15.8232 11.954 15.8232 12.4288 15.5303 12.7217L9.53033 18.7217C9.23744 19.0146 8.76256 19.0146 8.46967 18.7217C8.17678 18.4288 8.17678 17.954 8.46967 17.6611L13.9393 12.1914L8.46967 6.72174C8.17678 6.42884 8.17678 5.95397 8.46967 5.66108Z" />
                        </svg>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                </div>
              <?php
            endforeach;
            ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif;
