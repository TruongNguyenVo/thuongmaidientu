<?php

/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package honrix
 */
?>

</main>
<?php
$is_footer_active = false;
for ($counter = 1; $counter <= get_theme_mod('honrix_footer_columns', '3'); $counter++) {
    if (is_active_sidebar('footer' . $counter)) {
        $is_footer_active = true;
    }
} ?>
<?php if (esc_attr(get_theme_mod('honrix_footer_display', 'yes') == 'yes')) : ?>
    <footer class="site-footer">
        <?php
        if ($is_footer_active) : ?>
            <div class="inner-footer <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?> column-<?php echo esc_attr(get_theme_mod('honrix_footer_columns', '3')); ?> py-5">

                <?php for ($counter = 1; $counter <= get_theme_mod('honrix_footer_columns', '3'); $counter++) : ?>
                    <div class="footer w-100 pb-3">
                        <?php if (is_active_sidebar('footer' . $counter)) : ?>
                            <?php dynamic_sidebar('footer' . $counter); ?>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>

            </div>
        <?php endif; ?>
    </footer>
<?php endif; ?>
<?php if (esc_attr(get_theme_mod('honrix_copy_right_display', 'yes') == 'yes')) : ?>
    <div class="site-copyright">
        <div class="<?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
            <div class="row inner-copyright honrix-flex  flex-2 honrix-center">
                <?php
                $copyright = get_theme_mod('honrix_copyright_text', '© {year} {site_name}');
                if (!empty($copyright)) :
                ?>
                    <div class="copyright col-6">
                        <?php
                        $copyright = str_replace("{year}", date("Y"), $copyright);
                        $copyright = str_replace("{site_name}", get_bloginfo('name'), $copyright);
                        $copyright = str_replace("{description}", get_bloginfo('description'), $copyright);

                        echo wp_kses_post($copyright);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('copyright_widgets')) : ?>
                    <div class="col-6 d-flex justify-content-center justify-content-md-end">
                        <?php dynamic_sidebar('copyright_widgets'); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (class_exists('WooCommerce') || defined('YITH_WCWL')) : ?>
    <div class="hrix-mobile-bottom-menu honrix-is-mobile-flex row position-fixed start-0 bottom-0 w-100 p-2 m-0">
        <?php
        $column = 4;
        if (!class_exists('WooCommerce')) {
            $column = 12;
        }
        if (!defined('YITH_WCWL')) {
            $column = 6;
        }
        ?>
        <?php if (class_exists('WooCommerce')) : ?>
            <?php if (function_exists('wc_get_page_id')) : ?>
                <div class="col-<?php echo $column; ?> d-flex align-items-center justify-content-center">
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="d-flex align-items-center">
                        <div class="fs-4 me-2"><i class="fas fa-store"></i></div> <?php _e('Shop', 'honrix'); ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="col-<?php echo $column; ?> d-flex align-items-center justify-content-center">
                <?php do_action('honrix_header_account'); ?>
            </div>
        <?php endif; ?>
        <?php if (defined('YITH_WCWL')) : ?>
            <div class="col-<?php echo $column; ?> d-flex align-items-center justify-content-center">
                <?php do_action('honrix_header_wishlist'); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php if (get_theme_mod('honrix_to_top', 'yes') == 'yes') : ?>
    <button class='to-top honrix-arrow honrix-is-pc' onclick='window.scrollTo({top: 0, behavior: "smooth"});'>
        <span class='fas fa-arrow-up'></span>
    </button>
<?php endif; ?>
</div>
<?php wp_footer(); ?>

</body>

</html>