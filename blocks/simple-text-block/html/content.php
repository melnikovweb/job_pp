<?php
$acf_fields = $args['acf_fields'] ?? [];
$content = $acf_fields['simple-text-block-content'] ?? '';

if (!empty($content)): ?>
  <section class="simple-text-block">
    <div class="grid-container mx-auto prose pt-4 mt:pb-8 xl:pt-10 pb-8 md:pb-20 xl:pb-24">
      <div class="col-span-full lg:col-span-6 lg:col-start-2 xl:col-start-4">
        <?php echo $content; ?>
      </div>
    </div>
  </section>
<?php endif;
