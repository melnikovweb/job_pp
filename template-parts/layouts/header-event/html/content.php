<?php
$event_type = $args['events_type'];

if ($event_type === 'future') {
  $event_title = get_field('upcoming_events_title', 'options');
  $event_text = get_field('upcoming_events_text', 'options');
} elseif ($event_type === 'past') {
  $event_title = get_field('past_events_title', 'options');
  $event_text = get_field('past_events_text', 'options');
}
?>

<section class="header-event">
  <div class="grid-container gap-y-6 md:gap-y-10 pt-8 md:pt-16 xl:pt-20">
    <div class="grid col-span-full grid-cols-subgrid gap-y-4 md:gap-y-6 xl:col-span-8 xl:col-start-3">
      <?php if ($event_title): ?>
        <h2 class="font-h1 text-gray text-center col-span-full"><?php echo esc_html($event_title); ?></h2>
      <?php endif; ?>

      <?php if ($event_text): ?>
        <div class="text-center text-gray-800 font-b1 col-span-full"><?php echo esc_html($event_text); ?></div>
      <?php endif; ?>
    </div>
  </div>
</section>