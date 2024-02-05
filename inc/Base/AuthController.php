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
		add_action( 'wp_ajax_nopriv_ajaxlogin', array( $this, 'wpgreeks_login' ) );
		add_action('init', array( $this, 'wpgreeks_login_ajax' ));
		add_shortcode( 'wpgreeks-login', array( $this, 'SetLoginFormShortcode' ) );

		add_action('wp_ajax_wpgreeks_signup',  array( $this, 'wpgreeks_signup' ));
		add_action('wp_ajax_nopriv_wpgreeks_signup', array( $this, 'wpgreeks_signup' ));
		add_shortcode( 'wpgreeks-signup', array( $this, 'SetSignupFormShortcode' ) );
	}

	public function wpgreeks_login_ajax(){
		wp_register_script('wpgreeks-login-script', $this->plugin_url . 'assets/js/wpgreeks-auth.js', array('jquery') );
		wp_enqueue_script( 'wpgreeks-validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.js', array('jquery') );
		wp_enqueue_script('wpgreeks-login-script');
		wp_localize_script( 'wpgreeks-login-script', 'ajax_wpgreeks_login', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => home_url(),
			'loadingmessage' => __('We are retrieving your information, please wait...'),
			'infoclass'=> __('info')
		));
	}

	public function wpgreeks_login()
	{

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

	public function wpgreeks_signup()
	{
		$new_user_name = stripcslashes($_POST['new_user_name']);
		$new_user_email = stripcslashes($_POST['new_user_email']);
		$new_user_password = $_POST['new_user_password'];
		$user_nice_name = strtolower($_POST['new_user_email']);
		$user_data = array(
			'user_login' => $new_user_name,
			'user_email' => $new_user_email,
			'user_pass' => $new_user_password,
			'user_nicename' => $user_nice_name,
			'display_name' => $new_user_first_name,
			'role' => 'subscriber'
		);
		$user_id = wp_insert_user($user_data);
			if (!is_wp_error($user_id)) 
			{
				echo '<span class="successMsg">Welcome! You have registered successfully...</span>';
			} 
			else 
			{
			  if (isset($user_id->errors['existing_user_login'])) 
				{
					echo'<span class="errorMsg">Username already exists, please try another username.</span>';
				} 
				else 
				{
					echo'<span class="errorMsg">Unable to create new user, please try again</span>';
				}
			}
	  die;
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

	public function SetSignupFormShortcode()
	{
		ob_start(); ?>
		<div class="signup-container">
			<form id="wpgreeks-register-form" action="#" method="POST" name="register-form" class="register-form" autocomplete="off">
				<h2>Create Account</h2>
				<p>Enter your personal details and start journey with us</p>
				<p class="status" style="display:none"></p>
				<div class="form-group">
					<label for="username">Enter Username</label>
					<input type="text" class="form-control" name="new_user_name" placeholder="Username" id="new-username" >
				</div>
				<div class="form-group">
					<label for="useremail">Enter Email Address</label>
					<input type="email" class="form-control" name="new_user_email" placeholder="Email address" id="new-useremail">
				</div>
				<div class="form-group">
					<label for="password">Enter your Password</label>
					<input type="password" class="form-control" name="new_user_password" placeholder="Password" id="new-userpassword" autocomplete>
				</div>
				<div class="form-group">
					<label for="cpassword">Please Confirm Password</label>
					<input type="password" class="form-control" name="re_pwd" placeholder="Confirm Password" id="re_pwd" autocomplete>
				</div>
				<div class="register-form-btn-action">
					<input type="submit"  class="button" id="register-button" value="Register">
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
				'page_title' => 'Login & Signup', 
				'menu_title' => 'Login & Signup', 
				'capability' => 'manage_options', 
				'menu_slug' => 'wpgreeks_auth', 
				'callback' => array( $this->callbacks, 'adminAuth' )
			)
		);
	}
}