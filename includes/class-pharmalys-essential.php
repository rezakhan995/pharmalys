<?php

defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'Pharmalys_Essential' ) ) {

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
            if (  ( null !== self::$instance ) && ( self::$instance instanceof Pharmalys_Essential ) ) {
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
            self::$instance       = new self();
            self::$instance->file = $file;
        }

        /**
         * Assets Directory URL
         *
         * @since 1.0.0
         * @return void
         */
        public function get_assets_url(){
            return trailingslashit( PE_PLUGIN_URL . 'assets' );
        }

        /**
         * Assets Directory Path
         *
         * @since 1.0.0
         * @return void
         */
        public function get_assets_dir(){
            return trailingslashit( PE_PLUGIN_DIR . 'assets' );
        }

        /**
         * Plugin Directory URL
         *
         * @return void
         */
        public function get_plugin_url(){
            return trailingslashit( plugin_dir_url( PE_PLUGIN_FILE ) );
        }

        /**
         * Plugin Directory Path
         *
         * @return void
         */
        public function get_plugin_dir(){
            return Pharmalys_Essential_Prepare::get_plugin_dir();
        }

        /**
         * Plugin Basename
         *
         * @return void
         */
        public function get_plugin_basename(){
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
            if ( !defined( 'PE_VERSION' ) ) {
                define( 'PE_VERSION', Pharmalys_Essential_Prepare::get_version() );
            }

            //  Plugin Main File
            if ( !defined( 'PE_PLUGIN_FILE' ) ) {
                define( 'PE_PLUGIN_FILE', $this->file );
            }

            // Plugin File Basename
            if ( !defined( 'PE_PLUGIN_BASE' ) ) {
                define( 'PE_PLUGIN_BASE', $this->get_plugin_basename() );
            }

            // Plugin Main Directory Path
            if ( !defined( 'PE_PLUGIN_DIR' ) ) {
                define( 'PE_PLUGIN_DIR', $this->get_plugin_dir() );
            }

            // Plugin Main Directory URL
            if ( !defined( 'PE_PLUGIN_URL' ) ) {
                define( 'PE_PLUGIN_URL', $this->get_plugin_url() );
            }

            // Plugin Assets Directory URL
            if ( !defined( 'PE_ASSETS_URL' ) ) {
                define( 'PE_ASSETS_URL', $this->get_assets_url() );
            }

            // Plugin Assets Directory Path
            if ( !defined( 'PE_ASSETS_DIR' ) ) {
                define( 'PE_ASSETS_DIR', $this->get_assets_dir() );
            }

        }

        /**
         * Define DB Tables Required For This Plugin
         *
         * @since 1.0.0
         * @return void
         */
        private function define_tables(){

        }

        /**
         * Include All Required Files
         *
         * @since 1.0.0
         * @return void
         */
        private function include_files() {

        }

        /**
         * Initialize All Hooks
         * 
         * @since 1.0.0
         * @return void
         */
        private function initialize_hooks(){

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
