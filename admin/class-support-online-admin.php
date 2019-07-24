<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * @package    support-online
 * @subpackage support-online/admin
 * @author     MagePeople team <magepeopleteam@gmail.com>
 */
if ( ! class_exists( "Support_Online_Admin" ) ) {

	class Support_Online_Admin {

		public function __construct() {

			$this->load_admin_dependencies();

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		public function enqueue_styles() {

			wp_enqueue_style( 'mage-admin-css', SUPPORT_ONLINE_DIR . 'css/mage-plugin-admin.css', array(), time(), 'all' );

		}//end method enqueue_styles

		public function enqueue_scripts() {

			wp_enqueue_script( 'mage-plugin-js', SUPPORT_ONLINE_DIR . 'js/mage-plugin-admin.js', array( 'jquery' ), time(), false );

		}//end method enqueue_scripts


		/**
		 * This function will load all the dependencies.
		 */
		private function load_admin_dependencies() {
			require_once SUPPORT_ONLINE_DIR . 'admin/class/class-admin-settings.php';
		}//end method load_admin_dependencies


	}//end class Support_Online_Admin
}// class exist block

new Support_Online_Admin();