<?php $posts = $args['posts'] ?? []; ?>

<section class="events">
  <?php if ($args['event_type'] === 'past') : ?>
    <div class="filter-event container flex gap-[--container-gutter] flex-col lg:flex-row justify-center">
      <div class="w-full flex flex-col gap-1">
        <label class="text-gray font-b1">
          <?php _e('Years', 'SECRET-domain'); ?>

          <select multiple data-event-filter="year">
            <option value=""><?php _e('Select years', 'SECRET-domain'); ?></option>

            <?php for (
              $latest_year = $args['latest_date'], $year = date('Y');
              $latest_year <= $year;
              $latest_year++
            ) : ?>

              <option value="<?php echo esc_attr($latest_year); ?>"><?php echo esc_html($latest_year); ?></option>
            <?php endfor; ?>
          </select>
        </label>
      </div>

      <div class="w-full flex flex-col gap-1">
        <label class="text-gray font-b1">
          <?php _e('Topics', 'SECRET-domain'); ?>

          <select multiple data-event-filter="type">
            <?php if (is_array($args['event_type_filter'])) : ?>
              <option value=""><?php _e('Select types', 'SECRET-domain'); ?></option>

              <?php foreach ($args['event_type_filter'] as $type) : ?>
                <option value="<?php echo esc_attr($type->slug); ?>"><?php echo esc_html($type->name); ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </label>
      </div>
    </div>
  <?php endif; ?>

  <div class="grid-container gap-y-6 md:gap-y-16 xl:gap-y-20 pt-8 md:pt-16 xl:pt-20">
    <div class="grid grid-cols-subgrid col-span-full gap-y-2 md:gap-y-4 ">
      <?php if ($posts) :
        $item_attributes = $args['event_type'] === 'past' ? 'id=events-container data-container=posts' : ''; ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 col-span-full gap-[--container-gutter]" <?php echo esc_attr(
                                                                                              $item_attributes
                                                                                            ); ?>>
          <?php foreach ($posts as $post) : ?>
            <?php get_template_part('template-parts/components/event-item/event-item', null, $post); ?>
          <?php endforeach; ?>
        </div>
      <?php
      endif; ?>
    </div>

    <?php if ($args['event_type'] === 'past') : ?>
      <button class="button-md button-primary-dark col-span-full md:place-self-center" data-count="<?php echo esc_attr(
                                                                                                      $args['total_posts']
                                                                                                    ); ?>" data-action="show-more">
        <?php _e('Show more', 'SECRET-domain'); ?>
      </button>
    <?php endif; ?>
  </div>
</section>