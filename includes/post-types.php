<?php

/**
 * Functions Related To Post Types
 * @package PE
 * @subpackage Functions
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Post Types
 * 
 * @since 1.0.0
 * @return void
 */
function pe_setup_post_types(){
    $archives = true;
    $slug = '';
}
add_action('init', 'pe_setup_post_types', 1);