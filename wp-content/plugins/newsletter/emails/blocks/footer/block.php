<?php

/*
 * Name: Footer
 * Section: footer
 * Description: View online ad profile links
 */

$defaults = array(
    'show_company' => 1,
    'show_logo' => 1,
    'show_motto' => 1,
    'show_socials' => 1,
    'social_type' => 4,
    //
    'view' => __('View online', 'newsletter'),
    'view_enabled' => 1,
    //
    'profile' => __('Manage your subscription', 'newsletter'),
    'profile_enabled' => 1,
    //
    'unsubscribe' => __('Unsubscribe', 'newsletter'),
    'unsubscribe_enabled' => 1,
    //
    'font_family' => '',
    'font_size' => '',
    'font_color' => '',
    'font_weight' => '',
    //
    'logo_width' => 120,
    //
    'block_layout' => 'default',
    'block_style' => '', // no block style to apply by default
    //
    'block_padding_left' => 16,
    'block_padding_right' => 16,
    'block_padding_bottom' => 24,
    'block_padding_top' => 24,
    'block_background' => '',
    'block_background_wide' => '0',
);

$styles = [
    'default' => [
        'block_background' => '',
        'block_background_2' => '',
        'font_color' => '',
        'font_family' => '',
        'font_size' => '',
        'font_weight' => '',
        'title_font_color' => '',
        'title_font_weight' => '',
        'title_font_family' => '',
        'title_font_size' => '',
        'block_border_radius' => 0,
        'block_border_color' => '',
        'social_type' => 4,
    ],
    'inverted' => [
        'block_background' => '#000000',
        'font_color' => '#cccccc',
        'title_font_color' => '#ffffff',
        'title_font_weight' => 'bold',
        'block_border_radius' => 0,
        'block_border_color' => '',
        'social_type' => 3,
        'block_background_wide' => '1',
    ],
    'boxed' => [
        'block_background' => '#eeeeee',
        'font_color' => '#333333',
        'title_font_color' => '#333333',
        'title_font_weight' => 'bold',
        'block_border_radius' => 15,
        'block_border_color' => '#dddddd',
        'block_background_wide' => '0',
    ]
];

// Migration code
if (!isset($options['profile_enabled']) && isset($options['url'])) {
    if ($options['url'] === 'profile') {
        $options['profile_enabled'] = 1;
        $options['unsubscribe_enabled'] = 0;
    } else {
        $options['profile_enabled'] = 1;
        $options['unsubscribe_enabled'] = 0;
    }
}

// Old set of settings
if (!empty($options['view']) && !isset($options['block_layout'])) {
    $options['show_company'] = 0;
    $options['show_motto'] = 0;
    $options['show_logo'] = 0;
    $options['show_socials'] = 0;
}

$options = array_merge($defaults, $options);
$block_style = $options['block_style'] ?? 'default';
$options = array_merge($options, $styles[$block_style] ?? []);

$links = [];
if ($options['unsubscribe_enabled']) {
    $links[] = '<a inline-class="text" href="{unsubscription_url}" target="_blank">' . esc_html($options['unsubscribe']) . '</a>';
}
if ($options['profile_enabled']) {
    $links[] = '<a inline-class="text" href="{profile_url}" target="_blank">' . esc_html($options['profile']) . '</a>';
}
if ($options['view_enabled']) {
    $links[] = '<a inline-class="text" href="{email_url}" target="_blank">' . esc_html($options['view']) . '</a>';
}

$show_company = !empty($options['show_company']);
$show_motto = !empty($options['show_motto']);

$show_logo = !empty($options['show_logo']);
$media = null;
if ($show_logo) {
    if (!empty($info['header_logo']['id'])) {
        $media = tnp_get_media($info['header_logo']['id'], 'large');
        if ($media) {
            $media->alt = $info['header_title'];
            $media->link = home_url();
            $media->set_width($options['logo_width']);
        }
    }
}

$social_width = 32;
$social_type = (int) $options['social_type'];
$social_icon_url = plugins_url('newsletter') . '/images/social-' . $social_type;
$socials = ['facebook', 'twitter', 'pinterest', 'linkedin', 'tumblr', 'youtube',
    'soundcloud', 'instagram', 'vimeo', 'telegram', 'vk', 'discord', 'tiktok',
    'twitch', 'whatsapp', 'threads'];

$valid_socials = [];
foreach ($socials as &$social) {
    if (!empty($info[$social . '_url'])) {
        $valid_socials[] = $social;
    }
}

$show_socials = !empty($options['show_socials']) && !empty($valid_socials);

$text_style = TNP_Composer::get_text_style($options, '', $composer, ['scale' => 0.8]);

$block_layout = sanitize_key($options['block_layout'] ?? 'default');

include __DIR__ . '/layouts/' . $block_layout . '/layout.php';

