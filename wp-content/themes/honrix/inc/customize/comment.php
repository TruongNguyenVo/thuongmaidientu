<?php
if (!function_exists('honrix_comment_customizer_register')) {
    function honrix_comment_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');
        get_template_part('/inc/customize/class/Input_Number_Option');

        $wp_customize->add_section(
            'honrix_comment',
            array(
                'title' => __('Comments', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting(
            'honrix_comment_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_comment_display',
            array(
                'label'      => __('Comment', 'honrix'),
                'description' => __('Hide or display all comment section from posts and pages.', 'honrix'),
                'section'    => 'honrix_comment',
                'settings'   => 'honrix_comment_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_comment_close_message',
            array(
                'transport' => 'refresh',
                'default' => __('Comments are closed for this section.', 'honrix'),
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'honrix_sanitize_textarea_html'
            )
        );

        $wp_customize->add_control(
            'honrix_comment_close_message',
            array(
                'type' => 'textarea',
                'label' => __('Comment Closed Message', 'honrix'),
                'description' => __('Write close comment message in here to display when comments are closed for post or page. Leave it blank to display none.', 'honrix'),
                'section' => 'honrix_comment',
                'settings' => 'honrix_comment_close_message'
            )
        );
    }

    add_action('customize_register', 'honrix_comment_customizer_register');
}

if (!function_exists('honrix_sanitize_textarea_html')) {
    function honrix_sanitize_textarea_html($input)
    {
        return wp_kses_post($input);
    }
}
