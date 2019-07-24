<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


if ( ! class_exists( "Support_Online_Shortcode" ) ) {

	class Support_Online_Shortcode {
		public function __construct() {
			add_shortcode( 'support-online', array( $this, 'display_support_online' ) );
		}

		/**
		 * Callback [support-online] shortcode.
		 *
		 * @param $atts
		 * @param null $content
		 *
		 * @return false|string
		 */
		public function display_support_online( $atts, $content = null ) {

			$working_days = so_get_option( 'so_working_day', 'general_setting_sec', '' );

			if ( ! is_array( $working_days ) ) {
				$working_days = array();
			}

			return Support_Online_Helper::supportStatus();

		}//end method display_support_online


	}//end class Support_Online_Shortcode
}//end class exist block
new Support_Online_Shortcode();