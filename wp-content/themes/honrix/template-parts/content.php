<?php

/**
 * honrix blog list
 *
 * @package honrix
 */
?>

<?php if (is_search()) : ?>
    <div class="honrix-archive-title pt-3 pb-3">
        <div class="<?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
            <h1 class="page-title m-0 mb-2"><?php echo esc_html('Search Results for: ', 'honrix') . '<span class="search-term">' . esc_html(get_search_query()); ?></span></h1>
        </div>
    </div>
<?php elseif (is_archive()) : ?>
    <div class="hrix-archive-title pt-3 pb-3">
        <div class="<?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
            <?php the_archive_title('<h1 class="page-title m-0 mb-2">', '</h1>'); ?>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
        </div>
    </div>
<?php endif; ?>

<div id="content" class="honrix-content honrix-archive py-4 <?php echo esc_attr(get_theme_mod('honrix_boxed', 'boxed')) == 'boxed' ? 'container' : 'container-fluid'; ?>">
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
        <div class="col-12 col-md-<?php echo (12 - ($left_sidebar ? 3 : 0) - ($right_sidebar ? 3 : 0));  ?> honrix-entries">
            <div>
                <div class="posts honrix-entries column-2">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) :/* loop start*/
                            the_post(); ?>
                            <article class="post-<?php the_ID(); ?> d-flex flex-column">
                                <?php honrix_post_thumbnail(); ?>

                                <?php
                                honrix_entry_category();
                                honrix_entry_title(); ?>
                                <?php
                                $display_read_more_text = get_theme_mod('honrix_archive_content_read_more_text', __('Continue Reading...', 'honrix'));
                                ?>
                                <?php honrix_entry_content(); ?>
                                <div class="entry-body mt-auto">
                                    <div class="entry-read-more mb-2 pb-2">
                                        <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark"><?php echo esc_html($display_read_more_text) ?></a>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-6">
                                            <div class="entry-author d-flex align-items-center">
                                                <div class="avatar me-2">
                                                    <?php
                                                    $author_avatar_size = apply_filters('honrix_author_avatar_size', 24);
                                                    echo get_avatar(get_the_author_meta('user_email'), $author_avatar_size); ?>
                                                </div>
                                                <div class="author-name">
                                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-end">
                                            <span class="date"><i class="far fa-calendar me-1"></i><small><?php echo esc_html(get_the_date('M j, Y')); ?></small></span>
                                            <span class="comments ms-2">
                                                <?php if (comments_open() && intval(get_comments_number()) > 0) : ?>
                                                    <i class="far fa-comments me-1"></i> <small><?php echo intval(get_comments_number()); ?></small>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php honrix_entries_pagination(); ?>
            </div>
        </div>
        <?php if ($right_sidebar) : ?>
            <div class="col-12 col-md-3">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>