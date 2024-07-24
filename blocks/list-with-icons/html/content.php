<?php
$acf_fields = $args['acf_fields'];

$tag_type = $acf_fields['tag_type'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$text = $acf_fields['text'] ?? '';
$items = $acf_fields['items'] ?? '';
?>
<div class="list-with-icons">
  <div class="bg-gray-200 ">
    <div class="grid-container py-8 gap-y-8 text-center md:py-20 md:gap-y-20 xl:py-24">
      <div class="grid grid-cols-subgrid gap-4 col-span-full">
        <?php echo "<$tag_type class='font-h1 text-blue-600 col-span-full'>$heading</$tag_type>"; ?>

        <div class="font-b1 text-gray col-span-full xl:col-[3/-3] 2xl:col-[4/-4]">
          <?php echo $text; ?>
        </div>
      </div>

      <div class="grid grid-cols-subgrid gap-y-2 col-span-full md:gap-y-4 lg:col-[2/-2] xl:col-[3/-3] 2xl:col-[4/-4]">
        <?php foreach ($items as $item): ?>
          <div class="flex items-center text-gray gap-4 font-b1 col-span-full md:col-span-2 lg:col-span-3 xl:col-span-4 2xl:col-span-3 text-left">
            <figure class="rounded-full bg-white flex items-center justify-center shrink-0 overflow-hidden size-8">
              <?php echo wp_get_attachment_image($item['icon'], [44, 44], true, [
                'class' => 'size-full object-contain'
              ]); ?>
            </figure>

            <?php echo $item['text']; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
