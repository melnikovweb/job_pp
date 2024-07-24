<?php

require_once get_template_directory() . '/includes/TgmPluginActivation.php';

add_action('tgmpa_register', 'SECRET_register_required_plugins');
function SECRET_register_required_plugins()
{
  $base_path = get_template_directory() . '/bootstrap';

  $plugins = [
    [
      'name' => 'Advanced Custom Fields PRO',
      'slug' => 'advanced-custom-fields-pro',
      'source' => $base_path . '/advanced-custom-fields-pro-6.2.1.1.zip',
      'required' => true
    ],

    [
      'name' => 'All in One SEO',
      'slug' => 'all-in-one-seo-pack',
      'required' => false
    ],

    [
      'name' => 'All In One WP Security',
      'slug' => 'all-in-one-wp-security-and-firewall',
      'required' => false
    ],

    [
      'name' => 'Contact Form 7',
      'slug' => 'contact-form-7',
      'required' => true
    ],

    [
      'name' => 'Regenerate Thumbnails',
      'slug' => 'regenerate-thumbnails',
      'required' => false
    ],

    [
      'name' => 'W3 Total Cache',
      'slug' => 'w3-total-cache',
      'required' => false
    ],

    [
      'name' => 'WP Mail SMTP',
      'slug' => 'wp-mail-smtp',
      'required' => false
    ],

    [
      'name' => 'WP Migrate',
      'slug' => 'wp-migrate-db-pro',
      'source' => $base_path . '/wp-migrate-db-pro-2.6.10.zip',
      'required' => false
    ],

    [
      'name' => 'SVG Support',
      'slug' => 'svg-support',
      'required' => true
    ]
  ];

  $config = [
    'domain' => 'SECRET-domain',
    'default_path' => '',
    'menu' => 'SECRET-install-required-plugins',
    'has_notices' => true,
    'is_automatic' => true
  ];

  tgmpa($plugins, $config);
}
