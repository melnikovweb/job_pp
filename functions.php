<?php

/**
 * Load function parts.
 * Requires all PHP files found in the 'functions-parts' directory.
 */
function loadFunctionsParts(): void
{
  $files = glob(__DIR__ . '/functions-parts/*.php');
  foreach ($files as $file) {
    require_once $file;
  }
}

loadFunctionsParts();

if (is_readable(__DIR__ . '/vendor/autoload.php')) {
  /** @noinspection PhpIncludeInspection */
  require_once __DIR__ . '/vendor/autoload.php';
}
