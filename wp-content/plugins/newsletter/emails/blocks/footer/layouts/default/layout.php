<?php
$text_style = TNP_Composer::get_text_style($options, '', $composer, ['scale' => 0.8]);
?>

<style>
    .text {
        <?php $text_style->echo_css() ?>
        text-decoration: none;
        line-height: normal;
    }

    .motto {
        <?php $text_style->echo_css(1.2) ?>
        text-decoration: none;
        line-height: normal;
    }
    .link {
        line-height: normal;
        text-decoration: none;
    }
</style>
</style>

<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
    <?php if ($show_logo) { ?>
        <tr>
            <td width="100%" align="center" style="padding-bottom: 24px">
                <?php echo TNP_Composer::image($media); ?>
            </td>
        </tr>
    <?php } ?>

    <?php if ($show_motto) { ?>
        <tr>
            <td width="100%" align="center" style="padding-bottom: 24px">
                <div inline-class="motto"><?php echo esc_html($info['header_sub']); ?></div>
            </td>
        </tr>
    <?php } ?>


    <?php if ($show_socials) { ?>
        <tr>
            <td align="center" valign="middle" style="padding-bottom: 24px">
                <?php foreach ($valid_socials as &$social) { ?>
                    <a href="<?php echo esc_url($info[$social . '_url'], ['http', 'https']) ?>" inline-class="link" target="_blank"><img src="<?php echo esc_attr($social_icon_url) ?>/<?php echo esc_attr($social) ?>.png" width="<?php echo esc_attr($social_width) ?>" height="<?php echo esc_attr($social_width) ?>" alt="<?php echo esc_attr($social) ?>"></a>&nbsp;
                <?php } ?>
            </td>
        </tr>
    <?php } ?>

    <tr>
        <td width="100%" align="center" dir="<?php echo $dir ?>" style="padding-bottom: 24px">
            <?php echo implode('<span inline-class="text">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>', $links) ?>
        </td>
    </tr>

    <?php if ($show_company) { ?>
        <tr>
            <td width="100%" align="center" dir="<?php echo $dir ?>">
                <div inline-class="text">
                    <?php echo esc_html($info['footer_title']) ?>
                    <br>
                    <?php echo esc_html($info['footer_contact']) ?>
                    <br>
                    <em><?php echo esc_html($info['footer_legal']) ?></em>
                </div>
            </td>
        </tr>
    <?php } ?>
</table>



