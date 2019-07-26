<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 * @author     MagePeople team <magepeopleteam@gmail.com>
 */
if ( ! class_exists( "MAGESO_Support_Online_Public" ) ) {
	class MAGESO_Support_Online_Public {

		private $plugin_name;

		private $version;

		public function __construct() {
			$this->load_public_dependencies();
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		private function load_public_dependencies() {
			require_once MAGESO_SUPPORT_ONLINE_DIR . 'public/shortcode/shortcode.php';
		}

		public function enqueue_styles() {
			wp_enqueue_style( 'mageso-public-css', MAGESO_SUPPORT_PLUGIN_URL . 'public/css/style.css', array(), time(), 'all' );
		}
		public function enqueue_scripts() {

			$scripts = array(
				array(
					'handle'     => 'so-public-js',
					'src'        => MAGESO_SUPPORT_PLUGIN_URL . 'public/js/support-online-public.js',
					'dependency' => array( 'jquery' ),
					'vertion'    => time(),
					'in_footer'  => true
				),
			);

			foreach ( $scripts as $script ) {
				wp_enqueue_script( $script['handle'], $script['src'], $script['dependency'][0], $script['vertion'], $script['in_footer'] );
			}


		}


	}//end class MAGESO_Support_Online_Public
}//end class block exist

new MAGESO_Support_Online_Public();