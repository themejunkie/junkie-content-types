<?php
/**
 * Doctors taxonomy.
 * Register 'speciality' taxonomy.
 */

/**
 * Register the taxonomy.
 */
function junkie_types_register_speciality_tax() {

	$labels = array(
		'name'              => esc_html__( 'Specialities',          'junkie-types' ),
		'singular_name'     => esc_html__( 'Speciality',            'junkie-types' ),
		'menu_name'         => esc_html__( 'Specialities',          'junkie-types' ),
		'all_items'         => esc_html__( 'All Specialities',      'junkie-types' ),
		'edit_item'         => esc_html__( 'Edit Speciality',       'junkie-types' ),
		'view_item'         => esc_html__( 'View Specialities',     'junkie-types' ),
		'update_item'       => esc_html__( 'Update Speciality',     'junkie-types' ),
		'add_new_item'      => esc_html__( 'Add New Speciality',    'junkie-types' ),
		'new_item_name'     => esc_html__( 'New Speciality Name',   'junkie-types' ),
		'parent_item'       => esc_html__( 'Parent Speciality',     'junkie-types' ),
		'parent_item_colon' => esc_html__( 'Parent Speciality:',    'junkie-types' ),
		'search_items'      => esc_html__( 'Search Specialities',   'junkie-types' ),
	);

	$args = array(
		'labels'            => apply_filters( 'junkie_types_speciality_tax_labesl', $labels ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'speciality' ),
	);

	register_taxonomy( 'speciality', 'doctor', apply_filters( 'junkie_types_speciality_tax_args', $args ) );

}
add_action( 'init', 'junkie_types_register_speciality_tax' );