<?php
$acf_fields = $args['acf_fields'] ?? [];

$tag_type = $acf_fields['tag_type'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$items = $acf_fields['items'] ?? '';
?>
<section class="statistic">
  <div class="bg-gray-800">
    <div class="grid-container py-8 md:py-20 lg:py-20 xl:py-30 gap-y-8 2xl:gap-y-10 bg-gray-800">
      <div class="col-span-full xl:col-span-3">
        <?php echo '<' .
          esc_attr($tag_type) .
          " class='font-h3 md:font-h4 text-white'>" .
          esc_html($heading) .
          '</' .
          esc_attr($tag_type) .
          '>'; ?>
      </div>

      <div class="grid col-span-full md:grid-cols-2 xl:col-start-4 xl:col-end-15 gap-y-6 md:gap-y-8 md:gap-x-6 lg:gap-x-8 xl:gap-y-14 2xl:gap-x-10">
        <?php foreach ($items as $item): ?>
          <div class="relative flex col-span-full md:col-span-1 xl:col-span-1 md:h-[251px] border-l border-gray-600">
            <div class="flex flex-col pl-6 md:pl-8 gap-y-2 md:gap-y-4">
              <div class="font-a1 text-yellow">
                <?php echo esc_html($item['number']); ?>
              </div>
              <div class="font-h5 text-gray-400">
                <?php echo esc_html($item['label']); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
