<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */
?>

<p>Social profiles can be configured on company info page.</p>
<div class="tnp-accordion">
    <h3><?php esc_html_e('Appearance', 'newsletter'); ?></h3>
    <div>
        <?php $fields->select('type', 'Type', ['1' => 'Round colored', '2' => 'Round monochrome', '3' => 'White logo', '4' => 'Black logo']) ?>

        <?php $fields->select('width', 'Size', ['16' => '16 px', '24' => '24 px', '32' => '32 px']) ?>

    </div>

    <h3><?php esc_html_e('Commons', 'newsletter'); ?></h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>
