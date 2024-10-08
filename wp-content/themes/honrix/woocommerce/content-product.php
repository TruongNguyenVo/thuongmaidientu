<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<li <?php wc_product_class('', $product); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action('woocommerce_before_shop_loop_item');

	?>
	<div class="position-relative">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action('woocommerce_before_shop_loop_item_title');

		global $product;
		if ($product->get_type() == 'simple') {
			$stock = $product->get_stock_quantity();
			$stock_treshhold = $product->get_low_stock_amount();
			if (!empty($stock_treshhold)) {
				if ($stock <= $stock_treshhold) {
					if ($stock === 0) {
						echo '<div class="stock in-stock">' . __('SOLD OUT', 'honrix') . '</div>';
					} elseif ($product->is_in_stock()) {
						echo '<div class="stock in-stock">' . __('Only ', 'honrix') . $stock . __(' left in stock', 'honrix') . '</div>';
					}
				}
			}
		}
		?>
	</div>
	<div class="d-flex flex-wrap flex-md-nowrap">
		<?php

		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action('woocommerce_shop_loop_item_title');


		if (wc_review_ratings_enabled() && $product->get_average_rating() > 0) {
			echo '<span class="hrix-products-rating d-flex justify-content-start justify-content-md-end"><div class="star-rating" role="img"><span style="width:100%"><strong>1</strong></span></div>' . sprintf('%0.1f', $product->get_average_rating()) . '</span>';
		}

		?>
	</div>
	<?php

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action('woocommerce_after_shop_loop_item_title');

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action('woocommerce_after_shop_loop_item');
	?>
</li>