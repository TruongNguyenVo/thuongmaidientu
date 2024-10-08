<?php
if (!function_exists('honrix_post_thumbnail')) {
    function honrix_post_thumbnail()
    {
        if (class_exists('WooCommerce')) {
            if (
                is_shop() ||
                is_cart() ||
                is_checkout() ||
                is_account_page() ||
                is_product_category() ||
                is_product_tag() ||
                is_product() ||
                is_wc_endpoint_url()
            ) {
                return;
            }
        }
        $thumbnail_display = esc_attr(get_theme_mod('honrix_archive_display_thumbnail', 'yes')) == 'yes' && has_post_thumbnail();

        if ($thumbnail_display) : ?>
            <?php if (is_singular()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="d-block mb-2">
                    <div class="post-thumbnail overflow-hidden ratio ratio-16x9">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </a>
            <?php endif; ?>
        <?php
        endif;
    }
}

if (!function_exists('honrix_entry_category')) {
    function honrix_entry_category()
    {
        $categories_list = get_the_category_list(_x('', 'Used between list items, there is a space after the comma.', 'honrix'));
        if ($categories_list) : ?>
            <span class="entry-categories mb-2">
                <?php printf('<span class="screen-reader-text">%1$s </span><i class="far fa-folder-open me-1"></i>%2$s', esc_html__('Used before category names.', 'honrix'), wp_kses($categories_list, array('a' => array('href' => array(), 'rel' => array())))); ?>
            </span>
        <?php
        endif;
    }
}

if (!function_exists('honrix_entry_title')) {
    function honrix_entry_title()
    {
        ?>
        <?php if (is_singular()) : ?>
            <?php if (is_sticky()) : ?>
                <?php
                the_title(sprintf('<h1 class="entry-title mb-2 fs-4 d-flex align-items-center gap-2"><span class="fas fa-thumbtack"></span> ', esc_url(get_permalink())), '</h1>');
                ?>
            <?php else : ?>
                <?php
                the_title(sprintf('<h1 class="entry-title mb-2 fs-4">', esc_url(get_permalink())), '</h1>');
                ?>
            <?php endif; ?>
        <?php else : ?>
            <?php if (is_sticky()) : ?>
                <?php
                the_title(sprintf('<h2 class="entry-title mb-2 fs-5 d-flex align-items-center gap-2"><span class="fas fa-thumbtack"></span><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                ?>
            <?php else : ?>
                <?php the_title(sprintf('<h2 class="entry-title mb-2 fs-5"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php
    }
}

if (!function_exists('honrix_entry_content')) {
    function honrix_entry_content()
    {
    ?>
        <div class="entry-content mb-2">
            <?php get_template_part('template-parts/excerpt/excerpt', get_post_format()); ?>
        </div>
        <?php
    }
}

if (!function_exists('honrix_entry_comments_number')) {
    function honrix_entry_comments_number()
    {
        if (comments_open()) : ?>
            <span class="entry-comment-count">
                <?php
                $comments_number = get_comments_number(); ?>
                <?php if ('0' === $comments_number) : ?>
                    <?php esc_html_e("No Comment", 'honrix') ?>
                <?php elseif ('1' === $comments_number) : ?>
                    <?php esc_html_e("One Comment", 'honrix') ?>
                <?php else : ?>
                    <?php echo esc_html($comments_number); ?><?php esc_html_e(" Comments", 'honrix') ?>
                <?php endif; ?>
            </span>
        <?php
        endif;
    }
}

if (!function_exists('honrix_entries_pagination')) {
    function honrix_entries_pagination()
    {
        if (is_rtl()) {
            the_posts_pagination(array(
                'prev_text' => __('<i class="fas fa-angle-double-right"></i>', 'honrix'),
                'next_text' => __('<i class="fas fa-angle-double-left"></i>', 'honrix'),
            ));
        } else {
            the_posts_pagination(array(
                'prev_text' => __('<i class="fas fa-angle-double-left"></i>', 'honrix'),
                'next_text' => __('<i class="fas fa-angle-double-right"></i>', 'honrix'),
            ));
        }
    }
}

if (!function_exists('honrix_post_navigation')) {
    function honrix_post_navigation()
    {
        if (class_exists('WooCommerce')) {
            if (
                is_shop() ||
                is_cart() ||
                is_checkout() ||
                is_account_page() ||
                is_product_category() ||
                is_product_tag() ||
                is_product() ||
                is_wc_endpoint_url()
            ) {
                return;
            }
        }

        $prev_post = get_adjacent_post(false, '', true);
        $next_post = get_adjacent_post(false, '', false);
        if (!empty($prev_post) || !empty($next_post)) :
            $prev_title = !empty(esc_attr(get_theme_mod('honrix_single_navigation_prev_title', __('Previous Article', 'honrix')))) ? '<div>' . esc_attr(get_theme_mod('honrix_single_navigation_prev_title', 'Previous Article')) . '</div>' : '';
            $next_title = !empty(esc_attr(get_theme_mod('honrix_single_navigation_next_title', __('Next Article', 'honrix')))) ? '<div>' . esc_attr(get_theme_mod('honrix_single_navigation_next_title', 'Next Article')) . '</div>' : '';
        ?>
            <div class="entry-navigation py-2 border-top border-bottom mb-5">
                <div class="row">
                    <div class="pre-post col-12 col-md-6 text-capitalize">
                        <?php

                        if (!empty($prev_post)) { ?>
                            <small><?php echo wp_kses_post($prev_title); ?></small>
                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" title="<?php echo esc_attr(honrix_check_post_title($prev_post->post_title)); ?>" class="fs-5">
                                <div><?php echo wp_kses_post(honrix_check_post_title($prev_post->post_title)); ?></div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="next-post col-12 col-md-6 text-capitalize">
                        <?php

                        if (!empty($next_post)) { ?>
                            <small><?php echo wp_kses_post($next_title); ?></small>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo esc_attr(honrix_check_post_title($next_post->post_title)); ?>" class="fs-5">
                                <div><?php echo wp_kses_post(honrix_check_post_title($next_post->post_title)); ?></div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        endif;
    }
}

if (!function_exists('honrix_post_tags')) {
    function honrix_post_tags()
    {
        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'honrix'));
        if ($tags_list && !is_wp_error($tags_list)) :
        ?>
            <div class="entry-tags mb-4">
                <?php
                printf(
                    '<i class="fas fa-tags me-1"></i>%1$s',
                    wp_kses($tags_list, array('a' => array('href' => array(), 'rel' => array())))

                );
                ?>
            </div>
        <?php
        endif;
    }
}

if (!function_exists('honrix_post_avatar')) {
    function honrix_post_avatar($avatar_size = 100)
    {
        if (class_exists('WooCommerce')) {
            if (
                is_shop() ||
                is_cart() ||
                is_checkout() ||
                is_account_page() ||
                is_product_category() ||
                is_product_tag() ||
                is_product() ||
                is_wc_endpoint_url()
            ) {
                return;
            }
        }

        if ('post' === get_post_type()) : ?>
            <div class="entry-avatar py-2 d-flex">
                <?php
                $author_avatar_size = apply_filters('honrix_author_avatar_size', $avatar_size); ?>
                <span class="screen-reader-text"><?php esc_html_e('Used before post author name.', 'honrix'); ?></span>
                <div class="author-avatar me-3"><?php echo get_avatar(get_the_author_meta('user_email'), $author_avatar_size); ?></div>
                <div class="author-meta">
                    <div class="author-name"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="d-block fs-6 fw-bold text-decoration-none text-capitalize"><?php echo get_the_author(); ?></a>
                    </div>
                    <div class="author-description"><?php echo esc_html(get_the_author_meta('description')); ?></div>
                </div>
            </div>
        <?php
        endif;
    }
}

if (!function_exists('honrix_related_posts')) {
    function honrix_related_posts()
    { ?>
        <?php
        $categories = get_the_category();
        if (count($categories) > 0) :
        ?>

            <?php
            $terms = get_the_terms(get_the_ID(), 'category');

            if (empty($terms)) $terms = array();

            $term_list = wp_list_pluck($terms, 'slug');

            $related_args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'post__not_in' => array(get_the_ID()),
                //                        'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $term_list
                    )
                )
            );

            $the_query = new WP_Query($related_args);
            global $cl_from_element;
            $cl_from_element['is_related'] = true;
            if ($the_query->have_posts()) :
            ?>
                <div class="related-posts">
                    <h2 class="related-posts-title mb-2 fs-4">
                        <?php esc_html_e('Related Posts', 'honrix') ?>
                    </h2>
                    <div class="row">
                        <?php $counter = 1;
                        while ($the_query->have_posts() && $counter < 4) :
                            $the_query->the_post(); ?>
                            <div class="related-post col-12 col-md-4">

                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="related-post-thumbnail overflow-hidden ratio ratio-16x9">
                                            <?php the_post_thumbnail('honrix-blog-thumbnail'); ?>
                                        </div>
                                    <?php endif; ?>
                                </a>

                                <?php the_title(sprintf('<h2 class="related-post-title m-0 mt-2"><a href="%s" rel="bookmark" class="d-block fs-5 text-capitalize">', esc_url(get_permalink())), '</a></h2>'); ?>

                            </div>
                        <?php
                            $counter++;
                        endwhile;
                        ?>
                    </div>
                </div>
            <?php endif;

            wp_reset_query();
            $cl_from_element['is_related'] = false;
            ?>

            <?php endif;
    }
}

if (!function_exists('honrix_post_comment')) {
    function honrix_post_comment()
    {
        if (class_exists('WooCommerce')) {
            if (
                is_shop() ||
                is_cart() ||
                is_checkout() ||
                is_account_page() ||
                is_product_category() ||
                is_product_tag() ||
                is_product() ||
                is_wc_endpoint_url()
            ) {
                return;
            }
        }
        if (get_theme_mod('honrix_comment_display', 'yes') == 'yes') :
            if (comments_open() || get_comments_number()) : ?>
                <div class="entry-comment mt-5 border-top py-3">
                    <?php comments_template(); ?>
                </div>
            <?php elseif (!comments_open()) : ?>
            <?php
                $close_comment_msg = get_theme_mod('honrix_comment_close_message', __('Comments are closed for this section.', 'honrix'));
                if (!empty($close_comment_msg)) :
                    sprintf('<div class="entry-comment">%1$s</div>', $close_comment_msg);
                endif;
            endif;
        endif;
    }
}

if (!function_exists('honrix_post_date')) {
    function honrix_post_date()
    {
        if (class_exists('WooCommerce')) {
            if (
                is_shop() ||
                is_cart() ||
                is_checkout() ||
                is_account_page() ||
                is_product_category() ||
                is_product_tag() ||
                is_product() ||
                is_wc_endpoint_url()
            ) {
                return;
            }
        }
        if (is_page()) :
            ?>
            <div class="mb-3">
                <span class="entry-date me-4">
                    <small><i class="far fa-calendar me-1"></i><?php echo esc_html(get_the_date('M j, Y')); ?></small>
                </span>
            </div>
        <?php
        else : ?>
            <span class="entry-date me-4">
                <small><i class="far fa-calendar me-1"></i><?php echo esc_html(get_the_date('M j, Y')); ?></small>
            </span>
<?php endif;
    }
}
