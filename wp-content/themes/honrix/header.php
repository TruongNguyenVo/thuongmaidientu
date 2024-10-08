<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage honrix
 * @since honrix 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php esc_url(get_bloginfo('pingback_url')); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class('p-0 m-0'); ?>>
    <?php wp_body_open(); ?>
    <a class='skip-link screen-reader-text' href='#content'>
        <?php esc_html_e('Skip to content', 'honrix'); ?>
    </a>
    <?php if (get_theme_mod('honrix_loading_display', 'yes') == 'yes') : ?>
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 align-items-center justify-content-center">
            <div class="spinner"><span class="loader"></span></div>
        </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/sections/section','header'); ?>

    