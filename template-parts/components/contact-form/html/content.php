<?php
$contact_form_shortcode = $args['contact_form_shortcode'] ?? ''; ?>
<?php if ($contact_form_shortcode) { ?>
  <div class="contact-form">
    <?php echo do_shortcode($contact_form_shortcode); ?>
  </div>
<?php } ?>
