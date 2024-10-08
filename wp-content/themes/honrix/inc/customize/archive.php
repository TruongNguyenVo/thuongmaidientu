<?php
if (!function_exists('honrix_archive_customizer_register')) {
    function honrix_archive_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');
        get_template_part('/inc/customize/class/Input_Number_Option');

        $wp_customize->add_section(
            'honrix_archive',
            array(
                'title' => __('Blog', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting('honrix_archive_columns', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'honrix_sanitize_select',
            'default' => '3',
        ));

        $wp_customize->add_control('honrix_archive_columns', array(
            'type' => 'select',
            'section' => 'honrix_archive',
            'label' => __('Columns', 'honrix'),
            'description' => __('Choose columns to display.', 'honrix'),
            'settings' => 'honrix_archive_columns',
            'choices' => array(
                '1' => __('One', 'honrix'),
                '2' => __('Two', 'honrix'),
                '3' => __('Three', 'honrix'),
                '4' => __('Four', 'honrix'),
            ),
        ));

        $wp_customize->add_setting(
            'honrix_archive_display_thumbnail',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_archive_display_thumbnail',
            array(
                'label'      => __('Thumbnail', 'honrix'),
                'description' => __('Hide or display posts thumbnail.', 'honrix'),
                'section'    => 'honrix_archive',
                'settings'   => 'honrix_archive_display_thumbnail',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting('honrix_archive_content_length', array(
            'default' => '20',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_archive_content_length', array(
            'type' => 'input',
            'label' => __('Excerpt Length', 'honrix'),
            'section' => 'honrix_archive',
            'settings' => 'honrix_archive_content_length',
            'choices' => array(
                'columns' => '20'
            )
        )));

        $wp_customize->add_setting('honrix_archive_content_read_more_text', array(
            'default' => __('continue reading...', 'honrix'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_archive_content_read_more_text', array(
            'type' => 'text',
            'label' => __('Read More Text', 'honrix'),
            'description' => __('Change the text of the read more button.', 'honrix'),
            'section' => 'honrix_archive',
            'settings' => 'honrix_archive_content_read_more_text'
        )));
    }

    add_action('customize_register', 'honrix_archive_customizer_register');
}

if (!function_exists('honrix_sanitize_select')) {
    function honrix_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
}
