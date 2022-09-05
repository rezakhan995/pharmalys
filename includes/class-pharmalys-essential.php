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
            self::$instance->initialize_modules();

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
                define( 'PE_PLUGIN_BASE', plugin_basename( PE_PLUGIN_FILE ) );
            }

            // Plugin Main Directory Path
            if ( !defined( 'PE_PLUGIN_DIR' ) ) {
                define( 'PE_PLUGIN_DIR', Pharmalys_Essential_Prepare::get_plugin_dir() );
            }

            // Plugin Main Directory URL
            if ( !defined( 'PE_PLUGIN_URL' ) ) {
                define( 'PE_PLUGIN_URL', trailingslashit( plugin_dir_url( PE_PLUGIN_FILE ) ) );
            }

            // Plugin Assets Directory URL
            if ( !defined( 'PE_ASSETS_URL' ) ) {
                define( 'PE_ASSETS_URL', trailingslashit( PE_PLUGIN_URL . 'assets' ) );
            }

            // Plugin Assets Directory Path
            if ( !defined( 'PE_ASSETS_DIR' ) ) {
                define( 'PE_ASSETS_DIR', trailingslashit( PE_PLUGIN_DIR . 'assets' ) );
            }

        }

        /**
         * Include All Required Files
         *
         * @since 1.0.0
         * @return void
         */
        private function initialize_modules(){

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

}
