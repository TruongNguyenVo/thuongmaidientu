<?php
if (!function_exists('honrix_single_customizer_register')) {
    function honrix_single_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');

        $wp_customize->add_section(
            'honrix_single',
            array(
                'title' => __('Single (Post & Page)', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting('honrix_single_navigation_prev_title', array(
            'default' => __('Previous Article','honrix'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_single_navigation_prev_title', array(
            'type' => 'text',
            'label' => __('Previous Post Title', 'honrix'),
            'description' => __('Previous Post Title in navigation. Leave blank if you want to hide.', 'honrix'),
            'section' => 'honrix_single',
            'settings' => 'honrix_single_navigation_prev_title'
        )));

        $wp_customize->add_setting('honrix_single_navigation_next_title', array(
            'default' => __('Next Article','honrix'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_single_navigation_next_title', array(
            'type' => 'text',
            'label' => __('Next Post Title', 'honrix'),
            'description' => __('Next Post Title in navigation. Leave blank if you want to hide.', 'honrix'),
            'section' => 'honrix_single',
            'settings' => 'honrix_single_navigation_next_title'
        )));
    }
    add_action('customize_register', 'honrix_single_customizer_register');
}
