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
		add_shortcode( 'wpgreeks-login', array( $this, 'SetLoginFormShortcode' ) );
	}

	public function wpgreeks_login_ajax(){
		wp_register_script('wpgreeks-login-script', $this->plugin_url . 'assets/js/wpgreeks-auth.js', array('jquery') ); 
		wp_enqueue_script('wpgreeks-login-script');
		wp_localize_script( 'wpgreeks-login-script', 'ajax_wpgreeks_login', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => home_url(),
			'loadingmessage' => __('We are retrieving your information, please wait...'),
			'infoclass'=> __('info')
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
					'message'=>__('Wrong Username or Password.'),
					'class'=> __('error')
				)
			);
		} else {
			echo json_encode(
				array(
					'status'=>true,  
					'message'=>__('Login successful, redirecting...'),
					'class'=> __('success')
				)
			);
		}
	
		die();
	}

	public function SetLoginFormShortcode()
	{
		$loggedInUserMsg = "<div class='loggedinUserMsg'>". 'You are already logged in.' ."</div>";
		if ( is_user_logged_in() ) return $loggedInUserMsg;

		ob_start(); ?>
		<div class="login-container">
			<form id="wpgreeks-login-form" method="post" action="#" class="login-form">
				<h2>Welcome Back</h2>
				<p>Please login to your account</p>
				<p class="status"></p>
				<div class="form-group">
					<label for="username">Username or Email Address</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
				</div>
				<div class="login-form-btn-action">
					<button type="submit" name="submit" class="btn btn-primary btn-dark">LOG IN</button>
					<a href="<?php echo wp_lostpassword_url(); ?>">Request a new password?</a>

					<input type="hidden" name="action" value="wpgreeks_login_form">
					<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
				</div>
			</form>
		</div>
		<?php return ob_get_clean();
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