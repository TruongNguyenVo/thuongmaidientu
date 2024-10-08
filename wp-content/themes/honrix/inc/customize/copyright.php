<?php
if (!function_exists('honrix_copy_right_customizer_register')) {
    function honrix_copy_right_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');
        get_template_part('/inc/customize/class/Input_Number_Option');

        $wp_customize->add_section(
            'honrix_copy_right',
            array(
                'title' => __('Copy Right', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting(
            'honrix_copy_right_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_copy_right_display',
            array(
                'label'      => __('Copy Right', 'honrix'),
                'description' => __('Hide or display website copy right section.', 'honrix'),
                'section'    => 'honrix_copy_right',
                'settings'   => 'honrix_copy_right_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_copy_right_bg_color',
            array('default' => '#eeeeee', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_copy_right_bg_color', array(
            'label' => __('Background Color', 'honrix'),
            'section' => 'honrix_copy_right',
            'settings' => 'honrix_copy_right_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_copy_right_text_color',
            array('default' => '#666666', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_copy_right_text_color', array(
            'label' => __('Text Color', 'honrix'),
            'description' => __('Change copy right section text color.', 'honrix'),
            'section' => 'honrix_copy_right',
            'settings' => 'honrix_copy_right_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_copy_right_link_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_copy_right_link_color', array(
            'label' => __('Link Color', 'honrix'),
            'description' => __('Change copy right section links color.', 'honrix'),
            'section' => 'honrix_copy_right',
            'settings' => 'honrix_copy_right_link_color',
        )));

        $wp_customize->add_setting(
            'honrix_copy_right_link_hover_color',
            array('default' => '#666666', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_copy_right_link_hover_color', array(
            'label' => __('Hover Link Color', 'honrix'),
            'description' => __('Change copy right section links color in mouse hover.', 'honrix'),
            'section' => 'honrix_copy_right',
            'settings' => 'honrix_copy_right_link_hover_color',
        )));

        $wp_customize->add_setting(
            'honrix_copyright_text',
            array(
                'transport' => 'refresh',
                'default' => '© {year} {site_name}',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'honrix_sanitize_textarea_html'
            )
        );

        $wp_customize->add_control(
            'honrix_copyright_text',
            array(
                'type' => 'textarea',
                'label' => __('CopyRight Text', 'honrix'),
                'description' => __( 'Add text and HTML code to display in Copyright section. Add "{site_name}" to display website name, "{description}" to display website description or "{year}" to display current year.', 'honrix' ),
                'section' => 'honrix_copy_right',
                'settings' => 'honrix_copyright_text'
            )
        );
    }

    add_action('customize_register', 'honrix_copy_right_customizer_register');
}

if (!function_exists('honrix_copy_right_customizer_css')) {
    function honrix_copy_right_customizer_css()
    {
?>
        <style type="text/css">
            .site-copyright {
                background: <?php echo esc_attr(get_theme_mod('honrix_copy_right_bg_color', '#eeeeee')); ?> !important;
                color:<?php echo esc_attr(get_theme_mod('honrix_copy_right_text_color', '#666666')); ?> !important;
            }

            .site-copyright a{
                color:<?php echo esc_attr(get_theme_mod('honrix_copy_right_link_color', '#031424')); ?> !important;
            }

            .site-copyright a:hover{
                color:<?php echo esc_attr(get_theme_mod('honrix_copy_right_link_hover_color', '#666666')); ?> !important;
            }
        </style>
<?php
    }

    add_action('wp_head', 'honrix_copy_right_customizer_css');
}

if (!function_exists('honrix_sanitize_textarea_html')) {
    function honrix_sanitize_textarea_html($input)
    {
        return wp_kses_post($input);
    }
}
