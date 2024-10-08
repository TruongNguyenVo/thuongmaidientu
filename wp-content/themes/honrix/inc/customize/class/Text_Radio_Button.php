<?php
if (class_exists('WP_Customize_Control')) {
	if (!class_exists('honrix_Text_Radio_Button_Custom_Control')) {
		/**
		 * Text Radio Button Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		 */
		class honrix_Text_Radio_Button_Custom_Control extends WP_Customize_Control
		{
			/**
			 * The type of control being rendered
			 */
			public $type = 'text_radio_button';
			/**
			 * Enqueue our scripts and styles
			 */
			public function enqueue()
			{
				wp_enqueue_style('honrix-custom-controls-css', trailingslashit(HONRIX_TEMPLATE_URI) . 'inc/customize/assets/customizer.css', array(), '1.0', 'all');
			}
			/**
			 * Render the control in the customizer
			 */
			public function render_content()
			{
?>
				<div class="text_radio_button_control">
					<?php if (!empty($this->label)) { ?>
						<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
					<?php } ?>
					<?php if (!empty($this->description)) { ?>
						<span class="customize-control-description"><?php echo wp_specialchars_decode($this->description);// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<?php } ?>

					<div class="radio-buttons">
						<?php
						$class = 'radio-button-label';
						if (count($this->choices) > 2) {
							$class .= ' full_width_label';
						}
						foreach ($this->choices as $key => $value) { ?>
							<label class="<?php echo esc_attr($class); ?>">
								<input type="radio" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($key); ?>" <?php $this->link(); ?> <?php checked(esc_attr($key), $this->value()); ?> />
								<span for="_customize-input-<?php echo esc_attr($this->id); ?>-radio-<?php echo esc_attr($value); ?>"><?php echo esc_html($value); ?></span>
							</label>
						<?php	} ?>
					</div>
					<?php if (esc_attr($this->id) == 'honrix_archive_style' || esc_attr($this->id) == 'honrix_pagination_style') { ?>
						<a class="focus_shake" href="#"> </a>
					<?php } ?>
				</div>
<?php
			}
		}
	}
}
