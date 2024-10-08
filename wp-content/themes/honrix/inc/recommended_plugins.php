<?php
/******** TGMP */
if (!function_exists('honrix_register_required_plugins')) {
    add_action('tgmpa_register', 'honrix_register_required_plugins');

    function honrix_register_required_plugins()
    {
        $plugins = array(
            array(
                'name'        => __('One Click Demo Import', 'honrix'),
                'slug'        => 'one-click-demo-import',
                'required'  => false,
            ),
            array(
                'name'        => __('Contact Form 7', 'honrix'),
                'slug'        => 'contact-form-7',
                'required'  => false,
            ),
            array(
                'name'        => __('Elementor', 'honrix'),
                'slug'        => 'elementor',
                'required'  => false,
            ),
            array(
                'name'        => __('Simple Local Avatars', 'honrix'),
                'slug'        => 'simple-local-avatars',
                'required'  => false,
            ),
            array(
                'name'        => __('Newsletter', 'honrix'),
                'slug'        => 'newsletter',
                'required'  => false,
            ),
            array(
                'name'        => __('WooCommerce', 'honrix'),
                'slug'        => 'woocommerce',
                'required'  => false,
            ),
            array(
                'name'        => __('YITH WooCommerce Wishlist', 'honrix'),
                'slug'        => 'yith-woocommerce-wishlist',
                'required'  => false,
            ),
        );

        $config = array(
            'id'           => 'honrix',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa($plugins, $config);
    }
}

