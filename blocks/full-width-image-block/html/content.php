<?php
if ($args['acf_fields'] && isset($args['acf_fields']['img_id'])):
  $img_id = $args['acf_fields']['img_id']; ?>
  <section class="full-width-image-block py-6 px-4 md:py-20 md:px-12 lg:py-30 lg:px-16 2xl:py-30 2xl:px-16 3xl:p-30">
    <div class="grid-container p-6 px-4 md:p-20 md:px-12 lg:p-30 lg:px-16 2xl:p-30 2xl:px-16 3xl:p-30">
      <div class="col-span-full lg:col-start-2 lg:col-span-10">
        <?php echo wp_get_attachment_image($img_id, 'full-image', false, ['class' => 'rounded-lg']); ?>
      </div>
    </div>
  </section>
<?php
endif;
?>
