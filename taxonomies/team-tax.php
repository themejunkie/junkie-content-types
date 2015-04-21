<?php
/**
 * Teams taxonomy.
 * Register 'position' taxonomy.
 */

/**
 * Register the taxonomy.
 */
function junkie_types_register_position_tax() {

	$labels = array(
		'name'              => esc_html__( 'Position',          'junkie-types' ),
		'singular_name'     => esc_html__( 'Position',          'junkie-types' ),
		'menu_name'         => esc_html__( 'Position',          'junkie-types' ),
		'all_items'         => esc_html__( 'All Position',      'junkie-types' ),
		'edit_item'         => esc_html__( 'Edit Position',     'junkie-types' ),
		'view_item'         => esc_html__( 'View Position',     'junkie-types' ),
		'update_item'       => esc_html__( 'Update Position',   'junkie-types' ),
		'add_new_item'      => esc_html__( 'Add New Position',  'junkie-types' ),
		'new_item_name'     => esc_html__( 'New Position Name', 'junkie-types' ),
		'parent_item'       => esc_html__( 'Parent Position',   'junkie-types' ),
		'parent_item_colon' => esc_html__( 'Parent Position:',  'junkie-types' ),
		'search_items'      => esc_html__( 'Search Position',   'junkie-types' ),
	);

	$args = array(
		'labels'            => apply_filters( 'junkie_types_position_tax_labesl', $labels ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'position' ),
	);

	register_taxonomy( 'position', 'team', apply_filters( 'junkie_types_position_tax_args', $args ) );

}
add_action( 'init', 'junkie_types_register_position_tax' );