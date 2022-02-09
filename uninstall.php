<?php
/**
 * Fired on the plugin uninstallation.
 *
 * @link       https://mlab-studio.com
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wpdb;

// Delete party_planer db table
$table = $wpdb->prefix . 'party_planer';
$wpdb->query( "DROP TABLE IF EXISTS $table" );