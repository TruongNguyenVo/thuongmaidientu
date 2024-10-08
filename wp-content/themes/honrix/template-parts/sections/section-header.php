<div class="honrix-is-mobile shadow-sm">
    <?php if (esc_attr(get_theme_mod('honrix_top_bar_display', 'yes')) == 'yes' && is_active_sidebar('honrix_mobile_top_bar')) : ?>
        <div class="hrix-top-bar row p-2 m-0">
            <div class="col-12">
                <?php if (is_active_sidebar('honrix_mobile_top_bar')) : ?>
                    <?php dynamic_sidebar('honrix_mobile_top_bar'); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="hrix-site-header p-2  m-0">
        <div class="row align-items-center mx-auto px-0 <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed') == 'boxed' ? 'container' : 'container-fluid'); ?>">
            <div class="col-2">
                <?php do_action('honrix_nav_menu'); ?>
            </div>
            <div class="col-8 d-flex flex-column">
                <?php do_action('honrix_logo'); ?>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <?php do_action('honrix_header_minicart_mobile'); ?>
            </div>
        </div>
    </div>
</div>
<div class="honrix-is-pc shadow-sm">
    <?php if (esc_attr(get_theme_mod('honrix_top_bar_display', 'yes')) == 'yes' && (is_active_sidebar('honrix_top_left') || is_active_sidebar('honrix_top_center') || is_active_sidebar('honrix_top_right'))) : ?>
        <div class="hrix-top-bar d-block">
            <div class="py-2 <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed') == 'boxed' ? 'container' : 'container-fluid'); ?>">
                <div class="row align-items-center">
                    <?php $column = 0;
                    if (is_active_sidebar('honrix_top_left')) {
                        $column++;
                    }
                    if (is_active_sidebar('honrix_top_center')) {
                        $column++;
                    }
                    if (is_active_sidebar('honrix_top_right')) {
                        $column++;
                    }
                    ?>
                    <div class="col-lg-<?php echo esc_html(12 / $column); ?>">
                        <?php if (is_active_sidebar('honrix_top_left')) : ?>
                            <?php dynamic_sidebar('honrix_top_left'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-<?php echo esc_html(12 / $column); ?>">
                        <?php if (is_active_sidebar('honrix_top_center')) : ?>
                            <?php dynamic_sidebar('honrix_top_center'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-<?php echo esc_html(12 / $column); ?>">
                        <?php if (is_active_sidebar('honrix_top_right')) : ?>
                            <?php dynamic_sidebar('honrix_top_right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="hrix-site-header position-relative pt-2" style="background-image: url(<?php !empty(header_image()) ? header_image() : "" ?>);background-position: center center;background-repeat: no-repeat;background-size: cover;">
        <div class="<?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed') == 'boxed' ? 'container' : 'container-fluid'); ?> py-2">
            <div class="row align-items-center">
                <div class="col-3">
                    <?php do_action('honrix_logo'); ?>
                </div>
                <div class="col-<?php echo esc_html(is_active_sidebar('header_contact') ? 5 : 7); ?>">
                    <?php do_action('honrix_product_search'); ?>
                </div>

                <?php if (is_active_sidebar('header_contact')) : ?>
                    <div class="col-2">
                        <?php dynamic_sidebar('header_contact'); ?>
                    </div>
                <?php endif; ?>

                <div class="col-2 d-flex align-items-center justify-content-end gap-2">
                    <?php do_action('honrix_header_account'); ?>
                    <?php do_action('honrix_header_wishlist'); ?>
                    <?php do_action('honrix_header_minicart'); ?>
                </div>
            </div>

        </div>
        <div class="<?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed') == 'boxed' ? 'container' : 'container-fluid'); ?>">
            <div class="row align-items-center">
                <?php
                $category_display = get_theme_mod('honrix_header_categories_display', 'yes') == 'yes';
                $nav_area_display = is_active_sidebar('header_nav_area');
                $menu_column = 7;
                if (!$category_display && !$nav_area_display) {
                    $menu_column = 12;
                } elseif ($category_display && !$nav_area_display) {
                    $menu_column = 9;
                } elseif (!$category_display && $nav_area_display) {
                    $menu_column = 10;
                }
                ?>
                <?php if ($category_display) : ?>
                    <div class="col-3">
                        <?php do_action('honrix_browse_cat'); ?>
                    </div>
                <?php endif; ?>
                <div class="col-<?php echo esc_html($menu_column); ?>">
                    <?php do_action('honrix_nav_menu'); ?>
                </div>

                <?php if (is_active_sidebar('header_nav_area')) : ?>
                    <div class="col-2 d-flex justify-content-end">
                        <?php dynamic_sidebar('header_nav_area'); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>