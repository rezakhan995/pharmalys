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
 * The Main Plugin Requirements Chekcer
 *
 * @since 1.0.0
 */
final class Pharmalys_Essential {

    public function __construct() {
        // Always load translation
        add_action( 'plugins_loaded', [$this, 'load_text_domain'] );
    }

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
     * @return void
     */
    public function load_text_domain() {
        $locale = apply_filters( 'plugin_locale', get_user_locale(), 'pharmalys-essential' );
        
        unload_textdomain( 'pharmalys-essential' );
        load_textdomain( 'pharmalys-essential', WP_LANG_DIR . '/pharmalys-essential/pharmalys-essential-' . $locale . '.mo' );
        load_plugin_textdomain( 'pharmalys-essential', false, self::get_plugin_path() . 'languages/' );
    }
}

new Pharmalys_Essential();