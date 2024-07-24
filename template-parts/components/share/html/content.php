<?php extract($args); ?>

<div class="share">
	<div class="flex gap-6 mb-6 md:mb-8 items-center *:text-white/60 hover:*:text-white *:transition">
		<?php foreach ($args['socials'] as $social): ?>
		<a href="<?php echo esc_url($social['url']); ?>" class="" target="_blank">
			<?php echo wp_get_attachment_image($social['logo'], 'thumbnail', true); ?>
		</a>
		<?php endforeach; ?>
	</div>
</div>