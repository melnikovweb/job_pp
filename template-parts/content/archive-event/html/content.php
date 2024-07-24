<section class="archive-event">
  <?php get_template_part('template-parts/layouts/header-event/header-event', null, [
    'events_type' => 'future'
  ]); ?>

  <?php get_template_part('template-parts/components/events/events', null, [
    'events_type' => 'future'
  ]); ?>

  <div class="pb-4 md:pb-8">
    <?php get_template_part('template-parts/layouts/header-event/header-event', null, [
      'events_type' => 'past'
    ]); ?>
  </div>

  <div class="pb-8 md:pb-20 xl:pb-24">
    <?php get_template_part('template-parts/components/events/events', null, [
      'events_type' => 'past'
    ]); ?>
  </div>
