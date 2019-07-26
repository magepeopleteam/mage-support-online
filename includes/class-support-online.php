<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * @since      1.0.0
 * @package    Support_Online_Plugin
 * @subpackage Mage_Plugin/includes
 * @author     MagePeople team <magepeopleteam@gmail.com>
 */
if ( ! class_exists( "MAGESO_Support_Online_Loader" ) ) {

	class MAGESO_Support_Online_Loader {

		protected $loader;

		protected $plugin_name;

		protected $version;

		public function __construct() {
			$this->load_dependencies();
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		}

		/**
		 * Load all dependencies.
		 */
		private function load_dependencies() {
			require_once MAGESO_SUPPORT_ONLINE_DIR . 'lib/class-support-online-settings-api.php';
			require_once MAGESO_SUPPORT_ONLINE_DIR . 'includes/class-support-online-loader.php';
			require_once MAGESO_SUPPORT_ONLINE_DIR . 'admin/class-support-online-admin.php';
			require_once MAGESO_SUPPORT_ONLINE_DIR . 'public/class-support-online-public.php';
			$this->loader = new MAGESO_Support_Online_Plugin_Loader();
		}//end method load_dependencies


		/**
		 * Load plugin textdomain.
		 */
		public function load_plugin_textdomain() {

			load_plugin_textdomain(
				'mage-support-online',
				false,
				dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
			);

		}//end method load_plugin_textdomain

		public function get_plugin_name() {
			return $this->plugin_name;
		}

		public function get_loader() {
			return $this->loader;
		}

		public function get_version() {
			return $this->version;
		}

		public function run() {
			$this->loader->run();
		}

	}//end class MAGESO_Support_Online_Loader
}//end class exist block