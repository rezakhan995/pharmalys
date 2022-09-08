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
function pe_setup_post_types() {
    $archives = true;
    $slug     = 'pe-products';
    $rewrite  = [
        'slug'       => $slug,
        'with_front' => true,
        'pages'      => true,
        'feeds'      => false,
    ];

    /** Register Product Post Type */
    $product_labels = apply_filters( 'pe_product_labels', [
        'name'                  => _x( '%2$s', 'product post type name', 'pharmalys-essential' ),
        'singular_name'         => _x( '%1$s', 'singular product post type name', 'pharmalys-essential' ),
        'add_new'               => __( 'Add New', 'pharmalys-essential' ),
        'add_new_item'          => __( 'Add New %1$s', 'pharmalys-essential' ),
        'edit_item'             => __( 'Edit %1$s', 'pharmalys-essential' ),
        'new_item'              => __( 'New %1$s', 'pharmalys-essential' ),
        'all_items'             => __( '%2$s', 'pharmalys-essential' ),
        'view_item'             => __( 'View %1$s', 'pharmalys-essential' ),
        'search_items'          => __( 'Search %2$s', 'pharmalys-essential' ),
        'not_found'             => __( 'No %2$s found', 'pharmalys-essential' ),
        'not_found_in_trash'    => __( 'No %2$s found in Trash', 'pharmalys-essential' ),
        'parent_item_colon'     => '',
        'menu_name'             => _x( '%2$s', 'product post type menu name', 'pharmalys-essential' ),
        'featured_image'        => __( '%1$s Image', 'pharmalys-essential' ),
        'set_featured_image'    => __( 'Set %1$s Image', 'pharmalys-essential' ),
        'remove_featured_image' => __( 'Remove %1$s Image', 'pharmalys-essential' ),
        'use_featured_image'    => __( 'Use as %1$s Image', 'pharmalys-essential' ),
        'attributes'            => __( '%1$s Attributes', 'pharmalys-essential' ),
        'filter_items_list'     => __( 'Filter %2$s list', 'pharmalys-essential' ),
        'items_list_navigation' => __( '%2$s list navigation', 'pharmalys-essential' ),
        'items_list'            => __( '%2$s list', 'pharmalys-essential' ),
    ] );

    foreach ( $product_labels as $key => $value ) {
        $product_labels[$key] = sprintf( $value, pe_get_label_singular( 'product' ), pe_get_label_plural( 'product' ) );
    }

    $product_args = [
        'labels'             => $product_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-archive',
        'rewrite'            => $rewrite,
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        'has_archive'        => $archives,
        'hierarchical'       => false,
        'show_in_rest'       => true,
        'rest_base'          => 'pe-products',
        'show_in_menu'       => 'pharmalys-essential',
        'supports'           => apply_filters( 'pe_product_supports', ['title', 'editor', 'thumbnail', 'revisions', 'author'] ),
    ];
    register_post_type( 'pe-product', apply_filters( 'pe_product_post_type_args', $product_args ) );

    /** Register Product Post Type */
    $story_labels = apply_filters( 'pe_story_labels', [
        'name'                  => _x( '%2$s', 'story post type name', 'pharmalys-essential' ),
        'singular_name'         => _x( '%1$s', 'singular story post type name', 'pharmalys-essential' ),
        'add_new'               => __( 'Add New', 'pharmalys-essential' ),
        'add_new_item'          => __( 'Add New %1$s', 'pharmalys-essential' ),
        'edit_item'             => __( 'Edit %1$s', 'pharmalys-essential' ),
        'new_item'              => __( 'New %1$s', 'pharmalys-essential' ),
        'all_items'             => __( '%2$s', 'pharmalys-essential' ),
        'view_item'             => __( 'View %1$s', 'pharmalys-essential' ),
        'search_items'          => __( 'Search %2$s', 'pharmalys-essential' ),
        'not_found'             => __( 'No %2$s found', 'pharmalys-essential' ),
        'not_found_in_trash'    => __( 'No %2$s found in Trash', 'pharmalys-essential' ),
        'parent_item_colon'     => '',
        'menu_name'             => _x( '%2$s', 'story post type menu name', 'pharmalys-essential' ),
        'featured_image'        => __( '%1$s Image', 'pharmalys-essential' ),
        'set_featured_image'    => __( 'Set %1$s Image', 'pharmalys-essential' ),
        'remove_featured_image' => __( 'Remove %1$s Image', 'pharmalys-essential' ),
        'use_featured_image'    => __( 'Use as %1$s Image', 'pharmalys-essential' ),
        'attributes'            => __( '%1$s Attributes', 'pharmalys-essential' ),
        'filter_items_list'     => __( 'Filter %2$s list', 'pharmalys-essential' ),
        'items_list_navigation' => __( '%2$s list navigation', 'pharmalys-essential' ),
        'items_list'            => __( '%2$s list', 'pharmalys-essential' ),
    ] );

    foreach ( $story_labels as $key => $value ) {
        $story_labels[$key] = sprintf( $value, pe_get_label_singular( 'story' ), pe_get_label_plural( 'story' ) );
    }

    $story_args = [
        'labels'             => apply_filters( 'pe_story_labels', $story_labels ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-edit-page',
        'rewrite'            => $rewrite,
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        'has_archive'        => $archives,
        'hierarchical'       => false,
        'show_in_rest'       => true,
        'rest_base'          => 'pe-stories',
        'show_in_menu'       => 'pharmalys-essential',
        'supports'           => apply_filters( 'pe_story_supports', ['title', 'editor', 'thumbnail', 'revisions', 'author'] ),
    ];
    register_post_type( 'pe-story', apply_filters( 'pe_story_post_type_args', $story_args ) );
}
add_action( 'init', 'pe_setup_post_types', 1 );

/**
 * Labels For All CPT's
 *
 * @param [type] $term
 * @return void
 */
function pe_get_default_product_labels( $term ) {

    $labels = [];

    switch ( $term ) {
    case 'product':
        $labels = [
            'singular' => __( 'Product', 'pharmalys-essential' ),
            'plural'   => __( 'Products', 'pharmalys-essential' ),
        ];
        break;
    case 'story':
        $labels = [
            'singular' => __( 'Story', 'pharmalys-essential' ),
            'plural'   => __( 'Stories', 'pharmalys-essential' ),
        ];
        break;
    }

    return $labels;
}

/**
 * Singular Label For CPT
 *
 * @since 1.0.0
 * @param [type] $term
 * @param boolean $lowercase
 * @return void
 */
function pe_get_label_singular( $term, $lowercase = false ) {
    $defaults = pe_get_default_product_labels( $term );
    return $lowercase ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

/**
 * Plural Label For CPT
 *
 * @since 1.0.0
 * @param [type] $term
 * @param boolean $lowercase
 * @return void
 */
function pe_get_label_plural( $term, $lowercase = false ) {
    $defaults = pe_get_default_product_labels( $term );
    return $lowercase ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

/**
 * Registers Main Menu For 
 *
 * @since 1.0.0
 * @return void
 */
function pe_add_main_menu_page(){
    add_action('admin_menu', function(){
        add_menu_page(
            __('Pharmalys', 'pharmalys-essential'),
            __('Pharmalys', 'pharmalys-essential'),
            'read',
            'pharmalys-essential',
            '',
            'dashicons-store',
            10
        );
    } );
}
add_action('init', 'pe_add_main_menu_page', 0);