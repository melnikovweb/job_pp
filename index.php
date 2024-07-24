<?php
get_header();

if (have_posts()) {
  get_template_part('template-parts/content/archive-blog/archive-blog');
} else {
  get_template_part('template-parts/content/content-404/content-404');
}

get_footer();
