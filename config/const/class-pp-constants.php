<?php
/**
 * Class PP_Constants
 *
 * All declared constants for calculation
 *
 * @class PP_Constants
 * @package PP_Constants
 * @version 1.0.0
 * @author M Lab Studio
 */

if ( ! class_exists( 'PP_Constants' ) ) {
	class PP_Constants extends PP_Settings {
		public function __construct() {
			$this->pp_defined();
		}

		/**
		 * Check if constant exist
		 *
		 * @param string $const_name Constant name
		 * @param string $const_value Constant value
		 *
		 * @return string|void
		 */
		protected function pp_if_defines( $const_name, $const_value ) {
			if ( ! defined( $const_name ) ) {
				return define( $const_name, $this->pp_options_check( $const_value ) );
			}
		}

		/**
		 * Defining and declaring all constants
		 *
		 * @return void
		 */
		public function pp_defined() {
			$this->pp_if_defines( 'PP_BEER_CONS', 'beer_consumption' ); // Beer consumption
			$this->pp_if_defines( 'PP_WINE_CONS', 'wine_consumption' ); // Wine consumption
			$this->pp_if_defines( 'PP_STRONG_CONS', 'strong_consumption' ); // Strong consumption
			$this->pp_if_defines( 'PP_BEER_PREF', 'beer_preferences' ); // Beer preferences
			$this->pp_if_defines( 'PP_WINE_PREF', 'wine_preferences' ); // Wine preferences
			$this->pp_if_defines( 'PP_STRONG_PREF', 'strong_preferences' ); // Strong preferences
		}
	}

	new PP_Constants();
}