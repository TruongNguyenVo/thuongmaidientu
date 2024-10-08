<?php

/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */


$default_options = array(
    'block_background' => '#ffffff',
);

$options = array_merge($default_options, $options);
?>

<style>
    .CodeMirror {
        height: 400px;
    }
</style>

<script>
    var templateEditor;
    jQuery(function () {
        templateEditor = CodeMirror.fromTextArea(document.getElementById("options-html"), {
            lineNumbers: true,
            mode: 'htmlmixed',
            lineWrapping: true,
            //extraKeys: {"Ctrl-Space": "autocomplete"}
        });
    });
</script>

<div class="tnp-accordion">

    <h3><?php esc_html_e('Appearance', 'newsletter'); ?></h3>
    <div>
        <p>
            <a href="https://www.thenewsletterplugin.com/documentation/newsletters/newsletter-tags/"
               target="_blank">You can use tags to inject subscriber fields</a>.
        </p>
        <table class="form-table">
            <tr>
                <td>
                    <?php $controls->textarea('html', '100%', '300px') ?>
                </td>
            </tr>
        </table>
    </div>


    <h3><?php esc_html_e('Commons', 'newsletter'); ?></h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>

</div>
