<?php
/**
 * Header template.
 */
?>
<!DOCTYPE html>
<html lang="<?Php language_attributes() ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name');?><?php wp_title(); // get the page title?></title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }
    ?>

    <header id="masthead" class="site-header" role="banner">
        <?php get_template_part('template-parts/header/nav'); ?>
    </header>