<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class ModernDesignController extends BaseController
{

	public function register()
	{
		if ( ! $this->activated( 'modern_design' ) ) return;

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_modern_design' ) );

	}

    function enqueue_modern_design() {

		// enqueue all our scripts
		wp_enqueue_style( 'wpgreeks-admin-menu', $this->plugin_url . 'assets/css/admin-menu.css' );
	}
}