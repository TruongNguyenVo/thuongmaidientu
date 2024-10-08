<?php
// phpcs:disable WordPress.Security.NonceVerification.Recommended

/* @var $this NewsletterStatisticsAdmin */
/* @var $controls NewsletterControls */

defined('ABSPATH') || exit;
$email = $this->get_email((int) $_GET['id'] ?? 0);
if (empty($email)) {
    echo 'Newsletter not found';
    return;
}
$list = [];

$sub = new stdClass();
$sub->id = 1;
$sub->status = 'C';
$sub->email = $sub->id . '@example.org';
$sub->name = 'John';
$sub->surname = 'Doe';
$sub->sent_status = 0;
$sub->error = '';

$list[] = $sub;

$sub = new stdClass();
$sub->id = 1;
$sub->status = 'C';
$sub->email = $sub->id . '@example.org';
$sub->name = 'John';
$sub->surname = 'Doe';
$sub->sent_status = 0;
$sub->sent_open = 0;
$sub->error = '';

$list[] = $sub;

$sub = new stdClass();
$sub->id = 3;
$sub->status = 'C';
$sub->email = $sub->id . '@example.org';
$sub->name = 'John';
$sub->surname = 'Doe';
$sub->sent_status = 1;
$sub->sent_open = 0;
$sub->error = 'Unable to contact the mailbox';

$list[] = $sub;

$sub = new stdClass();
$sub->id = 4;
$sub->status = 'C';
$sub->email = $sub->id . '@example.org';
$sub->name = 'John';
$sub->surname = 'Doe';
$sub->sent_status = 0;
$sub->sent_open = 1;
$sub->error = '';

$list[] = $sub;

$sub = new stdClass();
$sub->id = 5;
$sub->status = 'U';
$sub->email = $sub->id . '@example.org';
$sub->name = 'John';
$sub->surname = 'Doe';
$sub->sent_status = 0;
$sub->sent_open = 2;
$sub->error = '';

$list[] = $sub;

$sub = new stdClass();
$sub->id = 6;
$sub->status = 'P';
$sub->email = $sub->id . '@example.org';
$sub->name = 'John';
$sub->surname = 'Doe';
$sub->sent_status = 0;
$sub->sent_open = 0;
$sub->error = '';

$list[] = $sub;
?>
<style>
<?php include __DIR__ . '/style.css'; ?>
</style>
<div class="wrap tnp-statistics tnp-statistics-view" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER; ?>

    <?php include __DIR__ . '/view-heading.php' ?>


    <div id="tnp-body">
        <p style="font-size: 1.1em;">
            Details by single subscriber for this newsletter are available
            with the <a href="https://www.thenewsletterplugin.com/reports?utm_source=statistics&utm_campaign=plugin" target="_blank">Reports Addon</a>.
            Data below is a sample view.
        </p>

        <table class="widefat" style="opacity: 50%">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Email/Name</th>
                    <th><?php esc_html_e('Status', 'newsletter') ?></th>
                    <th>Delivery</th>
                    <th>Open</th>
                    <th>Click</th>
                    <th>Error</th>
                </tr>
            </thead>

            <?php foreach ($list as $sub) { ?>
                <tr>
                    <td style="width: 55px">
                        <img src="https://www.gravatar.com/avatar/<?php echo rawurlencode(md5($sub->email)); ?>?s=50&d=mp" style="width: 50px; height: 50px">
                    </td>
                    <td>
                        <?php echo esc_html($sub->email) . "<br>" ?>
                        <?php echo esc_html($sub->name) . " " . esc_html($sub->surname) ?>
                    </td>
                    <td>
                        <?php echo $this->get_user_status_label($sub, true) ?>
                    </td>
                    <td>
                        <?php if ($sub->sent_status) { ?>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 48 48"><g ><path fill="#E86C60" d="M24,47C11.31738,47,1,36.68262,1,24S11.31738,1,24,1s23,10.31738,23,23S36.68262,47,24,47z"/>
                                        <polygon fill="#FFFFFF" points="35,31 28,24 35,17 31,13 24,20 17,13 13,17 20,24 13,31 17,35 24,28 31,35 "/></g></svg></span>

                        <?php } else { ?>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 48 48"><g ><path fill="#72C472" d="M24,47C11.31738,47,1,36.68213,1,24S11.31738,1,24,1s23,10.31787,23,23S36.68262,47,24,47z"/>
                                        <polygon fill="#FFFFFF" points="20,34.82861 9.17188,24 12,21.17139 20,29.17139 36,13.17139 38.82812,16 "/></g></svg></span>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($sub->sent_open >= 1) { ?>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 48 48"><g ><path fill="#72C472" d="M24,47C11.31738,47,1,36.68213,1,24S11.31738,1,24,1s23,10.31787,23,23S36.68262,47,24,47z"/>
                                        <polygon fill="#FFFFFF" points="20,34.82861 9.17188,24 12,21.17139 20,29.17139 36,13.17139 38.82812,16 "/></g></svg></span>
                        <?php } else { ?>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 48 48"><g ><path fill="#E86C60" d="M24,47C11.31738,47,1,36.68262,1,24S11.31738,1,24,1s23,10.31738,23,23S36.68262,47,24,47z"/>
                                        <polygon fill="#FFFFFF" points="35,31 28,24 35,17 31,13 24,20 17,13 13,17 20,24 13,31 17,35 24,28 31,35 "/></g></svg></span>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($sub->sent_open == 2) { ?>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 48 48"><g ><path fill="#72C472" d="M24,47C11.31738,47,1,36.68213,1,24S11.31738,1,24,1s23,10.31787,23,23S36.68262,47,24,47z"/>
                                        <polygon fill="#FFFFFF" points="20,34.82861 9.17188,24 12,21.17139 20,29.17139 36,13.17139 38.82812,16 "/></g></svg></span>
                        <?php } else { ?>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 48 48"><g ><path fill="#E86C60" d="M24,47C11.31738,47,1,36.68262,1,24S11.31738,1,24,1s23,10.31738,23,23S36.68262,47,24,47z"/>
                                        <polygon fill="#FFFFFF" points="35,31 28,24 35,17 31,13 24,20 17,13 13,17 20,24 13,31 17,35 24,28 31,35 "/></g></svg></span>
                        <?php } ?>
                    </td>

                    <td>
                        <?php
                        if (isset($sub->error)) {
                            echo esc_html($sub->error);
                        }
                        ?>
                    </td>

                </tr>
            <?php } ?>
        </table>
    </div>
    <?php include NEWSLETTER_ADMIN_FOOTER; ?>
</div>
