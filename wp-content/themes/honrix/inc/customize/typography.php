<?php
if (!function_exists('honrix_typography_customizer_register')) {
    function honrix_typography_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Input_Number_Option');

        $wp_customize->add_section(
            'honrix_typography',
            array(
                'title' => __('Typography', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting('honrix_google_font_url', array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_google_font_url', array(
            'type' => 'text',
            'label' => __('Google Font URL', 'honrix'),
            'description' => sprintf(
                '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s The url will be like "https://fonts.googleapis.com/css2?family=Roboto&display=swap". Copy url from google and past it in here.',
                __('Insert', 'honrix'),
                esc_url('https://www.google.com/fonts'),
                __('Google Font URL', 'honrix'),
                __('for embed fonts.', 'honrix')
            ),
            'section' => 'honrix_typography',
            'settings' => 'honrix_google_font_url'
        )));

        $wp_customize->add_setting('honrix_google_font_family', array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_google_font_family', array(
            'type' => 'text',
            'label' => __('Font Family', 'honrix'),
            'description' => __('Insert Google font family. The font family should be like <strong>Lato, sans-serif</strong> without \' or ".', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_google_font_family'
        )));

        $wp_customize->add_setting('honrix_google_font_size', array(
            'default' => '14',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_google_font_size', array(
            'type' => 'input',
            'label' => __('Font Size', 'honrix'),
            'description' => __('Change font size of the content text to increase better user experience.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_google_font_size',
            'choices' => array(
                'columns' => '14'
            )
        )));

        $wp_customize->add_setting('honrix_google_font_header_url', array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_google_font_header_url', array(
            'type' => 'text',
            'label' => __('Google Font Header URL', 'honrix'),
            'description' => sprintf(
                '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s The url will be like "https://fonts.googleapis.com/css2?family=Roboto&display=swap". Copy url from google and past it in here.',
                __('Insert', 'honrix'),
                esc_url('https://www.google.com/fonts'),
                __('Google Font URL', 'honrix'),
                __('for header (content titles) fonts.', 'honrix')
            ),
            'section' => 'honrix_typography',
            'settings' => 'honrix_google_font_header_url'
        )));

        $wp_customize->add_setting('honrix_google_font_header_family', array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'honrix_google_font_header_family', array(
            'type' => 'text',
            'label' => __('Font Family', 'honrix'),
            'description' => __('Insert Google font family for headers. The font family should be like <strong>Courgette, cursive</strong> without \' or ".', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_google_font_header_family'
        )));

        $wp_customize->add_setting('honrix_h1_font_size', array(
            'default' => '36',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_h1_font_size', array(
            'type' => 'input',
            'label' => __('H1 Font Size (px)', 'honrix'),
            'description' => __('Change H1 font size of the content.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_h1_font_size',
            'choices' => array(
                'columns' => '36'
            )
        )));

        $wp_customize->add_setting('honrix_h2_font_size', array(
            'default' => '32',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_h2_font_size', array(
            'type' => 'input',
            'label' => __('H2 Font Size (px)', 'honrix'),
            'description' => __('Change H2 font size of the content.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_h2_font_size',
            'choices' => array(
                'columns' => '32'
            )
        )));

        $wp_customize->add_setting('honrix_h3_font_size', array(
            'default' => '28',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_h3_font_size', array(
            'type' => 'input',
            'label' => __('H3 Font Size (px)', 'honrix'),
            'description' => __('Change H3 font size of the content.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_h3_font_size',
            'choices' => array(
                'columns' => '28'
            )
        )));

        $wp_customize->add_setting('honrix_h4_font_size', array(
            'default' => '25',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_h4_font_size', array(
            'type' => 'input',
            'label' => __('H4 Font Size (px)', 'honrix'),
            'description' => __('Change H4 font size of the content.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_h4_font_size',
            'choices' => array(
                'columns' => '25'
            )
        )));

        $wp_customize->add_setting('honrix_h5_font_size', array(
            'default' => '21',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_h5_font_size', array(
            'type' => 'input',
            'label' => __('H5 Font Size (px)', 'honrix'),
            'description' => __('Change H5 font size of the content.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_h5_font_size',
            'choices' => array(
                'columns' => '21'
            )
        )));

        $wp_customize->add_setting('honrix_h6_font_size', array(
            'default' => '17',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control(new honrix_Input_Number_Option($wp_customize, 'honrix_h6_font_size', array(
            'type' => 'input',
            'label' => __('H6 Font Size (px)', 'honrix'),
            'description' => __('Change H6 font size of the content.', 'honrix'),
            'section' => 'honrix_typography',
            'settings' => 'honrix_h6_font_size',
            'choices' => array(
                'columns' => '17'
            )
        )));
    }

    add_action('customize_register', 'honrix_typography_customizer_register');
}

if (!function_exists('honrix_typography_customizer_css')) {
    function honrix_typography_customizer_css()
    {
        $text_font_family = get_theme_mod('honrix_google_font_family', 'Roboto, sans-serif');
        if (empty($text_font_family)) {
            $text_font_family = 'Roboto, sans-serif';
        }
        $header_font_family = get_theme_mod('honrix_google_font_header_family', 'Roboto, sans-serif');
        if (empty($header_font_family)) {
            $header_font_family = 'Roboto, cursive';
        }
?>
        <style type="text/css">
            :root{
                --honrix-text-font-family: <?php echo esc_attr($text_font_family); ?>;
                --honrix-header-font-family: <?php echo esc_attr($header_font_family); ?>;
                --honrix-h1-font-size: <?php echo esc_attr(get_theme_mod('honrix_h1_font_size', '36')); ?>px;
                --honrix-h2-font-size: <?php echo esc_attr(get_theme_mod('honrix_h2_font_size', '32')); ?>px;
                --honrix-h3-font-size: <?php echo esc_attr(get_theme_mod('honrix_h3_font_size', '28')); ?>px;
                --honrix-h4-font-size: <?php echo esc_attr(get_theme_mod('honrix_h4_font_size', '25')); ?>px;
                --honrix-h5-font-size: <?php echo esc_attr(get_theme_mod('honrix_h5_font_size', '21')); ?>px;
                --honrix-h6-font-size: <?php echo esc_attr(get_theme_mod('honrix_h6_font_size', '17')); ?>px;
            }
        </style>
<?php
    }

    add_action('wp_head', 'honrix_typography_customizer_css');
}
