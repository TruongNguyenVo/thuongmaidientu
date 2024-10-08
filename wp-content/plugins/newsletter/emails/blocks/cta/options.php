<?php
/* @var $fields NewsletterFields */

$fields->controls->data['schema'] = '';
?>

<?php $fields->block_style(__('Apply style', 'newsletter'), ['default' => 'Default', 'wire' => 'Wire', 'inverted' => 'Inverted']) ?>

<div class="tnp-accordion">
    <h3><?php esc_html_e('Appearance', 'newsletter'); ?></h3>
    <div>
        <?php
        $fields->button('button', 'Button layout', [
            'family_default' => true,
            'size_default' => true,
            'weight_default' => true,
            'media' => true
        ])
        ?>

        <div class="tnp-field-row">

            <div class="tnp-field-col-2">
                <?php $fields->size('button_width', __('Width', 'newsletter')) ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->select('button_align', __('Alignment', 'newsletter'), ['center' => __('Center'), 'left' => __('Left'), 'right' => __('Right')]) ?>
            </div>

        </div>
    </div>

    <h3><?php esc_html_e('Lists', 'newsletter'); ?></h3>
    <div>
        <p>
            List changes on click.
        </p>
        <div class="tnp-field-row">

            <div class="tnp-field-col-2">
                <?php $fields->lists_public('list', 'Add to', ['empty_label' => 'None']) ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->lists_public('unlist', 'Remove from', ['empty_label' => 'None']) ?>
            </div>
            <div style="clear: both"></div>
            <?php if (!method_exists('NewsletterReports', 'build_lists_change_url')) { ?>
                <label class="tnp-row-label">Requires the Reports Addon last version</label>
            <?php } ?>
        </div>
    </div>

    <h3><?php esc_html_e('Commons', 'newsletter'); ?></h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>

