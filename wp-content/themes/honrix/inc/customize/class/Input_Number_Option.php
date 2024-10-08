<?php
/*
 * Customizer Input Number Option
 *
 * package WordPress
 * subpackage honrix
 * since honrix 1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('honrix_Input_Number_Option')) {
    class honrix_Input_Number_Option extends WP_Customize_Control
    {
        public function render_content()
        {
            if (empty($this->choices))
                return;

            $name = '_customize-number-' . $this->id; ?>

            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <p class="customize-control-description"><?php wp_kses_post($this->description); ?></p>
            <?php
            foreach ($this->choices as $value => $label) : ?>
                <input <?php $this->link(); ?>type="number" style="display: inline;" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" />
<?php
            endforeach;
        }
    }
}
