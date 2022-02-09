<?php
/**
 * Party Planer
 *
 * @package           Party_Planer
 * @author            M Lab Studio <info@mlab-studio.com>
 * @copyright         2022 M Lab Studio
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Party Planer
 * Plugin URI:        https://wordpress.org/plugins/party-planer
 * Description:       Party Planer Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cumque, dolor, dolorem dolores est eveniet expedita fugiat ipsa ipsam laudantium neque nihil obcaecati odit omnis perspiciatis quod totam velit vitae?
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            M Lab Studio
 * Author URI:        https://mlab-studio.com/
 * Text Domain:       party-planer
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

register_activation_hook( __FILE__, 'pp_activation' );
function pp_activation() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE `{$wpdb->prefix}party_planer` (
		`id` int(255) NOT NULL AUTO_INCREMENT,
		`fname` varchar(255) NOT NULL,
		`lname` varchar(255) NOT NULL,
		`email` varchar(255) NOT NULL,
		`phone` varchar(255) NOT NULL,
		PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	$wpdb->query( $sql );
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