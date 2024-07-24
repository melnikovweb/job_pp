<?php
require_once get_template_directory() . '/includes/RequiredPluginsChecker.php';

$required_plugins = ['advanced-custom-fields-pro/acf.php'];

$required_plugins_checker = new \SECRET\Includes\RequiredPluginsChecker($required_plugins);

add_action('template_redirect', [$required_plugins_checker, 'check_required_plugins']);
add_action('admin_notices', [$required_plugins_checker, 'check_required_plugins_admin_notice']);
