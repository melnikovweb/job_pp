<?php
function action_alphabet()
{
  register_taxonomy(
    'alphabet',
    ['glossary'],
    [
      'label' => __('Alphabet', 'SECRET-domain-admin'),
      'description' => __('Alphabet', 'SECRET-domain-admin'),
      'public' => true,
      'publicly_queryable' => null,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_tagcloud' => true,
      'show_in_quick_edit' => null,
      'hierarchical' => true,
      'rewrite' => ['slug' => 'glossary-category'],
      'show_admin_column' => true,
      'show_in_rest' => true
    ]
  );
}
add_action('init', 'action_alphabet', 2);
