<?php
global $current_user, $wpdb;

defined('ABSPATH') || exit;

$dismissed = get_option('newsletter_dismissed', []);

$user_count = Newsletter::instance()->get_user_count();

$is_administrator = current_user_can('administrator');

function newsletter_print_entries($group) {
    $entries = apply_filters('newsletter_menu_' . $group, []);
    if (!$entries) {
        return;
    }

    foreach ($entries as &$entry) {
        echo '<li><a href="', esc_attr($entry['url']), '">', wp_strip_all_tags($entry['label']), '</a></li>';
    }
}

$system_warnings = NewsletterSystemAdmin::instance()->get_warnings_count();
?>

<div id="tnp-menu">
    <ul>
        <li>
            <a href="?page=newsletter_main_index"><img src="<?php echo plugins_url('newsletter'); ?>/admin/images/logo.png" class="tnp-header-logo" style="vertical-align: bottom;"></a>

        </li>
        <li><a href="#"><i class="fas fa-users"></i> <?php esc_html_e('Subscribers', 'newsletter') ?></a>
            <ul>
                <li>
                    <a href="?page=newsletter_users_index"><?php esc_html_e('All subscribers', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_profile_index"><?php esc_html_e('Profile page', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_unsubscription_index"><?php esc_html_e('Unsubscription', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('subscribers') ?>

                <li>
                    <a href="?page=newsletter_users_statistics"><?php esc_html_e('Statistics', 'newsletter') ?></a>
                </li>

                <?php if (!class_exists('NewsletterImport')) { ?>
                    <li>
                        <a href="?page=newsletter_users_import"><?php esc_html_e('Import/Export', 'newsletter') ?></a>
                    </li>
                <?php } ?>

                <li>
                    <a href="?page=newsletter_users_massive"><?php esc_html_e('Maintenance', 'newsletter') ?></a>
                </li>


            </ul>
        </li>
        <li><a href="#"><i class="fas fa-list"></i> <?php esc_html_e('Subscription', 'newsletter') ?></a>
            <ul>

                <li>
                    <a href="?page=newsletter_subscription_options"><?php esc_html_e('Settings', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_sources"><?php esc_html_e('Forms', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_lists"><?php esc_html_e('Lists', 'newsletter') ?></a>
                </li>
                <li>
                    <a href="?page=newsletter_subscription_customfields"><?php esc_html_e('Custom fields', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_antispam"><?php esc_html_e('Antispam', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_unsubscription_index"><?php esc_html_e('Unsubscription', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('subscription') ?>
            </ul>
        </li>

        <li>
            <a href="#"><i class="fas fa-newspaper"></i> <?php esc_html_e('Newsletters', 'newsletter') ?></a>
            <ul>
                <li>
                    <a href="?page=newsletter_emails_index"><?php esc_html_e('All newsletters', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_emails_composer"><?php esc_html_e('Create newsletter', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_emails_presets"><?php esc_html_e('Templates', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="<?php echo NewsletterStatisticsAdmin::instance()->get_index_url() ?>"><?php _e('Statistics', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('newsletters') ?>
            </ul>
        </li>

        <li>
            <a href="#"><i class="fas fa-cog"></i> <?php esc_html_e('Settings', 'newsletter') ?></a>
            <ul>
                <?php if ($is_administrator) { ?>
                    <li>
                        <a href="?page=newsletter_main_main"><?php esc_html_e('General Settings', 'newsletter') ?></a>
                    </li>
                <?php } ?>

                <li>
                    <a href="?page=newsletter_main_info"><?php esc_html_e('Company Info', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_template"><?php esc_html_e('Messages Template', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('settings') ?>
            </ul>
        </li>

        <?php if ($is_administrator) { ?>
            <li>
                <a href="#">
                    <?php if ($system_warnings['total']) { ?>
                        <i class="fas fa-exclamation-triangle" style="color: red;"></i>
                    <?php } else { ?>
                        <i class="fas fa-thermometer"></i>
                    <?php } ?>
                    <?php esc_html_e('Help', 'newsletter') ?>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo esc_attr(admin_url('site-health.php')) ?>"><?php esc_html_e('WP Site Health') ?></a>
                    </li>
                    <li>
                        <a href="?page=newsletter_system_status"><?php esc_html_e('System', 'newsletter') ?>
                            <?php if ($system_warnings['status']) { ?>
                                <i class="fas fa-exclamation-triangle tnp-menu-warning" style="color: red;"></i>
                            <?php } ?>
                        </a>
                    </li>

                    <li><a href="?page=newsletter_system_scheduler"><?php esc_html_e('Scheduler', 'newsletter') ?></a></li>

                    <li><a href="?page=newsletter_system_delivery"><?php esc_html_e('Delivery', 'newsletter') ?></a></li>

                    <?php if (class_exists('NewsletterExtensions')) { ?>
                        <li>
                            <a href="?page=newsletter_extensions_support"><?php esc_html_e('Support', 'newsletter') ?></a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="?page=newsletter_system_support"><?php esc_html_e('Support', 'newsletter') ?></a>
                        </li>
                    <?php } ?>

                    <li><a href="?page=newsletter_system_logs"><?php esc_html_e('Logs', 'newsletter') ?></a></li>
                    <li>
                        <a href="https://www.thenewsletterplugin.com/documentation/developers/backup-recovery/" target="_blank"><?php _e('Backup', 'newsletter') ?></a>
                    </li>
                </ul>
            </li>
        <?php } ?>

        <?php
        $license_data = Newsletter::instance()->get_license_data();
        $premium_url = 'https://www.thenewsletterplugin.com/premium?utm_source=header&utm_medium=link&utm_campaign=plugin&utm_content=' . urlencode($_GET['page']);
        if (NEWSLETTER_DEBUG) {
            //$license_data->expire = 0; //time() + MONTH_IN_SECONDS + DAY_IN_SECONDS;
            //$license_data->type = 'personal';
            //$license_data = false;
        }
        ?>

        <?php if (empty($license_data)) { ?>

            <li class="tnp-licence-button"><a href="<?php echo esc_attr($premium_url); ?>" target="_blank">
                    <i class="fas fa-trophy"></i> <?php esc_html_e('Get Professional Addons', 'newsletter'); ?></a>
            </li>

        <?php } elseif (is_wp_error($license_data)) { ?>

            <li class="tnp-licence-button tnp-licence-button-red">
                <a href="?page=newsletter_main_main"><i class="fas fa-hand-paper" style="color: white"></i> <?php esc_html_e('License check failed', 'newsletter') ?></a>
            </li>

        <?php } elseif ($license_data->expire == 0) { ?>

            <li class="tnp-licence-button">
                <a href="<?php echo esc_attr($premium_url) ?>" target="_blank"><i class="fas fa-trophy"></i> <?php _e('Get Professional Addons', 'newsletter') ?></a>
            </li>

        <?php } elseif ($license_data->expire < time()) { ?>

            <?php if ($license_data->type === 'personal') { ?>
                <li class="tnp-licence-button tnp-licence-button-red">
                    <a href="https://www.thenewsletterplugin.com/account" target="_blank"><i class="fas fa-hand-paper" style="color: white"></i> <?php esc_html_e('License expired', 'newsletter') ?></a>
                </li>
            <?php } else { ?>
                <li class="tnp-licence-button tnp-licence-button-red">
                    <a href="javascript:alert('You have a reselled license, please ask your web agency to renew it or get a personal one.')"><i class="fas fa-check-square"></i> <?php esc_html_e('License expired', 'newsletter') ?></a>
                </li>
            <?php } ?>

        <?php } elseif ($license_data->expire < time() + MONTH_IN_SECONDS) { ?>

            <?php if ($license_data->type === 'personal') { ?>
                <li class="tnp-licence-button tnp-licence-button-red">
                    <a href="https://www.thenewsletterplugin.com/account" target="_blank"><i class="fas fa-check-square"></i> <?php esc_html_e('License expiring', 'newsletter') ?> (<?php echo esc_html(date('Y-m-d', $license_data->expire)); ?>)</a>
                </li>
            <?php } else { ?>
                <li class="tnp-licence-button tnp-licence-button-red">
                    <a href="javascript:alert('You have a reselled license, please ask your web agency to renew it or get a personal one.')"><i class="fas fa-check-square"></i> <?php esc_html_e('License expiring', 'newsletter') ?> (<?php echo esc_html(date('Y-m-d', $license_data->expire)); ?>)</a>
                </li>
            <?php } ?>

        <?php } elseif ($license_data->expire >= time()) { ?>

            <li class="tnp-licence-button">
                <a href="https://www.thenewsletterplugin.com/account" target="_blank"><i class="fas fa-check-square"></i> <?php esc_html_e('License active', 'newsletter') ?> (<?php echo esc_html(date('Y-m-d', $license_data->expire)); ?>)</a>
            </li>

        <?php } ?>
    </ul>
</div>

<?php
$news = NewsletterMainAdmin::instance()->get_news();
?>

<?php foreach ($news as $n) { ?>
    <div class="tnp-news">
        <a href="<?php echo esc_attr(($_SERVER['REQUEST_URI'] . '&news=' . urlencode($n['id']))) ?>" class="tnp-news-dismiss">&times;</a>
        <div class="tnp-news-message"><?php echo esc_html($n['message']) ?></div>
        <div class="tnp-news-cta">
            <a class="tnp-news-link" href="<?php echo esc_attr($n['url']) ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($n['label']) ?></a>
        </div>
    </div>
    <?php break; ?>
<?php } ?>

<?php
if (NEWSLETTER_DEBUG || NEWSLETTER_PAGE_WARNING) {
    $last_check = (int) get_option('newsletter_public_page_check', 0);
    if (NEWSLETTER_DEBUG || $last_check < time() - DAY_IN_SECONDS) {
        update_option('newsletter_public_page_check', time(), false);
        if (Newsletter::instance()->is_multilanguage()) {
            $languages = array_merge(['' => 'All languages'], Newsletter::instance()->get_languages());
            $missing = [];
            $missing_publish = [];
            $missing_shortcode = [];

            foreach ($languages as $l => $label) { // Do NOT use $language!
                $tnp_page_id = NewsletterMainAdmin::instance()->get_option('page', '', $l);

                // Found an installation with page ID equals to zero and returning a valid status...
                if (empty($tnp_page_id)) {
                    $missing[] = '<a href="?page=newsletter_main_main&lang=' . esc_attr($l) . '#tabs-basic">' . esc_html($label) . '</a>';
                    continue;
                }

                $tnp_page_status = get_post_status($tnp_page_id);
                if ($tnp_page_status === false) {
                    $missing[] = '<a href="?page=newsletter_main_main&lang=' . esc_attr($l) . '#tabs-basic">' . esc_html($label) . '</a>';
                    continue;
                }

                if ($tnp_page_status !== 'publish') {
                    $missing_publish[] = '<a href="' . esc_attr(admin_url('post.php')) . '?post=' . esc_attr($tnp_page_id)
                            . '&action=edit" target="_blank">' . esc_html(get_post_field('post_title', $tnp_page_id)) . '</a>';
                    continue;
                }

                $content = get_post_field('post_content', $tnp_page_id);
                if (strpos($content, '[newsletter]') === false && strpos($content, '[newsletter ') === false && strpos($content, '[newsletter/]') === false) {
                    $missing_shortcode[] = '<a href="' . esc_attr(admin_url('post.php')) . '?post=' . esc_attr($tnp_page_id)
                            . '&action=edit" target="_blank">' . esc_html(get_post_field('post_title', $tnp_page_id)) . '</a>';
                }
            }

            if ($missing) {
                update_option('newsletter_public_page_check', 0, false);
                ?>
                <div class="tnp-notice tnp-notice-warning">
                    The Newsletter public page is missing or not published for <?php echo implode(', ', $missing); ?>
                </div>
                <?php
            }
            if ($missing_publish) {
                update_option('newsletter_public_page_check', 0, false);
                ?>
                <div class="tnp-notice tnp-notice-warning">
                    Some Newsletter public page(s) are not published: <?php echo implode(', ', $missing_publish); ?>
                </div>
                <?php
            }
            if ($missing_shortcode) {
                update_option('newsletter_public_page_check', 0, false);
                ?>
                <div class="tnp-notice tnp-notice-warning">
                    Some Newsletter's public page(s) do not contain the <code>[newsletter]</code> shortcode: <?php echo implode(', ', $missing_shortcode); ?>
                </div>
                <?php
            }
        } else {

            $tnp_page_id = NewsletterMainAdmin::instance()->get_main_option('page');
            $tnp_page_status = get_post_status($tnp_page_id);
            if ($tnp_page_status === false) {
                update_option('newsletter_public_page_check', 0, false);
                echo '<div class="tnp-notice tnp-notice-warning">The Newsletter public page is missing. <a href="?page=newsletter_main_main#tabs-basic">Configure it</a>.</div>';
            } elseif ($tnp_page_status !== 'publish') {
                update_option('newsletter_public_page_check', 0, false);
                echo '<div class="tnp-notice tnp-notice-warning">The Newsletter public page is not published. <a href="', esc_attr(admin_url('post.php')) . '?post=', esc_attr($tnp_page_id), '&action=edit"><strong>Edit the page</strong></a> or <a href="admin.php?page=newsletter_main_main"><strong>review the main settings</strong></a>.</div>';
            } else {
                $content = get_post_field('post_content', $tnp_page_id);
                $title = get_post_field('post_title', $tnp_page_id);
                // With and without attributes
                if (strpos($content, '[newsletter]') === false && strpos($content, '[newsletter ') === false) {
                    update_option('newsletter_public_page_check', 0, false);
                    ?>
                    <div class="tnp-notice tnp-notice-warning">
                        The WordPress page "<?php echo esc_html($title) ?>" set as Newsletter's public page on the <a href="admin.php?page=newsletter_main_main">main settings</a>
                        does not contain the <code>[newsletter]</code> shortcode.
                        <br>
                        <a href="<?php echo esc_attr(admin_url('post.php')) ?>?post=<?php echo esc_attr($tnp_page_id) ?>&action=edit"><strong>Edit the page</strong></a>
                        and add the <code>[newsletter]</code> as the only page content.
                    </div>
                    <?php
                }
            }
        }
    }
}
?>

<?php if (isset($_GET['debug']) || isset($dismissed['newsletter-subscribe']) && !isset($dismissed['rate']) && $user_count > 300) { ?>
    <div class="tnp-notice">
        <a href="<?php echo esc_attr($_SERVER['REQUEST_URI']) . '&noheader=1&dismiss=rate' ?>" class="tnp-dismiss">&times;</a>

        ☆☆☆☆☆ Would you rate the Newsletter plugin</a> to help us improve even more?
    <br><br>
    <a href="https://wordpress.org/support/plugin/newsletter/reviews/?rate=5#new-post" target="_blank" class="button-primary" style="color: #fff"><?php esc_html_e('Yes, you deserve it!', 'newsletter') ?></a>
    &nbsp;&nbsp;&nbsp;
    <a href="<?php echo esc_attr($_SERVER['REQUEST_URI']) . '&noheader=1&dismiss=rate' ?>" style="color: #666; font-weight: normal; font-size: .9em"><?php esc_html_e('Maybe later', 'newsletter') ?></a>

    <br><br>
    <strong>Really appreciated, The Newsletter Team</strong>.

    </div>
<?php } ?>

<?php if (isset($_GET['debug']) || !isset($dismissed['newsletter-subscribe']) && get_option('newsletter_install_time') && get_option('newsletter_install_time') < time() - 86400 * 15) { ?>
    <div class="tnp-notice">
        <a href="<?php echo esc_attr($_SERVER['REQUEST_URI']) . '&noheader=1&dismiss=newsletter-subscribe' ?>" class="tnp-dismiss">&times;</a>
        Subscribe to our news, promotions and getting started lessons!
        Proceeding you agree to the <a href="https://www.thenewsletterplugin.com/privacy" target="_blank">privacy policy</a>.
        <br><br>
        <form action="https://www.thenewsletterplugin.com/?na=s" target="_blank" method="post">
            <input type="hidden" value="plugin-header" name="nr">
            <input type="hidden" value="3" name="nl[]">
            <input type="hidden" value="1" name="nl[]">
            <input type="hidden" value="double" name="optin">
            <input type="email" name="ne" value="">
            <input type="submit" class="button-primary" value="<?php esc_attr_e('Subscribe', 'newsletter') ?>">
        </form>
    </div>
<?php } ?>

<?php
if (!defined('NEWSLETTER_CRON_WARNINGS') || NEWSLETTER_CRON_WARNINGS) {
    $x = NewsletterSystemAdmin::instance()->get_job_status();
    if ($x !== NewsletterSystemAdmin::JOB_OK) {
        echo '<div class="tnp-notice tnp-notice-warning">There are issues with the delivery engine. Please <a href="?page=newsletter_system_scheduler">check them here</a>.</div>';
    }
}
?>

<?php
$hook_paused = get_option('wp_crontrol_paused');
if (isset($hook_paused['newsletter']) && $hook_paused['newsletter']) {
    echo '<div class="tnp-notice tnp-notice-error">The delivery engine has been paused using WP Crontrol. Please <a href="tools.php?page=crontrol_admin_manage_page">reactivate the <code>newsletter</code> hook</a>.</div>';
}







