<?php
// Template Name: Simple text

/**
 * Remove <link rel="next" ... />
 * @params string $next
 *
 * return string - new link meta tag in string
 */
function aioseo_filter_next_link($next)
{
  return '';
}
add_filter('aioseo_next_link', 'aioseo_filter_next_link');

/**
 * Remove <link rel="next" ... />
 * @params string $prev
 *
 * return string - new link meta tag in string
 */
function aioseo_filter_prev_link($prev)
{
  return '';
}
add_filter('aioseo_next_link', 'aioseo_filter_prev_link');
?>

<?php
get_header();
get_template_part('template-parts/content/content-simple-text/content-simple-text');
?>

<?php get_footer(); ?>

