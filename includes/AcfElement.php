<?php

declare(strict_types=1);

namespace SECRET\Includes;

/**
 * Class AcfElement
 * Extends the Element class to add Advanced Custom Fields support.
 */
class AcfElement extends Element
{
  /**
   * Add HTML content with Advanced Custom Fields support.
   */
  protected function add_html(): void
  {
    if (function_exists('get_fields')) {
      $template_args = $this->get_template_args();
      $template_args['acf_fields'] = get_fields();
      $this->set_template_args($template_args);
    }
    parent::add_html();
  }
}
