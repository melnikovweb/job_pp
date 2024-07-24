<?php $fields = $args['acf_fields']; ?>

<div class="simple-tabs">
  <div class="grid-container pb-24 pt-20">
    <div class="grid gap-6 col-span-full">
      <div class="flex justify-center font-h1 text-gray col-span-full"><?php echo $fields['title']; ?></div>

      <nav class="flex gap-4 flex-wrap w-full justify-center" aria-label="Tabs" data-id="tabs">
        <?php foreach ($fields['tabs'] as $index => $tab):

          $active_classes = 'text-gray bg-yellow-100 cursor-default pointer-events-none';
          $default_classes = 'bg-gray-100 text-gray-400 hover:bg-yellow-100 cursor-pointer transition';
          $is_selected = $index == 0;
          $classes_options = $is_selected ? $active_classes : $default_classes;
          ?>
          <div class="font-b1 rounded-full py-3 px-4 <?php echo $classes_options; ?>" data-active-classes="<?php echo $active_classes; ?>" data-default-classes="<?php echo $default_classes; ?>" data-value="<?php echo $index; ?>" <?php echo $is_selected
  ? 'aria-current="page"'
  : ''; ?>>
            <?php echo $tab['label']; ?>
          </div>
        <?php
        endforeach; ?>
      </nav>

      <div class="flex justify-center font-b1 text-gray-600" data-id='timestamp'>
        <?php foreach ($fields['tabs'] as $index => $tab):

          $is_selected = $index == 0;
          $classes_options = $is_selected ? 'block' : 'hidden';
          ?>
          <?php if ($tab['timestamp']): ?>
            <div class="<?php echo $classes_options; ?>" data-value="<?php echo $index; ?>">
              <?php echo $tab['timestamp_label']; ?>
              <?php echo $tab['timestamp']; ?>
            </div>
          <?php endif; ?>
        <?php
        endforeach; ?>
      </div>
    </div>

    <div class="grid grid-cols-subgrid col-span-full" data-id="content">
      <?php foreach ($fields['tabs'] as $index => $tab):

        $is_selected = $index == 0;
        $classes_options = $is_selected ? 'grid' : 'hidden';
        ?>
        <div class="grid-cols-subgrid col-span-full <?php echo $classes_options; ?>" data-value="<?php echo $index; ?>">
          <?php foreach ($tab['content'] as $item):
            $is_wysiwyg = $item['acf_fc_layout'] == 'wysiwyg'; ?>
            <?php if ($is_wysiwyg): ?>
              <div class="grid-cols-subgrid prose lg:col-span-6 lg:col-start-2 xl:col-span-8 xl:col-start-3" data-id="content">
                <?php echo $item['content']; ?>
              </div>
            <?php else: ?>
              <div class="grid-cols-subgrid">
                <?php echo $item['content']; ?>
              </div>
            <?php endif; ?>
          <?php
          endforeach; ?>
        </div>
      <?php
      endforeach; ?>
    </div>
  </div>
</div>
