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
         * @var The actual Pharmalys_Essential instance
         * @since 1.0.0
         */
        private static $instance;

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

    }

}
