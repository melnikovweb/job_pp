<?php

declare(strict_types=1);

namespace SECRET\Includes;

use Exception;

/**
 * Class Element
 * Base class for custom elements.
 */
class Element
{
  /** @var array Stores the paths of loaded stylesheets. */
  private static array $styles_queue = [];
  /** @var string The path to the stylesheets. */
  private string $styles;

  /** @var array Stores the IDs of loaded scripts. */
  private static array $scripts_queue = [];
  /** @var string The URL to the scripts. */
  private string $scripts;
  /** @var string The path to the scripts. */
  private string $scripts_path;
  /** @var string The ID of the scripts. */
  private string $id;
  /** @var array The depths of the scripts. */
  private array $scripts_depth = [];

  /** @var string The path to the HTML content. */
  private string $html;
  /** @var array The arguments for the template. */
  private array $template_args = [];

  /**
   * Constructor method.
   *
   * @param string $file The path to the file.
   *
   * @throws \InvalidArgumentException If $file is empty.
   */
  public function __construct(string $file, $args = [])
  {
    if (empty($file)) {
      throw new \InvalidArgumentException('$file was missed');
    }
    $template_directory_path = wp_normalize_path(get_template_directory());
    $file_path = wp_normalize_path($file);

    $args['template_path'] = str_replace($template_directory_path, '', dirname($file_path));

    $assets_path = substr(str_replace($template_directory_path, '/public', $file_path), 0, -3);
    $this->styles = $template_directory_path . $assets_path . 'css';
    $this->scripts = get_template_directory_uri() . $assets_path . 'js';
    $this->scripts_path = $template_directory_path . $assets_path . 'js';
    $this->id = basename($assets_path, '.');

    $this->html = str_replace($template_directory_path, '', dirname($file_path)) . '/html/content';

    $this->add_styles();
    $this->add_scripts();
    $this->set_template_args($args);
    $this->add_html();
  }

  /**
   * Add HTML content.
   *
   * @throws \Exception If the content.php file does not exist.
   */
  protected function add_html(): void
  {
    if (!file_exists(get_template_directory() . $this->html . '.php')) {
      throw new \Exception('element must have content.php in html folder');
    }

    \get_template_part($this->html, null, $this->template_args);
  }

  /**
   * Echo stylesheets.
   *
   * @return void.
   */
  private function add_styles(): void
  {
    if (!in_array($this->styles, self::$styles_queue)) {
      $html = '';
      if (!file_exists($this->styles)) {
        throw new Exception('Style file was not existed: ' . $this->styles);
      }

      $style_content = file_get_contents($this->styles);

      if ($style_content !== '') {
        $html = '<style>' . $style_content . '</style>';
        self::$styles_queue[] = $this->styles;

        echo $html;
      }
    }
  }

  /**
   * Add scripts.
   */
  private function add_scripts(): void
  {
    if (
      file_exists($this->scripts_path) &&
      filesize($this->scripts_path) &&
      !in_array($this->id, self::$scripts_queue)
    ) {
      wp_register_script($this->id, $this->scripts, $this->scripts_depth, filemtime($this->scripts_path), [
        'strategy' => 'async',
        'in_footer' => true
      ]);
      wp_enqueue_script($this->id);
      self::$scripts_queue[] = $this->id;
    }
  }

  /**
   * Add localized scripts.
   *
   * @param array $args The arguments to localize.
   */
  public function add_scripts_localize(array $args): void
  {
    wp_localize_script($this->id, 'SECRET_' . str_replace('-', '_', $this->id), $args);
  }

  /**
   * Get the HTML path.
   *
   * @return string The HTML path.
   */
  public function get_html(): string
  {
    return $this->html;
  }

  /**
   * Set the template arguments.
   *
   * @param array $template_args The arguments for the template.
   *
   * @throws \InvalidArgumentException If $template_args is not an array.
   */
  public function set_template_args(array $template_args): void
  {
    if (count($template_args)) {
      $this->template_args = $template_args;
    }
  }

  /**
   * Get the template arguments.
   *
   * @return array The template arguments.
   */
  public function get_template_args(): array
  {
    return $this->template_args;
  }

  /**
   * Set the scripts depth.
   *
   * @param array $scripts_depth The depths of the scripts.
   *
   * @throws \InvalidArgumentException If $scripts_depth is not an array.
   */
  public function set_scripts_depth(array $scripts_depth): void
  {
    if (count($scripts_depth)) {
      $this->scripts_depth = $scripts_depth;
    }
  }
}
