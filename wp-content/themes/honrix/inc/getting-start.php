<?php

/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

add_action('wp_ajax_honrix_dismissed_notice_handler', 'honrix_ajax_notice_handler');

/**
 * AJAX handler to store the state of dismissible notices.
 */
function honrix_ajax_notice_handler()
{
    if (isset($_POST['type'])) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field(wp_unslash($_POST['type']));
        // Store it in the options table
        update_option('dismissed-' . $type, TRUE);
    }
}

function honrix_deprecated_hook_admin_notice()
{
    // Check if it's been dismissed...
    if (!get_option('dismissed-get_started', FALSE)) {
        // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
        // and added "data-notice" attribute in order to track multiple / different notices
        // multiple dismissible notice states 
?>
        <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
            <div class="honrix-getting-started-notice clearfix">
                <div class="honrix-theme-screenshot">
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/img/screenshot.jpg" class="screenshot" alt="<?php esc_attr_e('Theme Screenshot', 'honrix'); ?>" />
                </div><!-- /.honrix-theme-screenshot -->
                <div class="honrix-theme-notice-content">
                    <h2 class="honrix-notice-h2">
                        <?php
                        printf(
                            /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__('Welcome! Thank you for choosing %1$s!', 'honrix'),
                            '<strong>' . wp_get_theme()->get('Name') . '</strong>'
                        );
                        ?>
                    </h2>

                    <a class="honrix-btn-get-started button button-primary button-hero honrix-button-padding" href="<?php echo esc_url(admin_url("admin.php?page=honrix_welcome")); ?>" data-name="" data-slug=""><?php esc_html_e('Get started with Honrix', 'honrix') ?></a>
                    <span class="honrix-push-down">
                        <?php
                        /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                        printf(
                            ' %1$sCustomize theme%2$s</a></span>',
                            '<a target="_blank" href="' . esc_url(admin_url('customize.php')) . '" class="button button-primary button-hero">',
                            '</a>'
                        );
                        ?>
                    </span>
                    <a class="honrix-btn-get-started button button-primary button-hero honrix-button-padding" target="_blank" href="https://honarsystems.com/product/honrix-pro/" data-name="" data-slug=""><?php esc_html_e('Get Honrix Pro', 'honrix') ?></a>
                </div><!-- /.honrix-theme-notice-content -->
            </div>
        </div>
<?php }
}

add_action('admin_notices', 'honrix_deprecated_hook_admin_notice');

/*******************************************************************************
 *  Plugin Installer
 *******************************************************************************/

add_action('wp_ajax_install_act_plugin', 'honrix_admin_install_plugin');

function honrix_admin_install_plugin()
{
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if (!file_exists(WP_PLUGIN_DIR . '/ecommerce-companion')) {
        $api = plugins_api('plugin_information', array(
            'slug'   => sanitize_key(wp_unslash('ecommerce-companion')),
            'fields' => array(
                'sections' => false,
            ),
        ));

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader($skin);
        $result   = $upgrader->install($api->download_link);
    }

    // Activate plugin.
    // if ( current_user_can( 'activate_plugin' ) ) {
    //     $result = activate_plugin( 'ecommerce-companion/ecommerce-companion.php' );
    // }
}
