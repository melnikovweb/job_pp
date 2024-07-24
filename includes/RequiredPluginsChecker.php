<?php

declare(strict_types=1);

namespace SECRET\Includes;

/**
 * Class RequiredPluginsChecker
 * @package SECRET\Includes
 */
class RequiredPluginsChecker
{
  /**
   * @var array List of required plugins
   */
  private array $required_plugins = [];

  /**
   * RequiredPluginsChecker constructor.
   * @param array $plugins List of required plugins
   */
  public function __construct(array $plugins)
  {
    $this->required_plugins = $plugins;
  }

  /**
   * Check if a plugin is active
   * @param string $plugin Plugin name
   * @return bool
   */
  public function is_plugin_active_custom(string $plugin): bool
  {
    return in_array($plugin, (array) get_option('active_plugins', []));
  }

  /**
   * Get the list of missing plugins
   * @return array List of missing plugins
   */
  private function get_missing_plugins(): array
  {
    $missing_plugins = [];

    foreach ($this->required_plugins as $plugin) {
      if (!$this->is_plugin_active_custom($plugin)) {
        $missing_plugins[] = $plugin;
      }
    }

    return $missing_plugins;
  }

  /**
   * Check required plugins and die with error message if any are missing
   */
  public function check_required_plugins(): void
  {
    $missing_plugins = $this->get_missing_plugins();

    if (!empty($missing_plugins)) {
      $missing_plugins_list = implode(', ', $missing_plugins);
      $message =
        __('For this template you need to install and activate the plugins: ', 'SECRET-domain') . $missing_plugins_list;
      wp_die($message);
    }
  }

  /**
   * Display admin notice if required plugins are missing
   */
  public function check_required_plugins_admin_notice(): void
  {
    $missing_plugins = $this->get_missing_plugins();

    if (!empty($missing_plugins)) {
      $missing_plugins_list = implode(', ', $missing_plugins);
      $message =
        __('For this template you need to install and activate the plugins: ', 'SECRET-domain') . $missing_plugins_list;
      echo '<div class="notice notice-error"><p>' . $message . '</p></div>';
    }
  }
}
