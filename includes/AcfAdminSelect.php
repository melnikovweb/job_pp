<?php

declare(strict_types=1);

namespace SECRET\Includes;

/**
 * Class AcfAdminSelect
 *
 * This class is responsible for creating ACF select fields for the admin panel.
 */
class AcfAdminSelect
{
  /**
   * @var array The array of select items.
   */
  private array $items;

  /**
   * AcfAdminSelect constructor.
   *
   * @param array $items The array of select items.
   */
  public function __construct(array $items)
  {
    $this->items = $items;
  }

  /**
   * Sanitize the image HTML using allowed tags.
   *
   * @param string $html The HTML string to sanitize.
   * @return string The sanitized HTML string.
   */
  private function sanitize_option_html(string $html): string
  {
    $allowed_tags = [
      'img' => [
        'src' => [],
        'alt' => [],
        'style' => []
      ],
      'div' => [
        'style' => []
      ]
    ];

    return wp_kses($html, $allowed_tags);
  }

  /**
   * Generate the HTML option template for a select.
   *
   * @param string $label The label of the select option.
   * @param string|null $image_url The URL of the select image.
   * @return string The generated HTML string.
   */
  private function get_option_template(string $label, ?string $image_url): string
  {
    $image_style = 'width: 30px;aspect-ratio: 2/1;object-fit: contain;';
    $option_style = 'display: inline-flex;vertical-align: middle;padding-block: 5px; padding-left: 5px; gap: 10px;';
    $image = $image_url ? "<img style=\"$image_style\" src=\"$image_url\" alt=\"$label\" />" : '';

    return $this->sanitize_option_html("<span style=\"$option_style\">" . $image . $label . '</span>');
  }

  /**
   * Generate the choices array for the select field.
   *
   * @return array The array of choices.
   */
  private function get_choices(): array
  {
    $choices = [];

    foreach ($this->items as $item) {
      $key = $item['value'] ?? '';
      $value = $this->get_option_template($item['label'] ?? '', $item['image_url'] ?? '');
      $choices[$key] = $value;
    }

    return $choices;
  }

  /**
   * Set the properties of the select field and assign choices.
   *
   * @param array $field The field configuration array.
   * @return array The modified field configuration array.
   */
  public function set_fields(array $field): array
  {
    $field['type'] = 'select';
    $field['allow_null'] = 1;
    $field['multiple'] = 1;
    $field['ui'] = 1;
    $field['choices'] = $this->get_choices();

    return $field;
  }

  /**
   * Create an instance and set up the filter for the select field.
   *
   * @param array $items The array of select items.
   * @param string $name The name of the ACF select.
   */
  public static function create(array $items, string $name): void
  {
    $instance = new self($items);
    add_filter('acf/load_field/name=' . $name, [$instance, 'set_fields']);
  }
}

// Example usage:
// AcfAdminSelect::create($items, $select_name);
