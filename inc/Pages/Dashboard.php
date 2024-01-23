<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\CallBacks\AdminCallbacks;
use Inc\Api\CallBacks\ManagerCallbacks;

class Dashboard extends BaseController
{
	public $settings;
	public $callbacks;
	public $callbacks_mngr;
	public $pages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();
		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'WPGreeks CPT', 
				'menu_title' => 'WPGreeks CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'wpgreeks_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-smiley', 
				'position' => 13
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'wpgreeks_plugin_settings',
				'option_name' => 'wpgreeks_plugin',
				'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'wpgreeks_admin_index',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'wpgreeks_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array();

		foreach ( $this->managers as $key => $value ) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'wpgreeks_plugin',
				'section' => 'wpgreeks_admin_index',
				'args' => array(
					'option_name' => 'wpgreeks_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}

		$this->settings->setFields( $args );
	}
}