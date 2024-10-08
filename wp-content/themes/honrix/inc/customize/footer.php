<?php
if (!function_exists('honrix_footer_customizer_register')) {
    function honrix_footer_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');
        get_template_part('/inc/customize/class/Input_Number_Option');

        $wp_customize->add_section(
            'honrix_footer',
            array(
                'title' => __('Footer', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting(
            'honrix_footer_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_footer_display',
            array(
                'label'      => __('Footer', 'honrix'),
                'description' => __('Hide or display website footer.', 'honrix'),
                'section'    => 'honrix_footer',
                'settings'   => 'honrix_footer_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_footer_columns',
            array(
                'default'     => '3',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_footer_columns',
            array(
                'label'      => __('Columns Count', 'honrix'),
                'description' => __('Choose your website column count. All columns will have the same width.', 'honrix'),
                'section'    => 'honrix_footer',
                'settings'   => 'honrix_footer_columns',
                'choices'    => array(
                    '1' => __('1', 'honrix'),
                    '2' => __('2', 'honrix'),
                    '3' => __('3', 'honrix'),
                    '4' => __('4', 'honrix'),
                    '5' => __('5', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_footer_bg_color',
            array('default' => '#eeeeee', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_footer_bg_color', array(
            'label' => __('Background Color', 'honrix'),
            'description' => __('Change footer background color.', 'honrix'),
            'section' => 'honrix_footer',
            'settings' => 'honrix_footer_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_footer_title_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_footer_title_color', array(
            'label' => __('Widget Title Color', 'honrix'),
            'section' => 'honrix_footer',
            'settings' => 'honrix_footer_title_color',
        )));

        $wp_customize->add_setting(
            'honrix_footer_text_color',
            array('default' => '#666666', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_footer_text_color', array(
            'label' => __('Text Color', 'honrix'),
            'section' => 'honrix_footer',
            'settings' => 'honrix_footer_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_footer_link_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_footer_link_color', array(
            'label' => __('Link Color', 'honrix'),
            'section' => 'honrix_footer',
            'settings' => 'honrix_footer_link_color',
        )));

        $wp_customize->add_setting(
            'honrix_footer_link_hover_color',
            array('default' => '#666666', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_footer_link_hover_color', array(
            'label' => __('Link Hover Color', 'honrix'),
            'section' => 'honrix_footer',
            'settings' => 'honrix_footer_link_hover_color',
        )));
    }

    add_action('customize_register', 'honrix_footer_customizer_register');
}

if (!function_exists('honrix_footer_customizer_css')) {
    function honrix_footer_customizer_css()
    {
?>
        <style type="text/css">
            .site-footer {
                background: <?php echo esc_attr(get_theme_mod('honrix_footer_bg_color', '#eeeeee')); ?> !important;
                color:<?php echo esc_attr(get_theme_mod('honrix_footer_text_color', '#666666')); ?> !important;
            }

            .site-footer .widget-title,
            .site-footer .widget h1,
            .site-footer .widget h2,
            .site-footer .widget h3,
            .site-footer .widget h4,
            .site-footer .widget h5,
            .site-footer .widget h6{
                color:<?php echo esc_attr(get_theme_mod('honrix_footer_title_color', '#031424')); ?> !important;
            }

            .site-footer a{
                color:<?php echo esc_attr(get_theme_mod('honrix_footer_link_color', '#031424')); ?> !important;
            }

            .site-footer a:hover{
                color:<?php echo esc_attr(get_theme_mod('honrix_footer_link_hover_color', '#666666')); ?> !important;
            }
        </style>
<?php
    }

    add_action('wp_head', 'honrix_footer_customizer_css');
}