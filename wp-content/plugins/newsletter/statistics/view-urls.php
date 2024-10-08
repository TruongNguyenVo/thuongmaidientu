<?php
/* @var $this NewsletterStatisticsAdmin */
/* @var $controls NewsletterControls */

defined('ABSPATH') || exit;
$email = $this->get_email((int) $_GET['id'] ?? 0);
if (empty($email)) {
    echo 'Newsletter not found';
    return;
}
$items = [];

$item = new stdClass();
$item->url = 'https://www.example.org/page-1';
$item->number = 130;

$items[] = $item;

$item = new stdClass();
$item->url = 'https://www.example.org/page-2';
$item->number = 40;

$items[] = $item;

$item = new stdClass();
$item->url = 'https://www.example.org/page-3';
$item->number = 20;

$items[] = $item;

$item = new stdClass();
$item->url = 'https://www.example.org/page-4';
$item->number = 1;

$items[] = $item;

$item = new stdClass();
$item->url = 'https://www.example.org/page-5';
$item->number = 0;

$items[] = $item;

$total = array_reduce($items, function ($carry, $item) {
    $carry += $item->number;
    return $carry;
});
?>
<style>
<?php include __DIR__ . '/style.css'; ?>
</style>
<div class="wrap tnp-statistics tnp-statistics-view" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER; ?>

    <?php include __DIR__ . '/view-heading.php' ?>

    <div id="tnp-body">
        <p style="font-size: 1.1em;">
            Details by single clicked link for this newsletter are available with the
            <a href="https://www.thenewsletterplugin.com/reports?utm_source=statistics&utm_campaign=plugin" target="_blank">Reports Addon</a>.
            Data below is a sample view.
        </p>

        <table class="widefat" style="opacity: 50%">
            <colgroup>
                <col class="w-80">
                <col class="w-10">
                <col class="w-10">
            </colgroup>
            <thead>
                <tr class="text-left">
                    <th>Clicked URLs</th>
                    <th>Clicks</th>
                    <th>%</th>
                    <th>Who clicked...</th>
                </tr>
            </thead>
            <tbody>

                <?php for ($i = 0; $i < count($items); $i++) : ?>
                    <tr>
                        <td>
                            <a href="<?php echo esc_attr($items[$i]->url); ?>" target="_blank">
                                <?php echo esc_html($items[$i]->url); ?>
                            </a>
                        </td>
                        <td><?php echo esc_html($items[$i]->number); ?></td>
                        <td>
                            <?php echo esc_html(NewsletterModule::percent($items[$i]->number, $total)); ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <?php $controls->init() ?>
                                <?php $controls->data['url'] = $items[$i]->url; ?>
                                <?php $controls->hidden('url') ?>
                                <?php $controls->lists_select() ?>
                                <?php $controls->btn('set', 'Add to this list', ['secondary' => true]) ?>
                            </form>
                        </td>
                    </tr>
                <?php endfor; ?>

            </tbody>
        </table>

    </div>
    <?php include NEWSLETTER_ADMIN_FOOTER; ?>
</div>
