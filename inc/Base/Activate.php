<?php

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'wpgreeks_plugin' ) ) {
			update_option( 'wpgreeks_plugin', $default );
		}

		if ( ! get_option( 'wpgreeks_plugin_cpt' ) ) {
			update_option( 'wpgreeks_plugin_cpt', $default );
		}
	}
}