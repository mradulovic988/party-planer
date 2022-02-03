<?php
/**
 * Party Planer
 *
 * @package           Party_Planer
 * @author            Marko Radulovic
 * @copyright         2022 Marko Radulovic
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Party Planer
 * Plugin URI:        https://wordpress.org/plugins/party-planer
 * Description:       Party Planer Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cumque, dolor, dolorem dolores est eveniet expedita fugiat ipsa ipsam laudantium neque nihil obcaecati odit omnis perspiciatis quod totam velit vitae?
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            Marko Radulovic
 * Author URI:        https://mlab-studio.com/
 * Text Domain:       party-planer
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Party_Planer' ) ) {
	class Party_Planer {
		public function __construct() {

			if ( ! defined( 'PARTY_PLANER_PATH' ) ) {
				define( 'PARTY_PLANER_PATH', plugin_dir_path( __FILE__ ) );
			}

			include PARTY_PLANER_PATH . '/config/class-pp-config.php';
			PP_Config::pp_instance();
		}
	}

	new Party_Planer();
}