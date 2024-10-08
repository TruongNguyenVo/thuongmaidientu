<?php
/*
 * Template for displaying comments for posts
 *
 * package honrix
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php
    $comment_args = array(
        'title_reply' => esc_html__('Leave a reply', 'honrix'),
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '<div class="comment-form-info"><p class="comment-form-author">' .
                '<input id="author" name="author" class="border p-2 w-100" placeholder="' . esc_html__('Name', 'honrix') . ($req ? ' *' : '') . '" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></p>',
            'email' => '<p class="comment-form-email">' .
                '<input id="email" name="email" class="border p-2 w-100" placeholder="' . esc_html__('Email', 'honrix') . ($req ? ' *' : '') . '" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" />' . '</p></div>',
            'url' => ''
        )),
        'comment_field' => '<p class="comment-form-comment">' .
            '<textarea id="comment" placeholder="' . esc_html__('Write a Comment', 'honrix') . ' *" name="comment" cols="45" aria-required="true" class="border p-2 w-100"></textarea>' .
            '</p>',
        'comment_notes_after' => '',
        'comment_notes_before' => '',
    );
    comment_form($comment_args);
    ?>
    <?php if (have_comments()) { ?>
        <h3 class="comments-title position-relative text-capitalize d-flex text-center align-items-center m-0 my-3 fs-5">
            <?php
            $comments_number = get_comments_number(); ?>
            <?php if ('0' === $comments_number) : ?>
                <?php esc_html_e("0 Comment", 'honrix') ?>
            <?php elseif ('1' === $comments_number) : ?>
                <?php esc_html_e("One Comment", 'honrix') ?>
            <?php else : ?>
                <?php echo esc_html($comments_number); ?><?php esc_html_e(" Comments", 'honrix') ?>
            <?php endif; ?>
            <span class="position-relative flex-grow-1 border h-0 ms-2"></span>
        </h3>

        <ul class="comment-list list-unstyled p-0">
            <?php
            wp_list_comments(
                array(
                    'short_ping' => true,
                    'avatar_size' => 50,
                    'callback' => 'honrix_custom_comment_list'
                )
            );
            ?>
        </ul>

        <div class="comment-pagination">
            <?php paginate_comments_links(array('prev_text' => __('<i class="fas fa-angle-left"></i>', 'honrix'), 'next_text' => __('<i class="fas fa-angle-right"></i>', 'honrix'))); ?>
        </div>

    <?php }
    ?>

</div>