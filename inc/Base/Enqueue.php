<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ) );
	}
	
	function enqueue() {

		// enqueue all our scripts
		wp_enqueue_style( 'wpgreeks-main-style', $this->plugin_url . 'assets/css/wpgreeks-main.css' );
		wp_enqueue_script( 'wpgreeks-main-script', $this->plugin_url . 'assets/js/wpgreeks-main.js' );
		wp_enqueue_script( 'code-prettify', 'https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js' );
	}
	function front_enqueue() {

		// enqueue all our scripts
		wp_enqueue_style( 'front-wpgreeks-style', $this->plugin_url . 'assets/css/wpgreeks-front.css' );
	}
}