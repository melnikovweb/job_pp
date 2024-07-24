<?php
$acf_fields = $args['acf_fields'] ?? [];
$tag_type = $acf_fields['tag_type'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$cards = $acf_fields['cards'] ?? '';
?>

<div class="list-of-cards">
  <div class="grid-container gap-y-8 py-8 md:py-20 md:gap-y-16 xl:gap-y-20 xl:py-24">
    <?php echo "<$tag_type class='font-h1 text-blue-600 text-center col-span-full'>$heading</$tag_type>"; ?>

    <div class="grid grid-cols-subgrid col-span-full gap-y-4 md:gap-y-6 lg:gap-y-8">
      <?php
      $colors_order = ['bg-pink-100', 'bg-blue-100', 'bg-green-100', 'bg-yellow-100'];

      foreach ($cards as $index => $card):
        [
          'icon' => $icon_id,
          'heading' => $heading,
          'text' => $text
        ] = $card; ?>
        <div class="rounded-xs md:rounded-md xl:rounded-lg p-4 <?php echo $colors_order[
          $index % count($colors_order)
        ]; ?> grid gap-4 col-span-2 content-start odd:last:col-span-full md:p-8 md:gap-8 lg:col-span-4 xl:[&:nth-child(-n+2)]:col-span-6 xl:[&:not(:nth-child(-n+2))]:col-span-4 xl:odd:last:col-span-4 xl:p-10">
          <div class="grid gap-2">
            <?php if ($icon_id): ?>
              <figure class="size-6 m-0 flex object-contain md:pr-1 md:pb-1 md:size-12">
                <?php echo wp_get_attachment_image($icon_id, [44, 44], true, ['class' => '']); ?>
              </figure>
            <?php endif; ?>

            <div class="font-h4 text-gray">
              <?php echo $heading; ?>
            </div>
          </div>

          <div class="font-b1 text-gray-800">
            <?php echo $text; ?>
          </div>
        </div>

      <?php
      endforeach;
      ?>
    </div>
  </div>
</div>
