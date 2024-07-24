<div class="single-last-update">
  <div class="grid-container mx-auto font-b1 text-center text-gray-600 mb-4 md:mb-8 xl:mb-10">
    <div class="col-span-full">
      <?php
      $custom_date = get_field('custom_modified_date');

      echo esc_html(__('Last amended as of:', 'SECRET-domain')) . ' ';

      if ($custom_date) {
        echo esc_html($custom_date);
      } else {
        echo get_the_modified_date('d M Y');
      }
      ?>
    </div>
  </div>
</div>