<?php
$acf_fields = $args['acf_fields'];
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$quote_text = $acf_fields['quote_text'] ?? '';
$img_id = $acf_fields['img_id'] ?? '';
$label = $acf_fields['label'] ?? '';
?>

<section class="blockquote">
  <div class="py-6 px-4 md:py-20 md:px-12 lg:py-30 lg:px-16 2xl:py-30 2xl:px-16 3xl:p-30">
    <div class="grid-container grid-cols-1 gap-y-4 md:gap-y-10 p-4 md:p-10 xl:p-14 bg-gray-800 rounded-xs md:rounded-md xl:rounded-lg">
      <?php echo '<' .
        esc_attr($tag_type) .
        " class='font-h3 text-white col-span-full text-center [&_strong]:text-yellow [&_strong]:font-normal'>" .
        $quote_text .
        '</' .
        esc_attr($tag_type) .
        '>'; ?>
      <div class="quote content-end grid gap-4 col-span-1 justify-items-center">
        <?php echo wp_get_attachment_image($img_id, [103, 123], true, [
          'class' => 'border border-white rounded-full'
        ]); ?>
        <div class="font-b1 text-gray-200">
          <?php echo esc_html($label); ?>
        </div>
      </div>
    </div>
  </div>
</section>
