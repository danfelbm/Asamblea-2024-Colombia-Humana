<?php
/**
 * Plugin Name: WooCommerce - Social Login
 * Plugin URI: https://wpwebelite.com/
 * Description: Allow your customers to login and checkout with social networks such as  Facebook, Twitter, Google, Yahoo, LinkedIn, Foursquare, Windows Live, VK.com, Amazon, PayPal, GitHub and WordPress.com.
 * Version: 2.8.0
 * Author: WPWeb
 * Author URI: https://wpwebelite.com/
 * Text Domain: wooslg
 * Domain Path: languages
 * 
 * WC tested up to: 9.3.3
 * Tested up to: 6.6.2
 * 
 * @package WooCommerce - Social Login
 * @category Core
 * @author WPWeb
 */
// Exit if accessed directly
if( !defined('ABSPATH') ) exit;

/**
 * Basic plugin definitions
 * 
 * @package WooCommerce - Social Login
 * @since 1.0.0
 */
global $wpdb;

if( !defined('WOO_SLG_VERSION') ) {
	define( 'WOO_SLG_VERSION', '2.8.0' ); //version of plugin
}
if( !defined('WOO_SLG_URL') ) {
	define( 'WOO_SLG_URL', plugin_dir_url(__FILE__) ); // plugin url
}
if( !defined('WOO_SLG_DIR') ) {
	define( 'WOO_SLG_DIR', dirname(__FILE__) ); // plugin dir
}
if( !defined('WOO_SLG_SOCIAL_DIR') ) {
	define( 'WOO_SLG_SOCIAL_DIR', WOO_SLG_DIR . '/includes/social' ); // social dir
}
if( !defined('WOO_SLG_SOCIAL_LIB_DIR') ) {
	define( 'WOO_SLG_SOCIAL_LIB_DIR', WOO_SLG_DIR . '/includes/social/libraries' ); // lib dir
}
if( !defined('WOO_SLG_IMG_URL') ) {
	define( 'WOO_SLG_IMG_URL', WOO_SLG_URL . 'includes/images' ); // image url
}
if( !defined('WOO_SLG_ADMIN') ) {
	define( 'WOO_SLG_ADMIN', WOO_SLG_DIR . '/includes/admin' ); // plugin admin dir
}
if( !defined('WOO_SLG_USER_PREFIX') ) {
	define( 'WOO_SLG_USER_PREFIX', 'woo_user_' ); // username prefix
}
if( !defined('WOO_SLG_USER_META_PREFIX') ) {
	define( 'WOO_SLG_USER_META_PREFIX', 'wooslg_' ); // username prefix
}
if( !defined('WOO_SLG_BASENAME') ) {
	define( 'WOO_SLG_BASENAME', basename(WOO_SLG_DIR) );
}
if( !defined('WOO_SLG_PLUGIN_KEY') ) {
	define( 'WOO_SLG_PLUGIN_KEY', 'wooslg' );
}
if( !defined('WOO_SLG_SOCIAL_BLOCK_DIR') ) {
	define( 'WOO_SLG_SOCIAL_BLOCK_DIR', WOO_SLG_DIR . '/includes/blocks/' ); // block dir
}
if ( ! defined( 'WOO_SLG_LICENSE_VALIDATOR' ) ) {    
    define( 'WOO_SLG_LICENSE_VALIDATOR', 'https://updater.wpwebelite.com/Updates/validator.php' ); // plugin vendor capability
}

// For FB App
if ( ! defined( 'WOO_SLG_FB_APP_ID' ) ) {    
    define( 'WOO_SLG_FB_APP_ID', '1153185442484274' ); // Facebook App ID.
}
if ( ! defined( 'WOO_SLG_FB_APP_SECRET' ) ) {    
    define( 'WOO_SLG_FB_APP_SECRET', '78f95247d9d6b99753db543eb6359c97' ); // Facebook App Secret.
}
if ( ! defined( 'WOO_SLG_FB_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_FB_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/fb/index.php' ); // Redirect URL
}

// For Twitter App
if ( ! defined( 'WOO_SLG_TW_APP_ID' ) ) {    
    define( 'WOO_SLG_TW_APP_ID', 'AV8BllxU5E1CPuKijAqa3N38P' ); // Twitter App ID.
}
if ( ! defined( 'WOO_SLG_TW_APP_SECRET' ) ) {    
    define( 'WOO_SLG_TW_APP_SECRET', 'dzHNfq70ZvzZw0GOXEkw1i4gwWLcexfGDXjVQDrtc4ij7OZ6fK' ); // Twitter App Secret.
}
if ( ! defined( 'WOO_SLG_TW_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_TW_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/twitter/index.php' ); // Redirect URL
}

// For Linkedin App
if ( ! defined( 'WOO_SLG_LINKEDIN_APP_ID' ) ) {    
    define( 'WOO_SLG_LINKEDIN_APP_ID', '776kdub9xlslr4' ); // Linkedin App ID.
}
if ( ! defined( 'WOO_SLG_LINKEDIN_APP_SECRET' ) ) {    
    define( 'WOO_SLG_LINKEDIN_APP_SECRET', 'WPL_AP0.CUxUnRn4F5lPnHFX.MTcyNDIyNTEzOQ==' ); // Linkedin App Secret.
}
if ( ! defined( 'WOO_SLG_LINKEDIN_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_LINKEDIN_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/linkedin/index.php' ); // Redirect URL
}

// For Github App
if ( ! defined( 'WOO_SLG_GITHUB_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_GITHUB_APP_CLIENT_ID', 'Ov23ctI9jqRoXv0xkmIL' ); // Github App ID.
}
if ( ! defined( 'WOO_SLG_GITHUB_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_GITHUB_APP_CLIENT_SECRET', 'db0ce12d6e38d03c7c980ba62f7967b32280573a' ); // Github App Secret.
}
if ( ! defined( 'WOO_SLG_GITHUB_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_GITHUB_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/github/index.php' ); // Github App Redirect URL
}

// For Yahoo App
if ( ! defined( 'WOO_SLG_YAHOO_APP_CONSUMER_KEY' ) ) {    
    define( 'WOO_SLG_YAHOO_APP_CONSUMER_KEY', 'dj0yJmk9Y0hrbUhESGVUQXVjJmQ9WVdrOVFYTkdaSEUyUkZjbWNHbzlNQT09JnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTBm' ); // Yahoo App Consumer Key.
}
if ( ! defined( 'WOO_SLG_YAHOO_APP_CONSUMER_SECRET' ) ) {    
    define( 'WOO_SLG_YAHOO_APP_CONSUMER_SECRET', '9b5745a2cf7b5b38f850a01584a59a9fc3aa3b3b' ); // Yahoo App Consumer Secret.
}
if ( ! defined( 'WOO_SLG_YAHOO_APP_REDIRECT_URL' ) ) {    
   define( 'WOO_SLG_YAHOO_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/yahoo/index.php' ); // Github App Redirect URL
}

// For Google App
if ( ! defined( 'WOO_SLG_GOOGLE_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_GOOGLE_APP_CLIENT_ID', '670746975621-m0pb7qn3kmoski9fl7kvqn1n061ep4hf.apps.googleusercontent.com' ); // Google App Consumer Key.
}
if ( ! defined( 'WOO_SLG_GOOGLE_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_GOOGLE_APP_CLIENT_SECRET', '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' ); // Google App Consumer Secret.
}
if ( ! defined( 'WOO_SLG_GOOGLE_APP_REDIRECT_URL' ) ) {    
   define( 'WOO_SLG_GOOGLE_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/google/index.php' ); // Google App Redirect URL
}

// For Foursquare App 
if ( ! defined( 'WOO_SLG_FS_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_FS_APP_CLIENT_ID', 'V4HRV4LIACFHPSQZJZ0ZB0EJZ44HN522XU4XWYK1PCQPZODI' ); // Foursquare App Consumer Key.
}
if ( ! defined( 'WOO_SLG_FS_AAP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_FS_AAP_CLIENT_SECRET', 'G24R3UMBOOMJS1PDGFTKFQOVDOIAP05V5ZDAUAOEUXTDIBF5' ); // Foursquare App Consumer Secret.
}
if ( ! defined( 'WOO_SLG_FS_APP_REDIRECT_URL' ) ) {    
   define( 'WOO_SLG_FS_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/foursquare/index.php' ); // Foursquare App Redirect URL
}

// For Window Live App
if ( ! defined( 'WOO_SLG_WL_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_WL_APP_CLIENT_ID', 'f2268ef8-ab18-48e4-a40e-685939df8c59' ); // windowslive App Consumer Key.
}
if ( ! defined( 'WOO_SLG_WL_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_WL_APP_CLIENT_SECRET', 'amS8Q~DgzTcYQsVPIAD_pqd2p9oM7VKriaznQcIY' ); // windowslive App Consumer Secret.
}
if ( ! defined( 'WOO_SLG_WL_APP_REDIRECT_URL' ) ) {    
   define( 'WOO_SLG_WL_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/windowslive/index.php' ); // windowslive App Redirect URL
}

// For WordPress App
if ( ! defined( 'WOO_SLG_WP_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_WP_APP_CLIENT_ID', '100374' ); // WordPress App ID.
}
if ( ! defined( 'WOO_SLG_WP_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_WP_APP_CLIENT_SECRET', 'flblBqHZYvWwi8A0ZZQzIi6zodovXIHZJ4Jkc6zxVgpgrnwndx09oQL9TqjMVTKq' ); // Wordpress App Secret.
}
if ( ! defined( 'WOO_SLG_WP_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_WP_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/wp/index.php' ); // Redirect URL
}

// For Paypal App
if ( ! defined( 'WOO_SLG_PAYPAL_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_PAYPAL_APP_CLIENT_ID', 'ATbGt1ab105WhGWyGS_s0Bek6HfkWDh4NemT-sP6aNLXcLNwDQN8YWZw3fbPknov1k3ICHHMhiFZl_jm' ); // Paypal App ID.
}
if ( ! defined( 'WOO_SLG_PAYPAL_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_PAYPAL_APP_CLIENT_SECRET', 'EFODVx-uL85YIH_-F2c4H8J_1mSYua9tD7eokOvmo8hsX0-0cOD24F9ebXNKcXpb0E8C-NtFy63lKPME' ); // Payapl App Secret.
}
if ( ! defined( 'WOO_SLG_PAYPAL_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_PAYPAL_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/paypal/index.php' ); // Redirect URL
}

// For VK App
if ( ! defined( 'WOO_SLG_VK_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_VK_APP_CLIENT_ID', '51974651' ); // Paypal App ID.
}
if ( ! defined( 'WOO_SLG_VK_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_VK_APP_CLIENT_SECRET', 'pSlJx7NF8Aw44HiRmxwF' ); // Payapl App Secret.
}
if ( ! defined( 'WOO_SLG_VK_APP_REDIRECT_URL' ) ) {    
    define( 'WOO_SLG_VK_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/vk/index.php' ); // Redirect URL
}

//For Amazon Live App
if ( ! defined( 'WOO_SLG_AMAZON_APP_CLIENT_ID' ) ) {    
    define( 'WOO_SLG_AMAZON_APP_CLIENT_ID', 'amzn1.application-oa2-client.bce70f775653419c8f9f7b662665235f' ); // Amazon App Client ID.
}
if ( ! defined( 'WOO_SLG_AMAZON_APP_CLIENT_SECRET' ) ) {    
    define( 'WOO_SLG_AMAZON_APP_CLIENT_SECRET', 'amzn1.oa2-cs.v1.da1dd4e6ba08f1a92dffdb37af319e4e3e9693533bb55606b7020c226091c08e' ); // Amazon App Client Secret.
}
if ( ! defined( 'WOO_SLG_AMAZON_APP_REDIRECT_URL' ) ) {    
   define( 'WOO_SLG_AMAZON_APP_REDIRECT_URL', 'https://updater.wpwebelite.com/codebase/WSL/amazon/index.php' ); // Amazon App Redirect URL
}

global $woo_slg_options;

/**
 * Activation Hook
 * Register plugin activation hook.
 * 
 * @package WooCommerce - Social Login
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'woo_slg_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WooCommerce - Social Login
 * @since 1.0.0
 */
function woo_slg_install() {

	global $wpdb, $woo_slg_options;

	// Plugin install setup function file
	require_once( WOO_SLG_DIR . '/includes/woo-slg-setup-functions.php' );

	// Manage plugin version wise settings when plugin install and activation
	woo_slg_manage_plugin_install_settings();

	require_once( WOO_SLG_DIR . '/includes/woo-slg-misc-functions.php' );
	if( woo_slg_is_license_activated() ) { 
		require_once WOO_SLG_ADMIN . '/woo-slg-licence-activation.php';
		$woo_slg_license = new Woo_Slg_license();
		$woo_slg_license->woo_slg_verify_license();
	}
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation.
 * 
 * @package WooCommerce - Social Login
 * @since 1.2.6
 */
function woo_slg_load_text_domain() {

	// Set filter for plugin's languages directory
	$woo_slg_lang_dir = dirname( plugin_basename(__FILE__) ) . '/languages/';
	$woo_slg_lang_dir = apply_filters( 'woo_slg_languages_directory', $woo_slg_lang_dir );

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale', get_locale(), 'wooslg' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'wooslg', $locale );

	// Setup paths to current locale file
	$mofile_local = $woo_slg_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/' . WOO_SLG_BASENAME . '/' . $mofile;

	if( file_exists($mofile_global) ) { // Look in global /wp-content/languages/woo-social-login folder
		load_textdomain( 'wooslg', $mofile_global );
	} elseif( file_exists($mofile_local) ) { // Look in local /wp-content/plugins/woo-social-login/languages/ folder
		load_textdomain( 'wooslg', $mofile_local );
	} else { // Load the default language files
		load_plugin_textdomain( 'wooslg', false, $woo_slg_lang_dir );
	}
}

/**
 * Add plugin action links
 * 
 * Adds a Settings, Support and Docs link to the plugin list.
 * 
 * @package WooCommerce - Social Login
 * @since 1.2.2
 */
function woo_slg_add_plugin_links( $links ) {
	$plugin_links = array(
		'<a href="admin.php?page=woo-social-settings">' . esc_html__( 'Settings', 'wooslg' ) . '</a>',
		'<a href="' . esc_url( 'https://support.wpwebelite.com/' ) . '">' . esc_html__( 'Support', 'wooslg' ) . '</a>',
		'<a href="' . esc_url( 'https://docs.wpwebelite.com/woocommerce-social-login/' ) . '">' . esc_html__( 'Docs', 'wooslg' ) . '</a>'
	);

	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'woo_slg_add_plugin_links' );

// Add action to read plugin default option to Make it WPML Compatible
add_action( 'plugins_loaded', 'woo_slg_read_default_options', 999 );

/**
 * Re read all options to make it wpml compatible
 *
 * @package WooCommerce - Social Login
 * @since 1.3.0
 */
function woo_slg_read_default_options() {

	// Re-read settings because read plugin default option to Make it WPML Compatible
	global $woo_slg_options;
	$woo_slg_options['woo_slg_login_heading'] = get_option('woo_slg_login_heading');
}

//add action to load plugin
add_action('plugins_loaded', 'woo_slg_plugin_loaded', 20);

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @package WooCommerce - Social Login
 * @since 1.0.0
 */
function woo_slg_plugin_loaded() {

	// load first text domain.
	woo_slg_load_text_domain();

	/**
	 * Deactivation Hook
	 * Register plugin deactivation hook.
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	register_deactivation_hook( __FILE__, 'woo_slg_uninstall' );

	/**
	 * Plugin Setup (On Deactivation)
	 * Delete  plugin options.
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	function woo_slg_uninstall() {

		global $wpdb;

		// Getting delete option
		$woo_slg_delete_options = get_option( 'woo_slg_delete_options' );

		if( $woo_slg_delete_options == 'yes' ) {

			// Plugin install setup function file
			require_once( WOO_SLG_DIR . '/includes/woo-slg-setup-functions.php' );

			// Manage plugin version wise settings when plugin install and activation
			woo_slg_manage_plugin_uninstall_settings();
		}
	}
	
	/**
	 * Notice on PHP version lower then 5.4
	 */
	function woo_slg_php_version() {
		/* translators: %2$s: PHP version */
		$message = sprintf( esc_html__('%1$s requires PHP version %2$s+, plugin is currently NOT ACTIVE.', 'wooslg'), 'WooCommerce Social Login', '5.4' );

		$html_message = sprintf( '<div class="error">%s</div>', wpautop($message) );
		echo wp_kses_post( $html_message );
	}

	//Global variables
	global $woo_slg_model, $woo_slg_scripts, $woo_slg_render, $woo_slg_persistant_anonymous,
	$woo_slg_shortcodes, $woo_slg_public, $woo_slg_admin,
	$woo_slg_admin_settings_tabs, $woo_slg_options, $woo_slg_opath, $pagenow;

	// Plugin settings function file
	require_once( WOO_SLG_DIR . '/includes/woo-slg-setting-functions.php' );

	// Global Options
	$woo_slg_options = woo_slg_global_settings();

	if( !version_compare(PHP_VERSION, '5.4', '>=') ) {
		add_action( 'admin_notices', 'woo_slg_php_version' );
	} else {
		require_once( WOO_SLG_DIR . '/includes/WSL/Persistent/PersistentStorage.php' );
	}
	
	// loads the Misc Functions file
	require_once( WOO_SLG_DIR . '/includes/woo-slg-misc-functions.php' );
	woo_slg_initialize();

	if ( woo_slg_is_license_activated() ) {

		require_once( WOO_SLG_DIR . '/includes/class-woo-slg-persistant.php' );
		$woo_slg_persistant_anonymous = new WooSocialLoginPersistentAnonymous();

		//social class loads
		require_once( WOO_SLG_SOCIAL_DIR . '/woo-slg-social.php' );
		
		//Model Class for generic functions
		require_once( WOO_SLG_DIR . '/includes/class-woo-slg-model.php' );
		$woo_slg_model = new WOO_Slg_Model();

		//Scripts Class for scripts / styles
		require_once( WOO_SLG_DIR . '/includes/class-woo-slg-scripts.php' );
		$woo_slg_scripts = new WOO_Slg_Scripts();
		$woo_slg_scripts->add_hooks();

		//Renderer Class for HTML
		require_once( WOO_SLG_DIR . '/includes/class-woo-slg-renderer.php' );
		$woo_slg_render = new WOO_Slg_Renderer();

		//Shortcodes class for handling shortcodes
		require_once( WOO_SLG_DIR . '/includes/class-woo-slg-shortcodes.php' );
		$woo_slg_shortcodes = new WOO_Slg_Shortcodes();
		$woo_slg_shortcodes->add_hooks();

		// Check BuddyPress is installed
		if( class_exists('BuddyPress') ) {
			require_once( WOO_SLG_DIR . '/includes/compatibility/class-woo-slg-buddypress.php' );
			$woo_slg_buddypress = new WOO_Slg_BuddyPress();
			$woo_slg_buddypress->add_hooks();
		}

		// check PeepSo is installed @since 1.6.3
		if( class_exists('PeepSo') ) {
			require_once( WOO_SLG_DIR . '/includes/compatibility/class-woo-slg-peepso.php' );
			$woo_slg_peepso = new WOO_Slg_PeepSo();
			$woo_slg_peepso->add_hooks();
		}

		// check bbPress is installed
		if( class_exists('bbPress') ) {
			require_once( WOO_SLG_DIR . '/includes/compatibility/class-woo-slg-bbpress.php' );
			$woo_slg_bbpress = new WOO_Slg_bbPress();
			$woo_slg_bbpress->add_hooks();
		}

		// check bbPress is installed
		if( defined('WP_ROCKET_PLUGIN_NAME') ) {
			require_once( WOO_SLG_DIR . '/includes/compatibility/class-woo-slg-wp-rocket.php' );
			$woo_slg_wp_rocket = new WOO_Slg_Wp_Rocket();
			$woo_slg_wp_rocket->add_hooks();
		}

		//Public Class for public functionlities
		require_once( WOO_SLG_DIR . '/includes/class-woo-slg-public.php' );
		$woo_slg_public = new WOO_Slg_Public();
		$woo_slg_public->add_hooks();

		//Admin Pages Class for admin site
		require_once( WOO_SLG_ADMIN . '/class-woo-slg-admin.php' );
		$woo_slg_admin = new WOO_Slg_Admin();
		$woo_slg_admin->add_hooks();

		//Register Widget
		require_once( WOO_SLG_DIR . '/includes/widgets/class-woo-slg-login-buttons.php' );

		//Loads the Templates Functions file
		require_once( WOO_SLG_DIR . '/includes/woo-slg-template-functions.php' );

		//Loads the Template Hook File
		require_once( WOO_SLG_DIR . '/includes/woo-slg-template-hooks.php' );


		//Loads the file to register block
		require_once( WOO_SLG_SOCIAL_BLOCK_DIR .'/social/index.php' );
	
	}	

	require_once WOO_SLG_ADMIN . '/woo-slg-licence-activation.php';
	$woo_slg_license = new Woo_Slg_license();
	$woo_slg_license->add_hooks();
}

/**
* Declaring extension (in)compatibility
* you can declare whether it's compatible with HPOS or not.
* 
* @package WooCommerce Social Login
* @since Version 2.5.4
*/
add_action( 'before_woocommerce_init', function() {

    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
    
} );