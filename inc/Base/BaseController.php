<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	protected $plugin;
	public $managers = array();

	public function __construct() {

		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/wpgreeks-plugin.php';

		$this->managers = array(
			'cpt_manager' => 'Activate CPT Manager',
			'taxonomy_manager' => 'Activate Taxonomy Manager',
			'modern_design'=> 'Enable Modern Design UI',
			'wpgreeks_widget' => 'Activate WPGreeks Widget',
			'wpgreeks_breadcrumb' => 'Activate WPGreeks Breadcrumbs',
			'login_manager' => 'Activate Ajax Login/Signup',
		);
	}

	public function activated( string $key )
	{
		$option = get_option( 'wpgreeks_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}