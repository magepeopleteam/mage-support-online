<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * @author     MagePeople team <magepeopleteam@gmail.com>
 */
if ( ! class_exists( "MAGESO_Support_Online_Admin_Base" ) ) {

	class MAGESO_Support_Online_Admin_Base {

		public function __construct() {
			$this->load_admin_dependencies();

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Enqueue all css file
		 */
		public function enqueue_styles() {

			wp_enqueue_style( 'mageso-admin-admin-css', MAGESO_SUPPORT_PLUGIN_URL . 'admin/css/mage-plugin-admin.css', array(), time(), 'all' );

			wp_enqueue_style( 'mageso-admin-timepicker', MAGESO_SUPPORT_PLUGIN_URL . 'admin/js/jquery.timepicker
			.min.css', array(), time(), 'all' );


		}//end method enqueue_styles

		/**
		 * Enqueue all js file
		 */
		public function enqueue_scripts() {

			wp_enqueue_script( 'mageso-admin-plugin-js', MAGESO_SUPPORT_PLUGIN_URL . 'admin/js/mage-plugin-admin.js', array( 'jquery' ), time(), true );

			wp_enqueue_script( 'mageso-admin-timepicker-js', MAGESO_SUPPORT_PLUGIN_URL . 'admin/js/jquery
			.timepicker.min.js', array( 'jquery' ), time(), true );

		}//end method enqueue_scripts


		/**
		 * This function will load all the dependencies.
		 */
		private function load_admin_dependencies() {
			require_once MAGESO_SUPPORT_ONLINE_DIR . 'admin/class/class-admin-settings.php';
		}//end method load_admin_dependencies


	}//end class MAGESO_Support_Online_Base
}// class exist block

new MAGESO_Support_Online_Admin_Base();