<?php

/**
 * honrix page template
 *
 * @package honrix
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="content" class="honrix-entry py-4 <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
    <div class="row">
        <?php
        $right_sidebar = $left_sidebar = false;
        $right_sidebar = get_theme_mod('honrix_post_right_sidebar_display', 'yes') === 'yes' && is_active_sidebar('page_right_sidebar');
        $left_sidebar = get_theme_mod('honrix_post_left_sidebar_display', 'yes') === 'yes' && is_active_sidebar('page_left_sidebar');
        ?>
        <?php if ($left_sidebar) : ?>
            <div class="col-12 col-md-3">
                <?php is_rtl() ? get_sidebar('right') : get_sidebar('left'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12 col-md-<?php echo (12 - ($left_sidebar ? 3 : 0) - ($right_sidebar ? 3 : 0));  ?> honrix-entries">
            <div class="honrix-content">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) :/* loop start*/
                        the_post(); ?>
                        <article <?php post_class('page'); ?>>
                            <div class="mb-3">
                                <?php honrix_post_thumbnail(); ?>
                            </div>

                            <?php honrix_post_date(); ?>

                            <?php honrix_entry_title(); ?>

                            <div class="entry-content mb-5 clearfix">
                                <?php the_content(); ?>
                                <?php
                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'honrix') . '</span>',
                                        'after' => '</div>',
                                        'link_before' => '<span>',
                                        'link_after' => '</span>',
                                        'pagelink' => '<span class="screen-reader-text">' . __('Page', 'honrix') . ' </span>%',
                                        'separator' => '<span class="screen-reader-text">, </span>',
                                    )
                                );
                                ?>
                            </div>
                            <?php
                            honrix_post_avatar(50);
                            honrix_post_navigation();

                            honrix_post_comment();
                            ?>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>