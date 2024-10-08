<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Category_List')) {
    class Honrix_Category_List extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
        }
        public function get_name()
        {
            return 'honrix_category_list';
        }

        public function get_title()
        {
            return __('Honrix: Categories Grid', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-product-related';
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
                'thumbnail',
                [
                    'label' => esc_html__('Display Thumbnail', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'thumbnail_rounded',
                [
                    'label' => esc_html__('Thumbnail Radius', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'circle',
                    'options' => [
                        'none' => esc_html__('None', 'honrix'),
                        'circle' => esc_html__('Circle', 'honrix')
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail_dimension',
                    'include' => [],
                    'default' => 'large',
                ]
            );

            $this->add_control(
                'limit',
                [
                    'label' => esc_html__('Limit', 'honrix'),
                    'description' => esc_html__('Limit 0 displays all categories.', 'honrix'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 0,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => esc_html__('Columns', 'honrix'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'step' => 1,
                    'min'  => 1,
                    'max'  => 12,
                    'default' => 4,
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
                        'title' => esc_html__('Title', 'honrix'),
                        'id' => esc_html__('ID', 'honrix'),
                        'name'  => esc_html__('Name', 'honrix')
                    ],
                ]
            );

            $this->add_control(
                'hide_empty',
                [
                    'label' => esc_html__('Hide Empty', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control('ids', [
                'label' => __('IDs', 'honrix'),
                'description' => __('Display by IDs (IDs seperated by comma ",")', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                // 'default' => __('Title', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control(
                'product_count',
                [
                    'label' => esc_html__('Display Product Counts', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control('product_count_title', [
                'label' => __('Product Counts Title', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Products', 'honrix'),
                'label_block' => true,
            ]);

            $this->end_controls_section();

            $this->start_controls_section('thumbnail_style_section', [
                'label' => esc_html__('Thumbnail', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('img_bg_color', [
                'label' => esc_html__('Image Background Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-category-list .hrix-thumbnail img' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'selector' => '{{WRAPPER}} .hrix-category-list .hrix-thumbnail img',
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
                    '{{WRAPPER}} .hrix-category-list .hrix-title' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_font',
                    'selector' => '{{WRAPPER}} .hrix-category-list .hrix-title',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('products_style_section', [
                'label' => esc_html__('Product Count', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('count_color', [
                'label' => esc_html__('Product Counts Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-category-list .hrix-count' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'count_font',
                    'selector' => '{{WRAPPER}} .hrix-category-list .hrix-count',
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();

            $orderby      = ($settings['orderby'] !== 'none' && $settings['orderby'] !== 'name') ? $settings['orderby'] : 'name';
            $empty        = $settings['hide_empty'] === 'yes' ? 1 : 0;
            $limit        = intval($settings['limit']);
            $parent       = 0;
            $ids          = esc_attr($settings['ids']);

            $args = array(
                'taxonomy'     => 'product_cat',
                'orderby'      => $orderby,
                'hide_empty'   => $empty,
                'number'       => $limit,
                'parent'       => $parent,
                'ids'          => $ids
            );

            $all_categories = get_categories($args); ?>
            <div class="hrix-category-list d-flex flex-wrap">
                <?php foreach ($all_categories as $cat) : ?>
                    <a href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>" class="col-6 col-md-4 col-lg-<?php echo intval(12 / $settings['columns']); ?>  text-center mb-5 mb-md-0">
                        <?php
                        if ($settings['thumbnail'] === 'yes') :
                            $thumbnail_size = [];
                            $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, 'thumbnail_dimension', $settings);
                            if (!$image_url) {
                                if ($settings['thumbnail_dimension_size'] === 'custom') {
                                    $thumbnail_size['width'] = $settings['thumbnail_dimension_custom_dimension']['width'];
                                    $thumbnail_size['height'] = $settings['thumbnail_dimension_custom_dimension']['height'];
                                }
                                $image_url = wc_placeholder_img_src($settings['thumbnail_dimension_size']);
                            }
                        ?>
                            <div class="hrix-thumbnail text-center">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($cat->name); ?>" <?php echo count($thumbnail_size) > 0 ? 'width="' . $thumbnail_size["width"] . '" height="' . $thumbnail_size["height"] . '"' : ''; ?> class="<?php echo $settings['thumbnail_rounded'] === 'circle' ? "rounded-circle":""; ?>" />
                            </div>
                        <?php endif; ?>
                        <h4 class="hrix-title mt-2 mb-0 fs-5"><?php echo esc_html($cat->name); ?></h4>
                        <?php if ($settings['product_count'] === 'yes') : ?>
                            <div class="hrix-count"><small><?php echo intval($cat->count); ?> <?php echo esc_html($settings['product_count_title']); ?></small></div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
<?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Category_List()
    );
}
