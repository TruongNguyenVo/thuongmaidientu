<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Testimonial')) {
    class Honrix_Testimonial extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_style(
                'owl-carousel-css',
                esc_url(
                    HONRIX_TEMPLATE_URI .
                        '/lib/owlcarousel/assets/owl.carousel.min.css'
                ),
                ['font-awesome'],
                null
            );
            wp_enqueue_style(
                'honrix-testimonial-css',
                esc_url(
                    get_template_directory_uri() . '/widgets/assets/css/testimonial.css'
                ),
                ['honrix-style'],
                null
            );
            wp_enqueue_script(
                'owl-carousel-js',
                esc_url(
                    HONRIX_TEMPLATE_URI .
                        '/lib/owlcarousel/owl.carousel.min.js'
                ),
                ['wow-js'],
                '1.0.0',
                true
            );
            wp_enqueue_script('honrix-testimonial-js', esc_url(get_template_directory_uri() . '/widgets/assets/js/testimonial.js'), ['jquery'], '1.0.0', true);
        }
        public function get_name()
        {
            return 'honrix_testimonial';
        }

        public function get_title()
        {
            return __('Honrix: Testimonial', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-review';
        }

        public function get_categories()
        {
            return ['honrix-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('items_section', [
                'label' => __('Items', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'image',
                [
                    'label' => esc_html__('Choose Image', 'honrix'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control('name', [
                'label' => __('Name', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Name', 'honrix'),
                'label_block' => true,
            ]);

            $repeater->add_control('title', [
                'label' => __('Title', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('CEO', 'honrix'),
                'label_block' => true,
            ]);

            $repeater->add_control(
                'description',
                [
                    'label' => esc_html__('Description', 'honrix'),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'honrix'),
                    'placeholder' => esc_html__('Type your description here', 'honrix'),
                ]
            );

            $this->add_control('items_list', [
                'label' => esc_html__('Items', 'honrix'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]);

            $this->end_controls_section();

            /****Style */
            $this->start_controls_section('name_style_section', [
                'label' => esc_html__('Name', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('name_color', [
                'label' => esc_html__('Name Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .name' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_section();

            $this->start_controls_section('title_style_section', [
                'label' => esc_html__('Title', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('title_color', [
                'label' => esc_html__('Title Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .title' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_section();

            $this->start_controls_section('style_section', [
                'label' => esc_html__('Style', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('description_color', [
                'label' => esc_html__('Description Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .description' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'selector' => '{{WRAPPER}} .hrix-testimonial .testimonial-item',
                ]
            );

            $this->start_controls_tabs(
                'button_style_tabs'
            );

            $this->start_controls_tab(
                'item_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('item_bg_color', [
                'label' => esc_html__('Item Background Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .owl-item .testimonial-item' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'item_style_hover_tab',
                [
                    'label' => esc_html__('Active', 'honrix'),
                ]
            );

            $this->add_responsive_control('item_active_bg_color', [
                'label' => esc_html__('Item Background Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#cccccc',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .owl-item.center .testimonial-item' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('item_active_shadow_color', [
                'label' => esc_html__('Item Active Shadow Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .owl-item.center .testimonial-item' =>
                    'box-shadow: 0 0 30px {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->start_controls_tabs(
                'dot_style_tabs'
            );

            $this->start_controls_tab(
                'dot_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('dot_color', [
                'label' => esc_html__('Dot Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .owl-dot' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'dot_style_hover_tab',
                [
                    'label' => esc_html__('Active', 'honrix'),
                ]
            );

            $this->add_responsive_control('dot_active_color', [
                'label' => esc_html__('Dot Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-testimonial .owl-dot.active' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display(); ?>
            <div class="hrix-testimonial owl-carousel testimonial-carousel" data-wow-delay="0.6s">
                <?php if ($settings['items_list']) : ?>
                    <?php foreach ($settings['items_list'] as $item) : ?>
                        <div class="testimonial-item p-3 mx-2">
                            <div class="d-flex align-items-center border-bottom p-4">
                                <img class="img-fluid rounded" src="<?php echo esc_url(
                                                                        $item['image']['url']
                                                                    ); ?>" style="width: 60px; height: 60px;">
                                <div class="ps-4">
                                    <h4 class="name mb-1"><?php echo esc_html($item['name']); ?></h4>
                                    <small class="title text-uppercase"><?php echo esc_html($item['title']); ?></small>
                                </div>
                            </div>
                            <div class="description p-4">
                                <?php echo esc_html($item['description']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
<?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Testimonial()
    );
}
