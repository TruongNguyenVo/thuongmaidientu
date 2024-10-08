<?php
/* @var $fields NewsletterFields */
?>

<?php
$fields->select('block_layout', __('Layout', 'newsletter'), [
    'default' => __('Default', 'newsletter'),
    'full' => __('Full', 'newsletter'),
]);
?>

<?php
$fields->block_style('', [
    'default' => __('Default', 'newsletter'),
    'inverted' => __('Inverted', 'newsletter'),
    'boxed' => __('Boxed', 'newsletter'),
]);
?>

<div class="tnp-accordion">
    <h3><?php esc_html_e('Elements', 'newsletter'); ?></h3>
    <div>

        <div class="tnp-field-row">
            <div class="tnp-field-col-2">
                <?php $fields->yesno('show_logo', __('Logo', 'newsletter')); ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->number('logo_width', 'Width') ?>
            </div>
            <div style="clear: both"></div>
        </div>

        <div class="tnp-field-row">
            <div class="tnp-field-col-2">
                <?php $fields->yesno('show_company', __('Company info', 'newsletter')); ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->yesno('show_motto', 'Motto') ?>
            </div>
            <div style="clear: both"></div>
        </div>

        <div class="tnp-field-row">
            <div class="tnp-field-col-2">
                <?php $fields->yesno('show_socials', __('Socials', 'newsletter')); ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->select('social_type', 'Type', ['3' => 'White logo', '4' => 'Black logo']) ?>
            </div>
            <div style="clear: both"></div>
        </div>

    </div>


    <h3><?php esc_html_e('Links', 'newsletter'); ?></h3>
    <div>

        <?php $fields->text_on_off('view', __('View online link', 'newsletter')) ?>

        <?php $fields->text_on_off('profile', __('Subscriber profile link', 'newsletter')) ?>

        <?php $fields->text_on_off('unsubscribe', __('Unsubscribe link', 'newsletter')) ?>
    </div>

    <h3><?php esc_html_e('Fonts', 'newsletter'); ?></h3>
    <div>
        <?php
        $fields->font('font', __('Text', 'newsletter'), [
            'family_default' => true,
            'size_default' => true,
            'weight_default' => true
        ])
        ?>

    </div>

    <h3><?php esc_html_e('Commons', 'newsletter'); ?></h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>