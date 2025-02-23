<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <?php wp_head(); ?>
  <?php get_template_part('template-parts/head'); ?>
</head>

<body <?php body_class(); ?>>
  <div class="page-wrapper">
    <?php get_template_part('template-parts/layouts/header/header'); ?>
    <main id="content" role="main">
