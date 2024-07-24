<?php $items = $args['items'] ?? []; ?>

<?php if ($items): ?>
  <div class="archive-glossary">
    <div class="grid-container gap-y-6 md:gap-y-16 xl:gap-y-20 py-8 md:pb-20 xl:pt-10 xl:pb-24">
      <?php foreach ($items as $item): ?>
        <section class="grid grid-cols-subgrid col-span-full gap-y-2 md:gap-y-4 xl:col-start-2 xl:col-end-[-2] 2xl:col-start-3 2xl:col-end-[-3]">
          <div class="font-a1 text-gray col-span-full"><?php echo esc_html($item['letter_name']); ?></div>

          <?php if ($item['posts']): ?>
            <ul class="grid grid-cols-subgrid col-span-full gap-y-2 text-gray lg:gap-y-6">
              <?php foreach ($item['posts'] as $post): ?>
                <li class="col-span-full lg:col-span-4 xl:col-span-5 2xl:col-span-4">
                  <a class="flex items-center gap-2 md:gap-4 font-b1 transition hover:text-blue-600" href="<?php echo esc_url(
                    $post['permalink']
                  ); ?>">
                    <?php echo esc_html($post['title']); ?>

                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                      </svg>
                    </div>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </section>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
