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
 *
 * @package    support-online
 * @subpackage support-online/includes
 */
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    support-online
 * @subpackage support-online/includes
 * @author     magepeople <info@mage-people.com>
 */
if ( ! class_exists( "Support_Online_Dectivator" ) ) {
	class Support_Online_Dectivator {
		/**
		 * Short Description. (use period)
		 *
		 * Long Description.
		 *
		 * @since    1.0.0
		 */
		public static function deactivate() {

		}
	}
}