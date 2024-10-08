<?php

/**
 * honrix 404 content page
 *
 * @package honrix
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

?>
<div id="content" class="honrix-entry single py-4 <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
    <div class="row">
        <?php
        $right_sidebar = $left_sidebar = false;
        $right_sidebar = get_theme_mod('honrix_right_sidebar_display', 'yes') === 'yes' && is_active_sidebar('right_sidebar');
        $left_sidebar = get_theme_mod('honrix_left_sidebar_display', 'yes') === 'yes' && is_active_sidebar('left_sidebar');
        ?>
        <?php if ($left_sidebar) : ?>
            <div class="col-12 col-md-3">
                <?php is_rtl() ? get_sidebar('right') : get_sidebar('left'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12 col-md-<?php echo (12 - ($left_sidebar ? 3 : 0) - ($right_sidebar ? 3 : 0));  ?> honrix-content">
            <article class="post">
                <div class="entry-header">
                    <h2 class="entry-title"><?php esc_html_e('404 Error', 'honrix'); ?></h2>
                    <div class="line"></div>
                </div>
                <div class="entry-content">
                    <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'honrix'); ?></p>
                </div>
            </article>
        </div>
        <?php if ($right_sidebar) : ?>
            <div class="col-12 col-md-3">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
