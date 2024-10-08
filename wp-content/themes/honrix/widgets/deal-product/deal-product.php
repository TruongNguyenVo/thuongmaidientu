<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Deal_Product')) {
    class Honrix_Deal_Product extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_style(
                'honrix-deal-product-css',
                esc_url(
                    get_template_directory_uri() . '/widgets/assets/css/deal-product.css'
                ),
                ['honrix-style'],
                null
            );
        }
        public function get_name()
        {
            return 'honrix_deal_product';
        }

        public function get_title()
        {
            return __('Honrix: Deal Product', 'honrix');
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

            foreach ($products as $product) {
                $products_arr[strval($product->get_id())] = $product->get_title() . " (ID:" . $product->get_id() . ")";
            }

            $this->add_control(
                'products',
                [
                    'label' => esc_html__('Select Products', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => $products_arr,
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('title_style_section', [
                'label' => esc_html__('Title', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('title_color', [
                'label' => esc_html__('Title Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-deal-product .product-title' =>
                        'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_font',
                    'selector' => '{{WRAPPER}} .hrix-deal-product .product-title',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('price_style_section', [
                'label' => esc_html__('Price', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('sale_price_color', [
                'label' => esc_html__('Price Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#A56A5F',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-deal-product .price, {{WRAPPER}} .hrix-deal-product .price ins' =>
                        'color: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('price_color', [
                'label' => esc_html__('Sale Price Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-deal-product .price del' =>
                        'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'price_font',
                    'selector' => '{{WRAPPER}} .hrix-deal-product .price',
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();



            if ($settings['products']) :
?>
                <div class="hrix-deal-products d-flex gap-2 flex-wrap flex-lg-nowrap">
                    <?php
                    foreach ($settings['products'] as $item) :
                        $product = wc_get_product($item);

                        if ($product) :

                            $image = wp_get_attachment_url($product->get_image_id());
                    ?>
                            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                                <div class="hrix-deal-product row m-0">
                                    <div class="col-5 p-0">

                                        <div class="position-relative h-100">
                                            <img src="<?php echo esc_url($image); ?>" class="h-100" />
                                            <?php
                                            if ($product->is_on_sale()) {

                                                if ($product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped')) {

                                                    $regular_price     = get_post_meta($product->get_id(), '_regular_price', true);
                                                    $sale_price     = get_post_meta($product->get_id(), '_sale_price', true);

                                                    if (!empty($sale_price)) {
                                                        $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                                                        echo sprintf('<span class="onsale">-%1$s</span>', esc_html(number_format($percentage, 0, '', '')) . '%');
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex flex-column py-2">

                                        <h2 class="product-title m-0 mb-2"><?php echo esc_html($product->get_name()); ?></h2>

                                        <?php if (wc_review_ratings_enabled() && $product->get_average_rating() > 0) : ?>
                                            <div class="product-rating">
                                                <?php
                                                echo wc_get_rating_html($product->get_average_rating()); // WordPress.XSS.EscapeOutput.OutputNotEscaped.
                                                echo sprintf('%0.1f', $product->get_average_rating()); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($price_html = $product->get_price_html()) : ?>
                                            <span class="price"><?php echo wp_kses_post($price_html); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($product->get_stock_quantity())) : ?>
                                            <div class="mt-auto">
                                                <div class="progress">
                                                    <?php
                                                    $total = intval($product->get_stock_quantity()) + intval(get_post_meta($product->get_id(), 'total_sales', true));
                                                    $percentage = intval((intval(get_post_meta($product->get_id(), 'total_sales', true)) * 100) / $total);
                                                    ?>
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" style="width:<?php echo $percentage; ?>%">
                                                        <span class="sr-only"><?php echo $percentage; ?>% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progress-bar-details row align-items-center">
                                                    <div class="col-6">
                                                        <?php echo sprintf('<small>%s: <strong>%d</strong></small>', esc_html__('Available', 'honrix'), $product->get_stock_quantity()); ?>
                                                    </div>
                                                    <div class="col-6 d-flex align-items-center justify-content-end">
                                                        <?php echo sprintf('<small>%s: <strong>%d</strong></small>', esc_html__('Sold', 'honrix'), get_post_meta($product->get_id(), 'total_sales', true)); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </a>
                    <?php
                        endif;
                    endforeach; ?>
                </div>
<?php
            endif;
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Deal_Product()
    );
}
