<?php
/**
 * Plugin Name:       Support-online
 * Plugin URI:        mage-people.com
 * Description:       This plugin will show your online status like active and deactive.
 * Version:           1.0.0
 * Author:            MagePeople team
 * Author URI:        mage-people.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       support_online
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
function activate_support_online_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-online-activator.php';
	Support_Online_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-support-online-deactivator.php
 */
function deactivate_support_online_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-support-online-deactivator.php';
	Support_Online_Dectivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_support_online_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_support_online_plugin' );


if ( ! class_exists( "Support_Online_Base" ) ) {

	class Support_Online_Base {

		public function __construct() {
			$this->define_constants();
			$this->load_main_class();
			$this->run_mage_plugin();
		}

		public function define_constants() {
			define( 'SUPPORT_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
			define( 'SUPPORT_ONLINE_DIR', plugin_dir_path( __FILE__ ) );
			define( 'SUPPORT_ONLINE_FILE', plugin_basename( __FILE__ ) );
			define( 'SUPPORT_ONLINE_TEXTDOMAIN', 'support_online' );
		}

		public function load_main_class() {
			require SUPPORT_ONLINE_DIR . 'includes/class-support-online.php';
			require SUPPORT_ONLINE_DIR . 'includes/class-support-online-loader.php';
			require SUPPORT_ONLINE_DIR . 'includes/class-support-online-helper.php';
		}

		public function run_mage_plugin() {
			$plugin = new Support_Online_Loader();
			$plugin->run();
		}

	}//end Support_Online_Base
}//end class exist block

new Support_Online_Base();