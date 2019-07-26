<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Fired during plugin activation
 *
 * @link       https://mage-people.com
 * @since      1.0.0
 * @author     magepeople <info@mage-people.com>
 */
if ( ! class_exists( "MAGESO_Support_Online_Dectivator" ) ) {
	class MAGESO_Support_Online_Dectivator {
		/**
		 *
		 * @since    1.0.0
		 */
		public static function deactivate() {

		}
	}
}