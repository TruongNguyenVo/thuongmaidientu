<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_PriceList')) {
    class Honrix_PriceList extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_style(
                'honrix-pricelist-css',
                esc_url(
                    get_template_directory_uri() . '/widgets/assets/css/pricelist.css'
                ),
                ['honrix-style'],
                null
            );
        }
        public function get_name()
        {
            return 'honrix_price_list';
        }

        public function get_title()
        {
            return __('Honrix: Price List', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-price-table';
        }

        public function get_categories()
        {
            return ['honrix-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('items_section', [
                'label' => __('List', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control('title', [
                'label' => __('Title', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control('subtitle', [
                'label' => __('Sub Title', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control('price', [
                'label' => __('Price', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('99.00', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control('currency', [
                'label' => __('Currency', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('$', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control('period', [
                'label' => __('Period', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('/Monthly', 'honrix'),
                'label_block' => true,
            ]);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
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

            $repeater->add_control('text', [
                'label' => __('Text', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Item', 'honrix'),
                'label_block' => true,
            ]);

            $repeater->add_control(
                'item_active',
                [
                    'label' => esc_html__('Active', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'honrix'),
                    'label_off' => esc_html__('No', 'honrix'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control('items', [
                'label' => esc_html__('Items', 'honrix'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]);

            $this->add_control(
                'h_button',
                [
                    'label' => esc_html__('Button', 'honrix'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control('button_text', [
                'label' => __('Button Text', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Text', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control(
                'button_link',
                [
                    'label' => esc_html__('Button Link', 'honrix'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__('https://your-link.com', 'honrix'),
                    'options' => ['url', 'is_external', 'nofollow'],
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
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
                    '{{WRAPPER}} .hrix-pricelist .pricelist-title' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('subtitle_color', [
                'label' => esc_html__('Sub Title Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-subtitle' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_section();

            $this->start_controls_section('price_style_section', [
                'label' => esc_html__('Price', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('price_color', [
                'label' => esc_html__('Price Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-price' =>
                    'color: {{VALUE}}',
                ],
            ]);
            $this->end_controls_section();

            $this->start_controls_section('item_style_section', [
                'label' => esc_html__('Items', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('item_text_color', [
                'label' => esc_html__('Item Text Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-item' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('item_active_icon_color', [
                'label' => esc_html__('Item Active Icon Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffbd28',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-item-icon.active' =>
                    'fill: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('item_deactive_icon_color', [
                'label' => esc_html__('Item Deactive Icon Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ec2635',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-item-icon.deactive' =>
                    'fill: {{VALUE}}',
                ],
            ]);

            $this->end_controls_section();

            $this->start_controls_section('button_style_section', [
                'label' => esc_html__('Button', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->start_controls_tabs(
                'button_style_tabs'
            );

            $this->start_controls_tab(
                'button_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('button_bg_color', [
                'label' => esc_html__('Button Background Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-button' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('button_color', [
                'label' => esc_html__('Button Text Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffbd28',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-button' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'button_style_hover_tab',
                [
                    'label' => esc_html__('Hover', 'honrix'),
                ]
            );

            $this->add_responsive_control('button_bg_hover_color', [
                'label' => esc_html__('Button Background Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-button:hover' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('button_hover_color', [
                'label' => esc_html__('Button Text Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-pricelist .pricelist-button:hover' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'selector' => '{{WRAPPER}} .hrix-pricelist .pricelist-button',
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display(); ?>
            <div class="hrix-pricelist">
                <div class="border-bottom pb-4 mb-4">
                    <h4 class="pricelist-title mb-1"><?php echo esc_html($settings['title']); ?></h4>
                    <small class="pricelist-subtitle text-uppercase"><?php echo esc_html($settings['subtitle']); ?></small>
                </div>
                <div class="">
                    <h3 class="pricelist-price fs-2 mb-3">
                        <small class="align-top" style="font-size: 22px; line-height: 45px;"><?php echo esc_html($settings['currency']); ?></small>
                        <?php echo esc_html($settings['price']); ?>
                        <small class="align-bottom" style="font-size: 16px; line-height: 40px;"><?php echo esc_html($settings['period']); ?></small>
                        </h1>
                        <?php if ($settings['items']) : ?>
                            <?php foreach ($settings['items'] as $item) : ?>
                                <div class="pricelist-item d-flex gap-2 mb-3">
                                    <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => 'pricelist-item-icon ' . esc_attr($item['item_active'] == 'yes' ? 'active' : 'deactive')]); ?>
                                    <span><?php echo esc_html($item['text']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="pricelist-button btn py-2 px-4 mt-4"><?php echo esc_html($settings['button_text']); ?></a>
                </div>
            </div>
<?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_PriceList()
    );
}
