<?php
/*
 * Name: Single image
 * Section: content
 * Description: A single image with link
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'image' => '',
    'image-alt' => '',
    'image_alt' => '',
    'url' => '',
    'width' => 0,
    'align' => 'center',
    'block_background' => '',
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);

$options = array_merge($defaults, $options);

// Migration
if (isset($options['image-alt']) && empty($options['image_alt'])) {
    $options['image_alt'] = $options['image-alt'];
}
// Migration end

if (empty($options['image']['id'])) {
    if (!empty($options['image-url'])) {
        $media = new TNP_Media();
        $media->url = $options['image-url'];
    } else {
        $media = new TNP_Media();
        // A placeholder can be set by a preset and it is kept indefinitely
        if (!empty($options['placeholder'])) {
            $media->url = $options['placeholder'];
            $media->width = $composer['width'];
            $media->height = 250;
        } else {
            $media->url = 'https://source.unsplash.com/1200x500/daily';
            $media->width = $composer['width'];
            $media->height = 250;
        }
    }
} else {
    $media = tnp_resize_2x($options['image']['id'], [$composer['width'], 0]);
    // Should never happen but... it happens
    if (!$media) {
        echo 'The selected media file cannot be processed';
        return;
    }
}

if (!empty($options['width'])) {
    $media->set_width($options['width']);
}
$media->link = $options['url'];
$media->alt = $options['image_alt'];
?>

<table width="100%" cellpadding="0" cellspacing="0" border="0" width="100%" role="presentation">
    <tr>
        <td align="<?php echo esc_attr($options['align']); ?>">

            <?php if ($media->link) { ?>
                <a href="', esc_attr($media->link), '" target="_blank" rel="noopener nofollow" style="display: block; font-size: 0; text-decoration: none; line-height: normal!important">';
                <?php } ?>

                <img src="<?php echo esc_attr($media->url); ?>" width="<?php echo esc_attr($media->width); ?>"
                <?php echo $media->height ? 'height="' . esc_attr($media->height) . '"' : ''; ?>
                     alt="<?php echo esc_attr($media->alt); ?>"
                     border="0" style="display: block; height: auto; max-width: <?php echo esc_attr($media->width); ?>px !important; width: 100%; padding: 0; border: 0; font-size: 12px">

                <?php if ($media->link) { ?>
                    echo '</a>';
            <?php } ?>

        </td>
    </tr>
</table>


