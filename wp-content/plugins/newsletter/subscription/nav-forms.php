<?php
$p = sanitize_key($_GET['page'] ?? '');
?>
<ul class="tnp-nav">
    <li class="<?php echo $p === 'newsletter_subscription_sources'?'active':''?>"><a href="?page=newsletter_subscription_sources">All forms</a></li>
    <li class="<?php echo $p === 'newsletter_subscription_shortcodes'?'active':''?>"><a href="?page=newsletter_subscription_shortcodes">Shortcodes and Widgets</a></li>
    <li class="<?php echo $p === 'newsletter_subscription_forms'?'active':''?>"><a href="?page=newsletter_subscription_forms">HTML Forms</a></li>
</ul>
<?php
unset($p);
?>