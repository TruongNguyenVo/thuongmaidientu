<?php
if (!function_exists('honrix_sidebar_customizer_register')) {
    function honrix_sidebar_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');
        get_template_part('/inc/customize/class/Input_Number_Option');

        $wp_customize->add_section(
            'honrix_sidebar',
            array(
                'title' => __('Sidebar', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        $wp_customize->add_setting(
            'honrix_sticky_sidebar',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_sticky_sidebar',
            array(
                'label'      => __('Sticky Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_sticky_sidebar',
                'choices'    => array(
                    'yes' => __('Yes', 'honrix'),
                    'no' => __('No', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_right_sidebar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_right_sidebar_display',
            array(
                'label'      => __('Default Right Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_right_sidebar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_left_sidebar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_left_sidebar_display',
            array(
                'label'      => __('Default Left Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_left_sidebar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        /****** post */
        $wp_customize->add_setting(
            'honrix_post_right_sidebar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_post_right_sidebar_display',
            array(
                'label'      => __('Post Right Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_post_right_sidebar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_post_left_sidebar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_post_left_sidebar_display',
            array(
                'label'      => __('Post Left Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_post_left_sidebar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        /****** page */
        $wp_customize->add_setting(
            'honrix_page_right_sidebar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_page_right_sidebar_display',
            array(
                'label'      => __('Page Right Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_page_right_sidebar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_page_left_sidebar_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_page_left_sidebar_display',
            array(
                'label'      => __('Page Left Sidebar', 'honrix'),
                'section'    => 'honrix_sidebar',
                'settings'   => 'honrix_page_left_sidebar_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        if (class_exists('WooCommerce')) {
            /****** Shop */
            $wp_customize->add_setting(
                'honrix_shop_right_sidebar_display',
                array(
                    'default'     => 'yes',
                    'sanitize_callback' => 'esc_attr',
                    'transport' => 'refresh',
                )
            );

            $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
                $wp_customize,
                'honrix_shop_right_sidebar_display',
                array(
                    'label'      => __('Shop Right Sidebar', 'honrix'),
                    'section'    => 'honrix_sidebar',
                    'settings'   => 'honrix_shop_right_sidebar_display',
                    'choices'    => array(
                        'yes' => __('Show', 'honrix'),
                        'no' => __('Hide', 'honrix')
                    ),
                )
            ));

            $wp_customize->add_setting(
                'honrix_shop_left_sidebar_display',
                array(
                    'default'     => 'yes',
                    'sanitize_callback' => 'esc_attr',
                    'transport' => 'refresh',
                )
            );

            $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
                $wp_customize,
                'honrix_shop_left_sidebar_display',
                array(
                    'label'      => __('Shop Left Sidebar', 'honrix'),
                    'section'    => 'honrix_sidebar',
                    'settings'   => 'honrix_shop_left_sidebar_display',
                    'choices'    => array(
                        'yes' => __('Show', 'honrix'),
                        'no' => __('Hide', 'honrix')
                    ),
                )
            ));

            /****** Product */
            $wp_customize->add_setting(
                'honrix_product_right_sidebar_display',
                array(
                    'default'     => 'yes',
                    'sanitize_callback' => 'esc_attr',
                    'transport' => 'refresh',
                )
            );

            $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
                $wp_customize,
                'honrix_product_right_sidebar_display',
                array(
                    'label'      => __('Product Right Sidebar', 'honrix'),
                    'section'    => 'honrix_sidebar',
                    'settings'   => 'honrix_product_right_sidebar_display',
                    'choices'    => array(
                        'yes' => __('Show', 'honrix'),
                        'no' => __('Hide', 'honrix')
                    ),
                )
            ));

            $wp_customize->add_setting(
                'honrix_product_left_sidebar_display',
                array(
                    'default'     => 'yes',
                    'sanitize_callback' => 'esc_attr',
                    'transport' => 'refresh',
                )
            );

            $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
                $wp_customize,
                'honrix_product_left_sidebar_display',
                array(
                    'label'      => __('Product Left Sidebar', 'honrix'),
                    'section'    => 'honrix_sidebar',
                    'settings'   => 'honrix_product_left_sidebar_display',
                    'choices'    => array(
                        'yes' => __('Show', 'honrix'),
                        'no' => __('Hide', 'honrix')
                    ),
                )
            ));
        }
    }

    add_action('customize_register', 'honrix_sidebar_customizer_register');
}

if (!function_exists('honrix_sidebar_customizer_css')) {
    function honrix_sidebar_customizer_css()
    {
?>
        <style type="text/css">
            <?php if (esc_attr(get_theme_mod('honrix_sticky_sidebar', 'yes') == 'yes')) : ?>@media (min-width: 768px) {
                .honrix-content .sidebar {
                    --offset: 2rem;
                    flex-grow: 1;
                    flex-basis: 300px;
                    align-self: start;
                    position: sticky;
                    top: var(--offset);
                }
            }

            <?php endif; ?>
        </style>
<?php
    }

    add_action('wp_head', 'honrix_sidebar_customizer_css');
}
