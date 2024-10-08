<?php

// namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('Honrix_Posts')) {
    class Honrix_Posts extends Elementor\Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
            wp_enqueue_style(
                'honrix-posts-css',
                esc_url(
                    get_template_directory_uri() . '/widgets/assets/css/posts.css'
                ),
                ['honrix-style'],
                null
            );
        }
        public function get_name()
        {
            return 'honrix_posts';
        }

        public function get_title()
        {
            return __('Honrix: Posts', 'honrix');
        }

        public function get_icon()
        {
            return 'eicon-post-list';
        }

        public function get_categories()
        {
            return ['honrix-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('items_section', [
                'label' => __('Posts', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_responsive_control(
                'count',
                [
                    'label' => esc_html__('Display Count', 'honrix'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 6,
                    'step' => 1,
                    'default' => 3
                ]
            );

            $this->add_control(
                'column',
                [
                    'label' => esc_html__('Display Columns', 'honrix'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => esc_html__('1', 'honrix'),
                        '2' => esc_html__('2', 'honrix'),
                        '3'  => esc_html__('3', 'honrix'),
                        '4' => esc_html__('4', 'honrix'),
                    ],
                ]
            );

            $this->end_controls_section();

            /***style */
            $this->start_controls_section('categories_style_section', [
                'label' => esc_html__('Categories', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('categories_icon_color', [
                'label' => esc_html__('Icon Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-categories svg' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->start_controls_tabs(
                'categories_style_tabs'
            );

            $this->start_controls_tab(
                'item_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('categories_color', [
                'label' => esc_html__('Name Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-categories a' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'categories_style_hover_tab',
                [
                    'label' => esc_html__('Hover', 'honrix'),
                ]
            );

            $this->add_responsive_control('categories_hover_color', [
                'label' => esc_html__('Name Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-categories a:hover' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'category_font',
                    'selector' => '{{WRAPPER}} .hrix-posts article .entry-categories a',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('title_style_section', [
                'label' => esc_html__('Title', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->start_controls_tabs(
                'title_style_tabs'
            );

            $this->start_controls_tab(
                'title_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('title_color', [
                'label' => esc_html__('Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-title a' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'title_style_hover_tab',
                [
                    'label' => esc_html__('Hover', 'honrix'),
                ]
            );

            $this->add_responsive_control('title_hover_color', [
                'label' => esc_html__('Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-title a:hover' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_font',
                    'selector' => '{{WRAPPER}} .hrix-posts article .entry-title a',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('content_style_section', [
                'label' => esc_html__('Content', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('content_color', [
                'label' => esc_html__('Content Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-content' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_font',
                    'selector' => '{{WRAPPER}} .hrix-posts article .entry-content',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('read_more_style_section', [
                'label' => esc_html__('Read More', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->start_controls_tabs(
                'read_more_style_tabs'
            );

            $this->start_controls_tab(
                'read_more_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('read_more_color', [
                'label' => esc_html__('Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-read-more a' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'read_more_style_hover_tab',
                [
                    'label' => esc_html__('Hover', 'honrix'),
                ]
            );

            $this->add_responsive_control('read_more_hover_color', [
                'label' => esc_html__('Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-read-more a:hover' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'read_more_font',
                    'selector' => '{{WRAPPER}} .hrix-posts article .entry-read-more a',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section('footer_style_section', [
                'label' => esc_html__('Footer', 'honrix'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control('footer_text_color', [
                'label' => esc_html__('Text Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .date' =>
                    'color: {{VALUE}}',
                    '{{WRAPPER}} .hrix-posts article .comments' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->add_responsive_control('footer_icon_color', [
                'label' => esc_html__('Icon Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .date svg' =>
                    'color: {{VALUE}}',
                    '{{WRAPPER}} .hrix-posts article .comments svg' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->start_controls_tabs(
                'footer_link_style_tabs'
            );

            $this->start_controls_tab(
                'footer_link_style_normal_tab',
                [
                    'label' => esc_html__('Normal', 'honrix'),
                ]
            );

            $this->add_responsive_control('footer_link_color', [
                'label' => esc_html__('Link Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#031424',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-author .author-name a' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'footer_link_style_hover_tab',
                [
                    'label' => esc_html__('Hover', 'honrix'),
                ]
            );

            $this->add_responsive_control('footer_link_hover_color', [
                'label' => esc_html__('Link Color', 'honrix'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .hrix-posts article .entry-author .author-name a:hover' =>
                    'color: {{VALUE}}',
                ],
            ]);

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'footer_font',
                    'selector' => '{{WRAPPER}} .hrix-posts article .entry-author .author-name ,{{WRAPPER}} .hrix-posts article .date',
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();
            $related_args = [
                'post_type' => 'post',
                'posts_per_page' => $settings['count'],
                'post_status' => 'publish',
            ];

            $the_query = new WP_Query($related_args);
            if ($the_query->have_posts()) : ?>
                <div class="hrix-posts d-flex column-<?php echo esc_attr($settings['column']); ?>">
                    <?php
                    while ($the_query->have_posts()) :
                        $the_query->the_post(); ?>
                        <article class="d-flex flex-column">
                            <a class="d-block mb-2" href="<?php echo esc_url(get_permalink()) ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail overflow-hidden ratio ratio-16x9">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <?php
                            $categories_list = get_the_category_list(_x('', 'Used between list items, there is a space after the comma.', 'honrix'));
                            if ($categories_list) : ?>
                                <span class="entry-categories mb-2">
                                    <?php printf('<span class="screen-reader-text">%1$s </span><i class="far fa-folder-open me-1"></i>%2$s', esc_html__('Used before category names.', 'honrix'), wp_kses($categories_list, array('a' => array('href' => array(), 'rel' => array())))); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (is_sticky()) : ?>
                                <?php
                                the_title(sprintf('<h2 class="entry-title mb-2 fs-5 d-flex align-items-center gap-2"><span class="fas fa-thumbtack"></span><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                ?>
                            <?php else : ?>
                                <?php the_title(sprintf('<h2 class="entry-title mb-2 fs-5"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                            <?php endif; ?>

                            <?php
                            $display_read_more_text = get_theme_mod('honrix_archive_content_read_more_text', __('Continue Reading...', 'honrix'));
                            ?>
                            <?php honrix_entry_content(); ?>
                            <div class="entry-body mt-auto">
                                <div class="entry-read-more mb-2 pb-2">
                                    <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark"><?php echo esc_html($display_read_more_text) ?></a>
                                </div>
                                <div class="row align-items-center mb-2">
                                    <div class="col-6">
                                        <div class="entry-author d-flex align-items-center">
                                            <div class="avatar me-2">
                                                <?php
                                                $author_avatar_size = apply_filters('honrix_author_avatar_size', 24);
                                                echo get_avatar(get_the_author_meta('user_email'), $author_avatar_size); ?>
                                            </div>
                                            <div class="author-name">
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex align-items-center justify-content-end">
                                        <span class="date"><i class="far fa-calendar me-1"></i><small><?php echo esc_html(get_the_date('M j, Y')); ?></small></span>
                                        <span class="comments ms-2">
                                            <?php if (comments_open() && intval(get_comments_number()) > 0) : ?>
                                                <i class="far fa-comments me-1"></i> <small><?php echo intval(get_comments_number()); ?></small>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php
                    endwhile; ?>
                </div>
            <?php endif; ?>
<?php
        }
    }
    Elementor\Plugin::instance()->widgets_manager->register_widget_type(
        new Honrix_Posts()
    );
}
