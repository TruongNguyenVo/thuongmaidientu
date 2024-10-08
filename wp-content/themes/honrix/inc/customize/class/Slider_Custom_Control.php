<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
    /**
		 * Slider Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		*/
		class honrix_Slider_Custom_Control extends WP_Customize_Control {
			/**
			 * The type of control being rendered
			 */
			public $type = 'slider_control';
			/**
			 * Enqueue our scripts and styles
			 */
			public function enqueue() {
				wp_enqueue_script( 'skyrocket-custom-controls-js', trailingslashit( HONRIX_TEMPLATE_URI ) . 'inc/customize/assets/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-slider' ), '1.0', true );
				wp_enqueue_style( 'skyrocket-custom-controls-css', trailingslashit( HONRIX_TEMPLATE_URI ) . 'inc/customize/assets/customizer.css', array(), '1.0', 'all' );
			}
			/**
			 * Render the control in the customizer
			 */
			public function render_content() {
			?>
				<div class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
					<div id="slider" class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
				</div>
			<?php
			}
		}
}