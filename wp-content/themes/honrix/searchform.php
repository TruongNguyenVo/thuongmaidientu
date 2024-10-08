<?php

if (!defined('ABSPATH')) {
    exit;
}
?>
<form role="search" method="get" class="search-form d-flex m-auto" action="<?php echo esc_url(home_url("/")); ?>">
    <input type="search" tabindex="0" placeholder="<?php esc_attr_e('Search', 'honrix') ?>" class="search-field w-100 text-center" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
    <button type="submit" tabindex="0" class="search-submit d-flex align-items-center justify-content-center w-25 p-2"><i class="fab fa-sistrix honrix-icon"></i></button>
</form>