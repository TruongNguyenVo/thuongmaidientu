<?php
function honrix_theme_page()
{
    add_theme_page(
        __('Honrix Welcome', 'honrix'),
        __('Honrix Theme', 'honrix'),
        'edit_theme_options',
        'honrix_welcome',
        'honrix_welcome_page_contents'
    );
}
add_action('admin_menu', 'honrix_theme_page');


// Load Styles
function honrix_welcome_admin_style($hook)
{
    if ($hook != 'toplevel_page_honrix_welcome') {
        return;
    }
}
add_action('admin_enqueue_scripts', 'honrix_welcome_admin_style');

function honrix_welcome_page_contents()
{
?>

    <div class="honrix-welcome">
        <h1>
            <?php esc_html_e('Welcome to Honrix WordPress Theme', 'honrix'); ?>
            <span class="theme-version"><?php echo 'v' . esc_html(wp_get_theme()->version); ?></span>
        </h1>
        <p><?php esc_html_e('Honrix is the ultimate ecommerce multipurpose WordPress theme for online stores. Whether you\'re selling clothing, electronics, garments, furniture, gadgets, beauty products & all types of store/website. With Honrix, you can create a stunning and professional looking online store in just a few clicks, It offers a customizable design, mobile-friendly interface, SEO optimization, Fully WooCommerce integration, one-click demo import, and fast loading times. Try Honrix to create a stunning online store.', 'honrix'); ?></p>
        <div class="items">
            <div class="item">
                <div class="inner-item">
                    <span class="dashicons dashicons-admin-plugins"></span>
                    <h2><?php esc_html_e('Required Plugins', 'honrix'); ?></h2>
                    <p><?php esc_html_e('Install required plugins to use all features of the theme.', 'honrix'); ?></p>
                    <a href="<?php echo esc_url(admin_url("themes.php?page=tgmpa-install-plugins")); ?>" class="button button-primary">
                        <?php esc_html_e('Required Plugins', 'honrix'); ?>
                    </a>
                </div>
            </div>

            <div class="item">
                <div class="inner-item">
                    <span class="dashicons dashicons-info"></span>
                    <h2><?php esc_html_e('Demo Content', 'honrix'); ?></h2>
                    <p><?php esc_html_e('Import demo content by "One Click Demo Import" plugin.', 'honrix'); ?></p>
                    <?php if (class_exists('OCDI_Plugin')) : ?>
                        <a href="<?php echo esc_url(admin_url("themes.php?page=one-click-demo-import")); ?>" class="button button-primary">
                            <?php esc_html_e('Import Demo', 'honrix'); ?>
                        </a>
                    <?php else : ?>
                        <p><?php esc_html_e('After installing the plugin from required plugins section, this option will be activated.', 'honrix'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="item">
                <div class="inner-item">
                    <span class="dashicons dashicons-book-alt"></span>
                    <h2><?php esc_html_e('Documentation', 'honrix'); ?></h2>
                    <p><?php esc_html_e('Honrix theme documantation is available in Honrix host website.', 'honrix'); ?></p>
                    <a href="https://honarsystems.com/honrix/" class="button button-primary" target="_blank">
                        <?php esc_html_e('Read Documentation', 'honrix'); ?>
                    </a>
                </div>
            </div>

            <div class="item">
                <div class="inner-item">
                    <span class="dashicons dashicons-admin-generic"></span>
                    <h2><?php esc_html_e('Theme Customization', 'honrix'); ?></h2>
                    <p><?php esc_html_e('Honrix theme has an awesome customizations.', 'honrix'); ?></p>
                    <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary">
                        <?php esc_html_e('Start Customizing', 'honrix'); ?>
                    </a>
                </div>
            </div>

            <div class="item">
                <div class="inner-item">
                    <span class="dashicons dashicons-visibility"></span>
                    <h2><?php esc_html_e('Demo', 'honrix'); ?></h2>
                    <p><?php esc_html_e('In demo website you can see the view of the website after installation the theme.', 'honrix'); ?></p>
                    <span class="honrix-italic"></span>
                    <a href="http://honarsystems.com/theme/honrix/" target="_blank" class="button button-primary">
                        <?php esc_html_e('Visit Demo', 'honrix'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
}
