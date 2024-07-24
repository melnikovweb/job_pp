<?php
$links = $args['links'] ?? []; ?>

<aside class="breadcrumbs" style="display: contents;">
  <div class="max-w-full overflow-hidden">
    <nav class="inline-block py-2 px-4 bg-gray-100 text-gray rounded-sm font-b3 md:py-3 max-w-full truncate">
      <?php foreach ($links as $key => $link):
        $title = $link['title'] ?? ''; ?>
        <?php echo $key != 0 ? '<span class="separator px-1">/</span>' : ''; ?>

        <?php if ($link['url']): ?>
          <a href="<?php echo esc_url($link['url']); ?>" class="text-gray-400 hover:text-gray text-nowrap transition">
            <?php echo esc_html($title); ?>
          </a>
        <?php else: ?>
          <span class="text-nowrap"><?php echo esc_html($title); ?></span>
        <?php endif; ?>
      <?php
      endforeach; ?>
    </nav>
  </div>
</aside>
