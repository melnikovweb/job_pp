<?php
$acf_fields = $args['acf_fields'] ?? [];

$tag_type = $acf_fields['tag-type'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$description = $acf_fields['description'] ?? '';
$button = $acf_fields['button'] ?? '';
$items = $acf_fields['items'] ?? '';

if (!is_array($items)) {
  $items = [];
}
?>
<section class="people-images">
  <div
      class="grid-container grid-cols-1 lg:grid-cols-4 gap-y-8 py-6 sm:py-20 lg:py-24 sm:gap-y-14 md:gap-y-16 lg:gap-y-20">
    <div class="grid col-span-full w-full text-center gap-4 lg:gap-6">
      <?php echo "<$tag_type class='font-h1 text-gray'>$heading</$tag_type>"; ?>
      <?php if ($description): ?>
        <p class="font-b1 text-gray"><?php echo wp_kses_post($description); ?></p>
      <?php endif; ?>
      <?php if (!empty($button)): ?>
        <a class="button-arrow-md button-primary-blue place-self-center col-span-full font-b2"
           href="<?php echo esc_url($button['url']); ?>">
          <?php echo esc_html($button['title']); ?>
        </a>
      <?php endif; ?>
    </div>
    <div class="people-images-slider overflow-hidden col-span-full">
      <div class="swiper-wrapper md:h-auto md:flex-col md:gap-14">
        <?php foreach (array_chunk($items, 4) as $itemChunk): ?>
          <div class="swiper-slide grid grid-cols-2 gap-x-4 gap-y-6 sm:gap-x-6 sm:gap-y-8 md:gap-x-8 3xl:gap-x-10 md:grid-cols-4">
            <?php foreach ($itemChunk as $item):

              $linkedin_url = $item['linkedin_url']['url'] ?? '';
              $linkedin_title = $item['linkedin_url']['title'] ?? '';
              ?>
              <div class="flex flex-col text-center items-center">
                <?php echo wp_get_attachment_image($item['img_id'], 'full', true, [
                  'class' => 'size-30 sm:size-50 3xl:size-59 rounded-full basis-0'
                ]); ?>
                <div class="flex flex-col items-start text-start sm:items-center sm:text-center">
                  <div class="font-b2 text-gray mt-4 ">
                    <a href="<?php echo esc_url($linkedin_url); ?>" class="flex items-center">
                      <?php echo esc_html($linkedin_title); ?>
                      <svg class="ml-2 size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14"
                           fill="currentColor">
                        <g clip-path="url(#clip0)">
                          <path
                              d="M12.6798 0.374268H1.31787C0.7736 0.374268 0.333496 0.803955 0.333496 1.33521V12.7441C0.333496 13.2753 0.7736 13.7076 1.31787 13.7076H12.6798C13.2241 13.7076 13.6668 13.2753 13.6668 12.7467V1.33521C13.6668 0.803955 13.2241 0.374268 12.6798 0.374268ZM4.28922 11.7362H2.31006V5.37166H4.28922V11.7362ZM3.29964 4.50448C2.66423 4.50448 2.1512 3.99145 2.1512 3.35864C2.1512 2.72583 2.66423 2.21281 3.29964 2.21281C3.93245 2.21281 4.44547 2.72583 4.44547 3.35864C4.44547 3.98885 3.93245 4.50448 3.29964 4.50448ZM11.6955 11.7362H9.71891V8.6425C9.71891 7.90552 9.70589 6.955 8.69027 6.955C7.66162 6.955 7.50537 7.75968 7.50537 8.59041V11.7362H5.53141V5.37166H7.42725V6.24145H7.45329C7.71631 5.74145 8.36214 5.21281 9.32308 5.21281C11.3257 5.21281 11.6955 6.53052 11.6955 8.24406V11.7362V11.7362Z"
                              fill="currentColor"/>
                        </g>
                        <defs>
                          <clipPath id="clip0">
                            <rect width="13.3333" height="13.3333" fill="currentColor"
                                  transform="translate(0.333496 0.374268)"/>
                          </clipPath>
                        </defs>
                      </svg>
                    </a>
                  </div>
                  <div class="font-b2 text-gray-400 mt-2">
                    <?php echo esc_html($item['position']); ?>
                  </div>
                </div>
              </div>
            <?php
            endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="col-span-full flex justify-end gap-4 md:hidden">
      <button data-navigation="prev" class="button-icon-md button-outlined-blue">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25">
          <path d="M15 6.32324L9 12.3232L15 18.3232" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" fill="none"/>
        </svg>
      </button>
      <button data-navigation="next" class="button-icon-md button-outlined-blue">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current" viewBox="0 0 24 24">
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M8.46967 5.46967C8.76256 5.17678 9.23744 5.17678 9.53033 5.46967L15.5303 11.4697C15.8232 11.7626 15.8232 12.2374 15.5303 12.5303L9.53033 18.5303C9.23744 18.8232 8.76256 18.8232 8.46967 18.5303C8.17678 18.2374 8.17678 17.7626 8.46967 17.4697L13.9393 12L8.46967 6.53033C8.17678 6.23744 8.17678 5.76256 8.46967 5.46967Z"/>
        </svg>
      </button>
    </div>
  </div>
</section>
