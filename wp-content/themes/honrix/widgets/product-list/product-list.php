<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Product_List')) {
    class Honrix_Product_List extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
        }
        public function get_name()
        {
            return 'honrix_product_list';
        }

        public function get_title()
        {
            return __('Honrix: Product Grid', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-products';
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

            $this->add_control(
                'limit',
                [
                    'label' => esc_html__('Limit', 'honrix'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => -1,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => esc_html__('Columns', 'honrix'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'step' => 1,
                    'min'  => 2,
                    'max'  => 5,
                    'default' => 4,
                ]
            );

            $this->add_control(
                'pagination',
                [
                    'label' => esc_html__('Pagination', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__('Order By', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none' => esc_html__('None', 'honrix'),
                        'date' => esc_html__('Date', 'honrix'),
                        'title' => esc_html__('Title', 'honrix'),
                        'id' => esc_html__('ID', 'honrix'),
                        'popularity'  => esc_html__('Popularity', 'honrix'),
                        'rand' => esc_html__('Rand', 'honrix'),
                        'rating' => esc_html__('Rating', 'honrix'),
                    ],
                ]
            );

            $this->add_control(
                'on_sale',
                [
                    'label' => esc_html__('On Sale', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'best_selling',
                [
                    'label' => esc_html__('Best Selling', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'top_rated',
                [
                    'label' => esc_html__('Top Rated', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control('ids', [
                'label' => __('IDs', 'honrix'),
                'description' => __('Display by IDs (IDs seperated by comma ",")', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]);

            $this->add_control('skus', [
                'label' => __('SKUs', 'honrix'),
                'description' => __('Display by SKUs (SKUs seperated by comma ",")', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]);

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display(); ?>
            <div class="hrix-product-list">
                <?php echo do_shortcode('[products ' 
                .($settings['limit'] > -1 ? 'limit="'.$settings['limit'].'"' : '').' '
                . ($settings['columns'] > 0 ? 'columns="'.$settings['columns'].'"' : '').' '
                .($settings['orderby'] !== 'none' ? 'orderby="'.$settings['orderby'].'"' : ''). ' '
                .($settings['on_sale'] === 'yes' ? 'on_sale="true"' : ''). ' '
                .($settings['best_selling'] === 'yes' ? 'best_selling="true"' : ''). ' '
                .($settings['top_rated'] === 'yes' ? 'top_rated="true"' : ''). ' '
                .($settings['pagination'] === 'yes' ? 'paginate="true"' : ''). ' '
                .(!empty($settings['ids']) ? 'ids="'.$settings['ids'].'"' : ''). ' '
                .(!empty($settings['skus']) ? 'SKUs="'.$settings['skus'].'"' : ''). ' '
                .' ]'); ?>
            </div>
<?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Product_List()
    );
}
