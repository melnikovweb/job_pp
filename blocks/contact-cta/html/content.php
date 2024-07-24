<?php

$acf_fields = $args['acf_fields'] ?? [];

$subheading = $acf_fields['subheading'] ?? '';
$tag_type = $acf_fields['tag_types'] ?? 'h2';
$heading = $acf_fields['heading'] ?? '';
$info_blocks = $acf_fields['info_blocks'] ?? [];

$block_key = strtolower(str_replace([' ', "'"], '_', $heading));

if (count($info_blocks)): ?>
  <section class="contact-cta">
    <div class="pt-8">
      <div class="font-b3 text-gray-400 pb-2 text-center">
        <?php echo esc_html($subheading); ?>
      </div>

      <?php echo '<' .
        esc_attr($tag_type) .
        ' class="font-h1 text-gray pb-4 md:pb-6 text-center">' .
        esc_html($heading) .
        '</' .
        esc_attr($tag_type) .
        '>'; ?>

      <div class="container lg:grid lg:grid-cols-2 lg:gap-x-[--container-gutter] lg:pb-20 lg:pt-8 xl:pt-14" data-contact-form>
        <div class="pt-1 pb-2 md:pt-8 md:pb-14 lg:py-0">
          <?php foreach ($info_blocks as $key => $block): ?>
            <div class="grid grid-rows-[auto,0fr] transition-all group has-[.accordion-control:checked]:grid-rows-[auto,1fr] content-start mb-2 lg:mb-6">
              <div class="p-4 md:pt-6 rounded-t-xs transition-all group-has-[.accordion-control:checked]:bg-blue-50">
                <label class="flex items-center" data-tab-button="<?php echo "form_item_$key"; ?>">
                  <input name="<?php echo $block_key; ?>" type="radio" class="accordion-control hidden" <?php echo !$key
  ? 'checked="checked"'
  : ''; ?> />

                  <div class="size-8 grid">
                    <svg class="size-full [grid-area:1/1] group-has-[.accordion-control:checked]:opacity-100 transition-all" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="0.5" y="0.5" width="31" height="31" rx="15.5" fill="#1C51FB" />
                      <rect x="0.5" y="0.5" width="31" height="31" rx="15.5" stroke="#1C51FB" />
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99951 16.0005C8.99951 15.8679 9.05219 15.7407 9.14596 15.6469C9.23973 15.5531 9.3669 15.5005 9.49951 15.5005L21.2925 15.5005L18.1455 12.3545C18.0516 12.2606 17.9989 12.1332 17.9989 12.0005C17.9989 11.8677 18.0516 11.7404 18.1455 11.6465C18.2394 11.5526 18.3667 11.4998 18.4995 11.4998C18.6323 11.4998 18.7596 11.5526 18.8535 11.6465L22.8535 15.6465C22.9001 15.6929 22.937 15.7481 22.9622 15.8088C22.9874 15.8696 23.0004 15.9347 23.0004 16.0005C23.0004 16.0662 22.9874 16.1314 22.9622 16.1921C22.937 16.2528 22.9001 16.308 22.8535 16.3545L18.8535 20.3545C18.7596 20.4484 18.6323 20.5011 18.4995 20.5011C18.3667 20.5011 18.2394 20.4484 18.1455 20.3545C18.0516 20.2606 17.9989 20.1332 17.9989 20.0005C17.9989 19.8677 18.0516 19.7404 18.1455 19.6465L21.2925 16.5005L9.49951 16.5005C9.3669 16.5005 9.23973 16.4478 9.14596 16.354C9.05219 16.2603 8.99951 16.1331 8.99951 16.0005Z" fill="white" />
                    </svg>

                    <svg class="size-full [grid-area:1/1] group-has-[.accordion-control:checked]:opacity-0 transition" width="32" height="32" viewBox="0 0 32 32" fill="white" xmlns="http://www.w3.org/2000/svg">
                      <rect x="0.5" y="0.5" width="31" height="31" rx="15.5" stroke="#32353E" />
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99951 16.0005C8.99951 15.8679 9.05219 15.7407 9.14596 15.6469C9.23973 15.5531 9.3669 15.5005 9.49951 15.5005L21.2925 15.5005L18.1455 12.3545C18.0516 12.2606 17.9989 12.1332 17.9989 12.0005C17.9989 11.8677 18.0516 11.7404 18.1455 11.6465C18.2394 11.5526 18.3667 11.4998 18.4995 11.4998C18.6323 11.4998 18.7596 11.5526 18.8535 11.6465L22.8535 15.6465C22.9001 15.6929 22.937 15.7481 22.9622 15.8088C22.9874 15.8696 23.0004 15.9347 23.0004 16.0005C23.0004 16.0662 22.9874 16.1314 22.9622 16.1921C22.937 16.2528 22.9001 16.308 22.8535 16.3545L18.8535 20.3545C18.7596 20.4484 18.6323 20.5011 18.4995 20.5011C18.3667 20.5011 18.2394 20.4484 18.1455 20.3545C18.0516 20.2606 17.9989 20.1332 17.9989 20.0005C17.9989 19.8677 18.0516 19.7404 18.1455 19.6465L21.2925 16.5005L9.49951 16.5005C9.3669 16.5005 9.23973 16.4478 9.14596 16.354C9.05219 16.2603 8.99951 16.1331 8.99951 16.0005Z" fill="#0A101E" />
                    </svg>
                  </div>

                  <div class="font-h4 ml-4 group-has-[.accordion-control:checked]:text-blue-600">
                    <?php echo esc_html($block['heading']); ?>
                  </div>
                </label>
              </div>

              <div class="overflow-hidden transition-height duration-300 ease-in-out">
                <div class="pb-4 px-4 text-gray-800 [&_a]:text-blue-600 font-b1 rounded-b-xs transition-all group-has-[.accordion-control:checked]:bg-blue-50 lg:pb-6">
                  <?php echo wp_kses_post($block['content'] ?? ''); ?>
                </div>

                <div class="[--form-color:theme(colors.white)] [--form-padding:theme(spacing.0)] pt-4 md:pt-8 md:pb-2 lg:hidden">
                  <?php get_template_part('template-parts/components/contact-form/contact-form', '', [
                    'contact_form_shortcode' => $block['contact_form_shortcode'] ?? ''
                  ]); ?>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

        </div>
        <div class="hidden lg:block">
          <?php foreach ($info_blocks as $key => $block): ?>
            <div class="" data-tab="<?php echo "form_item_$key"; ?>" data-tab-state="<?php echo !$key
  ? 'open'
  : 'close'; ?>" <?php echo !$key ? '' : 'style="display:none"'; ?>>

              <div class="[--form-color:theme(colors.white)] [--form-padding:theme(spacing.0)]">
                <?php get_template_part('template-parts/components/contact-form/contact-form', '', [
                  'contact_form_shortcode' => $block['contact_form_shortcode']
                ]); ?>
              </div>

            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif;
