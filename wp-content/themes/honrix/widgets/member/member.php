<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Member')) {
    class Honrix_Member extends Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_style(
                'honrix-member-css',
                esc_url(
                    get_template_directory_uri() . '/widgets/assets/css/member.css'
                ),
                ['honrix-style'],
                null
            );
        }
        public function get_name()
        {
            return 'honrix_member';
        }

        public function get_title()
        {
            return __('Honrix: Member', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-person';
        }

        public function get_categories()
        {
            return ['honrix-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('content_section', [
                'label' => __('Member', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control(
                'image',
                [
                    'label' => esc_html__('Choose Image', 'honrix'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control('name', [
                'label' => __('Name', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Name', 'honrix'),
                'label_block' => true,
            ]);

            $this->add_control('title', [
                'label' => __('Title', 'honrix'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('CEO', 'honrix'),
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

            $repeater->add_control(
                'link',
                [
                    'label' => esc_html__('Link', 'honrix'),
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

            $this->add_control('social_list', [
                'label' => esc_html__('Social Media', 'honrix'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]);

            $this->end_controls_section();

            /****Style */
            $this->start_controls_section('style_section', [
                'label' => esc_html__('Colors', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('name_color', [
                'label' => esc_html__('Name Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-member .name' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('title_color', [
                'label' => esc_html__('Title Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-member .title' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->start_controls_tabs(
                'icon_style_tabs'
            );

            $this->start_controls_tab(
                'icon_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('icon_bg_color', [
                'label' => esc_html__('Social Icon Background Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-member .team-social a' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('icon_color', [
                'label' => esc_html__('Social Icon Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffbd28',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-member .team-social a' =>
                    'color: {{VALUE}}',
                    '{{WRAPPER}} .hrix-member .team-social a svg path' =>
                    'fill: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'icon_style_hover_tab',
                [
                    'label' => esc_html__('Hover', 'honrix'),
                ]
            );

            $this->add_responsive_control('icon_bg_hover_color', [
                'label' => esc_html__('Social Icon Background Hover Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-member .team-social a:hover' =>
                    'background: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('icon_hover_color', [
                'label' => esc_html__('Social Icon Hover Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-member .team-social a:hover' =>
                    'color: {{VALUE}}',
                    '{{WRAPPER}} .hrix-member .team-social a:hover svg path' =>
                    'fill: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display(); ?>
            <div class="hrix-member slideInUp" data-wow-delay="0.3s">
                <div class="team-item overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo esc_url(
                                                                $settings['image']['url']
                                                            ); ?>" alt="">
                        <div class="team-social">
                            <?php if ($settings['social_list']) : ?>
                                <?php foreach ($settings['social_list'] as $item) : ?>
                                    <a class="btn btn-lg btn-lg-square" href="<?php echo esc_url($item['link']['url']); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="name"><?php echo esc_html($settings['name']); ?></h4>
                        <p class="title text-uppercase m-0 fw-bold"><?php echo esc_html($settings['title']); ?></p>
                    </div>
                </div>
            </div>
<?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Member()
    );
}
