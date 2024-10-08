<?php 

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();

get_template_part('template-parts/content', 'woocommerce');

get_footer();