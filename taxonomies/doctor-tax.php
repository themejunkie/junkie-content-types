<?php
/**
 * Doctors taxonomy.
 * Register 'department' taxonomy.
 */

/**
 * Register the taxonomy.
 */
function junkie_types_register_department_tax() {

	$labels = array(
		'name'              => esc_html__( 'Departments',          'junkie-types' ),
		'singular_name'     => esc_html__( 'Department',           'junkie-types' ),
		'menu_name'         => esc_html__( 'Departments',          'junkie-types' ),
		'all_items'         => esc_html__( 'All Departments',      'junkie-types' ),
		'edit_item'         => esc_html__( 'Edit Department',      'junkie-types' ),
		'view_item'         => esc_html__( 'View Departments',     'junkie-types' ),
		'update_item'       => esc_html__( 'Update Department',    'junkie-types' ),
		'add_new_item'      => esc_html__( 'Add New Department',   'junkie-types' ),
		'new_item_name'     => esc_html__( 'New Department Name',  'junkie-types' ),
		'parent_item'       => esc_html__( 'Parent Department',    'junkie-types' ),
		'parent_item_colon' => esc_html__( 'Parent Department:',   'junkie-types' ),
		'search_items'      => esc_html__( 'Search Departments',   'junkie-types' ),
	);

	$args = array(
		'labels'            => apply_filters( 'junkie_types_department_tax_labesl', $labels ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'department' ),
	);

	register_taxonomy( 'department', 'doctor', apply_filters( 'junkie_types_department_tax_args', $args ) );

}
add_action( 'init', 'junkie_types_register_department_tax' );