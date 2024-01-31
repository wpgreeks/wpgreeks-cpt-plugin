<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\CallBacks\AdminCallbacks;

class AuthController extends BaseController
{
    public $settings;
	public $callbacks;
	public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'login_manager' ) ) return;

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->setSubpages();
		$this->settings->addSubPages( $this->subpages )->register();

		// Enable the user with no privileges to run ajax_login() in AJAX
		add_action( 'wp_ajax_nopriv_ajaxlogin', array( $this, 'login' ) );
		add_action('init', array( $this, 'wpgreeks_login_ajax' ));
		add_shortcode( 'wpgreeks-login', array( $this, 'SetLoginFormShortcodePage' ) );
	}

	public function wpgreeks_login_ajax(){
		wp_register_script('wpgreeks-login-script', $this->plugin_url . 'assets/js/wpgreeks-auth.js', array('jquery') ); 
		wp_enqueue_script('wpgreeks-login-script');
		wp_localize_script( 'wpgreeks-login-script', 'ajax_wpgreeks_login', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => home_url(),
			'loadingmessage' => __('We are retrieving your information, please wait...')
		));
	}

	public function login(){

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-login-nonce', 'security' );
	
		// Nonce is checked, get the POST data and sign user on
		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['remember'] = true;
	
		$user_signon = wp_signon( $info, false );
		if ( is_wp_error($user_signon) ){
			echo json_encode(
				array(
					'status'=>false, 
					'message'=>__('Wrong Username or Password.')
				)
			);
		} else {
			echo json_encode(
				array(
					'status'=>true,  
					'message'=>__('Login successful, redirecting...')
				)
			);
		}
	
		die();
	}

	public function SetLoginFormShortcodePage()
	{
		if ( is_user_logged_in() ) return;

		ob_start();
		$file = $this->plugin_path . 'templates/login-form.php';
		if ( file_exists( $file ) ){
			load_template( $file, true );
		}	
		return ob_get_clean();

	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'wpgreeks_plugin', 
				'page_title' => 'Login Manager', 
				'menu_title' => 'Login Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'wpgreeks_auth', 
				'callback' => array( $this->callbacks, 'adminAuth' )
			)
		);
	}
}