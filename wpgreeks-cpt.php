<?php
/**
 * @package WPGreeksCPT
 * @author Prashant Agarwal
 * @license GPL-2.0-or-later
 */

/*
Plugin Name: WPGreeks CPT
Description: WPGreeks CPT Plugin provides an easy to use interface for registering and managing custom post types.
Version: 1.0.0
Requires at least: 5.2
Requires PHP: 7.4
Author: Prashant Agarwal
Author URI: https://profiles.wordpress.org/wpgreeks/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: wpgreeks-cpt
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2024 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'PLUGIN', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation
 */
function activate_wpgreeks_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_wpgreeks_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_wpgreeks_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_wpgreeks_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}