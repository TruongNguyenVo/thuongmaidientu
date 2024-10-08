<?php
if (!function_exists('honrix_nav_menu')) {
    function honrix_nav_menu()
    { ?>
        <div class="honrix-is-mobile">
            <?php
            if (
                has_nav_menu('mobile-menu') ||
                has_nav_menu('main-menu')
            ) : ?>
                <button class="hrix-navbar-toggler" type="button">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="hrix-mobile-navigation-menu position-fixed top-0 w-100 h-100">
                    <div class="w-75 w-md-50 px-1 py-2 position-relative">
                        <div class="d-flex align-items-center justify-content-end pb-4 mb-2">
                            <span class="close btn rounded-circle d-flex align-items-center justify-content-center shadow-sm" tabindex="0"><i class="fa fa-times"></i></span>
                        </div>
                        <div class="">
                            <?php do_action('honrix_product_search'); ?>
                        </div>
                        <div class="row mt-2 mx-0">
                            <div class="hrix-mobile-menu-selector active col-<?php echo esc_html(get_theme_mod('honrix_header_categories_display', 'yes') == 'yes' ? "6" : "12"); ?> d-flex align-items-center justify-content-center" tabindex="0">
                                <div class="w-100 d-flex align-items-center justify-content-center py-3"><?php esc_html_e('Menu', 'honrix'); ?></div>
                            </div>
                            <?php if (get_theme_mod('honrix_header_categories_display', 'yes') == 'yes') : ?>
                                <div class="hrix-mobile-category-selector col-6 d-flex align-items-center justify-content-center" tabindex="0">
                                    <div class="w-100 d-flex align-items-center justify-content-center py-3"><?php esc_html_e('Categories', 'honrix'); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <nav class="hrix-mobile-menu w-100 active">
                            <?php
                            wp_nav_menu([
                                'theme_location' => has_nav_menu('mobile-menu')
                                    ? 'mobile-menu'
                                    : 'main-menu',
                                'container' => 'div',
                                'container_class' => 'navbar-nav py-0 w-100',
                                'menu_class' => 'nav navbar-nav wrap',
                                'items_wrap' => '%3$s',
                                'walker' => new Honrix_Walker_Nav_Menu()
                            ]); ?>
                        </nav>
                        <?php if (get_theme_mod('honrix_header_categories_display', 'yes') == 'yes') : ?>
                            <div class="hrix-mobile-categories w-100 position-relative">
                                <?php do_action('honrix_browse_cat'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="honrix-is-pc">
            <nav class="hrix-header-menu navbar navbar-expand-lg navbar-dark py-lg-0">
                <?php if (has_nav_menu('main-menu')) : ?>
                    <div class="hrix-menu collapse navbar-collapse" id="navbarCollapse">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'main-menu',
                            'container' => 'div',
                            'container_class' => 'navbar-nav py-0',
                            'items_wrap' => '%3$s',
                            'walker' => new Honrix_Walker_Nav_Menu()
                        ]); ?>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
        <?php
    }
    add_action('honrix_nav_menu', 'honrix_nav_menu');
}
if (!function_exists('honrix_logo')) {
    function honrix_logo()
    {
        if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <h4 class="site-title text-decoration-none text-capitalize fw-bold m-0 text-center text-md-start">
                    <?php
                    echo esc_html(get_bloginfo('name'));
                    ?>
                </h4>
            </a>
        <?php
        endif;
        ?>
        <?php
        $honrix_description = get_bloginfo('description');
        if ($honrix_description) : ?>
            <p class="site-description m-0 text-capitalize py-1 text-center text-md-start"><?php echo esc_html($honrix_description); ?></p>
        <?php endif;
    }
    add_action('honrix_logo', 'honrix_logo');
}

if (!function_exists('honrix_product_search')) {
    function honrix_product_search()
    {
        $honrix_hs_product_search    = esc_attr(get_theme_mod('honrix_header_product_search_display', 'yes'));
        if ($honrix_hs_product_search === 'yes' && class_exists('woocommerce')) : ?>
            <div class="hrix-header-search-form">
                <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="w-100 d-flex overflow-hidden">
                    <select class="hrix-header-search-select d-inline-block position-relative rounded-0" name="product_cat">
                        <option value=""><?php esc_html_e('All', 'honrix'); ?></option>
                        <?php
                        $storely_product_categories = get_categories('taxonomy=product_cat');
                        foreach ($storely_product_categories as $category) {
                            $option = '<option value="' . esc_attr($category->category_nicename) . '">';
                            $option .= esc_html($category->cat_name);
                            $option .= ' (' . absint($category->category_count) . ')';
                            $option .= '</option>';
                            echo $option; // WPCS: XSS OK.
                        }
                        ?>
                    </select>
                    <input type="hidden" name="post_type" value="product" />
                    <div class="hrix-header-search-search-section d-flex">
                        <input class="hrix-header-search-input w-100 border-0 ps-2 pe-2" name="s" type="text" placeholder="<?php esc_attr_e('Search Products Here', 'honrix'); ?>" />
                        <input type="hidden" name="post_type" value="product" />
                        <button class="hrix-header-search-button w-25 fw-bold border-0" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        <?php endif;
    }
    add_action('honrix_product_search', 'honrix_product_search');
}

if (!function_exists('honrix_header_account')) {
    function honrix_header_account()
    {
        if (class_exists('woocommerce')) : ?>
            <div class="hrix-mobile-footer-account honrix-is-mobile">
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php echo is_user_logged_in() ? esc_html(wp_get_current_user()->display_name) : __('Login', 'honrix'); ?>" class="d-flex align-items-center">
                    <div class="fs-4 me-2"><i class="far fa-user"></i></div><?php esc_html_e('Account', 'honrix'); ?>
                </a>
            </div>
            <div class="hrix-header-account honrix-is-pc w40px d-flex align-items-center justify-content-center">
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php echo is_user_logged_in() ? esc_html(wp_get_current_user()->display_name) : __('Login', 'honrix'); ?>" class="d-flex align-items-center justify-content-center">
                    <div class="fs-4"><i class="far fa-user"></i></div>
                </a>
            </div>
        <?php
        endif;
    }
    add_action('honrix_header_account', 'honrix_header_account');
}

if (!function_exists('honrix_header_wishlist')) {
    function honrix_header_wishlist()
    {
        if (defined('YITH_WCWL') && class_exists('woocommerce')) :
            $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
            <span class="hrix-mobile-footer-wishlist honrix-is-mobile">
                <a href="<?php echo esc_url($wishlist_url); ?>" data-tooltip="<?php esc_attr_e('Wishlist', 'honrix'); ?>" title="<?php esc_attr_e('Wishlist', 'honrix'); ?>" class="d-flex align-items-center">
                    <div class="fs-4 me-2"><i class="far fa-heart"></i> </div><?php esc_html_e('Wishlist', 'honrix'); ?>
                </a>
            </span>
            <div class="hrix-header-wishlist fs-4 w40px d-flex align-items-center justify-content-center honrix-is-pc">
                <span class="position-relative">
                    <a href="<?php echo esc_url($wishlist_url); ?>" data-tooltip="<?php esc_attr_e('Wishlist', 'honrix'); ?>" title="<?php esc_attr_e('Wishlist', 'honrix'); ?>">
                        <i class="far fa-heart"></i>

                        <span class="yith-wcwl-items-count position-absolute top-0 start-100 translate-middle badge rounded-pill"><?php if (intval(yith_wcwl_count_all_products()) > 0) : ?>
                                <?php echo intval(yith_wcwl_count_all_products()); ?>
                            <?php endif; ?></span>

                    </a>
                </span>
            </div>
        <?php
        endif;
    }
    add_action('honrix_header_wishlist', 'honrix_header_wishlist');
}

if (!function_exists('honrix_header_minicart')) {
    function honrix_header_minicart()
    {
        if (class_exists('WooCommerce')) : ?>
            <div class="fs-4 w40px d-flex align-items-center justify-content-center">
                <span class="hrix-header-mini-cart position-relative">
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                        <i class="fas fa-shopping-bag honrix-is-mobile"></i>
                        <i class="fab fa-opencart honrix-is-pc"></i>
                        <span class="hrix-header-minicart-count">
                            <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                    <?php printf(esc_html__('%d', 'honrix'), WC()->cart->get_cart_contents_count()); ?>
                                </span>
                            <?php endif; ?>
                        </span>
                    </a>
                </span>
                <div class="hrix-header-minicart-context position-fixed top-0 w-100 h-100 honrix-is-pc">
                    <div class="h-100 text-capitalize pt-3 position-absolute top-0 end-0">
                        <span class="close btn rounded-circle d-flex align-items-center justify-content-center m-3 shadow-sm position-absolute start-0 top-0" tabindex="0"><i class="fa fa-times"></i></span>
                        <div class="text-center"><i class="fas fa-shopping-basket"></i></div>
                        <div class="text-center"><?php _e('Shopping Cart', 'honrix'); ?></div>
                        <div class="minicart-content d-flex flex-column">
                            <?php woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;
    }
    add_action('honrix_header_minicart', 'honrix_header_minicart');
}

if (!function_exists('honrix_header_minicart_mobile')) {
    function honrix_header_minicart_mobile()
    {
        if (class_exists('WooCommerce')) : ?>
            <div class="fs-4 w40px d-flex align-items-center justify-content-center">
                <span class="hrix-header-mini-cart position-relative">
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                        <i class="fas fa-shopping-bag honrix-is-mobile"></i>
                        <i class="fab fa-opencart honrix-is-pc"></i>
                        <span class="hrix-header-minicart-count">
                            <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                    <?php printf(esc_html__('%d', 'honrix'), WC()->cart->get_cart_contents_count()); ?>
                                </span>
                            <?php endif; ?>
                        </span>
                    </a>
                </span>
            </div>
        <?php endif;
    }
    add_action('honrix_header_minicart_mobile', 'honrix_header_minicart_mobile');
}

/**
 * honrix Browse Category
 */
if (!function_exists('honrix_browse_cat')) {
    function honrix_browse_cat()
    {
        $btn_icon = __('<i class="fas fa-bars me-2"></i>', 'honrix');
        $btn_title = __('Browse Categories', 'honrix');
        $browse_cat_ttl        = get_theme_mod('browse_cat_ttl', $btn_icon . ' ' . $btn_title);
        $browse_product_cat            = get_theme_mod('browse_product_cat');

        if (class_exists('woocommerce')) :
            $taxonomy     = 'product_cat';
            $orderby      = 'name';
            $show_count   = 0;
            $pad_counts   = 0;
            $hierarchical = 1;
            $title        = '';
            $empty        = 1;
            $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
            );

            $all_categories = get_categories($args); ?>

            <div class="product-category-menus w-100 honrix-is-mobile">
                <ul class="main-menu">
                    <?php

                    foreach ($all_categories as $cat) {
                        $honrix_product_cat_icon = get_term_meta($cat->term_id, 'honrix_product_cat_icon', true);
                        if ($cat->category_parent == 0) {
                            $category_id = $cat->term_id;
                            $child_class = (honrix_has_Children($category_id)) ? 'menu-item-has-children' : '';

                            echo '<li class="menu-item main-top-menu ' . $child_class . '"><a href="' . get_term_link($cat->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                            echo $cat->name . '</a>';
                            $args2 = array(
                                'taxonomy'     => $taxonomy,
                                'parent'       => $category_id,
                                'hierarchical' => $hierarchical,
                                'hide_empty'   => $empty
                            );
                            $sub_cats = get_categories($args2);
                            if ($sub_cats) {
                                echo '<ul class="dropdown-menu 2-main-top-menu">';
                                foreach ($sub_cats as $sub_category) {
                                    $child_class = (honrix_has_Children($sub_category->term_id)) ? 'menu-item-has-children' : '';


                                    $honrix_product_cat_icon = get_term_meta($sub_category->term_id, 'honrix_product_cat_icon', true);
                                    echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                    echo $sub_category->name . '</a>';

                                    $args3 = array(
                                        'taxonomy'     => $taxonomy,
                                        'parent'       => $sub_category->term_id,
                                        'hierarchical' => $hierarchical,
                                        'hide_empty'   => $empty
                                    );
                                    $sub_cats3 = get_categories($args3);

                                    if ($sub_cats3) {
                                        echo '<ul class="dropdown-menu 3-main-top-menu">';
                                        foreach ($sub_cats3 as $sub_category3) {
                                            $child_class = (honrix_has_Children($sub_category3->term_id)) ? 'menu-item-has-children' : '';

                                            $honrix_product_cat_icon = get_term_meta($sub_category3->term_id, 'honrix_product_cat_icon', true);
                                            echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category3->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                            echo $sub_category3->name . '</a>';

                                            $args4 = array(
                                                'taxonomy'     => $taxonomy,
                                                'parent'       => $sub_category3->term_id,
                                                'hierarchical' => $hierarchical,
                                                'hide_empty'   => $empty
                                            );
                                            $sub_cats4 = get_categories($args4);
                                            if ($sub_cats4) {
                                                echo '<ul class="dropdown-menu 4-main-top-menu">';
                                                foreach ($sub_cats4 as $sub_category4) {
                                                    $child_class = (honrix_has_Children($sub_category4->term_id)) ? 'menu-item-has-children' : '';

                                                    $honrix_product_cat_icon = get_term_meta($sub_category4->term_id, 'honrix_product_cat_icon', true);
                                                    echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category4->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                    echo $sub_category4->name . '</a>';

                                                    $args5 = array(
                                                        'taxonomy'     => $taxonomy,
                                                        'parent'       => $sub_category4->term_id,
                                                        'hierarchical' => $hierarchical,
                                                        'hide_empty'   => $empty
                                                    );

                                                    $sub_cats5 = get_categories($args5);
                                                    if ($sub_cats5) {
                                                        echo '<ul class="dropdown-menu 5-main-top-menu">';
                                                        foreach ($sub_cats5 as $sub_category5) {
                                                            $child_class = (honrix_has_Children($sub_category5->term_id)) ? 'menu-item-has-children' : '';

                                                            $honrix_product_cat_icon = get_term_meta($sub_category5->term_id, 'honrix_product_cat_icon', true);
                                                            echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category5->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                            echo $sub_category5->name . '</a>';

                                                            $args6 = array(
                                                                'taxonomy'     => $taxonomy,
                                                                'parent'       => $sub_category5->term_id,
                                                                'hierarchical' => $hierarchical,
                                                                'hide_empty'   => $empty
                                                            );

                                                            $sub_cats6 = get_categories($args6);

                                                            if ($sub_cats6) {
                                                                echo '<ul class="dropdown-menu 6-main-top-menu">';
                                                                foreach ($sub_cats6 as $sub_category6) {
                                                                    $child_class = (honrix_has_Children($sub_category6->term_id)) ? 'menu-item-has-children' : '';

                                                                    $honrix_product_cat_icon = get_term_meta($sub_category6->term_id, 'honrix_product_cat_icon', true);
                                                                    echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category6->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                                    echo $sub_category6->name . '</a></li>';
                                                                }
                                                                echo '</ul>';
                                                            }
                                                            echo '</li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                    echo '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="honrix-is-pc position-relative">
                <button type="button" class="product-category-btn w-100 d-flex align-items-center justify-content-center text-center position-relative overflow-hidden border-0 fw-bold p-3">
                    <span class="cat-left">
                        <?php echo wp_kses_post($browse_cat_ttl); ?>
                    </span>
                    <i class="fas fa-chevron-right ms-2 d-flex align-items-center justify-content-center"></i>
                </button>
                <div class="product-category-menus position-absolute">
                    <ul class="main-menu list-unstyled p-0 m-0">
                        <?php
                        foreach ($all_categories as $cat) {
                            $honrix_product_cat_icon = get_term_meta($cat->term_id, 'honrix_product_cat_icon', true);
                            if ($cat->category_parent == 0) {
                                $category_id = $cat->term_id;
                                $child_class = (honrix_has_Children($category_id)) ? 'menu-item-has-children' : '';

                                echo '<li class="menu-item main-top-menu ' . $child_class . '"><a href="' . get_term_link($cat->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                echo $cat->name . '</a>';
                                $args2 = array(
                                    'taxonomy'     => $taxonomy,
                                    'parent'       => $category_id,
                                    'hierarchical' => $hierarchical,
                                    'hide_empty'   => $empty
                                );
                                $sub_cats = get_categories($args2);
                                if ($sub_cats) {
                                    echo '<ul class="dropdown-menu 2-main-top-menu">';
                                    foreach ($sub_cats as $sub_category) {
                                        $child_class = (honrix_has_Children($sub_category->term_id)) ? 'menu-item-has-children' : '';


                                        $honrix_product_cat_icon = get_term_meta($sub_category->term_id, 'honrix_product_cat_icon', true);
                                        echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                        echo $sub_category->name . '</a>';

                                        $args3 = array(
                                            'taxonomy'     => $taxonomy,
                                            'parent'       => $sub_category->term_id,
                                            'hierarchical' => $hierarchical,
                                            'hide_empty'   => $empty
                                        );
                                        $sub_cats3 = get_categories($args3);

                                        if ($sub_cats3) {
                                            echo '<ul class="dropdown-menu 3-main-top-menu">';
                                            foreach ($sub_cats3 as $sub_category3) {
                                                $child_class = (honrix_has_Children($sub_category3->term_id)) ? 'menu-item-has-children' : '';

                                                $honrix_product_cat_icon = get_term_meta($sub_category3->term_id, 'honrix_product_cat_icon', true);
                                                echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category3->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                echo $sub_category3->name . '</a>';

                                                $args4 = array(
                                                    'taxonomy'     => $taxonomy,
                                                    'parent'       => $sub_category3->term_id,
                                                    'hierarchical' => $hierarchical,
                                                    'hide_empty'   => $empty
                                                );
                                                $sub_cats4 = get_categories($args4);
                                                if ($sub_cats4) {
                                                    echo '<ul class="dropdown-menu 4-main-top-menu">';
                                                    foreach ($sub_cats4 as $sub_category4) {
                                                        $child_class = (honrix_has_Children($sub_category4->term_id)) ? 'menu-item-has-children' : '';

                                                        $honrix_product_cat_icon = get_term_meta($sub_category4->term_id, 'honrix_product_cat_icon', true);
                                                        echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category4->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                        echo $sub_category4->name . '</a>';

                                                        $args5 = array(
                                                            'taxonomy'     => $taxonomy,
                                                            'parent'       => $sub_category4->term_id,
                                                            'hierarchical' => $hierarchical,
                                                            'hide_empty'   => $empty
                                                        );

                                                        $sub_cats5 = get_categories($args5);
                                                        if ($sub_cats5) {
                                                            echo '<ul class="dropdown-menu 5-main-top-menu">';
                                                            foreach ($sub_cats5 as $sub_category5) {
                                                                $child_class = (honrix_has_Children($sub_category5->term_id)) ? 'menu-item-has-children' : '';

                                                                $honrix_product_cat_icon = get_term_meta($sub_category5->term_id, 'honrix_product_cat_icon', true);
                                                                echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category5->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                                echo $sub_category5->name . '</a>';

                                                                $args6 = array(
                                                                    'taxonomy'     => $taxonomy,
                                                                    'parent'       => $sub_category5->term_id,
                                                                    'hierarchical' => $hierarchical,
                                                                    'hide_empty'   => $empty
                                                                );

                                                                $sub_cats6 = get_categories($args6);

                                                                if ($sub_cats6) {
                                                                    echo '<ul class="dropdown-menu 6-main-top-menu">';
                                                                    foreach ($sub_cats6 as $sub_category6) {
                                                                        $child_class = (honrix_has_Children($sub_category6->term_id)) ? 'menu-item-has-children' : '';

                                                                        $honrix_product_cat_icon = get_term_meta($sub_category6->term_id, 'honrix_product_cat_icon', true);
                                                                        echo  '<li class="menu-item ' . $child_class . '"><a class="nav-link" href="' . get_term_link($sub_category6->slug, 'product_cat') . '">' . (!empty($honrix_product_cat_icon) ? "<i class='fa {$honrix_product_cat_icon}'></i>" : '');
                                                                        echo $sub_category6->name . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
<?php
        endif;
    }
    add_action('honrix_browse_cat', 'honrix_browse_cat');
}

/* Get Product parent category Start */
function honrix_has_Children($cat_id)
{
    $children = get_terms(
        'product_cat',
        array('parent' => $cat_id, 'hide_empty' => false)
    );
    if ($children) {
        return true;
    }
    return false;
}




function honrix_body_classes($classes)
{

    // Helps detect if JS is enabled or not.
    $classes[] = 'no-js';

    // Adds `singular` to singular pages, and `hfeed` to all other pages.
    $classes[] = is_singular() ? 'singular' : 'hfeed';

    return $classes;
}
add_filter('body_class', 'honrix_body_classes');

function honrix_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'honrix_pingback_header');

/**
 * Remove the `no-js` class from body if JS is supported.
 */
function honrix_supports_js()
{
    echo '<script>document.body.classList.remove("no-js");</script>';
}
add_action('wp_footer', 'honrix_supports_js');

/**
 * Changes comment form default fields.
 */
function honrix_comment_form_defaults($defaults)
{

    // Adjust height of comment form.
    $defaults['comment_field'] = preg_replace('/rows="\d+"/', 'rows="5"', $defaults['comment_field']);

    return $defaults;
}
add_filter('comment_form_defaults', 'honrix_comment_form_defaults');

/**
 * Determines if post thumbnail can be displayed.
 *
 * @since honrix 1.0
 *
 * @return bool
 */
function honrix_can_show_post_thumbnail()
{
    return apply_filters(
        'honrix_can_show_post_thumbnail',
        !post_password_required() && !is_attachment() && has_post_thumbnail()
    );
}

if (!function_exists('honrix_post_title')) {
    /**
     * Add a title to posts and pages that are missing titles.
     */
    function honrix_post_title($title)
    {
        return '' === $title ? esc_html_x('Untitled', 'Added to posts and pages that are missing titles', 'honrix') : $title;
    }
}
add_filter('the_title', 'honrix_post_title');

// /**
//  * Print the first instance of a block in the content, and then break away.
//  */
function honrix_print_first_instance_of_block($block_name, $content = null, $instances = 1)
{
    $instances_count = 0;
    $blocks_content  = '';

    if (!$content) {
        $content = get_the_content();
    }

    // Parse blocks in the content.
    $blocks = parse_blocks($content);

    // Loop blocks.
    foreach ($blocks as $block) {

        // Sanity check.
        if (!isset($block['blockName'])) {
            continue;
        }

        // Check if this the block matches the $block_name.
        $is_matching_block = false;

        // If the block ends with *, try to match the first portion.
        if ('*' === $block_name[-1]) {
            $is_matching_block = 0 === strpos($block['blockName'], rtrim($block_name, '*'));
        } else {
            $is_matching_block = $block_name === $block['blockName'];
        }

        if ($is_matching_block) {
            // Increment count.
            $instances_count++;

            // Add the block HTML.
            $blocks_content .= render_block($block);

            // Break the loop if the $instances count was reached.
            if ($instances_count >= $instances) {
                break;
            }
        }
    }

    if ($blocks_content) {
        /** This filter is documented in wp-includes/post-template.php */
        echo apply_filters('the_content', $blocks_content); // phpcs:ignore WordPress.Security.EscapeOutput
        return true;
    }

    return false;
}

// /**
//  * Retrieve protected post password form content.
//  *
//  * @since honrix 1.0
//  *
//  * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
//  * @return string HTML content for password form for password protected post.
//  */
function honrix_password_form($post = 0)
{
    $post   = get_post($post);
    $label  = 'pwbox-' . (empty($post->ID) ? wp_rand() : $post->ID);
    $output = '<p class="post-password-message">' . esc_html__('This content is password protected. Please enter a password to view.', 'honrix') . '</p>
	<form action="' . esc_url(home_url('wp-login.php?action=postpass', 'login_post')) . '" class="post-password-form" method="post">
	<label class="post-password-form__label" for="' . esc_attr($label) . '">' . esc_html_x('Password', 'Post password form', 'honrix') . '</label><input class="post-password-form__input" name="post_password" id="' . esc_attr($label) . '" type="password" size="20" /><input type="submit" class="post-password-form__submit" name="' . esc_attr_x('Submit', 'Post password form', 'honrix') . '" value="' . esc_attr_x('Enter', 'Post password form', 'honrix') . '" /></form>
	';
    return $output;
}
add_filter('the_password_form', 'honrix_password_form');

if (!function_exists('honrix_get_option')) :
    function honrix_get_option($id)
    {
        if (!$id) {
            return;
        }
        if (get_theme_mod($id) !== null) {
            return get_theme_mod($id);
        }
    }
endif;
