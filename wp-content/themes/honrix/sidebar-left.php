<?php if (class_exists('WooCommerce')) : ?>
    <?php if (is_shop() || is_product_category() || is_product_tag()) : ?>
        <?php if (is_active_sidebar('shop_left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('shop_left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php elseif (is_product()) : ?>
        <?php if (is_active_sidebar('product_left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('product_left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php elseif (is_single() && !is_page()) : ?>
        <?php if (is_active_sidebar('post_left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('post_left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php elseif (is_page()) : ?>
        <?php if (is_active_sidebar('page_left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('page_left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?php if (is_active_sidebar('left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else : ?>
    <?php if (is_single() && !is_page()) : ?>
        <?php if (is_active_sidebar('post_left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('post_left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php elseif (is_page()) : ?>
        <?php if (is_active_sidebar('page_left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('page_left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?php if (is_active_sidebar('left_sidebar')) : ?>
            <div class="sidebar-left sidebar pt-5 pt-md-0">
                <?php dynamic_sidebar('left_sidebar'); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>