<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Special_Product')) {
    class Honrix_Special_Product extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_style(
                'honrix-special-product-css',
                esc_url(
                    get_template_directory_uri() . '/widgets/assets/css/special-product.css'
                ),
                ['honrix-style'],
                null
            );
            wp_enqueue_script('honrix-special-product-js', esc_url(get_template_directory_uri() . '/widgets/assets/js/date-countdown.js'), ['jquery'], '1.0.0', true);
        }
        public function get_name()
        {
            return 'honrix_special_product';
        }

        public function get_title()
        {
            return __('Honrix: Special Product', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-basket-light';
        }

        public function get_categories()
        {
            return ['honrix-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('layout_section', [
                'label' => __('Layout', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $products = wc_get_products(array('status' => 'publish', 'limit' => -1));

            $products_arr = [];

            $products_arr[0] = 'Select';

            foreach ($products as $product) {
                $products_arr[strval($product->get_id())] = $product->get_title() . " (ID:" . $product->get_id() . ")";
            }

            $this->add_control(
                'product',
                [
                    'label' => esc_html__('Select Product', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => $products_arr,
                ]
            );

            $this->add_control(
                'timer_display',
                [
                    'label' => esc_html__('Display Timer', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'honrix'),
                    'label_off' => esc_html__('Hide', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();

            $product = wc_get_product($settings['product']);

            if ($product) :

                $image = wp_get_attachment_url($product->get_image_id());

?>
                <div class="hrix-special-product">

                    <a href="<?php echo get_permalink($product->get_id()); ?>">
                        <?php
                        if ($product->is_on_sale()) {

                            if ($product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped')) {

                                $regular_price     = get_post_meta($product->get_id(), '_regular_price', true);
                                $sale_price     = get_post_meta($product->get_id(), '_sale_price', true);

                                if (!empty($sale_price)) {
                                    $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                                    echo '<span class="onsale">-' . number_format($percentage, 0, '', '') . '%</span>';
                                }
                            }
                        }
                        ?>
                        <div class="position-relative">
                            <img src="<?php echo $image; ?>" />
                            <?php
                            if (defined('YITH_WCWL')) {
                                echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                            }

                            if ($product->get_type() == 'simple') {
                                if ($product->get_stock_quantity() > 0 && $product->get_stock_quantity() < 10) {
                                    echo '<div class="leftstock">Only ' . $product->get_stock_quantity() . ' left in stock!</div>';
                                }
                            } 
                            // else if ($product->get_type() == 'variable') {
                            //     $variations = $product->get_available_variations();
                            //     foreach ($variations as $variation) {
                            //         if (isset($variation['max_qty'])) {
                            //             $attr_string = [];
                            //             foreach ($variation['attributes'] as $attr_name => $attr_value) {
                            //                 $attr_string[] = $attr_value;
                            //             }
                            //             if ($variation['max_qty'] > 0 && $variation['max_qty'] < 10) {
                            //                 echo '<div class="leftstock">' . implode(', ', $attr_string) . ' - Only ' . $variation['max_qty'] . ' left in stock!</div>';
                            //             } else if ($variation['max_qty'] < 1) {
                            //                 echo '<div class="leftstock">' . implode(', ', $attr_string) . ' - Out of stock!</div>';
                            //             }
                            //         }
                            //     }
                            // } 
                            ?>
                        </div>
                        <div class="d-flex align-items-center">
                            <h2 class="product-title"><?php echo $product->get_name(); ?></h2>
                            <span class="product-rating d-flex align-items-center justify-content-end">
                                <div class="star-rating" role="img">
                                    <span style="width:100%">
                                        <strong>1</strong>
                                    </span>
                                </div>
                                <?php echo sprintf('%0.1f', $product->get_average_rating()); ?>
                            </span>
                        </div>

                        <div class="hrix-price d-flex align-items-end">
                            <?php if ($price_html = $product->get_price_html()) : ?>
                                <span class="price"><?php echo $price_html; ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ('yes' === $settings['timer_display']) : ?>
                            <div class="hrix-timer">
                                <span class="days"></span>:
                                <span class="hours"></span>:
                                <span class="minutes"></span>:
                                <span class="seconds"></span>
                            </div>
                        <?php endif; ?>
                    </a>
                    <?php
                    if ('yes' === $settings['timer_display']) {
                        if (null !== $product->get_date_on_sale_to()) {
                            $date = $product->get_date_on_sale_to()->date("M d, Y H:i:s");
                            wp_localize_script('honrix-special-product-js', 'hrix_special_product', array(
                                'id' => 'elementor-element-' . $this->get_id(),
                                'date' => $date,
                            ));
                        }
                    }
                    ?>
                </div>
<?php
            endif;
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Special_Product()
    );
}
