<?php
/**
 * Plugin Name:       Mage Support Online
 * Description:       This plugin will show your online status like active and deactive. and when support will be offline or online.
 * Version:           1.0.2
 * Author:            MagePeopleTeam
 * Author URI:        mage-people.com
 * Text Domain:       mage-support-online
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-support-online-activator.php
 */
function mageso_activate_support_online_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-online-activator.php';
	MAGESO_Support_Online_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-support-online-deactivator.php
 */
function mageso_deactivate_support_online_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-online-deactivator.php';
	MAGESO_Support_Online_Dectivator::deactivate();
}

register_activation_hook( __FILE__, 'mageso_activate_support_online_plugin' );
register_deactivation_hook( __FILE__, 'mageso_deactivate_support_online_plugin' );


if ( ! class_exists( "MAGESO_Support_Online_Base" ) ) {
	
	class MAGESO_Support_Online_Base {
		
		public function __construct() {
			$this->define_constants();
			$this->load_main_class();
			$this->run_mage_plugin();
		}
		
		public function define_constants() {
			define( 'MAGESO_SUPPORT_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
			define( 'MAGESO_SUPPORT_ONLINE_DIR', plugin_dir_path( __FILE__ ) );
			define( 'MAGESO_SUPPORT_ONLINE_FILE', plugin_basename( __FILE__ ) );
		}
		
		public function load_main_class() {
			require MAGESO_SUPPORT_ONLINE_DIR . 'includes/class-support-online.php';
			require MAGESO_SUPPORT_ONLINE_DIR . 'includes/class-support-online-loader.php';
			require MAGESO_SUPPORT_ONLINE_DIR . 'includes/class-support-online-helper.php';
		}
		
		public function run_mage_plugin() {
			$plugin = new MAGESO_Support_Online_Loader();
			$plugin->run();
		}
		
	}//end MAGESO_Support_Online_Base
}//end class exist block

new MAGESO_Support_Online_Base();