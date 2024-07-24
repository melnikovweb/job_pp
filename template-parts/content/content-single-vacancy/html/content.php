<?php
$data = $args ?? [];

$title = $data['title'] ?? '';
$terms_name = $data['terms_name'] ?? '';
$development = $data['development'] ?? '';
$type = $data['type'] ?? '';
$contact_form_shortcode = $data['contact_form_shortcode'] ?? '';
?>

<div class="content-single-vacancy">
  <div class="container xl:py-12 md:py-10 py-8">
    <?php get_template_part('template-parts/components/breadcrumbs/breadcrumbs'); ?>

    <div class="text-center mt-4">
      <h1 class="font-h1 text-blue-600 text-center"><?php echo esc_html($title); ?></h1>
      <?php if ($terms_name) { ?>
        <ul class="flex justify-center gap-8 text-gray-600 font-b2 mt-2">
          <?php foreach ($terms_name as $term_name) { ?>
            <li><?php echo esc_html($term_name); ?></li>
          <?php } ?>
        </ul>
      <?php } ?>

      <a href="#vacancy-apply-now" class="flex justify-center button-md button-primary-dark inline-flex md:mt-8 mt-4"><?php _e(
                                                                                                                        'Apply Now',
                                                                                                                        'SECRET-domain'
                                                                                                                      ); ?></a>
    </div>
  </div>

  <div>
    <?php the_content(); ?>
  </div>

  <div id="vacancy-apply-now">
    <div class="grid-container py-8 md:py-20 xl:py-24 xl:grid-rows-[auto,1fr]">
      <div class="font-h2 text-blue-600 lg:mb-8 xl:mb-14 col-span-4 lg:col-span-8 xl:col-span-5 xl:col-end-6 xl:order-1 2xl:col-span-4 2xl:col-end-5">
        <?php _e('Apply for this Job', 'SECRET-domain'); ?>
      </div>
      <div class="col-span-4 lg:col-span-3 xl:col-span-5 xl:col-end-6 xl:order-3 2xl:col-span-4 2xl:col-end-5">
        <div class="my-6 md:my-8 lg:my-0">
          <ul class="flex flex-col gap-y-4 border-t border-b border-gray-200 py-4 font-b1 text-gray md:gap-y-6 md:py-10">
            <li>
              <span class="text-gray-400 mr-2"><?php _e('Position', 'SECRET-domain'); ?></span>
              <?php echo esc_html($title); ?>
            </li>
            <li>
              <span class="text-gray-400 mr-2"><?php _e('Development', 'SECRET-domain'); ?></span>
              <?php echo esc_html($development); ?>
            </li>
            <li>
              <span class="text-gray-400 mr-2"><?php _e('Type', 'SECRET-domain'); ?></span>
              <?php echo esc_html($type); ?>
            </li>
          </ul>
        </div>
      </div>

      <?php if ($contact_form_shortcode) : ?>
        <div class="col-span-4 lg:col-span-5 xl:col-span-6 xl:row-span-2 xl:order-2 xl:col-start-7 2xl:col-span-5 2xl:col-start-8">
          <?php get_template_part('template-parts/components/contact-form/contact-form', '', [
            'contact_form_shortcode' => $contact_form_shortcode
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>