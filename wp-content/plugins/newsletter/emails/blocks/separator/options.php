<?php
/* @var $fields NewsletterFields */
?>

<div class="tnp-accordion">
    <h3><?php esc_html_e('Appearance', 'newsletter'); ?></h3>
    <div>

        <div class="tnp-field-row">

            <div class="tnp-field-col-2">
                <?php $fields->color('color', __('Color', 'newsletter')) ?>
            </div>

            <div class="tnp-field-col-2">
                <?php $fields->select('height', __('Height', 'newsletter'), array('0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9)) ?>
            </div>
            
        </div>
    </div>

    <h3><?php esc_html_e('Commons', 'newsletter'); ?></h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>