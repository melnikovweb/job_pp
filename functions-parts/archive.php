<?php
add_filter('get_the_archive_title', function ($title) {
  if (is_home()) {
    $title = __('Blog', 'SECRET-domain');
  }

  if (is_post_type_archive('news')) {
    $title = __('News', 'SECRET-domain');
  }

  return $title;
});

function SECRET_read_time($post_id = null)
{
  $post_id = $post_id ?? get_the_ID();

  $text = get_the_content($post_id);
  $words = str_word_count(strip_tags($text), 0);

  if (!empty($words)) {
    $time_in_minutes = ceil($words / 200);
    return $time_in_minutes;
  }

  return false;
}
