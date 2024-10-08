<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Counter')) {
    class Honrix_Counter extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_script(
                'counterup-js',
                esc_url(
                    HONRIX_TEMPLATE_URI . '/lib/counterup/counterup.min.js'
                ),
                ['bootstrap-js'],
                '1.0.0',
                true
            );
            wp_enqueue_script('honrix-counter-js', esc_url(get_template_directory_uri() . '/widgets/assets/js/counter.js'), ['jquery'], '1.0.0', true);
        }
        public function get_name()
        {
            return 'honrix_counter';
        }

        public function get_title()
        {
            return __('Honrix: Counter', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-counter';
        }

        public function get_categories()
        {
            return ['honrix-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('items_section', [
                'label' => __('Layout', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control(
                'icon',
                [
                    'label' => esc_html__('Icon', 'honrix'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-circle',
                        'library' => 'fa-solid',
                    ],
                    'recommended' => [
                        'fa-solid' => [
                            'circle',
                            'dot-circle',
                            'square-full',
                        ],
                        'fa-regular' => [
                            'circle',
                            'dot-circle',
                            'square-full',
                        ],
                    ],
                ]
            );

            $this->add_control('title', [
                'label' => __('Title', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control(
                'count',
                [
                    'label' => esc_html__('Count', 'honrix'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 10,
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('Counter_style_section', [
                'label' => esc_html__('Style', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('icon_color', [
                'label' => esc_html__('Icon Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-counter .hrix-counter-icon svg' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('title_color', [
                'label' => esc_html__('Title Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-counter .hrix-counter-title' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_font',
                    'label' => esc_html__('Title Typography', 'honrix'),
                    'selector' => '{{WRAPPER}} .hrix-counter .hrix-counter-title',
                ]
            );

            $this->add_responsive_control('count_color', [
                'label' => esc_html__('Count Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-counter .hrix-counter-count' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'count_font',
                    'label' => esc_html__('Count Typography', 'honrix'),
                    'selector' => '{{WRAPPER}} .hrix-counter .hrix-counter-count',
                    'default' => [
                        'font_weight' => '700',
                        'font_size'      => '24px',
                    ]
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display(); ?>
            <div class="hrix-counter wow zoomIn" data-wow-delay="0.1s">
                <div class="hrix-counter-icon mb-2 fs-3 text-center">
                    <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true', 'class' => 'w-25']); ?>
                </div>
                <div class="">
                    <h5 class="hrix-counter-title text-center mb-0"><?php echo esc_html($settings['title']); ?></h5>
                    <div class="hrix-counter-count text-center mb-0 mt-2" data-toggle="counter-up"><?php echo esc_html($settings['count']); ?></div>
                </div>
            </div>
<?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Counter()
    );
}
