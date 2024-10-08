(function ($) {
	'use strict';

	$.bind('ready', function () {
		var item_check = [
			['honrix_top_bar_display', ['honrix_top_bg_color','honrix_top_text_color','honrix_top_link_color','honrix_top_link_hover_color'], 'yes'],
			['honrix_header_product_search_display', ['honrix_header_product_search_bg_color','honrix_header_product_search_text_color','honrix_header_product_search_button_bg_color','honrix_header_product_search_button_text_color'], 'yes'],
			['honrix_header_categories_display', ['honrix_header_categories_bg_color','honrix_header_categories_text_color','honrix_header_categories_submenu_bg_color','honrix_header_categories_submenu_link_color','honrix_header_categories_submenu_link_hover_color','honrix_header_categories_submenu_link_hover_bg_color'], 'yes'],
			
			['honrix_archive_content_display_read_more', 'honrix_archive_content_read_more_text', 'yes'],			
			['honrix_slider_mode', 'honrix_slider_category', 'category'],
			['honrix_slider_mode', 'honrix_slider_tag', 'tag'],
			['honrix_right_sidebar_display', 'honrix_right_sidebar_width', 'yes'],
			['honrix_left_sidebar_display', 'honrix_left_sidebar_width', 'yes'],
			['honrix_post_right_sidebar_display', 'honrix_post_right_sidebar_width', 'yes'],
			['honrix_post_left_sidebar_display', 'honrix_post_left_sidebar_width', 'yes'],
			['honrix_page_right_sidebar_display', 'honrix_page_right_sidebar_width', 'yes'],
			['honrix_page_left_sidebar_display', 'honrix_page_left_sidebar_width', 'yes'],
			['honrix_404_right_sidebar_display', 'honrix_404_right_sidebar_width', 'yes'],
			['honrix_404_left_sidebar_display', 'honrix_404_left_sidebar_width', 'yes'],
			['honrix_archive_display_thumbnail', ['honrix_archive_crop_thumbnail','honrix_archive_thumbnail_width_mode','honrix_archive_thumbnail_width','honrix_archive_thumbnail_height'], 'yes'],
			['honrix_archive_thumbnail_width_mode', ['honrix_archive_crop_thumbnail','honrix_archive_thumbnail_width','honrix_archive_thumbnail_height'], 'custom'],
			['honrix_archive_display_thumbnail', ['honrix_archive_crop_thumbnail','honrix_archive_thumbnail_width_mode','honrix_archive_thumbnail_width','honrix_archive_thumbnail_height'], 'yes'],
			['honrix_archive_thumbnail_width_mode', ['honrix_archive_crop_thumbnail','honrix_archive_thumbnail_width','honrix_archive_thumbnail_height'], 'custom'],
			['honrix_single_tag_display', 'honrix_single_tag_title', 'yes'],
		];

		item_check.forEach(function (item, index) {
			$(item[0], function (setting) {
				var linkSettingValueToControlActiveState;
				linkSettingValueToControlActiveState = function (control) {
					var visibility = function () {
						var check = item[2];
						var value = $.value(item[0])();
						var activate = false;
						if (typeof check !== 'undefined') {
							if (Array.isArray(check)) {
								if (check.indexOf(value) !== -1) {
									activate = true;
								} else {
									activate = false;
								}
							} else {
								if (check === value) {
									activate = true;
								} else {
									activate = false;
								}
							}
						} else {
							activate = value;
						}

						if (activate) {
							control.container.slideDown(180);
						} else {
							control.container.slideUp(180);
						}
					};
					// Set initial active state.
					visibility();
					// Update activate state whenever the setting is changed.
					setting.bind(visibility);
				};

				// Call linkSettingValueToControlActiveState on each dependent id if is array
				if (Array.isArray(item[1])) {
					item[1].forEach(function (setting, index) {
						$.control(setting, linkSettingValueToControlActiveState);
					});
				} else {
					$.control(item[1], linkSettingValueToControlActiveState);
				}
			});
		});

		// show control when edit button selected
		jQuery('.honrix-custom-refresh-partial').on('click', function (event) {
			event.stopImmediatePropagation();
			event.preventDefault();
			var data = [jQuery(this).attr('data-control'), jQuery(this).attr('data-focus')];
			// identify type to show
			if (data[1] === 'panel') {
				$.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				$.section(data[0]).focus();
			} else {
				$.control(data[0]).focus();
			}
		});
		$.previewer.bind('preview-edit', function (data) {
			// identify type to show
			if (data[1] === 'panel') {
				$.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				$.section(data[0]).focus();
			} else {
				$.control(data[0]).focus();
			}
		});

		jQuery.fn.shake = function (settings) {
			if (typeof settings.interval === 'undefined') {
				settings.interval = 100;
			}

			if (typeof settings.distance === 'undefined') {
				settings.distance = 10;
			}

			if (typeof settings.times === 'undefined') {
				settings.times = 4;
			}

			if (typeof settings.complete === 'undefined') {
				settings.complete = function () {};
			}

			jQuery(this).css('position', 'relative');

			for (var iter = 0; iter < (settings.times + 1); iter++) {
				jQuery(this).animate({ left: ((iter % 2 === 0 ? settings.distance : settings.distance * -1)) }, settings.interval);
			}

			jQuery(this).animate({ left: 0 }, settings.interval, settings.complete);
		};
		jQuery('.focus_shake').on('focus', function () {
			jQuery(this).parent().shake({
				interval: 100,
				distance: 5,
				times: 5
			});
		});
	});
}(wp.customize));
