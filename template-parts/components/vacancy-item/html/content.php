 <div class="vacancy-item p-4 rounded-xs md:rounded-sm md:p-6 xl:p-8 md:flex md:justify-between md:items-center xl:grid xl:grid-cols-subgrid xl:col-span-full <?php echo esc_attr(
                                                                                                                                                                $args['color']
                                                                                                                                                              ); ?>">
   <div class="xl:items-center xl:col-span-10 xl:grid xl:grid-cols-subgrid">
     <div class="xl:col-span-5">
       <?php if (isset($args['type-work'])) { ?>
         <div class="font-b2 mb-2"><?php echo esc_html($args['type-work']); ?></div>
       <?php } ?>
       <div class="font-h4 mb-2">
         <?php echo esc_html($args['post_title']); ?>
       </div>
     </div>

     <div class="flex gap-x-6 font-b2 xl:grid xl:grid-cols-subgrid xl:col-span-5 *:xl:col-span-2">
       <?php if (isset($args['work-schedule'])) { ?>
         <div><?php echo esc_html($args['work-schedule']); ?></div>
       <?php } ?>

       <?php if (isset($args['work-location'])) { ?>
         <div><?php echo esc_html($args['work-location']); ?></div>
       <?php } ?>
     </div>
   </div>

   <div class="md:flex md:justify-end inline-flex mt-6 md:mt-0 xl:col-span-2">
     <a href="<?php echo esc_url($args['url']); ?>" class="button-md button-primary-white w-fit">
       <?php _e('Apply', 'SECRET-domain'); ?>
     </a>
   </div>
 </div>