<?php 
/**
 * @package  WPGreeksCPT
 */

namespace Inc\Api\CallBacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/cpt.php" );
	}

	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}

	public function adminAuth()
	{
		echo "<h1>Login Manager</h1>";
		echo "<p>Coming soon...</p>";
	}
}