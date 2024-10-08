<?php

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('honrix_enqueue_scripts')) {
    function honrix_enqueue_scripts()
    {
        // Theme stylesheet.
        global $wp_scripts;

        wp_enqueue_style('font-awesome', HONRIX_TEMPLATE_URI . '/framework/font-awesome/css/all.min.css', array(), '1');

        /* Libraries Stylesheet */
        wp_enqueue_style(
            'animate',
            esc_url(
                HONRIX_TEMPLATE_URI . '/lib/animate/animate.min.css'
            ),
            ['font-awesome'],
            null
        );

        /* Bootstrap */
        wp_enqueue_style(
            'bootstrap-css',
            esc_url(
                HONRIX_TEMPLATE_URI . '/assets/css/bootstrap.min.css'
            ),
            ['animate'],
            null
        );

        /* css styles */
        wp_enqueue_style(
            'honrix-style',
            get_stylesheet_uri(),
            ['bootstrap-css'],
            null
        );

        wp_enqueue_style(
            'honrix-header-style',
            esc_url(
                HONRIX_TEMPLATE_URI . '/assets/css/header.css'
            ),
            ['honrix-style'],
            null
        );

        wp_enqueue_style(
            'honrix-footer-style',
            esc_url(
                HONRIX_TEMPLATE_URI . '/assets/css/footer.css'
            ),
            ['honrix-style'],
            null
        );

        /* woocommerce style */
        if (class_exists('WooCommerce')) {
            wp_enqueue_style(
                'honrix-woocommerce-style',
                esc_url(
                    HONRIX_TEMPLATE_URI . '/assets/css/woocommerce.css'
                ),
                ['honrix-style'],
                null
            );
        }

        wp_enqueue_style(
            'honrix-google-font',
            esc_url(
                get_theme_mod('honrix_google_font_url', 'https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&display=swap&ver=6.5.3')
            ),
            false
        );

        wp_enqueue_script(
            'bootstrap-js',
            esc_url(HONRIX_TEMPLATE_URI . '/framework/bootstrap/bootstrap.bundle.min.js'),
            ['jquery'],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'font-awesome-js',
            esc_url(HONRIX_TEMPLATE_URI . '/assets/js/fontawesome.min.all.js'),
            [],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'wow-js',
            esc_url(HONRIX_TEMPLATE_URI . '/lib/wow/wow.min.js'),
            ['bootstrap-js'],
            '1.0.0',
            true
        );
        wp_enqueue_script(
            'easing-js',
            esc_url(HONRIX_TEMPLATE_URI . '/lib/easing/easing.min.js'),
            ['wow-js'],
            '1.0.0',
            true
        );
        wp_enqueue_script(
            'waypoints-js',
            esc_url(
                HONRIX_TEMPLATE_URI . '/lib/waypoints/waypoints.min.js'
            ),
            ['easing-js'],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'honrix-script',
            esc_url(HONRIX_TEMPLATE_URI . '/assets/js/custom.js'),
            ['waypoints-js'],
            '1.0.0',
            true
        );

        $theme = 'theme-' . get_theme_mod('honrix_archive_theme', '1');

        wp_enqueue_style('honrix-content-theme', esc_url(HONRIX_TEMPLATE_URI . '/assets/css/content/' . $theme . '.css'), array('honrix-style'), null);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        // Register the IE11 polyfill file.
        wp_register_script(
            'honrix-ie11-polyfills-asset',
            HONRIX_TEMPLATE_URI . '/assets/js/polyfills.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );

        // Register the IE11 polyfill loader.
        wp_register_script(
            'honrix-ie11-polyfills',
            null,
            array(),
            wp_get_theme()->get('Version'),
            true
        );

        wp_add_inline_script(
            'honrix-ie11-polyfills',
            wp_get_script_polyfill(
                $wp_scripts,
                array(
                    'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'hs-honrix-ie11-polyfills-asset',
                )
            )
        );

        // Responsive embeds script.
        wp_enqueue_script(
            'honrix-responsive-embeds-script',
            HONRIX_TEMPLATE_URI . '/assets/js/responsive-embeds.js',
            array('honrix-ie11-polyfills'),
            wp_get_theme()->get('Version'),
            true
        );
    }

    add_action('wp_enqueue_scripts', 'honrix_enqueue_scripts');
}

if (!function_exists('honrix_admin_style')) {
    function honrix_admin_style()
    {
        wp_enqueue_style('honrix-admin-css', HONRIX_TEMPLATE_URI . '/assets/css/admin.css', array(), '1');
    }
    add_action('admin_enqueue_scripts', 'honrix_admin_style');
}

if (!function_exists('honrix_customizer_control_toggle')) {
    function honrix_customizer_control_toggle()
    {
        wp_enqueue_script('honrix-customize-controls-toggle', HONRIX_TEMPLATE_URI . '/inc/customize/assets/customize-controls-toggle.js', array('jquery', 'customize-preview'), '1.30', true);
    }
    add_action('customize_controls_enqueue_scripts', 'honrix_customizer_control_toggle');
}
