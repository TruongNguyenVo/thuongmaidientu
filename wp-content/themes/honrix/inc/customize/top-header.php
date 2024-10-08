<?php
if (!function_exists('honrix_top_header_customizer_register')) {
    function honrix_top_header_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');

        $wp_customize->add_section(
            'honrix_top_header',
            array(
                'title' => __('Top Header', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting(
            'honrix_top_bar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_top_bar_display',
            array(
                'label'      => __('Top Header', 'honrix'),
                'section'    => 'honrix_top_header',
                'settings'   => 'honrix_top_bar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_top_bg_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_top_bg_color', array(
            'label' => __('Background Color', 'honrix'),
            'section' => 'honrix_top_header',
            'settings' => 'honrix_top_bg_color',
        )));      
        
        $wp_customize->add_setting(
            'honrix_top_text_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_top_text_color', array(
            'label' => __('Text Color', 'honrix'),
            'section' => 'honrix_top_header',
            'settings' => 'honrix_top_text_color',
        ))); 

        $wp_customize->add_setting(
            'honrix_top_link_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_top_link_color', array(
            'label' => __('Link Color', 'honrix'),
            'section' => 'honrix_top_header',
            'settings' => 'honrix_top_link_color',
        )));

        $wp_customize->add_setting(
            'honrix_top_link_hover_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_top_link_hover_color', array(
            'label' => __('Link Hover Color', 'honrix'),
            'section' => 'honrix_top_header',
            'settings' => 'honrix_top_link_hover_color',
        )));
    }
    add_action('customize_register', 'honrix_top_header_customizer_register');
}

if (!function_exists('honrix_top_customizer_css')) {
    function honrix_top_customizer_css()
    {
?>
        <style type="text/css">
            .hrix-top-bar {
                background: <?php echo esc_attr(get_theme_mod('honrix_top_bg_color', '#031424')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_top_text_color', '#ffffff')); ?> !important;
            }
            .hrix-top-bar a {
                color: <?php echo esc_attr(get_theme_mod('honrix_top_link_color', '#ffffff')); ?> !important;
            }

            .hrix-top-bar a:hover {
                color: <?php echo esc_attr(get_theme_mod('honrix_top_link_hover_color', '#ffbd28')); ?> !important;
            }

            .hrix-top-bar select{
                border: none;
                background: <?php echo esc_attr(get_theme_mod('honrix_top_bg_color', '#031424')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_top_link_color', '#ffffff')); ?> !important;
            }

            .hrix-top-bar select:hover{
                color: <?php echo esc_attr(get_theme_mod('honrix_top_link_hover_color', '#ffbd28')); ?> !important;
            }
        </style>
<?php
    }

    add_action('wp_head', 'honrix_top_customizer_css');
}
