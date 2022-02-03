<?php
/**
 * Class PP_Admin
 *
 * Main class for communicating in back-end side
 *
 * @class PP_Admin
 * @package PP_Admin
 * @version 1.0.0
 * @author M Lab Studio
 */

if ( ! class_exists( 'PP_Admin' ) ) {
	class PP_Admin {
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'pp_enqueue_admin_styles' ) );
		}

		public function pp_enqueue_admin_styles() {
			wp_enqueue_style( 'pp_style', plugins_url( '/assets/css/pp-style.css', __FILE__ ) );
			wp_enqueue_script( 'pp_script', plugins_url( '/assets/js/pp-script.js', __FILE__ ), array(), '1.0.0', true );
		}
	}

	new PP_Admin();
}