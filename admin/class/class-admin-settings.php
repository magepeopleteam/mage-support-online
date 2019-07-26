<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
/**
 * MagePeople Settings API Bsed Setting Panel
 * @version 1.0
 */
if ( ! class_exists( 'MAGESO_Support_Online_Setting_Controls' ) ) {
	class MAGESO_Support_Online_Setting_Controls {

		private $settings_api;

		function __construct() {
			$this->settings_api = new MAGESO_Support_Online_Setting_API;

			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'create_options_page' ) );
		}

		function admin_init() {

			//set the settings
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );

			//initialize settings
			$this->settings_api->admin_init();
		}

		function create_options_page() {
			add_options_page(
				esc_html__( 'Support Online', 'mage-support-online '),
				esc_html__( 'Support Online', 'mage-support-online '),
				'manage_options',
				'mage-plugin_settings_page',
				array( $this, 'display_options_page' )
			);
		}

		function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'general_setting_sec',
					'title' => __( 'Working Hours', 'mage-support-online ')
				)
			);

			return $sections;
		}


		/**
		 * Returns all the settings fields
		 *
		 * @return array settings fields
		 */
		function get_settings_fields() {
			$settings_fields = array(
				'general_setting_sec' => array(

					array(
						'name'    => 'so_working_day',
						'label'   => __( 'Select working days', 'mage-support-online '),
						'type'    => 'multicheck',
						'options' => array(
							'sat' => esc_html__( 'Saturday', 'mage-support-online '),
							'sun' => esc_html__( 'Sunday', 'mage-support-online '),
							'mon' => esc_html__( 'Monday   ', 'mage-support-online '),
							'tue' => esc_html__( 'Tuesday', 'mage-support-online '),
							'wed' => esc_html__( 'Wednesday', 'mage-support-online '),
							'thu' => esc_html__( 'Thursday', 'mage-support-online '),
							'fri' => esc_html__( 'Friday', 'mage-support-online '),
						)
					),

					array(
						'name'    => 'so_off_day',
						'label'   => __( 'Select off days', 'mage-support-online '),
						'type'    => 'multicheck',
						'options' => array(
							'sat' => esc_html__( 'Saturday', 'mage-support-online '),
							'sun' => esc_html__( 'Sunday', 'mage-support-online '),
							'mon' => esc_html__( 'Monday   ', 'mage-support-online '),
							'tue' => esc_html__( 'Tuesday', 'mage-support-online '),
							'wed' => esc_html__( 'Wednesday', 'mage-support-online '),
							'thu' => esc_html__( 'Thursday', 'mage-support-online '),
							'fri' => esc_html__( 'Friday', 'mage-support-online '),
						)
					),

					array(
						'name'  => 'so_start_time',
						'label' => __( 'Enter start time', 'mage-support-online '),
						'type'  => 'text',
						'desc'  => esc_html__( 'Please enter support start time. Ex: 9.00 AM', 'mage-support-online '),

					),

					array(
						'name'  => 'so_end_time',
						'label' => __( 'Enter end time', 'mage-support-online '),
						'type'  => 'text',
						'desc'  => esc_html__( 'Please enter support end time.Ex: 6.00 PM', 'mage-support-online '),
					),

				),
			);

			return $settings_fields;
		}//end method get_settings_field

		function display_options_page() {
			echo '<div class="wrap">';

			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();

			echo '</div>';
		}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		function get_pages() {
			$pages         = get_pages();
			$pages_options = array();
			if ( $pages ) {
				foreach ( $pages as $page ) {
					$pages_options[ $page->ID ] = $page->post_title;
				}
			}

			return $pages_options;
		}

	}//end class MAGESO_Support_Online_Setting_Controls
}//end class exist block

$settings = new MAGESO_Support_Online_Setting_Controls();


function mageso_get_option( $option, $section, $default = '' ) {
	$options = get_option( $section );

	if ( isset( $options[ $option ] ) ) {
		return $options[ $option ];
	}

	return $default;
}
