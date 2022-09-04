<?php

/**
 * Plugin Name:       Pharmalys Essential
 * Plugin URI:        https://reza-khan.com/pharmalys/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            Reza Khan
 * Author URI:        https://reza-khan.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pharmalys-essential
 * Domain Path:       /languages

 * Pharmalys Essential is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.

 * Pharmalys Essential is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Pharmalys Essential. If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
/**
 * The Main Plugin Requirements Checker
 *
 * @since 1.0.0
 */
final class Pharmalys_Essential {

    /**
     * Requirements Array
     *
     * @since 1.0.0
     * @var array
     */
    private $requirements = [
        'php' => [
            'name'    => 'PHP',
            'minimum' => '7.3',
            'exists'  => true,
            'met'     => false,
            'checked' => false,
            'current' => false,
        ],
        'wp'  => [
            'name'    => 'WordPress',
            'minimum' => '5.2',
            'exists'  => true,
            'checked' => false,
            'met'     => false,
            'current' => false,
        ],
    ];

    /**
     * Setup Plugin Requirements
     *
     * @since 1.0.0
     *
     */
    public function __construct() {
        // Always load translation
        add_action( 'plugins_loaded', [$this, 'load_text_domain'] );

        // Initialize plugin functionalities or quit
        $this->requirements_met() ? $this->initialize_modules() : $this->quit();
    }

    /**
     * Plugin Current Production Version
     *
     * @return string
     */
    public static function get_version() {
        return '1.0.0';
    }

    public static function get_assets_path() {
        return trailingslashit( self::get_plugin_path() . 'assets' );
    }

    public static function get_assets_url() {
        return trailingslashit( self::get_plugin_url() . 'assets' );
    }

    public static function get_plugin_path() {
        return trailingslashit( plugin_dir_path( self::get_plugin_file() ) );
    }

    public static function get_plugin_url() {
        return trailingslashit( plugin_dir_url( self::get_plugin_file() ) );
    }

    public static function get_plugin_basename() {
        return plugin_basename( self::get_plugin_file() );
    }

    public static function get_plugin_file() {
        return __FILE__;
    }

    /**
     * Load Localization Files
     *
     * @since 1.0
     * @return void
     */
    public function load_text_domain() {
        $locale = apply_filters( 'plugin_locale', get_user_locale(), 'pharmalys-essential' );

        unload_textdomain( 'pharmalys-essential' );
        load_textdomain( 'pharmalys-essential', WP_LANG_DIR . '/pharmalys-essential/pharmalys-essential-' . $locale . '.mo' );
        load_plugin_textdomain( 'pharmalys-essential', false, self::get_plugin_path() . 'languages/' );
    }

    /**
     * Check If All Requirements Are Fulfilled
     *
     * @return boolean
     */
    private function requirements_met() {
        $this->prepare_requirement_versions();

        $result  = true;
        $to_meet = wp_list_pluck( $this->requirements, 'met' );

        foreach ( $to_meet as $met ) {

            if ( empty( $met ) ) {
                $result = false;
                continue;
            }

        }

        return $result;

    }

    /**
     * Requirement Version Prepare
     *
     * @since 1.0.0
     *
     * @return void
     */
    private function prepare_requirement_versions() {

        foreach ( $this->requirements as $dependency => $config ) {

            switch ( $dependency ) {
            case 'php':
                $version = phpversion();
                break;
            case 'wp':
                $version = get_bloginfo( 'version' );
                break;
            default:
                $version = false;
            }

            if ( !empty( $version ) ) {
                $this->requirements[$dependency] = array_merge(
                    $this->requirements[$dependency],
                    [
                        'current' => $version,
                        'checked' => true,
                        'met'     => version_compare( $version, $config['minimum'], '>=' ),
                    ]
                );
            }

        }

    }

    /**
     * Initialize Plugin Modules
     *
     * @since 1.0.0
     * @return void
     */
    private function initialize_modules() {

    }

    /**
     * Quit Plugin Execution
     *
     * @return void
     */
    private function quit() {
        add_action( 'admin_head', [$this, 'show_plugin_requirements_not_met_notice'] );
    }

    /**
     * Show Error Notice For Missing Requirements
     *
     * @return void
     */
    public function show_plugin_requirements_not_met_notice() {
        printf( '<div>Minimum requirements for %1$s are not met. Please update requirements to continue.</div>', esc_html( 'Pharmalys Essential' ) );
    }

}

new Pharmalys_Essential();