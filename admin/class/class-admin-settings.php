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
				esc_html__( 'Support Online', 'mage-support-online ' ),
				esc_html__( 'Support Online', 'mage-support-online ' ),
				'manage_options',
				'mage-plugin_settings_page',
				array( $this, 'display_options_page' )
			);
		}

		function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'general_setting_sec',
					'title' => __( 'Working Hours', 'mage-support-online ' )
				),
				array(
					'id'    => 'general_setting_section_timepicker',
					'title' => __( 'Style & Colors', 'mage-support-online ' )
				),
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

				'general_setting_sec'                => array(

					array(
						'name'    => 'so_working_day',
						'label'   => __( 'Select working days', 'mage-support-online ' ),
						'type'    => 'multicheck',
						'options' => array(
							'sat' => esc_html__( 'Saturday', 'mage-support-online ' ),
							'sun' => esc_html__( 'Sunday', 'mage-support-online ' ),
							'mon' => esc_html__( 'Monday   ', 'mage-support-online ' ),
							'tue' => esc_html__( 'Tuesday', 'mage-support-online ' ),
							'wed' => esc_html__( 'Wednesday', 'mage-support-online ' ),
							'thu' => esc_html__( 'Thursday', 'mage-support-online ' ),
							'fri' => esc_html__( 'Friday', 'mage-support-online ' ),
						)
					),

					array(
						'name'    => 'so_off_day',
						'label'   => __( 'Select off days', 'mage-support-online ' ),
						'type'    => 'multicheck',
						'options' => array(
							'sat' => esc_html__( 'Saturday', 'mage-support-online ' ),
							'sun' => esc_html__( 'Sunday', 'mage-support-online ' ),
							'mon' => esc_html__( 'Monday   ', 'mage-support-online ' ),
							'tue' => esc_html__( 'Tuesday', 'mage-support-online ' ),
							'wed' => esc_html__( 'Wednesday', 'mage-support-online ' ),
							'thu' => esc_html__( 'Thursday', 'mage-support-online ' ),
							'fri' => esc_html__( 'Friday', 'mage-support-online ' ),
						)
					),

					array(
						'name'  => 'so_start_time',
						'label' => __( 'Enter start time', 'mage-support-online ' ),
						'type'  => 'timepicker',
						'desc'  => esc_html__( 'Please enter support start time. Ex: 9.00 AM', 'mage-support-online ' ),

					),

					array(
						'name'  => 'so_end_time',
						'label' => __( 'Enter end time', 'mage-support-online ' ),
						'type'  => 'timepicker',
						'desc'  => esc_html__( 'Please enter support end time.Ex: 6.00 PM', 'mage-support-online ' ),
					),

					// start week day
					array(
						'name'    => 'start_weekday',
						'label'   => __( 'Enter start weekday', 'mage-support-online ' ),
						'type'    => 'select',
						'desc'    => esc_html__( 'Ex : sunday', 'mage-support-online ' ),
						'default' => __( 'Sunday', 'mage-support-online ' ),
						'options' => array(
							'sat' => esc_html__( 'Saturday', 'mage-support-online ' ),
							'sun' => esc_html__( 'Sunday', 'mage-support-online ' ),
							'mon' => esc_html__( 'Monday   ', 'mage-support-online ' ),
							'tue' => esc_html__( 'Tuesday', 'mage-support-online ' ),
							'wed' => esc_html__( 'Wednesday', 'mage-support-online ' ),
							'thu' => esc_html__( 'Thursday', 'mage-support-online ' ),
							'fri' => esc_html__( 'Friday', 'mage-support-online ' ),
						)
					),

					// end week day
					array(
						'name'    => 'end_weekday',
						'label'   => __( 'Enter end weekday', 'mage-support-online ' ),
						'type'    => 'select',
						'default' => __( 'Thesday', 'mage-support-online ' ),
						'options' => array(
							'sat' => esc_html__( 'Saturday', 'mage-support-online ' ),
							'sun' => esc_html__( 'Sunday', 'mage-support-online ' ),
							'mon' => esc_html__( 'Monday   ', 'mage-support-online ' ),
							'tue' => esc_html__( 'Tuesday', 'mage-support-online ' ),
							'wed' => esc_html__( 'Wednesday', 'mage-support-online ' ),
							'thu' => esc_html__( 'Thursday', 'mage-support-online ' ),
							'fri' => esc_html__( 'Friday', 'mage-support-online ' ),
						)
					),
				),
				'general_setting_section_timepicker' => array(
					//  online sections
					array(
						'name'    => 'online_color_sections',
						'desc'    => __( 'Select your text color', 'mage-support-online' ),
						'type'    => 'sections',
						'default' => 'Online'
					),

					// border color
					array(
						'name'    => 'border_color',
						'label'   => __( 'Online Border color', 'mage-support-online' ),
						'desc'    => __( 'Select your online border color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => ''
					),

					// background color
					array(
						'name'    => 'background_color',
						'label'   => __( 'Online Background color', 'mage-support-online' ),
						'desc'    => __( 'Select your online background color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => ''
					),

					//  text color
					array(
						'name'    => 'text_color',
						'label'   => __( 'Online Text color', 'mage-support-online' ),
						'desc'    => __( 'Select your online text color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => ''
					),

					//  offline sections
					array(
						'name'    => 'offline_color_sections',
						'desc'    => __( 'Select your offline text color', 'mage-support-online' ),
						'type'    => 'sections',
						'default' => 'Offline'
					),

					// border color
					array(
						'name'    => 'offline_border_color',
						'label'   => __( 'Offline Border color', 'mage-support-online' ),
						'desc'    => __( 'Select your offline border color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => ''
					),

					// background color
					array(
						'name'    => 'offline_background_color',
						'label'   => __( 'Offline Background color', 'mage-support-online' ),
						'desc'    => __( 'Select your offline background color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => ''
					),

					//  text color
					array(
						'name'    => 'offline_text_color',
						'label'   => __( 'Offline Text color', 'mage-support-online' ),
						'desc'    => __( 'Select your offline text color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => ''
					),
					//  online sections
					array(
						'name'    => 'online_clock_sections',
						'desc'    => __( 'Select your text color', 'mage-support-online' ),
						'type'    => 'sections',
						'default' => 'Your & Our Time Section'
					),
					// background color
					array(
						'name'    => 'clock_background_color',
						'label'   => __( 'Background color', 'mage-support-online' ),
						'desc'    => __( 'Please Select background color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => '#000000'
					),

					//  text color
					array(
						'name'    => 'clock_text_color',
						'label'   => __( 'Text color', 'mage-support-online' ),
						'desc'    => __( 'Please Select text color', 'mage-support-online' ),
						'type'    => 'color',
						'default' => '#fff'
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

	if ( isset( $options[ $option ] ) && !empty($options[ $option ])) {
		return $options[ $option ];
	}

	return $default;
}
