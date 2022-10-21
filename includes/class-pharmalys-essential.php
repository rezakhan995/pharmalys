<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Pharmalys_Essential' ) ) {

	/**
	 * Pharmalys_Essential class.
	 *
	 * @since 1.0.0
	 */
	final class Pharmalys_Essential {

		/**
		 * @var Pharmalys_Essential The Actual Pharmalys_Essential instance
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Main File
		 */
		private $file = '';

		/**
		 * Throw Error While Trying To Clone Object
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.', 'pharmalys-essential' ), '1.0.0' );
		}

		/**
		 * Disabling Un-serialization Of This Class
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'pharmalys-essential' ), '1.0.0' );
		}

		/**
		 * The actual Pharmalys_Essential instance
		 *
		 * @since 1.0.0
		 * @param string $file
		 * @return void
		 */
		public static function instantiate( $file = '' ) {

			// Return if already instantiated
			if ( self::instantiated() ) {
				return self::$instance;
			}

			self::prepare_instance( $file );

			self::$instance->initialize_constants();
			self::$instance->define_tables();
			self::$instance->include_files();
			self::$instance->initialize_hooks();

			return self::$instance;

		}

		/**
		 * Return If The Main Class has Already Been Instantiated Or Not
		 *
		 * @since 1.0.0
		 * @return boolean
		 */
		private static function instantiated() {
			if ( ( null !== self::$instance ) && ( self::$instance instanceof Pharmalys_Essential ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Prepare Singleton Instance
		 *
		 * @since 1.0.0
		 * @param string $file
		 * @return void
		 */
		private static function prepare_instance( $file = '' ) {
			self::$instance          = new self();
			self::$instance->file    = $file;
			self::$instance->version = Pharmalys_Essential_Prepare::get_version();
		}

		/**
		 * Assets Directory URL
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function get_assets_url() {
			return trailingslashit( PE_PLUGIN_URL . 'assets' );
		}

		/**
		 * Assets Directory Path
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function get_assets_dir() {
			return trailingslashit( PE_PLUGIN_DIR . 'assets' );
		}

		/**
		 * Plugin Directory URL
		 *
		 * @return void
		 */
		public function get_plugin_url() {
			return trailingslashit( plugin_dir_url( PE_PLUGIN_FILE ) );
		}

		/**
		 * Plugin Directory Path
		 *
		 * @return void
		 */
		public function get_plugin_dir() {
			return Pharmalys_Essential_Prepare::get_plugin_dir();
		}

		/**
		 * Plugin Basename
		 *
		 * @return void
		 */
		public function get_plugin_basename() {
			return plugin_basename( PE_PLUGIN_FILE );
		}

		/**
		 * Setup Plugin Constants
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function initialize_constants() {

			// Plugin Version
			self::$instance->define( 'PE_VERSION', Pharmalys_Essential_Prepare::get_version() );

			// Plugin Main File
			self::$instance->define( 'PE_PLUGIN_FILE', $this->file );

			// Plugin File Basename
			self::$instance->define( 'PE_PLUGIN_BASE', $this->get_plugin_basename() );

			// Plugin Main Directory Path
			self::$instance->define( 'PE_PLUGIN_DIR', $this->get_plugin_dir() );

			// Plugin Main Directory URL
			self::$instance->define( 'PE_PLUGIN_URL', $this->get_plugin_url() );

			// Plugin Assets Directory URL
			self::$instance->define( 'PE_ASSETS_URL', $this->get_assets_url() );

			// Plugin Assets Directory Path
			self::$instance->define( 'PE_ASSETS_DIR', $this->get_assets_dir() );

		}
		/**
		 * Define constant if not already set.
		 *
		 * @since 1.0.0
		 * @param string      $name  Constant name.
		 * @param string|bool $value Constant value.
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}


		/**
		 * Define DB Tables Required For This Plugin
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function define_tables() {
			// To Be Implemented
		}

		/**
		 * Include All Required Files
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function include_files() {
			require_once PE_PLUGIN_DIR . 'includes/post-types.php';
			require_once PE_PLUGIN_DIR . 'includes/widgets/manifest.php';
			require_once PE_PLUGIN_DIR . 'includes/template-functions.php';
			require_once PE_PLUGIN_DIR . 'includes/shortcodes.php';
			require_once PE_PLUGIN_DIR . 'includes/install.php';
		}

		/**
		 * Initialize All Hooks
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function initialize_hooks() {
			// To be Implemented
		}
	}

}

/**
 * Returns The Instance Of Pharmalys_Essential.
 * The main function that is responsible for returning Pharmalys_Essential instance.
 *
 * @since 1.0.0
 * @return Pharmalys_Essential
 */
function PE() {
	return Pharmalys_Essential::instantiate();
}
