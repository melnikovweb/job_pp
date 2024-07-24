<?php
class VacancyFilterACFfilter
{
  const VACANCY_TAXONOMY_FIELD_NAME = 'vacancy_taxonomis_select';

  public static function get_vacancy_taxonomies()
  {
    $results = [];
    $taxonomies = get_object_taxonomies('vacancy');
    foreach ($taxonomies as $taxonomy) {
      $results[$taxonomy] = str_replace('-', ' ', $taxonomy);
    }

    return $results;
  }

  public static function set_vacancy_taxonomy_field($field)
  {
    $field['type'] = 'select';
    $field['allow_null'] = true;
    $field['multiple'] = false;
    $field['ui'] = true;
    $field['choices'] = self::get_vacancy_taxonomies();

    return $field;
  }

  public static function init()
  {
    add_filter('acf/load_field/name=' . self::VACANCY_TAXONOMY_FIELD_NAME, [__CLASS__, 'set_vacancy_taxonomy_field']);
  }
}

VacancyFilterACFfilter::init();
