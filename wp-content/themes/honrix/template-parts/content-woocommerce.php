<?php

/**
 * Honrix page template
 *
 * @package honrix
 */

if (!defined('ABSPATH')) {
    exit;
} ?>

<div id="content" class="honrix-content honrix-shop py-4 <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
    <div class="row">
        <?php
        $right_sidebar = $left_sidebar = false;
        if (is_shop() || is_product_category() || is_product_tag()) {
            $right_sidebar = get_theme_mod('honrix_shop_right_sidebar_display', 'yes') === 'yes' && is_active_sidebar('shop_right_sidebar');
            $left_sidebar = get_theme_mod('honrix_shop_left_sidebar_display', 'yes') === 'yes' && is_active_sidebar('shop_left_sidebar');
        }elseif(is_product()){
            $right_sidebar = get_theme_mod('honrix_product_right_sidebar_display', 'yes') === 'yes' && is_active_sidebar('product_right_sidebar');
            $left_sidebar = get_theme_mod('honrix_product_left_sidebar_display', 'yes') === 'yes' && is_active_sidebar('product_left_sidebar');
        }
        ?>
        <?php if ($left_sidebar) : ?>
            <div class="col-12 col-md-3">
                <?php is_rtl() ? get_sidebar('right') : get_sidebar('left'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12 col-md-<?php echo (12 - ($left_sidebar ? 3 : 0) - ($right_sidebar ? 3 : 0));  ?> honrix-entries">
            <?php woocommerce_content(); ?>
        </div>
        <?php if ($right_sidebar) : ?>
            <div class="col-12 col-md-3">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>