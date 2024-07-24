<?php
add_filter('wpcf7_load_css', '__return_false');
add_filter('wpcf7_autop_or_not', '__return_false');

function remove_validation_for_country_select($schema)
{
  $reflection = new ReflectionClass($schema);
  $rulesProperty = $reflection->getProperty('rules');
  $rulesProperty->setAccessible(true);
  $rules = $rulesProperty->getValue($schema);

  foreach ($rules as $key => $rule) {
    if (get_class($rule) == 'Contactable\SWV\EnumRule') {
      $ruleReflection = new ReflectionClass($rule);
      $propertiesProperty = $ruleReflection->getProperty('properties');
      $propertiesProperty->setAccessible(true);
      $properties = $propertiesProperty->getValue($rule);

      if ($properties['field'] === 'country-select') {
        unset($rules[$key]);
      }
    }
  }

  $rulesProperty->setValue($schema, $rules);

  return $schema;
}

add_filter('wpcf7_swv_create_schema', 'remove_validation_for_country_select', 20, 1);
