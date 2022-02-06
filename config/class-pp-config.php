<?php
/**
 * Class PP_Config
 *
 * Main class for configuration
 *
 * @class PP_Config
 * @package PP_Config
 * @version 1.0.0
 * @author M Lab Studio
 */

if ( ! class_exists( 'PP_Config' ) ) {
	class PP_Config {
		private static $instance;

		public function __construct() {
			if ( ! defined( 'PARTY_PLANER_TEXT_DOMAIN' ) ) {
				define( 'PARTY_PLANER_TEXT_DOMAIN', 'eg360-tag-optimizer' );
			}

			if ( ! defined( 'PARTY_PLANER_VERSION' ) ) {
				define( 'PARTY_PLANER_VERSION', '1.0.0' );
			}

			if ( ! defined( 'PARTY_PLANER_PLUGIN_BASENAME' ) ) {
				define( 'PARTY_PLANER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			}

			if ( ! defined( 'PARTY_PLANER_BASENAME' ) ) {
				define( 'PARTY_PLANER_BASENAME', basename( dirname( __FILE__ ) ) );
			}

			if ( is_admin() ) {
				$this->pp_admin_files();
			} else {
				$this->pp_public_files();
			}
			include PARTY_PLANER_PATH . '/includes/class-pp-includes.php';
			include PARTY_PLANER_PATH . '/config/api/class-pp-settings.php';
			include PARTY_PLANER_PATH . '/config/const/class-pp-constants.php';
		}

		public function pp_admin_files() {
			include PARTY_PLANER_PATH . '/admin/class-pp-admin.php';
		}

		public function pp_public_files() {
			include PARTY_PLANER_PATH . '/public/class-pp-public.php';
		}

		public static function pp_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	PP_Config::pp_instance();
}