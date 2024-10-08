<?php
if (!function_exists('honrix_general_customizer_register')) {
    function honrix_general_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Input_Number_Option');
        get_template_part('/inc/customize/class/Text_Radio_Button');

        $wp_customize->add_section(
            'honrix_layout',
            array(
                'title' => __('Layout', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting(
            'honrix_boxed',
            array(
                'default'     => 'boxed',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_boxed',
            array(
                'label'      => __('Layout Mode', 'honrix'),
                'description'      => __('This is an option you can choose to display your website content in full width mode or boxed mode.', 'honrix'),
                'section'    => 'honrix_layout',
                'settings'   => 'honrix_boxed',
                'choices'    => array(
                    'boxed' => __('Boxed', 'honrix'),
                    'wide' => __('Wide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_to_top',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_to_top',
            array(
                'label'      => __('Display Back To Top Button', 'honrix'),
                'description'      => __('Back to top button is a little button in bottom of the website page. If client clicks it, he will go to top of the page smoothly. Choose to display or hide the button in here.', 'honrix'),
                'section'    => 'honrix_layout',
                'settings'   => 'honrix_to_top',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_loading_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_loading_display',
            array(
                'label'      => __('Loading Page', 'honrix'),
                'description'      => __('If page is loading, the client will see the Loading Page with a little spinner. Hide or display the page with this option.', 'honrix'),
                'section'    => 'honrix_layout',
                'settings'   => 'honrix_loading_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_theme_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_theme_color', array(
            'label' => __('Theme Color', 'honrix'),
            'description'    => __('Change Theme color to customize your website as you wanted.', 'honrix'),
            'section' => 'colors',
            'settings' => 'honrix_theme_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_color',
            array('default' => '#333333', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_color', array(
            'label' => __('h1 - h6 Color', 'honrix'),
            'description'    => __('Change heading (h1-h6) color', 'honrix'),
            'section' => 'colors',
            'settings' => 'honrix_header_color',
        )));

        $wp_customize->add_setting(
            'honrix_text_color',
            array('default' => '#666666', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_text_color', array(
            'label' => __('Text Color', 'honrix'),
            'description'    => __('Change text (posts and pages content) color', 'honrix'),
            'section' => 'colors',
            'settings' => 'honrix_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_accent_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_accent_color', array(
            'label' => __('Accent Color', 'honrix'),
            'description'    => __('This color will be used in some borders and lines between the items like comment message txtarea border.', 'honrix'),
            'section' => 'colors',
            'settings' => 'honrix_accent_color',
        )));

        $wp_customize->add_setting(
            'honrix_secondary_color',
            array('default' => '#A56A5F', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_secondary_color', array(
            'label' => __('Secondary Color', 'honrix'),
            'section' => 'colors',
            'settings' => 'honrix_secondary_color',
        )));
    }

    add_action('customize_register', 'honrix_general_customizer_register');
}

if (!function_exists('honrix_customizer_css')) {
    function honrix_customizer_css()
    {
?>
        <style type="text/css">
            :root{
                --honrix-theme-color: <?php echo esc_attr(get_theme_mod('honrix_theme_color', '#031424')); ?>;
                --honrix-header-color: <?php echo esc_attr(get_theme_mod('honrix_header_color', '#333333')); ?>;
                --honrix-text-color: <?php echo esc_attr(get_theme_mod('honrix_text_color', '#666666')); ?>;
                --honrix-background-color: #<?php echo esc_attr(get_background_color()); ?>;
                --honrix-accent-color: <?php echo esc_attr(get_theme_mod('honrix_accent_color', '#ffbd28')); ?>;
                --honrix-secondary-color: <?php echo esc_attr(get_theme_mod('honrix_secondary_color', '#A56A5F')); ?>;
            }
        </style>
<?php
    }

    add_action('wp_head', 'honrix_customizer_css');
}

if (!function_exists('ic_sanitize_image')) {
    function ic_sanitize_image($file, $setting)
    {
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
        $file_ext = wp_check_filetype($file, $mimes);
        return ($file_ext['ext'] ? $file : $setting->default);
    }
}
