<?php
// Cannot access pages directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * 2AM Awesome loginbar Settings Controls
 *
 * @version 1.0
 *
 */
if ( ! class_exists( 'Support_Online_Setting_Controls' ) ) {
	class Support_Online_Setting_Controls {

		private $settings_api;

		function __construct() {
			$this->settings_api = new Support_Online_Setting_API;

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
				esc_html__( 'Support Online', SUPPORT_ONLINE_TEXTDOMAIN ),
				esc_html__( 'Support Online', SUPPORT_ONLINE_TEXTDOMAIN ),
				'manage_options',
				'mage-plugin_settings_page',
				array( $this, 'display_options_page' )
			);
		}

		function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'general_setting_sec',
					'title' => __( 'Working Hours', SUPPORT_ONLINE_TEXTDOMAIN )
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
						'label'   => __( 'Select working days', SUPPORT_ONLINE_TEXTDOMAIN ),
						'type'    => 'multicheck',
						'options' => array(
							'sat' => esc_html__( 'Saturday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'sun' => esc_html__( 'Sunday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'mon' => esc_html__( 'Monday   ', SUPPORT_ONLINE_TEXTDOMAIN ),
							'tue' => esc_html__( 'Tuesday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'wed' => esc_html__( 'Wednesday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'thu' => esc_html__( 'Thursday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'fri' => esc_html__( 'Friday', SUPPORT_ONLINE_TEXTDOMAIN ),
						)
					),

					array(
						'name'    => 'so_off_day',
						'label'   => __( 'Select off days', SUPPORT_ONLINE_TEXTDOMAIN ),
						'type'    => 'multicheck',
						'options' => array(
							'sat' => esc_html__( 'Saturday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'sun' => esc_html__( 'Sunday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'mon' => esc_html__( 'Monday   ', SUPPORT_ONLINE_TEXTDOMAIN ),
							'tue' => esc_html__( 'Tuesday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'wed' => esc_html__( 'Wednesday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'thu' => esc_html__( 'Thursday', SUPPORT_ONLINE_TEXTDOMAIN ),
							'fri' => esc_html__( 'Friday', SUPPORT_ONLINE_TEXTDOMAIN ),
						)
					),

					array(
						'name'  => 'so_start_time',
						'label' => __( 'Enter start time', SUPPORT_ONLINE_TEXTDOMAIN ),
						'type'  => 'text',
						'desc'  => esc_html__( 'Please enter support start time. Ex: 9.00 AM', SUPPORT_ONLINE_TEXTDOMAIN ),

					),

					array(
						'name'  => 'so_end_time',
						'label' => __( 'Enter end time', SUPPORT_ONLINE_TEXTDOMAIN ),
						'type'  => 'text',
						'desc'  => esc_html__( 'Please enter support end time.Ex: 6.00 PM', SUPPORT_ONLINE_TEXTDOMAIN ),
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

	}//end class Support_Online_Setting_Controls
}//end class exist block

$settings = new Support_Online_Setting_Controls();


function so_get_option( $option, $section, $default = '' ) {
	$options = get_option( $section );

	if ( isset( $options[ $option ] ) ) {
		return $options[ $option ];
	}

	return $default;
}
