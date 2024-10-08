<?php

/**
 * @package WordPress
 */

if (!function_exists('honrix_setting_customizer_register')) {
    function honrix_setting_customizer_register($wp_customize)
    {
        $wp_customize->add_panel('honrix_settings_pannel', array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => 'Honrix Customization',
            'description' => '',
        ));
    }
    add_action('customize_register', 'honrix_setting_customizer_register');
}

get_template_part('/inc/customize/general');
get_template_part('/inc/customize/top-header');
get_template_part('/inc/customize/header-menu');
get_template_part('/inc/customize/typography');
get_template_part('/inc/customize/archive');
get_template_part('/inc/customize/single');
get_template_part('/inc/customize/comment');
get_template_part('/inc/customize/sidebar');
get_template_part('/inc/customize/footer');
get_template_part('/inc/customize/copyright');
