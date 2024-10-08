<?php
if (!function_exists('honrix_elementor_widget_categories')) {
    function honrix_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category('honrix-addon', [
            'title' => esc_html__('Honrix Addons', 'honrix'),
            'icon' => 'fa fa-plug',
        ]);
    }
    add_action(
        'elementor/elements/categories_registered',
        'honrix_elementor_widget_categories'
    );
}

add_action('elementor/widgets/widgets_registered', function () {
    get_template_part('/widgets/category-list/category-list');
    get_template_part('/widgets/product-list/product-list');
    get_template_part('/widgets/special-product/special-product');
    get_template_part('/widgets/deal-product/deal-product');
    get_template_part('/widgets/counter/counter');
    get_template_part('/widgets/pricelist/pricelist');
    get_template_part('/widgets/testimonial/testimonial');
    get_template_part('/widgets/member/member');
    get_template_part('/widgets/posts/posts');
});
