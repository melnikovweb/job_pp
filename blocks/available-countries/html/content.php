<?php

$acf_fields = $args['acf_fields'] ?? [];
$countries = $args['countries'] ?? [];
$countries_map = $args['countries_map'] ?? [];
$regions = $args['regions'] ?? [];
$all_countries_key = $args['all_countries_key'] ?? '';

$tag_type = $acf_fields['tag_type'] ?? 'h2';
$headline = $acf_fields['headline'] ?? '';
$excluded_contries = $acf_fields['excluded_contries'] ?? [];
$show_all_button_label = $acf_fields['show_all_button_label'] ?? '';
$is_info_block_shown = $acf_fields['is_info_block_shown'] ?? false;
$info_block = $acf_fields['info_block'] ?? [];
?>

<div class="available-countries">
  <template data-not-found="available-countries">
    <div class="font-h5 text-gray-600 text-center col-span-full">
      <?php _e('No results found', 'SECRET-domain'); ?>
    </div>
  </template>

  <div class="grid-container bg-white py-8 sm:py-20 lg:py-24 gap-y-8 sm:gap-y-16 lg:gap-y-24">
    <div class="grid grid-cols-subgrid col-span-full gap-y-8 sm:gap-y-14">
      <div class="grid col-span-full md:col-[2/-2] lg:col-[4/-4] gap-y-8">
        <?php if ($headline) : ?>
          <?php
          $headline_classes = 'font-h3 text-gray col-span-full text-center';
          $headline_open_tag = '<' . esc_attr($tag_type) . ' class="' . esc_attr($headline_classes) . '">';
          $headline_close_tag = '</' . esc_attr($tag_type) . '>';
          $headline = $headline_open_tag . esc_html($headline) . $headline_close_tag;

          echo wp_kses_post($headline);
          ?>
        <?php endif; ?>

        <div class="col-span-full">
          <div class="rounded-full border border-solid flex items-center gap-2 py-2 px-4 text-gray border-gray-400 sm:py-3 sm:px-6 lg:py-4">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M20.0001 20L16.1334 16.1333M18.2223 11.1111C18.2223 15.0385 15.0385 18.2223 11.1111 18.2223C7.18377 18.2223 4 15.0385 4 11.1111C4 7.18377 7.18377 4 11.1111 4C15.0385 4 18.2223 7.18377 18.2223 11.1111Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            <input type="text" data-control="search" class="placeholder-gray-600 text-current w-full border-none p-0 focus:[box-shadow:none]" placeholder="<?php _e(
                                                                                                                                                              'Search',
                                                                                                                                                              'SECRET-domain'
                                                                                                                                                            ); ?>">
          </div>
        </div>
      </div>

      <div class="col-span-full 2xl:col-[2/-2] flex flex-wrap gap-2 md:gap-4 justify-center [&.is-searching]:hidden" data-container="tabs-control">
        <?php foreach ($regions as $index => $region_name) :
          $is_active = $index === 0 ? 'active' : ''; ?>
          <div class="flex rounded-full bg-gray-200 min-w-17 md:min-w-25 px-4 py-2 justify-center font-b1 text-gray-400 hover:bg-yellow hover:text-gray cursor-pointer transition-colors [&.active]:bg-yellow [&.active]:text-gray [&.active]:cursor-default <?php echo esc_html(
                                                                                                                                                                                                                                                                $is_active
                                                                                                                                                                                                                                                              ); ?>" data-value="<?php echo esc_html($region_name); ?>">
            <?php echo esc_html($region_name); ?>
          </div>
        <?php
        endforeach; ?>
      </div>
    </div>

    <div class="grid col-span-full content-start" data-container="tabs-content">
      <?php foreach ($countries_map as $region_name => $region_countries) :
        $is_active = $region_name === $all_countries_key ? 'active' : ''; ?>
        <div data-region="<?php echo esc_html(
                            $region_name
                          ); ?>" class="group/countries grid [grid-area:1/1] content-start [&:not(.active)]:hidden gap-y-6 sm:gap-y-10 <?php echo esc_html(
                                                                                                                        $is_active
                                                                                                                      ); ?>" data-show-more="container">
          <div data-show-more="content" class="group-[:not(.is-overflow)]/countries:after:hidden group-[.is-searching]/countries:max-h-none group-[.is-shown]/countries:after:hidden group-[.is-searching]/countries:after:hidden transition-all group-[.is-shown]/countries:max-h-full max-h-[432px] overflow-y-clip relative after:absolute after:bottom-0 after:left-0 after:w-full after:bg-gradient-to-t after:from-white after:to-transparent after:h-20">
            <div class="grid content-start grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-[--container-gutter] gap-y-2 ">
              <?php foreach ($region_countries as $country) :
                $search_queries = join('|', [$country->cca2, $country->shortName]); ?>

                <div class="flex items-center gap-4 py-1 font-b1 text-gray" data-search-queries="<?php echo esc_html(
                                                                                                    $search_queries
                                                                                                  ); ?>">
                  <div class="size-8 overflow-hidden rounded-full shrink-0">
                    <img class="size-full object-cover" src="<?php echo esc_url(
                                                                $country->flag
                                                              ); ?>" alt="<?php echo esc_html($country->cca2); ?>">
                  </div>

                  <?php echo esc_html($country->shortName); ?>
                </div>
              <?php
              endforeach; ?>
            </div>
          </div>

          <button class="group-[:not(.is-overflow)]/countries:hidden button-md button-outlined-dark justify-self-center group-[.is-shown]/countries:hidden group-[.is-searching]/countries:hidden" data-show-more="action">
            <?php echo esc_html($show_all_button_label); ?>
          </button>
        </div>
      <?php
      endforeach; ?>
    </div>

    <?php if ($is_info_block_shown) : ?>
      <div class="col-span-full">
        <?php get_template_part('template-parts/components/info-block/info-block', 'info-block', $info_block); ?>
      </div>
    <?php endif; ?>
  </div>
</div>