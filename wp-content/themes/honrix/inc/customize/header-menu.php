<?php
if (!function_exists('honrix_header_customizer_register')) {
    function honrix_header_customizer_register($wp_customize)
    {
        get_template_part('/inc/customize/class/Text_Radio_Button');

        $wp_customize->add_section(
            'honrix_header',
            array(
                'title' => __('Header', 'honrix'),
                'capability' => 'edit_theme_options',
                'panel' => 'honrix_settings_pannel'
            )
        );

        /*** Header ***/
        $wp_customize->add_setting(
            'honrix_header_bg_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_bg_color', array(
            'label' => __('Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_text_color',
            array('default' => '#cccccc', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_text_color', array(
            'label' => __('Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_link_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_link_color', array(
            'label' => __('Link Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_link_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_link_hover_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_link_hover_color', array(
            'label' => __('Link Hover Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_link_hover_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_badge_bg_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_badge_bg_color', array(
            'label' => __('Badge Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_badge_bg_color',
        )));
        $wp_customize->add_setting(
            'honrix_header_badge_text_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_badge_text_color', array(
            'label' => __('Badge Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_badge_text_color',
        )));

        /*** Site Name ***/
        $wp_customize->add_setting(
            'honrix_header_site_name_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_site_name_color', array(
            'label' => __('Website Name Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_site_name_color',
        )));

        /*** Product Search ***/
        $wp_customize->add_setting(
            'honrix_header_product_search_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_header_product_search_display',
            array(
                'label'      => __('Display Product Search', 'honrix'),
                'section'    => 'honrix_header',
                'settings'   => 'honrix_header_product_search_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));

        $wp_customize->add_setting(
            'honrix_header_product_search_bg_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_product_search_bg_color', array(
            'label' => __('Product Search Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_product_search_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_product_search_text_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_product_search_text_color', array(
            'label' => __('Product Search Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_product_search_text_color',
        )));
        $wp_customize->add_setting(
            'honrix_header_product_search_button_bg_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_product_search_button_bg_color', array(
            'label' => __('Product Search Button Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_product_search_button_bg_color',
        )));
        $wp_customize->add_setting(
            'honrix_header_product_search_button_text_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_product_search_button_text_color', array(
            'label' => __('Product Search Button Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_product_search_button_text_color',
        )));

        /*** Browse Categories ***/
        $wp_customize->add_setting(
            'honrix_header_categories_display',
            array(
                'default'     => 'yes',
                'sanitize_callback' => 'esc_attr',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new honrix_Text_Radio_Button_Custom_Control(
            $wp_customize,
            'honrix_header_categories_display',
            array(
                'label'      => __('Browse Categories Display', 'honrix'),
                'section'    => 'honrix_header',
                'settings'   => 'honrix_header_categories_display',
                'choices'    => array(
                    'yes' => __('Show', 'honrix'),
                    'no' => __('Hide', 'honrix')
                ),
            )
        ));
        $wp_customize->add_setting(
            'honrix_header_categories_bg_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_categories_bg_color', array(
            'label' => __('Browse Categories Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_categories_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_categories_text_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_categories_text_color', array(
            'label' => __('Browse Categories Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_categories_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_categories_submenu_bg_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_categories_submenu_bg_color', array(
            'label' => __('Browse Categories Submenu Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_categories_submenu_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_categories_submenu_link_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_categories_submenu_link_color', array(
            'label' => __('Browse Categories Submenu Link Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_categories_submenu_link_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_categories_submenu_link_hover_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_categories_submenu_link_hover_color', array(
            'label' => __('Browse Categories Submenu Link Hover Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_categories_submenu_link_hover_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_categories_submenu_link_hover_bg_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_categories_submenu_link_hover_bg_color', array(
            'label' => __('Browse Categories Submenu Link Hover Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_categories_submenu_link_hover_bg_color',
        )));

        /*** Menu ***/
        $wp_customize->add_setting(
            'honrix_header_menu_item_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_menu_item_color', array(
            'label' => __('Menu Item Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_menu_item_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_menu_item_hover_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_menu_item_hover_color', array(
            'label' => __('Menu Item Hover Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_menu_item_hover_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_submenu_bg_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_submenu_bg_color', array(
            'label' => __('Sub Menu Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_submenu_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_submenu_item_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_submenu_item_color', array(
            'label' => __('Sub Menu Item Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_submenu_item_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_submenu_item_hover_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_submenu_item_hover_color', array(
            'label' => __('Sub Menu Item Hover Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_submenu_item_hover_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_submenu_item_bg_hover_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_submenu_item_bg_hover_color', array(
            'label' => __('Sub Menu Item Hover Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_submenu_item_bg_hover_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_mobile_toggle_bg_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_mobile_toggle_bg_color', array(
            'label' => __('Mobile Toggle Menu Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_mobile_toggle_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_mobile_toggle_menu_cat_bg_color',
            array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_mobile_toggle_menu_cat_bg_color', array(
            'label' => __('Mobile Toggle Menu & Category Button Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_mobile_toggle_menu_cat_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_mobile_toggle_menu_cat_text_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_mobile_toggle_menu_cat_text_color', array(
            'label' => __('Mobile Toggle Menu & Category Button Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_mobile_toggle_menu_cat_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_mobile_toggle_menu_cat_active_bg_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_mobile_toggle_menu_cat_active_bg_color', array(
            'label' => __('Mobile Toggle Menu & Category Button Active Background Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_mobile_toggle_menu_cat_active_bg_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_mobile_toggle_menu_cat_active_text_color',
            array('default' => '#ffbd28', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_mobile_toggle_menu_cat_active_text_color', array(
            'label' => __('Mobile Toggle Menu & Category Button Active Text Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_mobile_toggle_menu_cat_active_text_color',
        )));

        $wp_customize->add_setting(
            'honrix_header_mobile_toggle_menu_link_color',
            array('default' => '#031424', 'sanitize_callback' => 'sanitize_hex_color')
        );

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'honrix_header_mobile_toggle_menu_link_color', array(
            'label' => __('Mobile Toggle Menu & Category Link Color', 'honrix'),
            'section' => 'honrix_header',
            'settings' => 'honrix_header_mobile_toggle_menu_link_color',
        )));
    }
    add_action('customize_register', 'honrix_header_customizer_register');
}

if (!function_exists('honrix_header_customizer_css')) {
    function honrix_header_customizer_css()
    {
?>
        <style type="text/css">
            .hrix-site-header {
                <?php if(empty(header_image())): ?>
                    background: <?php echo esc_attr(get_theme_mod('honrix_header_bg_color', '#031424')); ?> !important;
                <?php endif; ?>
                color: <?php echo esc_attr(get_theme_mod('honrix_header_text_color', '#cccccc')); ?> !important;
            }

            .hrix-mobile-bottom-menu{
                background: <?php echo esc_attr(get_theme_mod('honrix_header_bg_color', '#031424')); ?> !important;
            }

            .hrix-site-header .widget a,
            .hrix-site-header .hrix-header-account a,
            .hrix-site-header .hrix-header-wishlist a,
            .hrix-site-header .hrix-header-mini-cart a,
            .hrix-mobile-bottom-menu a,
            .hrix-navbar-toggler {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_link_color', '#ffffff')); ?> !important;
            }

            .hrix-site-header .widget a:hover,
            .hrix-site-header .hrix-header-account a:hover,
            .hrix-site-header .hrix-header-wishlist a:hover,
            .hrix-site-header .hrix-header-mini-cart a:hover {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_link_hover_color', '#ffbd28')); ?> !important;
            }

            .hrix-site-header .site-title,
            .hrix-site-header .site-title a {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_site_name_color', '#ffbd28')); ?> !important;
            }

            .hrix-site-header .site-description {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_text_color', '#cccccc')); ?> !important;
            }

            .hrix-site-header .badge {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_badge_bg_color', '#ffbd28')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_badge_text_color', '#ffffff')); ?> !important;
            }

            .hrix-header-search-form form,
            .hrix-header-search-form form .hrix-header-search-select,
            .hrix-header-search-form form .hrix-header-search-input {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_product_search_bg_color', '#ffffff')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_product_search_text_color', '#031424')); ?> !important;
            }

            .hrix-header-search-form .hrix-header-search-button {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_product_search_button_bg_color', '#ffbd28')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_product_search_button_text_color', '#031424')); ?> !important;
            }

            .hrix-site-header .product-category-btn {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_categories_bg_color', '#ffbd28')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_categories_text_color', '#031424')); ?> !important;
            }

            .hrix-site-header .product-category-menus {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_categories_submenu_bg_color', '#ffffff')); ?> !important;
            }

            .hrix-site-header .product-category-menus a {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_categories_submenu_link_color', '#031424')); ?> !important;
            }

            .hrix-site-header .product-category-menus a:hover {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_categories_submenu_link_hover_color', '#ffffff')); ?> !important;
                background: <?php echo esc_attr(get_theme_mod('honrix_header_categories_submenu_link_hover_bg_color', '#031424')); ?> !important;
            }

            .hrix-site-header .navbar-dark .navbar-nav .nav-link {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_menu_item_color', '#ffffff')); ?> !important;
            }

            .hrix-site-header .navbar-dark .navbar-nav .nav-link:hover {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_menu_item_hover_color', '#ffbd28')); ?> !important;
            }

            .hrix-site-header .hrix-header-menu .sub-menu {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_submenu_bg_color', '#ffffff')); ?> !important;
            }

            .hrix-site-header .hrix-header-menu .sub-menu a {
                color: <?php echo esc_attr(get_theme_mod('honrix_header_submenu_item_color', '#031424')); ?> !important;
            }

            .hrix-site-header .hrix-header-menu .sub-menu a:hover {
                background: <?php echo esc_attr(get_theme_mod('honrix_header_submenu_item_bg_hover_color', '#031424')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_submenu_item_hover_color', '#ffffff')); ?> !important;
            }

            .hrix-mobile-navigation-menu > div{
                background: <?php echo esc_attr(get_theme_mod('honrix_header_mobile_toggle_bg_color', '#ffffff')); ?> !important;
            }

            .hrix-mobile-menu-selector, 
            .hrix-mobile-category-selector{
                background: <?php echo esc_attr(get_theme_mod('honrix_header_mobile_toggle_menu_cat_bg_color', '#ffffff')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_mobile_toggle_menu_cat_text_color', '#031424')); ?> !important;
            }

            .hrix-mobile-menu-selector.active, 
            .hrix-mobile-category-selector.active{
                background: <?php echo esc_attr(get_theme_mod('honrix_header_mobile_toggle_menu_cat_active_bg_color', '#031424')); ?> !important;
                color: <?php echo esc_attr(get_theme_mod('honrix_header_mobile_toggle_menu_cat_active_text_color', '#ffbd28')); ?> !important;
            }

            @media (max-width:991px) {
                .hrix-site-header .hrix-mobile-navigation-menu a,
                .hrix-mobile-navigation-menu span.close {
                    color: <?php echo esc_attr(get_theme_mod('honrix_header_mobile_toggle_menu_link_color', '#031424'));?> !important;
                }

                .hrix-header-search-form .hrix-header-search-button {
                    border: 1px solid <?php echo esc_attr(get_theme_mod('honrix_header_product_search_button_bg_color', '#ffbd28')); ?> !important;
                }
            }
        </style>
<?php
    }

    add_action('wp_head', 'honrix_header_customizer_css');
}

if (!function_exists('honrix_sanitize_select')) {
    function honrix_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
}
