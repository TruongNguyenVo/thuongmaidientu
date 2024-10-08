<?php
if (!function_exists('honrix_init_widget_area')) {
    function honrix_init_widget_area()
    {
        if (get_theme_mod('honrix_top_bar_display', 'yes') === 'yes') {
            register_sidebar([
                'name' => __('Top Left', 'honrix'),
                'id' => 'honrix_top_left',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);

            register_sidebar([
                'name' => __('Top Center', 'honrix'),
                'id' => 'honrix_top_center',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);

            register_sidebar([
                'name' => __('Top Right', 'honrix'),
                'id' => 'honrix_top_right',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);
        }

        register_sidebar(
            array(
                'name' => __('Header Contact', 'honrix'),
                'id' => 'header_contact',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Header Navigation Area', 'honrix'),
                'id' => 'header_nav_area',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Default Left Sidebar', 'honrix'),
                'id' => 'left_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Default Right Sidebar', 'honrix'),
                'id' => 'right_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Post Left Sidebar', 'honrix'),
                'id' => 'post_left_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Post Right Sidebar', 'honrix'),
                'id' => 'post_right_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Page Left Sidebar', 'honrix'),
                'id' => 'page_left_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        register_sidebar(
            array(
                'name' => __('Page Right Sidebar', 'honrix'),
                'id' => 'page_right_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            )
        );

        if (class_exists('WooCommerce')) {
            register_sidebar([
                'name' => __('Shop Right Sidebar', 'honrix'),
                'id' => 'shop_right_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);

            register_sidebar([
                'name' => __('Shop Left Sidebar', 'honrix'),
                'id' => 'shop_left_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);

            register_sidebar([
                'name' => __('Product Right Sidebar', 'honrix'),
                'id' => 'product_right_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);

            register_sidebar([
                'name' => __('Product Left Sidebar', 'honrix'),
                'id' => 'product_left_sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                'after_title' => '</h5>',
            ]);
        }

        for ($counter = 1; $counter <= get_theme_mod('honrix_footer_columns', '3'); $counter++) :
            $name = 'Footer Column %s';
            $name = sprintf($name, $counter);
            register_sidebar(
                array(
                    'name' => $name,
                    'id' => 'footer' . $counter,
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
                    'after_title' => '</h5>',
                )
            );
        endfor;

        register_sidebar([
            'name' => __('Copyright Widgets', 'honrix'),
            'id' => 'copyright_widgets',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
            'after_title' => '</h5>',
        ]);

        register_sidebar([
            'name' => __('Mobile Top Bar', 'honrix'),
            'id' => 'honrix_mobile_top_bar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget-title fs-4 m-0 mb-3 pb-1">',
            'after_title' => '</h5>',
        ]);
    }

    add_action('widgets_init', 'honrix_init_widget_area');
}
