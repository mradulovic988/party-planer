<?php
/**
 * Class PP_Public
 *
 * Main class for communicating in front-end side
 *
 * @class PP_Public
 * @package PP_Public
 * @version 1.0.0
 * @author M Lab Studio
 */

if ( ! class_exists( 'PP_Public' ) ) {
	class PP_Public {
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'pp_enqueue_public_styles' ) );
			$this->pp_includes();
		}

		public function pp_enqueue_public_styles() {
			wp_enqueue_style( 'pp_style', plugins_url( '/assets/css/pp-style.css', __FILE__ ) );
			wp_enqueue_script( 'pp_script', plugins_url( '/assets/js/pp-script.js', __FILE__ ), array(), '1.0.0', true );
		}

		public function pp_includes() {
			include PARTY_PLANER_PATH . '/public/shortcodes/pp-calculator-form.php';
		}
	}

	new PP_Public();
}