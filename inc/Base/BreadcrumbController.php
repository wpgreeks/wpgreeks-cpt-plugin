<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\CallBacks\AdminCallbacks;

class BreadcrumbController extends BaseController
{
    public $settings;
	public $callbacks;
	public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'wpgreeks_breadcrumb' ) ) return;

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->setSubpages();
		$this->settings->addSubPages( $this->subpages )->register();

		add_shortcode( 'wpgreeks-breadcrumb', array( $this, 'SetBreadcrumbShortcodePage' ) );
	}

    public function SetBreadcrumbShortcodePage()
    {
		ob_start();

        require_once( "$this->plugin_path/templates/breadcrumb-navigation.php" );

		return ob_get_clean();

    }

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'wpgreeks_plugin', 
				'page_title' => 'Breadcrumbs', 
				'menu_title' => 'Breadcrumbs', 
				'capability' => 'manage_options', 
				'menu_slug' => 'wpgreeks_breadcrumb', 
				'callback' => array( $this->callbacks, 'adminBreadcrumb' )
			)
		);
	}
}