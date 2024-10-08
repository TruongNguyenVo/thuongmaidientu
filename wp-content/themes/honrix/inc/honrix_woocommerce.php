<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start(); ?>
    <div class="minicart-content d-flex flex-column">
        <?php woocommerce_mini_cart(); ?>
    </div>
<?php
    $fragments['.minicart-content'] = ob_get_clean();

    return $fragments;
});

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start(); ?>
    <span class="hrix-header-minicart-count">
        <?php
        if (WC()->cart->get_cart_contents_count() > 0) :
        ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                <?php printf(esc_html__('%d', 'honrix'), WC()->cart->get_cart_contents_count()); ?>
            </span>
        <?php
        endif; ?>
    </span>
    <?php
    $fragments['.hrix-header-minicart-count'] = ob_get_clean();

    return $fragments;
});

add_filter('woocommerce_sale_flash', 'honrix_change_sale_text');
function honrix_change_sale_text()
{
    global $product;
    if ($product->is_on_sale()) {

        if ($product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped')) {

            $regular_price     = get_post_meta($product->get_id(), '_regular_price', true);
            $sale_price     = get_post_meta($product->get_id(), '_sale_price', true);

            if (!empty($sale_price)) {
                $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                return '<span class="onsale">-' . number_format($percentage, 0, '', '') . '%</span>';
            }
        }
    }
    return '<span class="onsale">Sale!</span>';
}

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);


if (defined('YITH_WCWL') && !function_exists('honrix_yith_wcwl_ajax_update_count')) {
    function honrix_yith_wcwl_ajax_update_count()
    {
        wp_send_json(array(
            'count' => yith_wcwl_count_all_products()
        ));
    }
    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'honrix_yith_wcwl_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'honrix_yith_wcwl_ajax_update_count');
}

if (defined('YITH_WCWL') && !function_exists('honrix_yith_wcwl_enqueue_custom_script')) {
    function honrix_yith_wcwl_enqueue_custom_script()
    {
        wp_add_inline_script(
            'jquery-yith-wcwl',
            "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              
              if(data.count === 0){
                $('.yith-wcwl-items-count').html('' );
              }else{
                $('.yith-wcwl-items-count').html(data.count );
              }
            } );
          } );
        } );
      "
        );
    }

    add_action('wp_enqueue_scripts', 'honrix_yith_wcwl_enqueue_custom_script', 20);
}
