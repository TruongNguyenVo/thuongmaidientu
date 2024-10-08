<?php

/*
 * Name: Header
 * Section: header
 * Description: Default header with company info
 */

$defaults = array(
    'font_family' => '',
    'font_size' => '',
    'font_color' => '',
    'font_weight' => '',
    'logo_width' => 120,
    'block_padding_top' => 24,
    'block_padding_bottom' => 24,
    'block_padding_left' => 16,
    'block_padding_right' => 16,
    'block_background' => '',
    'block_layout' => 'default',
    'block_background_wide' => '0',
);

$styles = [
    'default' => [
        'block_background' => '',
        'block_background2' => '',
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
        'block_background_wide' => '0',
    ],
    'inverted' => [
        'block_background' => '#000000',
        'font_color' => '#cccccc',
        'title_font_color' => '#ffffff',
        'title_font_weight' => 'bold',
        'block_border_radius' => 0,
        'block_border_color' => '',
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

// Migration
if (!empty($options['layout'])) {
    $options['block_layout'] = $options['layout'];
}
// End migration


$options = array_merge($defaults, $options);

$block_layout = sanitize_key($options['block_layout'] ?? '');

$block_style = $options['block_style'] ?? '';
$options = array_merge($options, $styles[$block_style] ?? []);

$media = tnp_get_media($info['header_logo']['id'] ?? 0, 'large');
if ($media) {
    $media->alt = $info['header_title'];
    $media->link = home_url();
}

$empty = !$media && empty($info['header_sub']) && empty($info['header_title']);

include __DIR__ . '/layouts/' . $block_layout . '/layout.php';

