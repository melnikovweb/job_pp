<?php
add_action('after_setup_theme', function () {
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script']);
});
